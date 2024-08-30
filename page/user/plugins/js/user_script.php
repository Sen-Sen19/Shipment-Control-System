

<?php




if (isset($_SESSION['username'])) {
    $loggedInUser = $_SESSION['username'];
    echo '<script>';
    echo 'document.addEventListener("DOMContentLoaded", function() {';
    echo '    var inspectedByInput = document.getElementById("inspected_by");';
    echo '    inspectedByInput.value = "' . $loggedInUser . '";';
    echo '});';
    echo '</script>';
}
?>



<script>

$(document).ready(function () {
    $("#part_name_dropdown, #part_name_quantity, #outside_appearance, #slit_condition, #inside_appearance, #color_select, #inside-start, #inside-end, #outside-start, #outside-end, #q1_start, #q2_start, #q3_start, #q4_start, #q1_middle, #q2_middle, #q3_middle, #q4_midlle, #q1_end, #q2_end, #q3_end, #q4_end, #serial_no, #lot_no, #using_round_bar, #using_bare_hands, #appearance_judgment, #dimension_judgment, #defect_type, #ng_quantity, #confirm_by, #remarks").prop('disabled', true);

    $("input[name='processType']").change(function () {
      if ($(this).val() === "SP") {
        $("#serial_no").prop('disabled', true).val('N/A');
        $("#lot_no").prop('disabled', true).val('N/A');
        $("#part_name_dropdown").prop('disabled', false).val('');
        $("#part_name_quantity").prop('disabled', false).val('');
        $("#outside_appearance").prop('disabled', false).val('');
        $("#slit_condition").prop('disabled', false).val('');
        $("#inside_appearance").prop('disabled', false).val('');
        $("#color_select").prop('disabled', false).val('');
        $("#inside-start").prop('disabled', false).val('');
        $("#inside-end").prop('disabled', false).val('');
        $("#outside-start").prop('disabled', false).val('');
        $("#outside-end").prop('disabled', false).val('');
        $("#q1_start").prop('disabled', true).val('0');
        $("#q2_start").prop('disabled', true).val('0');
        $("#q3_start").prop('disabled', true).val('0');
        $("#q4_start").prop('disabled', true).val('0');
        $("#q1_middle").prop('disabled', false).val('');
        $("#q2_middle").prop('disabled', false).val('');
        $("#q3_middle").prop('disabled', false).val('');
        $("#q4_middle").prop('disabled', false).val('');
        $("#q1_end").prop('disabled', false).val('');
        $("#q2_end").prop('disabled', false).val('');
        $("#q3_end").prop('disabled', false).val('');
        $("#q4_end").prop('disabled', false).val('');
        $("#using_round_bar").prop('disabled', false).val('');
        $("#using_bare_hands").prop('disabled', false).val('');
        $("#appearance_judgment").prop('disabled', false).val('');
        $("#dimension_judgment").prop('disabled', false).val('');
        $("#dimension_judgment").prop('disabled', false).val('');
        $("#defect_type").prop('disabled', false).val('');
        $("#ng_quantity").prop('disabled', false).val('');
        $("#confirm_by").prop('disabled', false).val('');
        $("#remarks").prop('disabled', false).val('');
           
    $("#part_name_dropdown").on("change", function() {
        var partNameValue = $(this).val();
        if (
    partNameValue === "VO10X0.5(B)" || 
    partNameValue === "VO10X1(B)" || 
    partNameValue === "VO12X0.5(B)" || 
    partNameValue === "VO12X1(B)" || 
    partNameValue === "VO14X0.5(B)" || 
    partNameValue === "VO14X1(B)" || 
    partNameValue === "VO16X0.6(B)" || 
    partNameValue === "VO16X1(B)" || 
    partNameValue === "VO18X0.6(B)" || 
    partNameValue === "VO18X1(B)" || 
    partNameValue === "VO20X0.6(B)" || 
    partNameValue === "VO20X1(B)" || 
    partNameValue === "VO22X1(B)" || 
    partNameValue === "VO24X1(B)" || 
    partNameValue === "VO4X0.5(B)" || 
    partNameValue === "VO4X1(B)" || 
    partNameValue === "VO6X0.5(B)" || 
    partNameValue === "VO6X1(B)" || 
    partNameValue === "VO8X0.5(B)" || 
    partNameValue === "VO8X1(B)"   
) { 
            $("#slit_condition").prop('disabled', true).val('N/A');
            $("#q1_start").prop('disabled', false).val('');
            $("#q2_start").prop('disabled', false).val('');
            $("#q3_start").prop('disabled', false).val('');
            $("#q4_start").prop('disabled', false).val('');
            $("#q1_middle").prop('disabled', true).val('0');
            $("#q2_middle").prop('disabled', true).val('0');
            $("#q3_middle").prop('disabled', true).val('0');
            $("#q4_middle").prop('disabled', true).val('0');
            $("#outside-start").prop('disabled', true).val('0');
            $("#outside-end").prop('disabled', true).val('0');
            $("#using_round_bar").prop('disabled', true).val('N/A');
            $("#using_bare_hands").prop('disabled', true).val('N/A');

            

        } else {
            $("#slit_condition").prop('disabled', false).val('');
            $("#q1_start").prop('disabled', true).val('0');
            $("#q2_start").prop('disabled', true).val('0');
            $("#q3_start").prop('disabled', true).val('0');
            $("#q4_start").prop('disabled', true).val('0');
            $("#q1_middle").prop('disabled', false).val('');
            $("#q2_middle").prop('disabled', false).val('');
            $("#q3_middle").prop('disabled', false).val('');
            $("#q4_middle").prop('disabled', false).val('');
            $("#outside-start").prop('disabled', false).val('');
            $("#outside-end").prop('disabled', false).val('');
            $("#using_round_bar").prop('disabled', false).val('');
            $("#using_bare_hands").prop('disabled', false).val('');
        }
    });

    
    $("#part_name_dropdown").trigger("change");

      }



      
      else if ($(this).val() === "MP") {
    // Enable all other fields as before
    $("#serial_no").prop('disabled', false).val('');
    $("#lot_no").prop('disabled', false).val('');
    $("#part_name_dropdown").prop('disabled', false).val('');
    $("#part_name_quantity").prop('disabled', false).val('');
    $("#outside_appearance").prop('disabled', false).val('');
    $("#slit_condition").prop('disabled', false).val('');
    $("#inside_appearance").prop('disabled', false).val('');
    $("#color_select").prop('disabled', false).val('');
    $("#inside-start").prop('disabled', false).val('');
    $("#inside-end").prop('disabled', false).val('');
    $("#outside-start").prop('disabled', false).val('');
    $("#outside-end").prop('disabled', false).val('');

    // Disable q1_start to q4_middle fields
    $("#q1_start").prop('disabled', true).val('0');
    $("#q2_start").prop('disabled', true).val('0');
    $("#q3_start").prop('disabled', true).val('0');
    $("#q4_start").prop('disabled', true).val('0');
    $("#q1_middle").prop('disabled', true).val('0');
    $("#q2_middle").prop('disabled', true).val('0');
    $("#q3_middle").prop('disabled', true).val('0');
    $("#q4_middle").prop('disabled', true).val('0');

    // Enable q1_end to q4_end fields
    $("#q1_end").prop('disabled', false).val('');
    $("#q2_end").prop('disabled', false).val('');
    $("#q3_end").prop('disabled', false).val('');
    $("#q4_end").prop('disabled', false).val('');

    // Enable the rest of the fields
    $("#using_round_bar").prop('disabled', false).val('');
    $("#using_bare_hands").prop('disabled', false).val('');
    $("#appearance_judgment").prop('disabled', false).val('');
    $("#dimension_judgment").prop('disabled', false).val('');
    $("#defect_type").prop('disabled', false).val('');
    $("#ng_quantity").prop('disabled', false).val('');
    $("#confirm_by").prop('disabled', false).val('');
    $("#remarks").prop('disabled', false).val('');

   
    $("#part_name_dropdown").on("change", function() {
    var partNameValue = $(this).val();

    // Condition for the first set of part names
    if (
        partNameValue === "VO10X0.5(B)" || 
        partNameValue === "VO10X1(B)" || 
        partNameValue === "VO12X0.5(B)" || 
        partNameValue === "VO12X1(B)" || 
        partNameValue === "VO14X0.5(B)" || 
        partNameValue === "VO14X1(B)" || 
        partNameValue === "VO16X0.6(B)" || 
        partNameValue === "VO16X1(B)" || 
        partNameValue === "VO18X0.6(B)" || 
        partNameValue === "VO18X1(B)" || 
        partNameValue === "VO20X0.6(B)" || 
        partNameValue === "VO20X1(B)" || 
        partNameValue === "VO22X1(B)" || 
        partNameValue === "VO24X1(B)" || 
        partNameValue === "VO4X0.5(B)" || 
        partNameValue === "VO4X1(B)" || 
        partNameValue === "VO6X0.5(B)" || 
        partNameValue === "VO6X1(B)" || 
        partNameValue === "VO8X0.5(B)" || 
        partNameValue === "VO8X1(B)"
    ) { 
        // Actions specific to the first condition
        $("#slit_condition").prop('disabled', true).val('N/A');
        $("#q1_start, #q2_start, #q3_start, #q4_start").prop('disabled', false).val('');
        $("#q1_middle, #q2_middle, #q3_middle, #q4_middle").prop('disabled', true).val('0');
        $("#outside-start, #outside-end").prop('disabled', true).val('0');
        $("#using_round_bar, #using_bare_hands").prop('disabled', true).val('N/A');
    } 
    // Condition for the second set of part names
    else if (
        partNameValue === "NCOT13-NC" || 
        partNameValue === "RCOT13" || 
        partNameValue === "NCOT13" || 
        partNameValue === "NCOT15" || 
        partNameValue === "RCOT15" || 
        partNameValue === "NCOT19" || 
        partNameValue === "RCOT19"
    ) { 
        // Actions specific to the second condition
        $("#q1_start, #q2_start, #q3_start, #q4_start").prop('disabled', false).val('');
    } 
    // Default actions when none of the conditions match
    else {
        $("#slit_condition").prop('disabled', false).val('N/A');
        $("#q1_start, #q2_start, #q3_start, #q4_start").prop('disabled', true).val('0');
        $("#q1_middle, #q2_middle, #q3_middle, #q4_middle").prop('disabled', false).val('');
        $("#outside-start, #outside-end").prop('disabled', false).val('');
        $("#using_round_bar, #using_bare_hands").prop('disabled', false).val('');
    }
});

// Optionally, you can call the change event once manually during page load, if needed
$(document).ready(function() {
    $("#part_name_dropdown").trigger("change");
});

}

      else if ($(this).val() === "EP") {
        $("#serial_no").prop('disabled', true).val('N/A');
        $("#lot_no").prop('disabled', true).val('N/A');
        $("#part_name_dropdown").prop('disabled', false).val('');
        $("#part_name_quantity").prop('disabled', false).val('');
        $("#outside_appearance").prop('disabled', false).val('');
        $("#slit_condition").prop('disabled', false).val('');
        $("#inside_appearance").prop('disabled', false).val('');
        $("#color_select").prop('disabled', false).val('');
        $("#inside-start").prop('disabled', false).val('');
        $("#inside-end").prop('disabled', false).val('');
        $("#outside-start").prop('disabled', false).val('');
        $("#outside-end").prop('disabled', false).val('');
        $("#q1_start").prop('disabled', false).val('0');
        $("#q2_start").prop('disabled', false).val('0');
        $("#q3_start").prop('disabled', false).val('0');
        $("#q4_start").prop('disabled', false).val('0');
        $("#q1_middle").prop('disabled', true).val('0');
        $("#q2_middle").prop('disabled', true).val('0');
        $("#q3_middle").prop('disabled', true).val('0');
        $("#q4_middle").prop('disabled', true).val('0');
        $("#q1_end").prop('disabled', false).val('');
        $("#q2_end").prop('disabled', false).val('');
        $("#q3_end").prop('disabled', false).val('');
        $("#q4_end").prop('disabled', false).val('');
        $("#using_round_bar").prop('disabled', false).val('');
        $("#using_bare_hands").prop('disabled', false).val('');
        $("#appearance_judgment").prop('disabled', false).val('');
        $("#dimension_judgment").prop('disabled', false).val('');
        $("#dimension_judgment").prop('disabled', false).val('');
        $("#defect_type").prop('disabled', false).val('');
        $("#ng_quantity").prop('disabled', false).val('');
        $("#confirm_by").prop('disabled', false).val('');
        $("#remarks").prop('disabled', false).val('');
        $("#part_name_dropdown").on("change", function() {
        var partNameValue = $(this).val();
        if (
    partNameValue === "VO10X0.5(B)" || 
    partNameValue === "VO10X1(B)" || 
    partNameValue === "VO12X0.5(B)" || 
    partNameValue === "VO12X1(B)" || 
    partNameValue === "VO14X0.5(B)" || 
    partNameValue === "VO14X1(B)" || 
    partNameValue === "VO16X0.6(B)" || 
    partNameValue === "VO16X1(B)" || 
    partNameValue === "VO18X0.6(B)" || 
    partNameValue === "VO18X1(B)" || 
    partNameValue === "VO20X0.6(B)" || 
    partNameValue === "VO20X1(B)" || 
    partNameValue === "VO22X1(B)" || 
    partNameValue === "VO24X1(B)" || 
    partNameValue === "VO4X0.5(B)" || 
    partNameValue === "VO4X1(B)" || 
    partNameValue === "VO6X0.5(B)" || 
    partNameValue === "VO6X1(B)" || 
    partNameValue === "VO8X0.5(B)" || 
    partNameValue === "VO8X1(B)"   
) { 
            $("#slit_condition").prop('disabled', true).val('N/A');
            $("#q1_start").prop('disabled', false).val('');
            $("#q2_start").prop('disabled', false).val('');
            $("#q3_start").prop('disabled', false).val('');
            $("#q4_start").prop('disabled', false).val('');
            $("#q1_middle").prop('disabled', true).val('0');
            $("#q2_middle").prop('disabled', true).val('0');
            $("#q3_middle").prop('disabled', true).val('0');
            $("#q4_middle").prop('disabled', true).val('0');
            $("#outside-start").prop('disabled', true).val('0');
            $("#outside-end").prop('disabled', true).val('0');
            $("#using_round_bar").prop('disabled', true).val('N/A');
            $("#using_bare_hands").prop('disabled', true).val('N/A');

            

        } else {
            $("#slit_condition").prop('disabled', false).val('');
            $("#q1_start").prop('disabled', true).val('0');
            $("#q2_start").prop('disabled', true).val('0');
            $("#q3_start").prop('disabled', true).val('0');
            $("#q4_start").prop('disabled', true).val('0');
            $("#q1_middle").prop('disabled', false).val('');
            $("#q2_middle").prop('disabled', false).val('');
            $("#q3_middle").prop('disabled', false).val('');
            $("#q4_middle").prop('disabled', false).val('');
            $("#outside-start").prop('disabled', false).val('');
            $("#outside-end").prop('disabled', false).val('');
            $("#using_round_bar").prop('disabled', false).val('');
            $("#using_bare_hands").prop('disabled', false).val('');
        }
    });

    
    $("#part_name_dropdown").trigger("change");

      }
      else {


      }
    });
  });

// --------------------------------modal open------------------------
document.getElementById("openModalBtn").addEventListener("click", function() {
     
    });





// ------------------------------Get PartName-------------------------
$(document).ready(function() {
    $.ajax({
        url: '../../process/get_partname.php',
        method: 'GET',
        success: function(data) {
            var parts = JSON.parse(data);
            var dropdown1 = $('#part_name_dropdown');
            var dropdown2 = $('#partName'); 
            dropdown1.empty();
            dropdown1.append('<option selected="true" disabled>Choose Part</option>');
            dropdown1.prop('selectedIndex', 0);
         
            $.each(parts, function (key, entry) {
                dropdown1.append($('<option></option>').attr('value', entry.part_name)
                    .data('iDiaMin', entry.i_dia_min)
                    .data('iDiaMax', entry.i_dia_max)
                    .data('oDiaMin', entry.o_dia_min)
                    .data('oDiaMax', entry.o_dia_max)
                    .data('wMin', entry.w_min)
                    .data('wValue', entry.w_value)
                    .data('wMax', entry.w_max)
                    .data('iDiaTolMin', entry.i_dia_tol_min)
                    .data('iDiaTolMax', entry.i_dia_tol_add)
                    .data('oDiaTolMin', entry.o_dia_tol_min)
                    .data('oDiaTolMax', entry.o_dia_tol_add)
                    .data('wTolMin', entry.w_tol_min)
                    .data('wTolMax', entry.w_tol_add)
                    .text(entry.part_name));

                  
            });
        },
        error: function() {
            alert('Failed to retrieve data.');
        }
    });

    $('#part_name_dropdown').change(function() {
    var selectedOption = $(this).find(':selected');



   
    $('#i-diameter-min').val(selectedOption.data('iDiaMin'));
    $('#i-diameter-max').val(selectedOption.data('iDiaMax'));
      // Set min and max values for outside diameter
      $('#o-diameter-min').val(selectedOption.data('oDiaMin'));
    $('#o-diameter-max').val(selectedOption.data('oDiaMax'));



    $('#tolerance-plus').val(selectedOption.data('iDiaTolMin'));
    $('#tolerance-minus').val(selectedOption.data('iDiaTolMax'));

   
    $('#o-tolerance-plus').val(selectedOption.data('oDiaTolMin'));
    $('#o-tolerance-minus').val(selectedOption.data('oDiaTolMax'));

    
    $('#o-min').val(selectedOption.data('oDiaMin'));
    $('#o-max').val(selectedOption.data('oDiaMax'));


    $('#w-tolerance-plus').val(selectedOption.data('wTolMin'));
    $('#w-tolerance-minus').val(selectedOption.data('wTolMax'));


    $('#w-min').val(selectedOption.data('wMin'));
    $('#w-value').val(selectedOption.data('wValue'));
    $('#w-max').val(selectedOption.data('wMax'));


    $('#inside-start').val('').removeClass('is-invalid');
    $('#inside-end').val('').removeClass('is-invalid');
    $('#inside-start').data('iDiaMin', selectedOption.data('iDiaMin'));
    $('#inside-end').data('iDiaMax', selectedOption.data('iDiaMax'));

    
    $('#outside-start').val('').removeClass('is-invalid');
    $('#outside-end').val('').removeClass('is-invalid');
    $('#outside-start').data('oDiaMin', selectedOption.data('oDiaMin'));
    $('#outside-end').data('oDiaMax', selectedOption.data('oDiaMax'));

   
    $('#q1_start').val('').removeClass('is-invalid');
    $('#q1_middle').val('').removeClass('is-invalid');
    $('#q1_end').val('').removeClass('is-invalid');
    $('#q1_start').data('wMin', selectedOption.data('wMin'));
    $('#q1_middle').data('wValue', selectedOption.data('wValue'));
    $('#q1_end').data('wMax', selectedOption.data('wMax'));

   
    $('#q2_start').val('').removeClass('is-invalid');
    $('#q2_middle').val('').removeClass('is-invalid');
    $('#q2_end').val('').removeClass('is-invalid');
    $('#q2_start').data('wMin', selectedOption.data('wMin'));
    $('#q2_middle').data('wValue', selectedOption.data('wValue'));
    $('#q2_end').data('wMax', selectedOption.data('wMax'));

    
    $('#q3_start').val('').removeClass('is-invalid');
    $('#q3_middle').val('').removeClass('is-invalid');
    $('#q3_end').val('').removeClass('is-invalid');
    $('#q3_start').data('wMin', selectedOption.data('wMin'));
    $('#q3_middle').data('wValue', selectedOption.data('wValue'));
    $('#q3_end').data('wMax', selectedOption.data('wMax'));


    $('#q4_start').val('').removeClass('is-invalid');
    $('#q4_middle').val('').removeClass('is-invalid');
    $('#q4_end').val('').removeClass('is-invalid');
    $('#q4_start').data('wMin', selectedOption.data('wMin'));
    $('#q4_middle').data('wValue', selectedOption.data('wValue'));
    $('#q4_end').data('wMax', selectedOption.data('wMax'));
});


    $('#inside-start').on('input', function() {
    var startVal = $(this).val();
    var iDiaMin = $(this).data('iDiaMin');
    var iDiaMax = $('#inside-end').data('iDiaMax'); 

  
    if (startVal !== '' && (parseFloat(startVal) < parseFloat(iDiaMin) || parseFloat(startVal) > parseFloat(iDiaMax))) {
        $(this).addClass('is-invalid');
    } else {
        $(this).removeClass('is-invalid');
    }
});
$('#inside-end').on('input', function() {
    var endVal = $(this).val();
    var iDiaMin = $('#inside-start').data('iDiaMin'); 
    var iDiaMax = $(this).data('iDiaMax');

  
    if (endVal !== '' && (parseFloat(endVal) < parseFloat(iDiaMin) || parseFloat(endVal) > parseFloat(iDiaMax))) {
        $(this).addClass('is-invalid');
    } else {
        $(this).removeClass('is-invalid');
    }
});
$('#outside-start').on('input', function() {
    var startVal = $(this).val();
    var oDiaMin = $(this).data('oDiaMin');
    var oDiaMax = $('#outside-end').data('oDiaMax'); 

    
    if (startVal !== '' && (parseFloat(startVal) < parseFloat(oDiaMin) || parseFloat(startVal) > parseFloat(oDiaMax))) {
        $(this).addClass('is-invalid');
    } else {
        $(this).removeClass('is-invalid');
    }
});


 $('#outside-end').on('input', function() {
    var endVal = $(this).val();
    var oDiaMin = $('#outside-start').data('oDiaMin'); 
    var oDiaMax = $(this).data('oDiaMax');


    if (endVal !== '' && (parseFloat(endVal) < parseFloat(oDiaMin) || parseFloat(endVal) > parseFloat(oDiaMax))) {
        $(this).addClass('is-invalid');
    } else {
        $(this).removeClass('is-invalid');
    }
});

$('#q1_start,#q2_start,#q3_start,#q4_start').on('input', function() {
    var endVal = $(this).val();
    var wMax = $('#q1_end,#q2_end,#q3_end,#q4_end').data('wMax'); 
    var wMin = $(this).data('wMin');


    if (endVal !== '' && (parseFloat(endVal) < parseFloat(wMin) || parseFloat(endVal) > parseFloat(wMax))) {
        $(this).addClass('is-invalid');
    } else {
        $(this).removeClass('is-invalid');
    }
});

    


    $('#q1_middle, #q2_middle, #q3_middle, #q4_middle').on('input', function() {
    var endVal = $(this).val();
    var wMax = $('#q1_end,#q2_end,#q3_end,#q4_end').data('wMax'); 
    var wMin = $('#q1_start,#q2_start,#q3_start,#q4_start').data('wMin');

  
    if (endVal !== '' && (parseFloat(endVal) < parseFloat(wMin) || parseFloat(endVal) > parseFloat(wMax))) {
        $(this).addClass('is-invalid');
    } else {
        $(this).removeClass('is-invalid');
    }
});
    

    $('#q1_end,#q2_end,#q3_end,#q4_end').on('input', function() {
    var endVal = $(this).val();
    var wMin = $('#q1_start,#q2_start,#q3_start,#q4_start').data('wMin'); 
    var wMax = $(this).data('wMax');

   
    if (endVal !== '' && (parseFloat(endVal) < parseFloat(wMin) || parseFloat(endVal) > parseFloat(wMax))) {
        $(this).addClass('is-invalid');
    } else {
        $(this).removeClass('is-invalid');
    }
});
});



        // -----------------------Inspection Date --------------------------
        document.addEventListener('DOMContentLoaded', (event) => {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); 
    var yyyy = today.getFullYear();
    
    var formattedDate = yyyy + '-' + mm + '-' + dd;
    

    document.getElementById('inspection_date').value = formattedDate;
});





  // -----------------------Time Start, End and Total Mins --------------------------





  document.addEventListener('DOMContentLoaded', function() {
    var startTimeInput = document.getElementById('start_time');
    var endTimeInput = document.getElementById('end_time');
    var totalMinsInput = document.getElementById('total_mins');
    var startButton = document.querySelector('.start-button');
    var endButton = document.querySelector('.end-button');
    var shiftInput = document.getElementById('shift_select');

    startButton.addEventListener('click', function() {
        var startTime = new Date();
        startTimeInput.value = formatDateTime(startTime);
        updateShift(startTime);
    });

    endButton.addEventListener('click', function() {
        var endTime = new Date();
        endTimeInput.value = formatDateTime(endTime);

        var startTimestamp = new Date(startTimeInput.value);
        var endTimestamp = new Date(endTimeInput.value);
        var timeDifference = endTimestamp - startTimestamp;

        var totalMinutes = timeDifference / (1000 * 60); 
        totalMinsInput.value = totalMinutes.toFixed(2); 
    });

    function formatDateTime(dateTime) {
        var year = dateTime.getFullYear();
        var month = (dateTime.getMonth() + 1).toString().padStart(2, '0');
        var day = dateTime.getDate().toString().padStart(2, '0');
        var hours = dateTime.getHours().toString().padStart(2, '0');
        var minutes = dateTime.getMinutes().toString().padStart(2, '0');
        var seconds = dateTime.getSeconds().toString().padStart(2, '0');
        return year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':' + seconds;
    }

    function updateShift(startTime) {
        var hours = startTime.getHours();
        if (hours >= 6 && hours < 18) {
            shiftInput.value = "Dayshift";
        } else { 
            shiftInput.value = "Night shift";
        }
    }
});





// -------------------------Clear Button----------------------------------
document.addEventListener("DOMContentLoaded", function() {
    const clearButton = document.querySelector("#addRecordModal .btn-danger");

    clearButton.addEventListener("click", function() {
        const inputs = document.querySelectorAll("#addRecordModal input");
        const selects = document.querySelectorAll("#addRecordModal select");
        const textareas = document.querySelectorAll("#addRecordModal textarea");
        const excludedIds = ['inspected_by', 'inspection_date'];

        inputs.forEach(input => {
            if (!excludedIds.includes(input.id) && input.type !== 'button' && input.type !== 'submit') {
                input.value = '';
            }
        });

        selects.forEach(select => {
            if (!excludedIds.includes(select.id)) {
                select.selectedIndex = 0;
            }
        });

        textareas.forEach(textarea => {
            if (!excludedIds.includes(textarea.id)) {
                textarea.value = '';
            }
        });

        Swal.fire({
            icon: 'success',
            title: 'Form Cleared',
            text: 'All fields have been cleared.',
            showConfirmButton: false,
            timer: 1500
        });
    });
});



// -------------------------------save-------------------------------
function saveData() {
    var form = document.getElementById('myForm');
    var formData = new FormData(form);
    var isEmpty = false;

    
    function resetBorder(event) {
        event.target.style.border = ''; 
    }


    form.querySelectorAll('input[type="text"]').forEach(input => {
        input.style.border = ''; 
        input.removeEventListener('input', resetBorder); 
    });


    form.querySelectorAll('select').forEach(select => {
        select.style.border = '';
    });

   
    form.querySelectorAll('input[type="text"]').forEach(input => {
        if (input.value.trim() === "") {
            isEmpty = true;
            input.style.border = '1px solid red';

           
            input.addEventListener('input', resetBorder);
        }
    });

    
    form.querySelectorAll('select').forEach(select => {
        if (select.value.trim() === "") {
            isEmpty = true;
            select.style.border = '1px solid red';
        }
    });

  
    var processValue = '';
    var spChecked = document.getElementById('sp').checked;
    var mpChecked = document.getElementById('mp').checked;
    var epChecked = document.getElementById('ep').checked;

    if (!spChecked && !mpChecked && !epChecked) {
        isEmpty = true;
        Swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'Please select one of SP, MP, or EP!',
            showConfirmButton: true
        });
        return;
    } else {
        if (spChecked) {
            processValue = 'Start Point';
        } else if (mpChecked) {
            processValue = 'Mass Production';
        } else if (epChecked) {
            processValue = 'End Point';
        }
        formData.append('process', processValue); 
    }

    if (isEmpty) {
        Swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'Please fill out all required fields!',
            showConfirmButton: true
        });
        return;
    }

  
    form.querySelectorAll('input, select, button').forEach(element => {
        element.disabled = true;
    });

    
    fetch('../../process/cot_save.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.text();
    })
    .then(data => {
        console.log(data);

        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Your work has been saved',
            showConfirmButton: false,
            timer: 1500
        });

        setTimeout(function() {
            // window.location.reload();
        }, 1600);
    })
    .catch(error => {
        console.error('Error:', error);

        Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Oops...',
            text: 'There was an error saving the data.',
            timer: 1500
        });
    })
    .finally(() => {
      
        form.querySelectorAll('input, select, button').forEach(element => {
            element.disabled = false;
        });
    });
}





// ------------------------------------------------date-------------------------------------------------

function formatDate(dateObject, isInspectionDate = false, removeMilliseconds = false) {
    if (!dateObject) return ''; 

    const date = new Date(dateObject.date);
    
    if (isInspectionDate) {
        return date.toLocaleDateString();
    } else {
        let formattedDate = date.toLocaleDateString();
        let formattedTime = date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', second: '2-digit' });

        if (removeMilliseconds) {
      
            formattedTime = formattedTime.replace(/\.\d+/, '');
        }

        return `${formattedDate} ${formattedTime}`;
    }
}


// --------------------------------------------refresh button -----------------------------------------------------
function refreshPage() {
        window.location.reload(); 
    }


//------------------------------------------------defect type--------------------------------------------------------

function handleDefectTypeChange() {
            const defectType = document.getElementById('defect_type');
            const selectedOption = defectType.value;

            if (selectedOption === 'Others') {
              
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Do you want to specify another defect type?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, specify',
                    cancelButtonText: 'No, cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                  
                        const inputField = document.createElement('input');
                        inputField.setAttribute('type', 'text');
                        inputField.setAttribute('class', 'form-control');
                        inputField.setAttribute('id', 'other_defect_type'); 
                        inputField.setAttribute('name', 'defect_type');
                        inputField.setAttribute('placeholder', 'Specify other defect type');
                        inputField.style.marginBottom = '16px';

                        const defectContainer = document.getElementById('defect-container');
                        defectContainer.innerHTML = ''; 
                        defectContainer.appendChild(inputField);
                    } else {
                       
                        defectType.value = "";
                    }
                });
            }
        }

        function handleFormSubmit(event) {
            event.preventDefault(); 

       
            const otherDefectTypeInput = document.getElementById('other_defect_type');
            if (otherDefectTypeInput) {
                const defectType = document.getElementById('defect_type');
                defectType.value = otherDefectTypeInput.value;
            }

            
            console.log('Form submitted with defect type:', document.getElementById('defect_type').value);
           
        }

        function clearForm() {
            document.getElementById('defectForm').reset();
           
            const defectContainer = document.getElementById('defect-container');
            defectContainer.innerHTML = ''; 
            
            const selectElement = document.createElement('select');
            selectElement.id = 'defect_type';
            selectElement.className = 'form-control';
            selectElement.name = 'defect_type';
            selectElement.style.marginBottom = '16px';
            selectElement.onchange = handleDefectTypeChange;
            selectElement.innerHTML = `
                <option value="" selected disabled>Choose...</option>
                <option value="N/A">N/A</option>
                <option value="Round crest">Round crest</option>
                <option value="Damage">Damage</option>
                <option value="Molding defect">Molding defect</option>
                <option value="Excess burr">Excess burr</option>
                <option value="Dent">Dent</option>
                <option value="Misaligned joint portion">Misaligned joint portion</option>
                <option value="Foreign material">Foreign material</option>
                <option value="Slit position is on joint portion">Slit position is on joint portion</option>
                <option value="With gap on slit">With gap on slit</option>
                <option value="Crack">Crack</option>
                <option value="Overlap">Overlap</option>
                <option value="Slit is uneven">Slit is uneven</option>
                <option value="Slanted slit">Slanted slit</option>
                <option value="Unstable thickness">Unstable thickness</option>
                <option value="Tubebreaking on slit portion">Tubebreaking on slit portion</option>
                <option value="Out of Tolerance">Out of Tolerance</option>
                <option value="Others">Others</option>
            `;
            defectContainer.appendChild(selectElement);
        }


        // ----------------------------------export-----------------------------------
        
function exportTable() {
    const partName = document.getElementById('partName').value;
    const inspectedBy = document.getElementById('inspectedBy').value;
    const defectType = document.getElementById('defectType').value;
    const dateFrom = document.getElementById('date_from').value;
    const dateTo = document.getElementById('date_to').value;

  
    const currentDate = new Date().toISOString().slice(0, 10);


    const filename = `COT_Start_Point_${currentDate}.csv`;


    const url = `../../process/cot_sp_export_data.php?partName=${encodeURIComponent(partName)}&inspectedBy=${encodeURIComponent(inspectedBy)}&defectType=${encodeURIComponent(defectType)}&dateFrom=${encodeURIComponent(dateFrom)}&dateTo=${encodeURIComponent(dateTo)}`;


    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.blob(); 
        })
        .then(blob => {
            
            const downloadUrl = window.URL.createObjectURL(blob);

            
            const a = document.createElement('a');
            a.style.display = 'none';
            a.href = downloadUrl;
            a.download = filename; 
            document.body.appendChild(a);

           
            a.click();

            
            window.URL.revokeObjectURL(downloadUrl);
        })
        .catch(error => {
            console.error('Error exporting data:', error);
        });
}
document.addEventListener('DOMContentLoaded', () => {
        let offset = 0;
        const limit = 10;

      
        loadTableData(offset, limit);

   
        document.getElementById('btnLoadMore').addEventListener('click', () => {
            offset += limit;
            loadTableData(offset, limit);
        });

       
        document.getElementById('accounts_table_res').addEventListener('scroll', () => {
            const container = document.getElementById('accounts_table_res');
            if (container.scrollTop + container.clientHeight >= container.scrollHeight) {
                offset += limit;
                loadTableData(offset, limit);
            }
        });

        
        document.getElementById('searchbtn').addEventListener('click', () => {
            offset = 0;
            loadTableData(offset, limit, true);
        });
    });

    function loadTableData(offset, limit, reset = false) {
     
        const partName = document.getElementById('partName').value;
        const inspectedBy = document.querySelector('input[placeholder="Inspected By"]').value;
        const defectType = document.getElementById('defectType').value;
        const dateFrom = document.getElementById('date_from').value;
        const dateTo = document.getElementById('date_to').value;

        const url = `../../process/cot_get_data.php?offset=${offset}&limit=${limit}&partName=${partName}&inspectedBy=${inspectedBy}&defectType=${defectType}&dateFrom=${dateFrom}&dateTo=${dateTo}`;

        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (reset) {
                    document.getElementById('sp_cotdb_body').innerHTML = '';
                }
                populateTable(data);

          
                if (data.length < limit) {
                    document.getElementById('btnLoadMore').style.display = 'none';
                } else {
                    document.getElementById('btnLoadMore').style.display = 'block';
                }
            })
            .catch(error => console.error('Error fetching data:', error));
    }

  


    // -----------------------------populate table-------------------
    function populateTable(data) {
        const tbody = document.getElementById('sp_cotdb_body');

        data.forEach(row => {
            const newRow = tbody.insertRow();

            // Format date fields
            const timeStart = formatDate(row.time_start, false, true); 
            const timeEnd = formatDate(row.time_end, false, true);
            const inspectionDate = formatDate(row.inspection_date, true);

            newRow.innerHTML = `
            <td>${row.id}</td>
            <td>${row.part_name}</td>
            <td>${row.process}</td>
             <td>${row.serial_no}</td>
              <td>${row.lot_no}</td>
            <td>${row.quantity}</td>
            <td>${timeStart}</td>
            <td>${timeEnd}</td>
            <td>${row.inspected_by}</td>
            <td>${row.shift}</td>
            <td>${inspectionDate}</td>
            <td>${row.total_mins}</td>
            <td>${row.outside_appearance}</td>
            <td>${row.slit_condition}</td>
            <td>${row.inside_appearance}</td>
            <td>${row.color}</td>
            <td>${row.i_tolerance_plus}</td>
            <td>${row.i_tolerance_minus}</td>
            <td>${row.i_diameter_start}</td>
            <td>${row.i_diameter_end}</td>
            <td>${row.o_tolerance_plus}</td>
            <td>${row.o_tolerance_minus}</td>
            <td>${row.o_diameter_start}</td>
            <td>${row.o_diameter_end}</td>
            <td>${row.w_tolerance_plus}</td>
            <td>${row.w_tolerance_minus}</td>
            <td>${row.q1_start}</td>
            <td>${row.q2_start}</td>
            <td>${row.q3_start}</td>
            <td>${row.q4_start}</td>
            <td>${row.q1_middle}</td>
            <td>${row.q2_middle}</td>
            <td>${row.q3_middle}</td>
            <td>${row.q4_middle}</td>
            <td>${row.q1_end}</td>
            <td>${row.q2_end}</td>
            <td>${row.q3_end}</td>
            <td>${row.q4_end}</td>
            <td>${row.using_round_bar}</td>
            <td>${row.using_bare_hands}</td>
            <td>${row.appearance_judgement}</td>
            <td>${row.dimension_judgement}</td>
            <td>${row.ng_quantity}</td>
            <td>${row.defect_type}</td>
            <td>${row.confirm_by}</td>
            <td>${row.remarks}</td>
        `;
            newRow.addEventListener('click', () => {
                
                openModalWithData(row);
            });
        });
    }
    document.addEventListener('DOMContentLoaded', () => {
     
        fetch('../../process/get_partname.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
              
                const partNameSelect = document.getElementById('partName');
                data.forEach(part => {
                    const option = document.createElement('option');
                    option.value = part.part_name;
                    option.textContent = part.part_name;
                    partNameSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching part names:', error));
    });



    function exportTable() {
        const partName = document.getElementById('partName').value;
        const inspectedBy = document.getElementById('inspectedBy').value;
        const defectType = document.getElementById('defectType').value;
        const dateFrom = document.getElementById('date_from').value;
        const dateTo = document.getElementById('date_to').value;

       
        const currentDate = new Date().toISOString().slice(0, 10);

       
        const filename = `COT_Start_Point_${currentDate}.csv`;


        const url = `../../process/cot_sp_export_data.php?partName=${encodeURIComponent(partName)}&inspectedBy=${encodeURIComponent(inspectedBy)}&defectType=${encodeURIComponent(defectType)}&dateFrom=${encodeURIComponent(dateFrom)}&dateTo=${encodeURIComponent(dateTo)}`;

     
        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.blob();
            })
            .then(blob => {

                const downloadUrl = window.URL.createObjectURL(blob);


                const a = document.createElement('a');
                a.style.display = 'none';
                a.href = downloadUrl;
                a.download = filename;
                document.body.appendChild(a);


                a.click();


                window.URL.revokeObjectURL(downloadUrl);
            })
            .catch(error => {
                console.error('Error exporting data:', error);
            });
    }


    // ---------------------------------------------------------- Edit Modal----------------------------------------------------------------------
    function openModalWithData(rowData) {
        const modalBody = document.getElementById('modalDataContent');
        modalBody.innerHTML = ''; 

       
        const modalContent = `
        <form id="inspectionForm">
            <table class="table table-bordered">
                <tbody>
                     <tr>
                    <th>ID:</th>
                    <td><input type="text" name="id" value="${rowData.id}" class="form-control" readonly></td>
                    <th>Part Name:</th>
                    <td><input type="text" name="part_name" value="${rowData.part_name}" class="form-control" readonly></td>
                </tr>
                <tr>
                    <th>Quantity:</th>
                    <td><input type="text" name="quantity" value="${rowData.quantity}" class="form-control"></td>
                    <th>Inspected By:</th>
                    <td><input type="text" name="inspected_by" value="${rowData.inspected_by}" class="form-control" readonly></td>
                </tr>
                <tr>
                    <th>Shift:</th>
                    <td><input type="text" name="shift" value="${rowData.shift}" class="form-control"readonly></td>
                    <th>Total Minutes:</th>
                    <td><input type="text" name="total_mins" value="${rowData.total_mins}" class="form-control" readonly></td>
                </tr>
                <tr>
                    <th>Outside Appearance:</th>
                    <td>
                        <select name="outside_appearance" class="form-control">
                            <option value="OK" ${rowData.outside_appearance === 'OK' ? 'selected' : ''}>OK</option>
                            <option value="NG" ${rowData.outside_appearance === 'NG' ? 'selected' : ''}>NG</option>
                        </select>
                    </td>
                    <th>Slit Condition:</th>
                    <td>
                        <select name="slit_condition" class="form-control">
                            <option value="OK" ${rowData.slit_condition === 'OK' ? 'selected' : ''}>OK</option>
                            <option value="NG" ${rowData.slit_condition === 'NG' ? 'selected' : ''}>NG</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Inside Appearance:</th>
                    <td>
                        <select name="inside_appearance" class="form-control">
                            <option value="OK" ${rowData.inside_appearance === 'OK' ? 'selected' : ''}>OK</option>
                            <option value="NG" ${rowData.inside_appearance === 'NG' ? 'selected' : ''}>NG</option>
                        </select>
                    </td>
                    <th>Color:</th>
                    <td>
                        <select name="color" class="form-control">
                            <option value="OK" ${rowData.color === 'OK' ? 'selected' : ''}>OK</option>
                            <option value="NG" ${rowData.color === 'NG' ? 'selected' : ''}>NG</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Using Round Bar:</th>
                    <td>
                        <select name="using_round_bar" class="form-control">
                            <option value="OK" ${rowData.using_round_bar === 'OK' ? 'selected' : ''}>OK</option>
                            <option value="NG" ${rowData.using_round_bar === 'NG' ? 'selected' : ''}>NG</option>
                        </select>
                    </td>
                    <th>Using Bare Hands:</th>
                    <td>
                        <select name="using_bare_hands" class="form-control">
                            <option value="OK" ${rowData.using_bare_hands === 'OK' ? 'selected' : ''}>OK</option>
                            <option value="NG" ${rowData.using_bare_hands === 'NG' ? 'selected' : ''}>NG</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Inner Diameter Tolerance Plus:</th>
                    <td><input type="text" name="i_tolerance_plus" value="${rowData.i_tolerance_plus}" class="form-control" readonly></td>
                    <th>Inner Diameter Tolerance Minus:</th>
                    <td><input type="text" name="i_tolerance_minus" value="${rowData.i_tolerance_minus}" class="form-control" readonly></td>
                </tr>
                <tr>
                    <th>Inner Diameter Start:</th>
                    <td><input type="text" name="i_diameter_start" value="${rowData.i_diameter_start}" class="form-control"></td>
                    <th>Inner Diameter End:</th>
                    <td><input type="text" name="i_diameter_end" value="${rowData.i_diameter_end}" class="form-control"></td>
                </tr>
                <tr>
                    <th>Outer Diameter Tolerance Plus:</th>
                    <td><input type="text" name="o_tolerance_plus" value="${rowData.o_tolerance_plus}" class="form-control" readonly></td>
                    <th>Outer Diameter Tolerance Minus:</th>
                    <td><input type="text" name="o_tolerance_minus" value="${rowData.o_tolerance_minus}" class="form-control" readonly></td>
                </tr>
                <tr>
                    <th>Outer Diameter Start:</th>
                    <td><input type="text" name="o_diameter_start" value="${rowData.o_diameter_start}" class="form-control"></td>
                    <th>Outer Diameter End:</th>
                    <td><input type="text" name="o_diameter_end" value="${rowData.o_diameter_end}" class="form-control"></td>
                </tr>
                <tr>
                    <th>W Tolerance + :</th>
                    <td><input type="text" name="w_tolerance_plus" value="${rowData.w_tolerance_plus}" class="form-control" readonly></td>
                    <th>W Tolerance - :</th>
                    <td><input type="text" name="w_tolerance_minus" value="${rowData.w_tolerance_minus}" class="form-control" readonly></td>
                </tr>
                <tr>
                    <th>Q1 Start:</th>
                    <td><input type="text" name="q1_start" value="${rowData.q1_start}" class="form-control" ></td>
                    <th>Q2 Start:</th>
                    <td><input type="text" name="q2_start" value="${rowData.q2_start}" class="form-control" ></td>
                </tr>
                <tr>
                    <th>Q3 Start:</th>
                    <td><input type="text" name="q3_start" value="${rowData.q3_start}" class="form-control" ></td>
                    <th>Q4 Start:</th>
                    <td><input type="text" name="q4_start" value="${rowData.q4_start}" class="form-control" ></td>
                </tr>
                <tr>
                    <th>Q1 Middle:</th>
                    <td><input type="text" name="q1_middle" value="${rowData.q1_middle}" class="form-control" ></td>
                    <th>Q2 Middle:</th>
                    <td><input type="text" name="q2_middle" value="${rowData.q2_middle}" class="form-control" ></td>
                </tr>
                <tr>
                    <th>Q3 Middle:</th>
                    <td><input type="text" name="q3_middle" value="${rowData.q3_middle}" class="form-control" ></td>
                    <th>Q4 Middle:</th>
                    <td><input type="text" name="q4_middle" value="${rowData.q4_middle}" class="form-control" ></td>
                </tr>
                <tr>
                    <th>Q1 End:</th>
                    <td><input type="text" name="q1_end" value="${rowData.q1_end}" class="form-control" ></td>
                    <th>Q2 End:</th>
                    <td><input type="text" name="q2_end" value="${rowData.q2_end}" class="form-control" ></td>
                </tr>
                <tr>
                    <th>Q3 End:</th>
                    <td><input type="text" name="q3_end" value="${rowData.q3_end}" class="form-control" ></td>
                    <th>Q4 End:</th>
                    <td><input type="text" name="q4_end" value="${rowData.q4_end}" class="form-control" ></td>
                </tr>
                <tr>
                    <th>Defect Type:</th>
                    <td><input type="text" name="defect_type" value="${rowData.defect_type}" class="form-control"></td>
                    <th>NG Quantity:</th>
                    <td><input type="text" name="ng_quantity" value="${rowData.ng_quantity}" class="form-control"></td>
                </tr>
                <tr>
                    <th>Appearance Judgement:</th>
                    <td>
                        <select name="appearance_judgement" class="form-control">
                            <option value="OK" ${rowData.appearance_judgement === 'OK' ? 'selected' : ''}>OK</option>
                            <option value="NG" ${rowData.appearance_judgement === 'NG' ? 'selected' : ''}>NG</option>
                        </select>
                    </td>
                    <th>Dimension Judgement:</th>
                    <td>
                        <select name="dimension_judgement" class="form-control">
                            <option value="OK" ${rowData.dimension_judgement === 'OK' ? 'selected' : ''}>OK</option>
                            <option value="NG" ${rowData.dimension_judgement === 'NG' ? 'selected' : ''}>NG</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Confirm By:</th>
                    <td><input type="text" name="confirm_by" value="${rowData.confirm_by}" class="form-control"></td>
                    <th>Inspector's Remarks:</th>
                    <td colspan="3"><textarea name="remarks" class="form-control">${rowData.remarks}</textarea></td>
                </tr>
                </tbody>
            </table>
        </form>
    `;

        modalBody.innerHTML = modalContent;
        const dataModal = new bootstrap.Modal(document.getElementById('dataModal'));
        dataModal.show();
    }



    // -----------------------------------------save------------------------------------------------------

    function saveInspectionDetails() {
       
        const form = document.getElementById('inspectionForm');
        const formData = new FormData(form);

    
        let formIsValid = true;
        form.querySelectorAll('.form-control').forEach(input => {
            if (input.value.trim() === '' && !input.readOnly) { 
                formIsValid = false;
                input.classList.add('is-invalid'); 
            } else {
                input.classList.remove('is-invalid');
            }
        });

        if (!formIsValid) {

            Swal.fire({
                icon: 'warning',
                title: 'Validation Error',
                text: 'Please fill out all required fields.',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
            return;
        }

       
        fetch('../../process/data_update.php', {
            method: 'POST',
            body: formData
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(data => {
                console.log(data);

                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Data saved successfully.',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload( ); 
                    }
                });
            })
            .catch(error => {
                console.error('Error:', error);
       
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'There was an error saving the data.',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'OK'
                });
            });
    }


    </script>

    