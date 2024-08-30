<script type="text/javascript">
    // DOMContentLoaded function
	document.addEventListener("DOMContentLoaded", () => {
        get_section_dropdown_search();

        load_accounts();

        // get_line_no_dropdown_search();
        // load_accounts();
    });

    const get_section_dropdown_search = () => {
		$.ajax({
			url: '../../process/admin/backlogs/bl_p.php',
			type: 'POST',
			cache: false,
			data: {
				method: 'get_section_dropdown_search'
			},  
			success: response => {
				document.getElementById("section_search").innerHTML = response;
			}
		});
	}

    

    let page = 1; // Initial page number
    const rowsPerPage = 10; // Number of rows to fetch per request
    
    const load_accounts = (isPagination = false) => {
        if (!isPagination) {
            page = 1; // Reset page number for initial load
        }

        $.ajax({
            url: '../../process/admin/backlogs/view_backlogs_p.php',
            type: 'POST',
            cache: false,
            data: {
                method: 'backlog_list',
                page: page,
                rows_per_page: rowsPerPage
            }, success: function (response) {
                // document.getElementById("list_of_accounts").innerHTML = response;
                const responseData = JSON.parse(response);
                if (isPagination) {
                    if (responseData.html.trim() !== '') {
                        document.getElementById('list_of_accounts').innerHTML += responseData.html;
                        page++;
                        if (responseData.has_more) {
                            document.getElementById('load_more').style.display = 'block';
                        } else {
                            document.getElementById('load_more').style.display = 'none';
                        }
                    } else {
                        document.getElementById('load_more').style.display = 'none';
                    }
                } else {
                    document.getElementById('list_of_accounts').innerHTML = responseData.html;
                    page++;
                    if (responseData.has_more) {
                        document.getElementById('load_more').style.display = 'block';
                    } else {
                        document.getElementById('load_more').style.display = 'none';
                    }
                }
            }
        });
    }
document.getElementById('load_more').addEventListener('click', () => load_accounts(true));



let page1 = 1; // Initial page number
const rowsPerPage1 = 10;

const search_backlogs = (isPaginations = false) => {
    if (!isPaginations) {
        page1 = 1; // Reset page number for initial load
    }

    var section = document.getElementById('section_search').value;
    var line_num = document.getElementById('line_no_search').value;
    var product_no = document.getElementById('product_no_search').value;
    let date_from = document.getElementById('date_from_search').value;
    let date_to = document.getElementById('date_to_search').value;

    if (date_from == "" || date_to == "") {
        Swal.fire({
            icon: 'error',
            title: 'Missing Dates',
            text: 'Date Required',
            showConfirmButton: false,
            timer: 1000
        });
        return 0;
    }

    $.ajax({
        url: '../../process/admin/backlogs/view_backlogs_p.php',
        type: 'POST',
        cache: false,
        data: {
            method: 'search_backlog_list',
            section: section,
            line_num: line_num,
            product_no: product_no,
            date_from: date_from,
            date_to: date_to,
            page1: page1,
            rows_per_page: rowsPerPage1
        },
        success: function(response) {
            try {
                const responseData = JSON.parse(response);
                if (isPaginations) {
                    if (responseData.html.trim() !== '') {
                        document.getElementById('list_of_accounts').innerHTML += responseData.html;
                        page1++;
                        if (responseData.has_more) {
                            document.getElementById('load_more').style.display = 'block';
                        } else {
                            document.getElementById('load_more').style.display = 'none';
                        }
                    } else {
                        document.getElementById('load_more').style.display = 'none';
                    }
                } else {
                    document.getElementById('list_of_accounts').innerHTML = responseData.html;
                    page1++;
                    if (responseData.has_more) {
                        document.getElementById('load_more').style.display = 'block';
                    } else {
                        document.getElementById('load_more').style.display = 'none';
                    }
                }
            } catch (e) {
                console.error('Error parsing JSON:', e);
                console.error('Response:', response);
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
        }
    });
}

// Add event listener to the "Load More" button
document.getElementById('load_more').addEventListener('click', function() {
    search_backlogs(true);
});

const export_accounts3 = () => {
   var section = document.getElementById('section_search').value;
   var line_num = document.getElementById('line_no_search').value;
   var product_no = document.getElementById('product_no_search').value;
   let date_from = document.getElementById('date_from_search').value;
   let date_to = document.getElementById('date_to_search').value;

    if (date_from == "" || date_to == "") {
        Swal.fire({
            icon: 'error',
            title: 'Missing Dates',
            text: 'Date Required',
            showConfirmButton: false,
            timer: 1000
        });
        return 0;
    }
        //url_main = '../../process/export/exp_accounts3.php?section=' + section + "&line_num=" + line_num + "&product_no=" + product_no + "&date_from=" + date_from + "&date_to=" + date_to, '_blank';
        window.open('../../process/export/exp_accounts3.php?section=' + section + "&line_num=" + line_num + "&product_no=" + product_no + "&date_from=" + date_from + "&date_to=" + date_to, '_blank');
        console.log(url_main);
    }




</script>