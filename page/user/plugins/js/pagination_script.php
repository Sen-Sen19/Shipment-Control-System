<script type="text/javascript">
    // AJAX IN PROGRESS GLOBAL VARS
    var search_accounts_ajax_in_progress = false;

    // DOMContentLoaded function
	document.addEventListener("DOMContentLoaded", () => {
        search_accounts(1, 0);
    });

    const th_order_by = order_by_code => {
        var current_page = parseInt(document.getElementById("accounts_table_pagination").value.trim());

        // Table Header Sort Behavior
        switch (order_by_code) {
            case 0:
            case 1:
                document.getElementById("employee_no_th").setAttribute('onclick', 'th_order_by(2)');
                document.getElementById("username_th").setAttribute('onclick', 'th_order_by(4)');
                document.getElementById("fullname_th").setAttribute('onclick', 'th_order_by(6)');
                document.getElementById("section_th").setAttribute('onclick', 'th_order_by(8)');
                document.getElementById("role_th").setAttribute('onclick', 'th_order_by(10)');
                break;
            case 2:
            case 3:
                document.getElementById("c_th").setAttribute('onclick', 'th_order_by(0)');
                document.getElementById("username_th").setAttribute('onclick', 'th_order_by(4)');
                document.getElementById("fullname_th").setAttribute('onclick', 'th_order_by(6)');
                document.getElementById("section_th").setAttribute('onclick', 'th_order_by(8)');
                document.getElementById("role_th").setAttribute('onclick', 'th_order_by(10)');
                break;
            case 4:
            case 5:
                document.getElementById("c_th").setAttribute('onclick', 'th_order_by(0)');
                document.getElementById("employee_no_th").setAttribute('onclick', 'th_order_by(2)');
                document.getElementById("fullname_th").setAttribute('onclick', 'th_order_by(6)');
                document.getElementById("section_th").setAttribute('onclick', 'th_order_by(8)');
                document.getElementById("role_th").setAttribute('onclick', 'th_order_by(10)');
                break;
            case 6:
            case 7:
                document.getElementById("c_th").setAttribute('onclick', 'th_order_by(0)');
                document.getElementById("employee_no_th").setAttribute('onclick', 'th_order_by(2)');
                document.getElementById("username_th").setAttribute('onclick', 'th_order_by(4)');
                document.getElementById("section_th").setAttribute('onclick', 'th_order_by(8)');
                document.getElementById("role_th").setAttribute('onclick', 'th_order_by(10)');
                break;
            case 8:
            case 9:
                document.getElementById("c_th").setAttribute('onclick', 'th_order_by(0)');
                document.getElementById("employee_no_th").setAttribute('onclick', 'th_order_by(2)');
                document.getElementById("username_th").setAttribute('onclick', 'th_order_by(4)');
                document.getElementById("fullname_th").setAttribute('onclick', 'th_order_by(6)');
                document.getElementById("role_th").setAttribute('onclick', 'th_order_by(10)');
                break;
            case 10:
            case 11:
                document.getElementById("c_th").setAttribute('onclick', 'th_order_by(0)');
                document.getElementById("employee_no_th").setAttribute('onclick', 'th_order_by(2)');
                document.getElementById("username_th").setAttribute('onclick', 'th_order_by(4)');
                document.getElementById("fullname_th").setAttribute('onclick', 'th_order_by(6)');
                document.getElementById("section_th").setAttribute('onclick', 'th_order_by(8)');
                break;
            default:
        }

        search_accounts(current_page, order_by_code);
    }

    document.getElementById("accounts_table_pagination").addEventListener("keyup", e => {
        var current_page = parseInt(document.getElementById("accounts_table_pagination").value.trim());
        var order_by_code = parseInt(sessionStorage.getItem('order_by_code'));
        //var total = document.getElementById("count_rows").value;
        let total = sessionStorage.getItem('count_rows');
        var last_page = parseInt(sessionStorage.getItem('last_page'));
        if (e.which === 13) {
            e.preventDefault();
            console.log(total);
            if (current_page != 0 && current_page <= last_page && total > 0) {
                search_accounts(current_page, order_by_code);
            }
        }
    });

    const get_prev_page = () => {
        var current_page = parseInt(sessionStorage.getItem('accounts_table_pagination'));
        var order_by_code = parseInt(sessionStorage.getItem('order_by_code'));
        //var total = document.getElementById("count_rows").value;
        let total = sessionStorage.getItem('count_rows');
        var prev_page = current_page - 1;
        if (prev_page > 0 && total > 0) {
            search_accounts(prev_page, order_by_code);
        }
    }

    const get_next_page = () => {
        var current_page = parseInt(sessionStorage.getItem('accounts_table_pagination'));
        var order_by_code = parseInt(sessionStorage.getItem('order_by_code'));
        //var total = document.getElementById("count_rows").value;
        let total = sessionStorage.getItem('count_rows');
        var last_page = parseInt(sessionStorage.getItem('last_page'));
        var next_page = current_page + 1;
        if (next_page <= last_page && total > 0) {
            search_accounts(next_page, order_by_code);
        }
    }

    const count_accounts = () => {
        var employee_no = sessionStorage.getItem('employee_no_search');
        var full_name = sessionStorage.getItem('full_name_search');
        var user_type = sessionStorage.getItem('user_type_search');
        $.ajax({
            url: '../../process/user/pagination/page2_p.php',
            type: 'POST',
            cache: false,
            data: {
                method: 'count_account_list',
                employee_no: employee_no,
                full_name: full_name,
                user_type: user_type
            },
            success: function (response) {
                //document.getElementById("count_rows").value = response;
                sessionStorage.setItem('count_rows', response);
                var count = `Total: ${response}`;
                document.getElementById("accounts_table_info").innerHTML = count;

                if (response > 0) {
                    load_accounts_pagination();
                    document.getElementById("btnPrevPage").removeAttribute('disabled');
                    document.getElementById("btnNextPage").removeAttribute('disabled');
                    document.getElementById("accounts_table_pagination").removeAttribute('disabled');
                } else {
                    document.getElementById("btnPrevPage").setAttribute('disabled', true);
                    document.getElementById("btnNextPage").setAttribute('disabled', true);
                    document.getElementById("accounts_table_pagination").setAttribute('disabled', true);
                }
            }
        });
    }

    const load_accounts_pagination = () => {
        var employee_no = sessionStorage.getItem('employee_no_search');
        var full_name = sessionStorage.getItem('full_name_search');
        var user_type = sessionStorage.getItem('user_type_search');
        var current_page = sessionStorage.getItem('accounts_table_pagination');
        $.ajax({
            url: '../../process/user/pagination/page2_p.php',
            type: 'POST',
            cache: false,
            data: {
                method: 'account_list_pagination',
                employee_no: employee_no,
                full_name: full_name,
                user_type: user_type
            },
            success: function (response) {
                $('#accounts_table_paginations').html(response);
                $('#accounts_table_pagination').val(current_page);
                let last_page_check = document.getElementById("accounts_table_paginations").innerHTML;
                if (last_page_check != '') {
                    let last_page = document.getElementById("accounts_table_paginations").lastChild.text;
                    sessionStorage.setItem('last_page', last_page);
                }
            }
        });
    }

    const search_accounts = (current_page, order_by_code) => {
        // If an AJAX call is already in progress, return immediately
        if (search_accounts_ajax_in_progress) {
            return;
        }

        //var order_by_code = 0;

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
            url: '../../process/user/pagination/page2_p.php',
            type: 'POST',
            cache: false,
            data: {
                method: 'search_account_list',
                employee_no: employee_no,
                full_name: full_name,
                user_type: user_type,
                current_page: current_page,
                order_by_code: order_by_code
            },
            beforeSend: (jqXHR, settings) => {
                document.getElementById("btnPrevPage").setAttribute('disabled', true);
                document.getElementById("accounts_table_pagination").setAttribute('disabled', true);
                document.getElementById("btnNextPage").setAttribute('disabled', true);
                var loading = `<tr><td colspan="6" style="text-align:center;"><div class="spinner-border text-dark" role="status"><span class="sr-only">Loading...</span></div></td></tr>`;
                document.getElementById("list_of_accounts").innerHTML = loading;
                jqXHR.url = settings.url;
                jqXHR.type = settings.type;
            },
            success: function (response) {
                document.getElementById("btnPrevPage").removeAttribute('disabled');
                document.getElementById("accounts_table_pagination").removeAttribute('disabled');
                document.getElementById("btnNextPage").removeAttribute('disabled');
                $('#list_of_accounts').html(response);
                sessionStorage.setItem('accounts_table_pagination', current_page);

                // Table Header Sort Behavior
                switch (order_by_code) {
                    case 0:
                        sessionStorage.setItem('order_by_code', 0);
                        document.getElementById("c_th").setAttribute('onclick', 'th_order_by(1)');
                        document.getElementById("c_th").innerHTML = ' # <i class="fas fa-sort-numeric-up ml-2">';
                        document.getElementById("employee_no_th").innerHTML = ' Employee No. ';
                        document.getElementById("username_th").innerHTML = ' Username ';
                        document.getElementById("fullname_th").innerHTML = ' Full Name ';
                        document.getElementById("section_th").innerHTML = ' Section ';
                        document.getElementById("role_th").innerHTML = ' User Type ';
                        break;
                    case 1:
                        sessionStorage.setItem('order_by_code', 1);
                        document.getElementById("c_th").setAttribute('onclick', 'th_order_by(0)');
                        document.getElementById("c_th").innerHTML = ' # <i class="fas fa-sort-numeric-down-alt ml-2">';
                        document.getElementById("employee_no_th").innerHTML = ' Employee No. ';
                        document.getElementById("username_th").innerHTML = ' Username ';
                        document.getElementById("fullname_th").innerHTML = ' Full Name ';
                        document.getElementById("section_th").innerHTML = ' Section ';
                        document.getElementById("role_th").innerHTML = ' User Type ';
                        break;
                    case 2:
                        sessionStorage.setItem('order_by_code', 2);
                        document.getElementById("employee_no_th").setAttribute('onclick', 'th_order_by(3)');
                        document.getElementById("c_th").innerHTML = ' # ';
                        document.getElementById("employee_no_th").innerHTML = ' Employee No. <i class="fas fa-sort-alpha-up ml-2">';
                        document.getElementById("username_th").innerHTML = ' Username ';
                        document.getElementById("fullname_th").innerHTML = ' Full Name ';
                        document.getElementById("section_th").innerHTML = ' Section ';
                        document.getElementById("role_th").innerHTML = ' User Type ';
                        break;
                    case 3:
                        sessionStorage.setItem('order_by_code', 3);
                        document.getElementById("employee_no_th").setAttribute('onclick', 'th_order_by(2)');
                        document.getElementById("c_th").innerHTML = ' # ';
                        document.getElementById("employee_no_th").innerHTML = ' Employee No. <i class="fas fa-sort-alpha-down-alt ml-2">';
                        document.getElementById("username_th").innerHTML = ' Username ';
                        document.getElementById("fullname_th").innerHTML = ' Full Name ';
                        document.getElementById("section_th").innerHTML = ' Section ';
                        document.getElementById("role_th").innerHTML = ' User Type ';
                        break;
                    case 4:
                        sessionStorage.setItem('order_by_code', 4);
                        document.getElementById("username_th").setAttribute('onclick', 'th_order_by(5)');
                        document.getElementById("c_th").innerHTML = ' # ';
                        document.getElementById("employee_no_th").innerHTML = ' Employee No. ';
                        document.getElementById("username_th").innerHTML = ' Username <i class="fas fa-sort-alpha-up ml-2">';
                        document.getElementById("fullname_th").innerHTML = ' Full Name ';
                        document.getElementById("section_th").innerHTML = ' Section ';
                        document.getElementById("role_th").innerHTML = ' User Type ';
                        break;
                    case 5:
                        sessionStorage.setItem('order_by_code', 5);
                        document.getElementById("username_th").setAttribute('onclick', 'th_order_by(4)');
                        document.getElementById("c_th").innerHTML = ' # ';
                        document.getElementById("employee_no_th").innerHTML = ' Employee No. ';
                        document.getElementById("username_th").innerHTML = ' Username <i class="fas fa-sort-alpha-down-alt ml-2">';
                        document.getElementById("fullname_th").innerHTML = ' Full Name ';
                        document.getElementById("section_th").innerHTML = ' Section ';
                        document.getElementById("role_th").innerHTML = ' User Type ';
                        break;
                    case 6:
                        sessionStorage.setItem('order_by_code', 6);
                        document.getElementById("fullname_th").setAttribute('onclick', 'th_order_by(7)');
                        document.getElementById("c_th").innerHTML = ' # ';
                        document.getElementById("employee_no_th").innerHTML = ' Employee No. ';
                        document.getElementById("username_th").innerHTML = ' Username ';
                        document.getElementById("fullname_th").innerHTML = ' Full Name <i class="fas fa-sort-alpha-up ml-2">';
                        document.getElementById("section_th").innerHTML = ' Section ';
                        document.getElementById("role_th").innerHTML = ' User Type ';
                        break;
                    case 7:
                        sessionStorage.setItem('order_by_code', 7);
                        document.getElementById("fullname_th").setAttribute('onclick', 'th_order_by(6)');
                        document.getElementById("c_th").innerHTML = ' # ';
                        document.getElementById("employee_no_th").innerHTML = ' Employee No. ';
                        document.getElementById("username_th").innerHTML = ' Username ';
                        document.getElementById("fullname_th").innerHTML = ' Full Name <i class="fas fa-sort-alpha-down-alt ml-2">';
                        document.getElementById("section_th").innerHTML = ' Section ';
                        document.getElementById("role_th").innerHTML = ' User Type ';
                        break;
                    case 8:
                        sessionStorage.setItem('order_by_code', 8);
                        document.getElementById("section_th").setAttribute('onclick', 'th_order_by(9)');
                        document.getElementById("c_th").innerHTML = ' # ';
                        document.getElementById("employee_no_th").innerHTML = ' Employee No. ';
                        document.getElementById("username_th").innerHTML = ' Username ';
                        document.getElementById("fullname_th").innerHTML = ' Full Name ';
                        document.getElementById("section_th").innerHTML = ' Section <i class="fas fa-sort-alpha-up ml-2">';
                        document.getElementById("role_th").innerHTML = ' User Type ';
                        break;
                    case 9:
                        sessionStorage.setItem('order_by_code', 9);
                        document.getElementById("section_th").setAttribute('onclick', 'th_order_by(8)');
                        document.getElementById("c_th").innerHTML = ' # ';
                        document.getElementById("employee_no_th").innerHTML = ' Employee No. ';
                        document.getElementById("username_th").innerHTML = ' Username ';
                        document.getElementById("fullname_th").innerHTML = ' Full Name ';
                        document.getElementById("section_th").innerHTML = ' Section <i class="fas fa-sort-alpha-down-alt ml-2">';
                        document.getElementById("role_th").innerHTML = ' User Type ';
                        break;
                    case 10:
                        sessionStorage.setItem('order_by_code', 10);
                        document.getElementById("role_th").setAttribute('onclick', 'th_order_by(11)');
                        document.getElementById("c_th").innerHTML = ' # ';
                        document.getElementById("employee_no_th").innerHTML = ' Employee No. ';
                        document.getElementById("username_th").innerHTML = ' Username ';
                        document.getElementById("fullname_th").innerHTML = ' Full Name ';
                        document.getElementById("section_th").innerHTML = ' Section ';
                        document.getElementById("role_th").innerHTML = ' User Type <i class="fas fa-sort-alpha-up ml-2">';
                        break;
                    case 11:
                        sessionStorage.setItem('order_by_code', 11);
                        document.getElementById("role_th").setAttribute('onclick', 'th_order_by(10)');
                        document.getElementById("c_th").innerHTML = ' # ';
                        document.getElementById("employee_no_th").innerHTML = ' Employee No. ';
                        document.getElementById("username_th").innerHTML = ' Username ';
                        document.getElementById("fullname_th").innerHTML = ' Full Name ';
                        document.getElementById("section_th").innerHTML = ' Section ';
                        document.getElementById("role_th").innerHTML = ' User Type <i class="fas fa-sort-alpha-down-alt ml-2">';
                        break;
                    default:
                }

                count_accounts();
                // Set the flag back to false as the AJAX call has completed
                search_accounts_ajax_in_progress = false;
            }
        }).fail((jqXHR, textStatus, errorThrown) => {
            console.log(jqXHR);
            console.log(`System Error : Call IT Personnel Immediately!!! They will fix it right away. Error: url: ${jqXHR.url}, method: ${jqXHR.type} ( HTTP ${jqXHR.status} - ${jqXHR.statusText} ) Press F12 to see Console Log for more info.`);
            document.getElementById("btnPrevPage").removeAttribute('disabled');
            document.getElementById("accounts_table_pagination").removeAttribute('disabled');
            document.getElementById("btnNextPage").removeAttribute('disabled');
            // Set the flag back to false as the AJAX call has completed
            search_accounts_ajax_in_progress = false;
        });
    }
</script>