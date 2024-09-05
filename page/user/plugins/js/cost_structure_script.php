<script type="text/javascript">
    $(document).ready(function () {
        // get_fsib_data();
        count();
    });

    const get_fsib_data = () => {
        var date_from = document.getElementById('date_from').value;
        var date_to = document.getElementById('date_to').value;
        var delivery_status = document.getElementById('delivery_status').value;

        $.ajax({
            url: '../../process/user/cost_structure_p.php',
            type: 'POST',
            cache: false,
            data: {
                method: 'get_fsib_data',
                date_from: date_from,
                date_to: date_to,
                delivery_status: delivery_status

            },
            beforeSend: () => {
                var loading = `<tr id="loading"><td colspan="6" style="text-align:center;"><div class="spinner-border text-dark" role="status"><span class="sr-only">Loading...</span></div></td></tr>`;
                // document.getElementById("sp_cotdb tbody").html(loading);
                $('#sp_cotdb tbody').html(loading);
            },
            success: function (response) {
                $('#loading').remove();
                document.getElementById("sp_cotdb_body").innerHTML = response;
                // $('#sp_cotdb_body').html(response);
                count();
                // document.getElementById("lbl_c1").innerHTML = '';
                // $('#t_t1_breadcrumb').hide();
            }
        });
    }

    const count = () =>{
        // var count = document.getElementById('row_count').value;
        var date_from = document.getElementById('date_from').value;
        var date_to = document.getElementById('date_to').value;
        var delivery_status = document.getElementById('delivery_status').value;

        $.ajax({
            type: "POST",
            url: '../../process/user/cost_structure_p.php',
            data: {
                method: 'count',
                date_from: date_from,
                date_to: date_to,
                delivery_status: delivery_status,
            },
          
            success: function (response) {
                document.getElementById('row_count').innerHTML = response;
            }
        });
    }

</script>