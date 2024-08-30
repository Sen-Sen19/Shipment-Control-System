<script type="text/javascript">
    // DOMContentLoaded function
	document.addEventListener("DOMContentLoaded", () => {
        load_accounts();
    });

    const load_accounts = () => {
        let xhr = new XMLHttpRequest();
        let url = "../../process/admin/sample/sample1_p.php", type = "POST";
        var data = serialize({
            method: 'account_list'
        });
        var loading = `<tr><td colspan="6" style="text-align:center;"><div class="spinner-border text-dark" role="status"><span class="sr-only">Loading...</span></div></td></tr>`;
        document.getElementById("list_of_accounts").innerHTML = loading;

        xhr.onreadystatechange = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                let response = xhr.responseText;
                if (xhr.readyState == 4 && (xhr.status >= 200 && xhr.status < 400)) {
                    try {
                        let response_array = JSON.parse(response);
                        console.log(response_array);
                        if (response_array.length) {
                            document.getElementById("list_of_accounts").innerHTML = '';
                            Object.keys(response_array).forEach(key => {
                                if (typeof response_array[key].message != "undefined") {
                                    console.log(response_array[key].message);
                                    var table_row = `<tr><td colspan="6" style="text-align:center; color:red;">${response_array[key].message}</td></tr>`;
                                    document.getElementById("list_of_accounts").innerHTML = table_row;
                                } else {
                                    console.log(`${response_array[key].id} | ${response_array[key].id_number} | ${response_array[key].username} | ${response_array[key].full_name} | ${response_array[key].section} | ${response_array[key].role}`);
                                    var c = key;
                                    var table_row = `
                                        <tr>
                                        <td><p class="mb-0"><label class="mb-0">
                                        <input type="checkbox" class="singleCheck" value="${response_array[key].id}" onclick="get_checked_length()" /><span></span>
                                        </label></p></td>
                                        <td style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#update_account" 
                                        data-id="${response_array[key].id}" 
                                        data-id_number="${response_array[key].id_number}" 
                                        data-username="${response_array[key].username}" 
                                        data-full_name="${response_array[key].full_name}" 
                                        data-section="${response_array[key].section}" 
                                        data-role="${response_array[key].role}" 
                                        onclick="get_accounts_details(this)">${++c}</td>
                                        <td>${response_array[key].id_number}</td>
                                        <td>${response_array[key].username}</td>
                                        <td>${response_array[key].full_name}</td>
                                        <td>${response_array[key].section}</td>
                                        <td>${response_array[key].role}</td>
                                        </tr>
                                    `;
                                    document.getElementById("list_of_accounts").insertAdjacentHTML("beforeend", table_row);
                                }
                            });
                        } else {
                            console.log('No Results Found');
                            var table_row = `<tr><td colspan="6" style="text-align:center; color:red;">No Results Found</td></tr>`;
                            document.getElementById("list_of_accounts").innerHTML = table_row;
                        }
                    } catch(response) {
                        console.log(response);
                    }
                } else {
                    console.log(xhr);
                    console.log(`System Error: url: ${url}, method: ${type} ( HTTP ${xhr.status} - ${xhr.statusText} ) Press F12 to see Console Log for more info.`);
                }
            }
        };
        xhr.open(type, url, true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send(data);
    }

    const search_accounts = () => {
        var employee_no = document.getElementById('employee_no_search').value;
        var full_name = document.getElementById('full_name_search').value;
        var user_type = document.getElementById('user_type_search').value;

        let xhr = new XMLHttpRequest();
        let url = "../../process/admin/sample/sample1_p.php", type = "POST";
        var data = serialize({
            method: 'search_account_list',
            employee_no: employee_no,
            full_name: full_name,
            user_type: user_type
        });
        var loading = `<tr><td colspan="6" style="text-align:center;"><div class="spinner-border text-dark" role="status"><span class="sr-only">Loading...</span></div></td></tr>`;
        document.getElementById("list_of_accounts").innerHTML = loading;

        xhr.onreadystatechange = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                let response = xhr.responseText;
                if (xhr.readyState == 4 && (xhr.status >= 200 && xhr.status < 400)) {
                    try {
                        let response_array = JSON.parse(response);
                        console.log(response_array);
                        if (response_array.length) {
                            document.getElementById("list_of_accounts").innerHTML = '';
                            Object.keys(response_array).forEach(key => {
                                if (typeof response_array[key].message != "undefined") {
                                    console.log(response_array[key].message);
                                    var table_row = `<tr><td colspan="6" style="text-align:center; color:red;">${response_array[key].message}</td></tr>`;
                                    document.getElementById("list_of_accounts").innerHTML = table_row;
                                } else {
                                    console.log(`${response_array[key].id} | ${response_array[key].id_number} | ${response_array[key].username} | ${response_array[key].full_name} | ${response_array[key].section} | ${response_array[key].role}`);
                                    var c = key;
                                    var table_row = `
                                        <tr>
                                        <td><p class="mb-0"><label class="mb-0">
                                        <input type="checkbox" class="singleCheck" value="${response_array[key].id}" onclick="get_checked_length()" /><span></span>
                                        </label></p></td>
                                        <td style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#update_account" 
                                        data-id="${response_array[key].id}" 
                                        data-id_number="${response_array[key].id_number}" 
                                        data-username="${response_array[key].username}" 
                                        data-full_name="${response_array[key].full_name}" 
                                        data-section="${response_array[key].section}" 
                                        data-role="${response_array[key].role}" 
                                        onclick="get_accounts_details(this)">${++c}</td>
                                        <td>${response_array[key].id_number}</td>
                                        <td>${response_array[key].username}</td>
                                        <td>${response_array[key].full_name}</td>
                                        <td>${response_array[key].section}</td>
                                        <td>${response_array[key].role}</td>
                                        </tr>
                                    `;
                                    document.getElementById("list_of_accounts").insertAdjacentHTML("beforeend", table_row);
                                }
                            });
                        } else {
                            console.log('No Results Found');
                            var table_row = `<tr><td colspan="6" style="text-align:center; color:red;">No Results Found</td></tr>`;
                            document.getElementById("list_of_accounts").innerHTML = table_row;
                        }
                    } catch(response) {
                        console.log(response);
                    }
                } else {
                    console.log(xhr);
                    console.log(`System Error: url: ${url}, method: ${type} ( HTTP ${xhr.status} - ${xhr.statusText} ) Press F12 to see Console Log for more info.`);
                }
            }
        };
        xhr.open(type, url, true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send(data);
    }

    document.getElementById('new_account_form').addEventListener('submit', e => {
        e.preventDefault();
        register_accounts();
    });

    const register_accounts = () => {
        var employee_no = document.getElementById('employee_no').value;
        var full_name = document.getElementById('full_name').value;
        var username = document.getElementById('username').value;
        var password = document.getElementById('password').value;
        var section = document.getElementById('section').value;
        var user_type = document.getElementById('user_type').value;

        let xhr = new XMLHttpRequest();
        let url = "../../process/admin/sample/sample1_p.php", type = "POST";
        var data = serialize({
            method: 'register_account',
            employee_no: employee_no,
            full_name: full_name,
            username: username,
            password: password,
            section: section,
            user_type: user_type
        });

        xhr.onreadystatechange = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                let response = xhr.responseText;
                if (xhr.readyState == 4 && (xhr.status >= 200 && xhr.status < 400)) {
                    if (response == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Succesfully Recorded!!!',
                            text: 'Success',
                            showConfirmButton: false,
                            timer: 1000
                        });
                        document.getElementById("employee_no").value = '';
                        document.getElementById("full_name").value = '';
                        document.getElementById("username").value = '';
                        document.getElementById("password").value = '';
                        document.getElementById("section").value = '';
                        document.getElementById("user_type").value = '';
                        load_accounts();
                        $('#new_account').modal('hide');
                    } else if (response == 'Already Exist') {
                        Swal.fire({
                            icon: 'info',
                            title: 'Duplicate Data !!!',
                            text: 'Information',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error !!!',
                            text: 'Error',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                } else {
                    console.log(xhr);
                    console.log(`System Error: url: ${url}, method: ${type} ( HTTP ${xhr.status} - ${xhr.statusText} ) Press F12 to see Console Log for more info.`);
                }
            }
        };
        xhr.open(type, url, true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send(data);
    }

    const get_accounts_details = el => {
        var id = el.dataset.id;
        var id_number = el.dataset.id_number;
        var username = el.dataset.username;
        var full_name = el.dataset.full_name;
        var section = el.dataset.section;
        var role = el.dataset.role;

        document.getElementById('id_account_update').value = id;
        document.getElementById('employee_no_update').value = id_number;
        document.getElementById('username_update').value = username;
        document.getElementById('full_name_update').value = full_name;
        document.getElementById('password_update').value = '';
        document.getElementById('section_update').value = section;
        document.getElementById('user_type_update').value = role;
    }

    // Get the form element
    var update_account_form = document.getElementById('update_account_form');

    // Add a submit event listener to the form
    update_account_form.addEventListener('submit', e => {
        e.preventDefault();

        // Get the button that triggered the submit event
        var button = document.activeElement;

        // Check the id or name of the button
        if (button.id === 'btnUpdateAccount') {
            // Call the function for the first submit button
            update_account();
        } else if (button.id === 'btnDeleteAccount') {
            // Call the function for the first submit button
            delete_account();
        }
    });

    const update_account = () => {
        var id = document.getElementById('id_account_update').value;
        var id_number = document.getElementById('employee_no_update').value;
        var username = document.getElementById('username_update').value;
        var full_name = document.getElementById('full_name_update').value;
        var password = document.getElementById('password_update').value;
        var section = document.getElementById('section_update').value;
        var role = document.getElementById('user_type_update').value;

        let xhr = new XMLHttpRequest();
        let url = "../../process/admin/sample/sample1_p.php", type = "POST";
        var data = serialize({
            method: 'update_account',
            id: id,
            id_number: id_number,
            username: username,
            full_name: full_name,
            password: password,
            section: section,
            role: role
        });

        xhr.onreadystatechange = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                let response = xhr.responseText;
                if (xhr.readyState == 4 && (xhr.status >= 200 && xhr.status < 400)) {
                    if (response == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Succesfully Recorded!!!',
                            text: 'Success',
                            showConfirmButton: false,
                            timer: 1000
                        });
                        document.getElementById("employee_no_update").value = '';
                        document.getElementById("full_name_update").value = '';
                        document.getElementById("username_update").value = '';
                        document.getElementById("password_update").value = '';
                        document.getElementById("section_update").value = '';
                        document.getElementById("user_type_update").value = '';
                        load_accounts();
                        $('#update_account').modal('hide');
                    } else if (response == 'duplicate') {
                        Swal.fire({
                            icon: 'info',
                            title: 'Duplicate Data !!!',
                            text: 'Information',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error !!!',
                            text: 'Error',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                } else {
                    console.log(xhr);
                    console.log(`System Error: url: ${url}, method: ${type} ( HTTP ${xhr.status} - ${xhr.statusText} ) Press F12 to see Console Log for more info.`);
                }
            }
        };
        xhr.open(type, url, true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send(data);
    }

    const delete_account = () => {
        var id = document.getElementById('id_account_update').value;

        let xhr = new XMLHttpRequest();
        let url = "../../process/admin/sample/sample1_p.php", type = "POST";
        var data = serialize({
            method: 'delete_account',
            id: id
        });

        xhr.onreadystatechange = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                let response = xhr.responseText;
                if (xhr.readyState == 4 && (xhr.status >= 200 && xhr.status < 400)) {
                    if (response == 'success') {
                        Swal.fire({
                            icon: 'info',
                            title: 'Succesfully Deleted !!!',
                            text: 'Information',
                            showConfirmButton: false,
                            timer: 1000
                        });
                        document.getElementById("employee_no_update").value = '';
                        document.getElementById("full_name_update").value = '';
                        document.getElementById("username_update").value = '';
                        document.getElementById("password_update").value = '';
                        document.getElementById("section_update").value = '';
                        document.getElementById("user_type_update").value = '';
                        load_accounts();
                        $('#update_account').modal('hide');
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error !!!',
                            text: 'Error',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                } else {
                    console.log(xhr);
                    console.log(`System Error: url: ${url}, method: ${type} ( HTTP ${xhr.status} - ${xhr.statusText} ) Press F12 to see Console Log for more info.`);
                }
            }
        };
        xhr.open(type, url, true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send(data);
    }

    // uncheck all
    const uncheck_all = () => {
        var select_all = document.getElementById('check_all');
        select_all.checked = false;
        document.querySelectorAll(".singleCheck").forEach((el, i) => {
            el.checked = false;
        });
        get_checked_length();
    }
    // check all
    const select_all_func = () => {
        var select_all = document.getElementById('check_all');
        if (select_all.checked == true) {
            console.log('check');
            document.querySelectorAll(".singleCheck").forEach((el, i) => {
                el.checked = true;
            });
        } else {
            console.log('uncheck');
            document.querySelectorAll(".singleCheck").forEach((el, i) => {
                el.checked = false;
            });
        }
        get_checked_length();
    }
    // GET THE LENGTH OF CHECKED CHECKBOXES
    const get_checked_length = () => {
        var arr = [];
        document.querySelectorAll("input.singleCheck[type='checkbox']:checked").forEach((el, i) => {
            arr.push(el.value);
        });
        console.log(arr);
        var numberOfChecked = arr.length;
        console.log(numberOfChecked);
        if (numberOfChecked > 0) {
            document.getElementById("count_delete_account_selected").innerHTML = `${numberOfChecked} Account Row/s Selected`;
            document.getElementById("checkbox_control").removeAttribute('disabled');
        } else {
            document.getElementById("checkbox_control").setAttribute('disabled', true);
        }
    }

    const delete_account_selected = () => {
        var arr = [];
        document.querySelectorAll("input.singleCheck[type='checkbox']:checked").forEach((el, i) => {
            arr.push(el.value);
        });
        console.log(arr);

        var numberOfChecked = arr.length;
        if (numberOfChecked > 0) {
            let xhr = new XMLHttpRequest();
            let url = "../../process/admin/sample/sample1_p.php", type = "POST";
            var data = serialize({
                method: 'delete_account_selected',
                id_arr: arr
            });

            xhr.onreadystatechange = () => {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    let response = xhr.responseText;
                    if (xhr.readyState == 4 && (xhr.status >= 200 && xhr.status < 400)) {
                        if (response == 'success') {
                            Swal.fire({
                                icon: 'info',
                                title: 'Succesfully Deleted !!!',
                                text: 'Information',
                                showConfirmButton: false,
                                timer: 1000
                            });
                            load_accounts();
                            $('#confirm_delete_account_selected').modal('hide');
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error !!!',
                                text: 'Error',
                                showConfirmButton: false,
                                timer: 2000
                            });
                        }
                    } else {
                        console.log(xhr);
                        console.log(`System Error: url: ${url}, method: ${type} ( HTTP ${xhr.status} - ${xhr.statusText} ) Press F12 to see Console Log for more info.`);
                    }
                }
            };
            xhr.open(type, url, true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send(data);
        } else {
            Swal.fire({
                icon: 'info',
                title: 'No checkbox checked',
                text: 'Information',
                showConfirmButton: false,
                timer: 1000
            });
        }
    }

    const export_employees = () => {
        var employee_no = document.getElementById('employee_no_search').value;
        var full_name = document.getElementById('full_name_search').value;
        window.open('../../process/export/exp_accounts.php?employee_no=' + employee_no + "&full_name=" + full_name, '_blank');
    }

    const export_employees3 = () => {
        var employee_no = document.getElementById('employee_no_search').value;
        var full_name = document.getElementById('full_name_search').value;
        window.open('../../process/export/exp_accounts3.php?employee_no=' + employee_no + "&full_name=" + full_name, '_blank');
    }

    const export_csv = (table_id, separator = ',') => {
        // Select rows from table_id
        var rows = document.querySelectorAll('table#' + table_id + ' tr');
        // Construct csv
        var csv = [];
        for (var i = 0; i < rows.length; i++) {
            var row = [], cols = rows[i].querySelectorAll('td, th');
            for (var j = 0; j < cols.length; j++) {
                var data = cols[j].innerText.replace(/(\r\n|\n|\r)/gm, '').replace(/(\s\s)/gm, ' ')
                data = data.replace(/"/g, '""');
                // Push escaped string
                row.push('"' + data + '"');
            }
            csv.push(row.join(separator));
        }
        var csv_string = csv.join('\n');
        // Download it
        var filename = 'Export-Accounts' + '_' + new Date().toLocaleDateString() + '.csv';
        var link = document.createElement('a');
        link.style.display = 'none';
        link.setAttribute('target', '_blank');
        link.setAttribute('href', 'data:text/csv;charset=utf-8,%EF%BB%BF' + encodeURIComponent(csv_string));
        link.setAttribute('download', filename);
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    const upload_csv = () => {
        var file_form = document.getElementById('file_form');
        var form_data = new FormData(file_form);
        let xhr = new XMLHttpRequest();
        let url = "../../process/import/imp_accounts3.php", type = "POST";

        Swal.fire({
            icon: 'info',
            title: 'Uploading Please Wait...',
            text: 'Info',
            showConfirmButton: false,
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false
        });

        xhr.onreadystatechange = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                let response = xhr.responseText;
                if (xhr.readyState == 4 && (xhr.status >= 200 && xhr.status < 400)) {
                    setTimeout(() => {
                        swal.close();
                        if (response != '') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Upload CSV Error',
                                text: `Error: ${response}`,
                                showConfirmButton: false,
                                timer: 2000
                            });
                        } else {
                            Swal.fire({
                                icon: 'info',
                                title: 'Upload CSV',
                                text: 'Uploaded and updated successfully',
                                showConfirmButton: false,
                                timer: 1000
                            });
                            load_accounts();
                        }
                        document.getElementById("file2").value = '';
                    }, 500);
                } else {
                    console.log(xhr);
                    console.log(`System Error: url: ${url}, method: ${type} ( HTTP ${xhr.status} - ${xhr.statusText} ) Press F12 to see Console Log for more info.`);
                }
            }
        };
        xhr.open(type, url, true);
        xhr.send(form_data);
    }

    const popup1 = () => {
        var employee_no = document.getElementById('employee_no_search').value;
        var full_name = document.getElementById('full_name_search').value;
        PopupCenter('../../process/export/exp_accounts3.php?employee_no=' + employee_no + "&full_name=" + full_name, 'Popup Export Accounts 3', '1190', '600');
    }
</script>