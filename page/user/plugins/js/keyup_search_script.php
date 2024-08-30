<script type="text/javascript">
    // AJAX IN PROGRESS GLOBAL VARS
    var search_accounts_ajax_in_progress = false;

    // DOMContentLoaded function
	document.addEventListener("DOMContentLoaded", () => {
        search_accounts(1);
    });

    var typingTimerEmployeeNoSearch; // Timer identifier Employee No Search
    var doneTypingInterval = 250; // Time in ms

    // On keyup, start the countdown
    document.getElementById("employee_no_search").addEventListener('keyup', e => {
        clearTimeout(typingTimerEmployeeNoSearch);
        typingTimerEmployeeNoSearch = setTimeout(doneTypingSearchAccounts, doneTypingInterval);
    });

    // On keydown, clear the countdown
    document.getElementById("employee_no_search").addEventListener('keydown', e => {
        clearTimeout(typingTimerEmployeeNoSearch);
    });

    // User is "finished typing," do something
    function doneTypingSearchAccounts() {
        search_accounts(1);
    }

    const get_next_page = () => {
        var current_page = parseInt(sessionStorage.getItem('accounts_table_pagination'));
        let total = sessionStorage.getItem('count_rows');
        var last_page = parseInt(sessionStorage.getItem('last_page'));
        var next_page = current_page + 1;
        if (next_page <= last_page && total > 0) {
            search_accounts(next_page);
        }
    }

    const count_accounts = () => {
        var employee_no = sessionStorage.getItem('employee_no_search');
        $.ajax({
            url: '../../process/user/keyup/key_p.php',
            type: 'POST',
            cache: false,
            data: {
                method: 'count_account_list',
                employee_no: employee_no
            },
            success: function (response) {
                sessionStorage.setItem('count_rows', response);
                var count = `Total: ${response}`;
                document.getElementById("accounts_table_info").innerHTML = count;

                if (response > 0) {
                    load_accounts_last_page();
                    /*document.getElementById("btnNextPage").style.display = "block";
                    document.getElementById("btnNextPage").removeAttribute('disabled');*/
                } else {
                    document.getElementById("btnNextPage").style.display = "none";
                    document.getElementById("btnNextPage").setAttribute('disabled', true);
                }
            }
        });
    }

    const load_accounts_last_page = () => {
        var employee_no = sessionStorage.getItem('employee_no_search');
        var current_page = parseInt(sessionStorage.getItem('accounts_table_pagination'));
        $.ajax({
            url: '../../process/user/keyup/key_p.php',
            type: 'POST',
            cache: false,
            data: {
                method: 'account_list_last_page',
                employee_no: employee_no
            },
            success: function (response) {
                sessionStorage.setItem('last_page', response);
                let total = sessionStorage.getItem('count_rows');
                var next_page = current_page + 1;
                if (next_page > response || total < 1) {
                    document.getElementById("btnNextPage").style.display = "none";
                    document.getElementById("btnNextPage").setAttribute('disabled', true);
                } else {
                    document.getElementById("btnNextPage").style.display = "block";
                    document.getElementById("btnNextPage").removeAttribute('disabled');
                }
            }
        });
    }

    const search_accounts = current_page => {
        // If an AJAX call is already in progress, return immediately
        if (search_accounts_ajax_in_progress) {
            return;
        }

        var employee_no = document.getElementById('employee_no_search').value;

        var employee_no_1 = sessionStorage.getItem('employee_no_search');

        if (current_page > 1) {
            switch (true) {
                case employee_no !== employee_no_1:
                    employee_no = employee_no_1;
                    break;
                default:
            }
            /*if (employee_no !== employee_no_1) {
                employee_no = employee_no_1;
            }*/
        } else {
            sessionStorage.setItem('employee_no_search', employee_no);
        }

        // Set the flag to true as we're starting an AJAX call
        search_accounts_ajax_in_progress = true;

        $.ajax({
            url: '../../process/user/keyup/key_p.php',
            type: 'POST',
            cache: false,
            data: {
                method: 'search_account_list',
                employee_no: employee_no,
                current_page: current_page
            },
            beforeSend: (jqXHR, settings) => {
                document.getElementById("btnNextPage").setAttribute('disabled', true);
                var loading = `<tr id="loading"><td colspan="6" style="text-align:center;"><div class="spinner-border text-dark" role="status"><span class="sr-only">Loading...</span></div></td></tr>`;
                if (current_page == 1) {
                    document.getElementById("list_of_accounts").innerHTML = loading;
                } else {
                    $('#accounts_table tbody').append(loading);
                }
                jqXHR.url = settings.url;
                jqXHR.type = settings.type;
            },
            success: function (response) {
                $('#loading').remove();
                document.getElementById("btnNextPage").removeAttribute('disabled');
                if (current_page == 1) {
                    $('#accounts_table tbody').html(response);
                } else {
                    $('#accounts_table tbody').append(response);
                }
                sessionStorage.setItem('accounts_table_pagination', current_page);
                count_accounts();
                // Set the flag back to false as the AJAX call has completed
                search_accounts_ajax_in_progress = false;
            }
        }).fail((jqXHR, textStatus, errorThrown) => {
            console.log(jqXHR);
            console.log(`System Error : Call IT Personnel Immediately!!! They will fix it right away. Error: url: ${jqXHR.url}, method: ${jqXHR.type} ( HTTP ${jqXHR.status} - ${jqXHR.statusText} ) Press F12 to see Console Log for more info.`);
            $('#loading').remove();
            document.getElementById("btnNextPage").removeAttribute('disabled');
            // Set the flag back to false as the AJAX call has completed
            search_accounts_ajax_in_progress = false;
        });
    }
</script>