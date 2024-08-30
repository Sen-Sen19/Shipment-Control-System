<script type="text/javascript">
    // AJAX IN PROGRESS GLOBAL VARS
    var search_accounts_ajax_in_progress = false;

    // DOMContentLoaded function
	document.addEventListener("DOMContentLoaded", () => {
        search_accounts(1);
    });

    // Reference: Table Responsive Scroll Event (Body)
    /*window.onscroll = function(ev){
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
       get_next_page();
    }*/

    // Table Responsive Scroll Event for Load More
    document.getElementById("accounts_table_res").addEventListener("scroll", () => {
        var scrollTop = document.getElementById("accounts_table_res").scrollTop;
        var scrollHeight = document.getElementById("accounts_table_res").scrollHeight;
        var offsetHeight = document.getElementById("accounts_table_res").offsetHeight;

        if (search_accounts_ajax_in_progress == false) {
            //check if the scroll reached the bottom
            if ((offsetHeight + scrollTop + 1) >= scrollHeight) {
                get_next_page();
            }
        }
    });

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
        var full_name = sessionStorage.getItem('full_name_search');
        var user_type = sessionStorage.getItem('user_type_search');
        $.ajax({
            url: '../../process/user/pagination/load_more_p.php',
            type: 'POST',
            cache: false,
            data: {
                method: 'count_account_list',
                employee_no: employee_no,
                full_name: full_name,
                user_type: user_type
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
        var full_name = sessionStorage.getItem('full_name_search');
        var user_type = sessionStorage.getItem('user_type_search');
        var current_page = parseInt(sessionStorage.getItem('accounts_table_pagination'));
        $.ajax({
            url: '../../process/user/pagination/load_more_p.php',
            type: 'POST',
            cache: false,
            data: {
                method: 'account_list_last_page',
                employee_no: employee_no,
                full_name: full_name,
                user_type: user_type
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
        var full_name = document.getElementById('full_name_search').value;
        var user_type = document.getElementById('user_type_search').value;

        var employee_no_1 = sessionStorage.getItem('employee_no_search');
        var full_name_1 = sessionStorage.getItem('full_name_search');
        var user_type_1 = sessionStorage.getItem('user_type_search');
        if (current_page > 1) {
            switch (true) {
                case employee_no !== employee_no_1:
                case full_name !== full_name_1:
                case user_type !== user_type_1:
                    employee_no = employee_no_1;
                    full_name = full_name_1;
                    user_type = user_type_1;
                    break;
                default:
            }
            /*if (employee_no !== employee_no_1 || full_name !== full_name_1 || user_type !== user_type_1) {
                employee_no = employee_no_1;
                full_name = full_name_1;
                user_type = user_type_1;
            }*/
        } else {
            sessionStorage.setItem('employee_no_search', employee_no);
            sessionStorage.setItem('full_name_search', full_name);
            sessionStorage.setItem('user_type_search', user_type);
        }

        // Set the flag to true as we're starting an AJAX call
        search_accounts_ajax_in_progress = true;

        $.ajax({
            url: '../../process/user/pagination/load_more_p.php',
            type: 'POST',
            cache: false,
            data: {
                method: 'search_account_list',
                employee_no: employee_no,
                full_name: full_name,
                user_type: user_type,
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