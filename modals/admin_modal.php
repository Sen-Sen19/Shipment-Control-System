
<style>
    .is-invalid {
    border-color: #dc3545; /* Red color for invalid input */
}

</style>
<div class="modal fade" id="addRecordModal" tabindex="-1" role="dialog" aria-labelledby="addRecordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content" style="border-color: #20c997;"> <!-- Apply the stroke color here -->
            <div class="modal-header" style="background-color:#20c997">
                <h5 class="fas fa-plus mr-2" id="addRecordModalLabel" style="color:white"> ADD RECORD</h5>
                <button type="button" class="close" data-dismiss="modal" style="color:white" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            <form id="myForm">







            
                <!----------------------------------------------------------- Start Point ----------------------------------------->
                <h5 class="modal-title" style="color: black; margin-bottom: 30px;"><strong>Add Account</strong></h5>
                <div class="row mb-4">
                  
                    <div class="col-sm-4">
                        <label>Username</label>
                        <input type="text" id="username" name="username" class="form-control" autocomplete="off" style="margin-bottom: 30px;">
                        </div>
                        <div class="col-sm-4">
                        <label>Password</label>
                        <input type="text" id="password" name="password" class="form-control" autocomplete="off" style="margin-bottom: 30px;">
                        </div>
            
               
                            <div class="col-sm-4">
                                <label>Type</label>
                                <select id="type" class="form-control" name="type" style="margin-bottom:30px">
                                 
                                    <option value="user">user</option>
                                  
                                </select>
                            </div>
            
            
               




<div id="notice" style="display: none;"></div>


                <!-- Footer Buttons -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger float-right">Clear</button>
                    <button type="button" id="saveButton" class="btn btn-success float-right" style="width: 150px; background-color: #20c997; border-color: #20c997; color: white;" onclick="saveData()">Add</button>
                    </div>
            </div>
        </div>
    </div>
</div>

</form>
<!-- <script>
    document.getElementById('part_name_dropdown').addEventListener('change', function () {
    const partName = this.value;
    const disabledValues = [
      'VO10X0.5(B)', 'VO10X1(B)', 'VO12X0.5(B)', 'VO12X1(B)',
      'VO14X0.5(B)', 'VO14X1(B)', 'VO16X0.6(B)', 'VO16X1(B)',
      'VO18X0.6(B)', 'VO18X1(B)', 'VO20X0.6(B)', 'VO20X1(B)',
      'VO22X1(B)', 'VO24X1(B)', 'VO4X0.5(B)', 'VO4X1(B)',
      'VO6X0.5(B)', 'VO6X1(B)', 'VO8X0.5(B)', 'VO8X1(B)'
    ];

    const slitCondition = document.getElementById('slit_condition');
    const usingRoundBar = document.getElementById('using_round_bar');
    const usingBareHands = document.getElementById('using_bare_hands');
    const oDiameterStart = document.getElementById('outside-start');
    const oDiameterEnd = document.getElementById('outside-end');
    const oDiameterMin = document.getElementById('o-diameter-min');
    const oDiameterMax = document.getElementById('o-diameter-max');

    if (disabledValues.includes(partName)) {
      
      slitCondition.disabled = true;
      usingRoundBar.disabled = true;
      usingBareHands.disabled = true;
      slitCondition.value = 'N/A';
      usingRoundBar.value = 'N/A';
      usingBareHands.value = 'N/A';

    
      oDiameterStart.readOnly = true;
      oDiameterEnd.readOnly = true;
      oDiameterStart.value = 'N/A';
      oDiameterEnd.value = 'N/A';
      oDiameterMin.value = 'N/A';
      oDiameterMax.value = 'N/A';
    } else {
     
      slitCondition.disabled = false;
      usingRoundBar.disabled = false;
      usingBareHands.disabled = false;
      oDiameterStart.readOnly = false;
      oDiameterEnd.readOnly = false;
      slitCondition.value = '';
      usingRoundBar.value = '';
      usingBareHands.value = '';
      oDiameterStart.value = '';
      oDiameterEnd.value = '';
      oDiameterMin.value = '';
      oDiameterMax.value = '';
    }
  });
  function handleRadioChange() {
    const spRadio = document.getElementById('sp');
    const mpRadio = document.getElementById('mp');
    const epRadio = document.getElementById('ep');
    const serialNoInput = document.getElementById('serial_no');
    const lotNoInput = document.getElementById('lot_no');
    const q1Middle = document.getElementById('q1_middle');
    const q2Middle = document.getElementById('q2_middle');
    const q3Middle = document.getElementById('q3_middle');
    const q4Middle = document.getElementById('q4_middle');

    if (spRadio.checked || epRadio.checked) {
   
      serialNoInput.value = 'N/A';
      lotNoInput.value = 'N/A';
      serialNoInput.readOnly = true;
      lotNoInput.readOnly = true;


      q1Middle.disabled = false;
      q2Middle.disabled = false;
      q3Middle.disabled = false;
      q4Middle.disabled = false;
    } else if (mpRadio.checked) {
      // For MP
      serialNoInput.value = '';
      lotNoInput.value = '';
      serialNoInput.readOnly = false;
      lotNoInput.readOnly = false;

    
      q1Middle.value = 'N/A';
      q2Middle.value = 'N/A';
      q3Middle.value = 'N/A';
      q4Middle.value = 'N/A';
      q1Middle.disabled = true;
      q2Middle.disabled = true;
      q3Middle.disabled = true;
      q4Middle.disabled = true;
    } else {
    
      serialNoInput.value = '';
      lotNoInput.value = '';
      serialNoInput.readOnly = false;
      lotNoInput.readOnly = false;

  
      q1Middle.value = '';
      q2Middle.value = '';
      q3Middle.value = '';
      q4Middle.value = '';
      q1Middle.disabled = false;
      q2Middle.disabled = false;
      q3Middle.disabled = false;
      q4Middle.disabled = false;
    }
  }

  document.getElementById('sp').addEventListener('change', handleRadioChange);
  document.getElementById('mp').addEventListener('change', handleRadioChange);
  document.getElementById('ep').addEventListener('change', handleRadioChange);
</script> -->