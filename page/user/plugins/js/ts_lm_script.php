<script type="text/javascript">
$( document ).ready(function() {
    load_t_t1();
});

// Table Responsive Scroll Event for Load More
document.getElementById("t_table_res").addEventListener("scroll", function() {
    var scrollTop = document.getElementById("t_table_res").scrollTop;
    var scrollHeight = document.getElementById("t_table_res").scrollHeight;
    var offsetHeight = document.getElementById("t_table_res").offsetHeight;

    //check if the scroll reached the bottom
    if ((offsetHeight + scrollTop + 1) >= scrollHeight) {
        get_next_page();
    }
});

const get_next_page = () => {
    var current_table = parseInt(sessionStorage.getItem('t_table_number'));
    var current_page = parseInt(sessionStorage.getItem('t_table_pagination'));
    let total = sessionStorage.getItem('count_rows');
    var last_page = parseInt(sessionStorage.getItem('last_page'));
    var next_page = current_page + 1;
    if (next_page <= last_page && total > 0) {
        switch (current_table) {
            case 1:
                load_t_t1_data(next_page);
                break;
            case 2:
                load_t_t2_data(next_page);
                break;
            default:
        }
    }
}

const load_t_t1_data_last_page = () =>{
    var current_page = parseInt(sessionStorage.getItem('t_table_pagination'));
    $.ajax({
        url:'../../process/user/table_switching/ts_lm_p.php',
        type:'POST',
        cache:false,
        data:{
            method: 'load_t_t1_data_last_page'
        },
        success:function(response){
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

const count_t_t1_data = () => {
    $.ajax({
        url:'../../process/user/table_switching/ts_lm_p.php',
        type:'POST',
        cache:false,
        data:{
            method: 'count_t_t1_data'
        }, 
        success:function(response){
            sessionStorage.setItem('count_rows', response);
            var count = `Total: ${response}`;
            $('#t_table_info').html(count);

            if (response > 0) {
                load_t_t1_data_last_page();
                /*document.getElementById("btnNextPage").style.display = "block";
                document.getElementById("btnNextPage").removeAttribute('disabled');*/
            } else {
                document.getElementById("btnNextPage").style.display = "none";
                document.getElementById("btnNextPage").setAttribute('disabled', true);
            }
        }
    });
}

const load_t_t1_table = () =>{
    sessionStorage.setItem('t_table_number', 1);
    document.getElementById("t_table").innerHTML = `
        <thead style="text-align: center;">
            <tr>
                <th> # </th>
                <th> C1 </th>
                <th> C2 </th>
                <th> C3 </th>
                <th> C4 </th>
                <th> Date Updated </th>
            </tr>
        </thead>
        <tbody id="t_t1_data" style="text-align: center;"></tbody>
    `;
}

const load_t_t1_data = current_page =>{
    $.ajax({
        url:'../../process/user/table_switching/ts_lm_p.php',
        type:'POST',
        cache:false,
        data:{
            method: 'load_t_t1_data',
            current_page: current_page
        },
        beforeSend: () => {
            var loading = `<tr id="loading"><td colspan="6" style="text-align:center;"><div class="spinner-border text-dark" role="status"><span class="sr-only">Loading...</span></div></td></tr>`;
            if (current_page == 1) {
                document.getElementById("t_t1_data").innerHTML = loading;
            } else {
                $('#t_table tbody').append(loading);
            }
        }, 
        success:function(response){
            $('#loading').remove();
            if (current_page == 1) {
                $('#t_table tbody').html(response);
            } else {
                $('#t_table tbody').append(response);
            }
            sessionStorage.setItem('t_table_pagination', current_page);
            $('#lbl_c1').html('');
            $('#t_t1_breadcrumb').hide();
            count_t_t1_data();
        }
    });
}

const load_t_t1 = () => {
    load_t_t1_table();
    setTimeout(() => {
        load_t_t1_data(1);
    }, 500);
}

const load_t_t2_data_last_page = () =>{
    var c1 = sessionStorage.getItem('load_t_t2_c1');
    var current_page = parseInt(sessionStorage.getItem('t_table_pagination'));

    $.ajax({
        url:'../../process/user/table_switching/ts_lm_p.php',
        type:'POST',
        cache:false,
        data:{
            method: 'load_t_t2_data_last_page',
            c1: c1
        },
        success:function(response){
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

const count_t_t2_data = () => {
    var c1 = sessionStorage.getItem('load_t_t2_c1');

    $.ajax({
        url:'../../process/user/table_switching/ts_lm_p.php',
        type:'POST',
        cache:false,
        data:{
            method: 'count_t_t2_data',
            c1: c1
        }, 
        success:function(response){
            sessionStorage.setItem('count_rows', response);
            var count = `Total: ${response}`;
            $('#t_table_info').html(count);

            if (response > 0) {
                load_t_t2_data_last_page();
                /*document.getElementById("btnNextPage").style.display = "block";
                document.getElementById("btnNextPage").removeAttribute('disabled');*/
            } else {
                document.getElementById("btnNextPage").style.display = "none";
                document.getElementById("btnNextPage").setAttribute('disabled', true);
            }
        }
    });
}

const load_t_t2_table = () =>{
    sessionStorage.setItem('t_table_number', 2);
    document.getElementById("t_table").innerHTML = `
        <thead style="text-align: center;">
            <tr>
                <th> # </th>
                <th> C1 </th>
                <th> D1 </th>
                <th> D2 </th>
                <th> D3 </th>
                <th> Date Updated </th>
            </tr>
        </thead>
        <tbody id="t_t2_data" style="text-align: center;"></tbody>`;
}

const load_t_t2_data = current_page =>{
    var c1 = sessionStorage.getItem('load_t_t2_c1');

    $.ajax({
        url:'../../process/user/table_switching/ts_lm_p.php',
        type:'POST',
        cache:false,
        data:{
            method: 'load_t_t2',
            c1: c1,
            current_page: current_page
        },
        beforeSend: () => {
            var loading = `<tr id="loading"><td colspan="6" style="text-align:center;"><div class="spinner-border text-dark" role="status"><span class="sr-only">Loading...</span></div></td></tr>`;
            if (current_page == 1) {
                document.getElementById("t_t2_data").innerHTML = loading;
            } else {
                $('#t_table tbody').append(loading);
            }
        }, 
        success:function(response){
            $('#loading').remove();
            if (current_page == 1) {
                $('#t_table tbody').html(response);
            } else {
                $('#t_table tbody').append(response);
            }
            sessionStorage.setItem('t_table_pagination', current_page);
            $('#lbl_c1').html(c1);
            $('#t_t1_breadcrumb').show();
            count_t_t2_data();
        }
    });
}

const load_t_t2 = param => {
    var string = param.split('~!~');
    var id = string[0];
    var c1 = string[1];

    sessionStorage.setItem('load_t_t2_c1', c1);

    load_t_t2_table();
    setTimeout(() => {
        load_t_t2_data(1);
    }, 500);
}
</script>