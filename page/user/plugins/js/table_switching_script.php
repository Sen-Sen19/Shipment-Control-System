<script type="text/javascript">
    // DOMContentLoaded function
	document.addEventListener("DOMContentLoaded", () => {
        load_t_t1();
    });

    const load_t_t1 = () => {
        $.ajax({
            url: '../../process/user/table_switching/ts_p.php',
            type: 'POST',
            cache: false,
            data: {
                method: 'load_t_t1'
            },
            beforeSend: () => {
                var loading = `<tr id="loading"><td colspan="6" style="text-align:center;"><div class="spinner-border text-dark" role="status"><span class="sr-only">Loading...</span></div></td></tr>`;
                document.getElementById("t_table").innerHTML = loading;
            },
            success: function (response) {
                $('#loading').remove();
                document.getElementById("t_table").innerHTML = response;
                document.getElementById("lbl_c1").innerHTML = '';
                $('#t_t1_breadcrumb').hide();
            }
        });
    }

    const load_t_t2 = param => {
        var string = param.split('~!~');
        var id = string[0];
        var c1 = string[1];

        $.ajax({
            url: '../../process/user/table_switching/ts_p.php',
            type: 'POST',
            cache: false,
            data: {
                method: 'load_t_t2',
                c1: c1
            },
            beforeSend: () => {
                var loading = `<tr id="loading"><td colspan="6" style="text-align:center;"><div class="spinner-border text-dark" role="status"><span class="sr-only">Loading...</span></div></td></tr>`;
                document.getElementById("t_table").innerHTML = loading;
            },
            success: function (response) {
                $('#loading').remove();
                document.getElementById("t_table").innerHTML = response;
                document.getElementById("lbl_c1").innerHTML = c1;
                $('#t_t1_breadcrumb').show();
            }
        });
    }
</script>