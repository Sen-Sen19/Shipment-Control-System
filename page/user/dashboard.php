<?php include 'plugins/navbar.php'; ?>
<?php include 'plugins/sidebar/user_bar.php'; ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item active">Plastic Tube Inspection</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
      
                <div class="col-sm-12">
                    <div class="card card-gray-dark card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-box"></i> Plastic Tube Inspection
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                    <i class="fas fa-expand"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-sm-3">
                                    <label>Part Name</label>
                                    <select class="form-control" id="partName" style="height: 31px; font-size: 14px;">
                                        <option value="">Choose...</option>
                                    </select>
                                </div>


                                <div class="col-sm-3">
                                    <label>Inspected By</label>
                                    <input type="text" class="form-control" placeholder="Inspected By" id="inspectedBy"
                                        style="height: 31px; font-size: 14px;">
                                </div>
                                <div class="col-sm-3">
                                    <label for="defectType">Defect Type</label>
                                    <select id="defectType" class="form-control" style="height: 31px;font-size: 14px;">
                                        <option value="" selected disabled>Choose...</option>
                                        <option value="Round crest">Round crest</option>
                                        <option value="Damage">Damage</option>
                                        <option value="Molding defect">Molding defect</option>
                                        <option value="Excess burr">Excess burr</option>
                                        <option value="Dent">Dent</option>
                                        <option value="Misaligned joint portion">Misaligned joint portion</option>
                                        <option value="Foreign material">Foreign material</option>
                                        <option value="Slit position is on joint portion">Slit position is on joint
                                            portion</option>
                                        <option value="With gap on slit">With gap on slit</option>
                                        <option value="Crack">Crack</option>
                                        <option value="Overlap">Overlap</option>
                                        <option value="Slit is uneven">Slit is uneven</option>
                                        <option value="Slanted slit">Slanted slit</option>
                                        <option value="Unstable thickness">Unstable thickness</option>
                                        <option value="Tubebreaking on slit portion">Tubebreaking on slit portion
                                        </option>
                                        <option value="Hole">Hole</option>
                                        <option value="Scratch">Scratch</option>
                                        <option value="Deformed">Deformed</option>
                                        <option value="Rough surface">Rough surface</option>
                                        <option value="Bubbles on surface">Bubbles on surface</option>
                                        <option value="Big Diameter">Big Diameter</option>
                                        <option value="Small Diameter">Small Diameter</option>
                                        <option value="Wrinkled on surface">Wrinkled on surface</option>
                                        <option value="Out of Tolerance">Out of Tolerance</option>
                                    </select>
                                </div>


                                <div class="col-6 col-sm-3 ">
                                 
                                    <label
                                        style="font-weight:normal;margin-bottom:9px;padding:0; visibility: hidden !important;">Refresh</label>
                                    <button class="btn btn-info btn-block btn-sm" id="refreshPageBtn"
                                        style="background-color:#f8f100; border-color:#cbc500; color:black;"
                                        onclick="refreshPage()">
                                        <i class="fas fa-sync-alt mr-2"></i>Refresh
                                    </button>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-6 col-sm-3">

                                    <label
                                        style="font-weight:normal;margin:0;padding:0;color:#000; font-weight:bold;">Date
                                        From</label>
                                    <input type="date" name="date_from" class="form-control form-control-sm"
                                        id="date_from">
                                </div>
                                <div class="col-6 col-sm-3">

                                    <label
                                        style="font-weight:normal;margin:0;padding:0;color:#000; font-weight:bold;">Date
                                        To</label>
                                    <input type="date" name="date_to" class="form-control form-control-sm" id="date_to">
                                </div>

                                <div class="col-6 col-sm-3 ">
                                    <label
                                        style="font-weight:normal;margin:0;padding:0; visibility: hidden !important;">Search</label>
                                    <button class="btn btn-primary btn-block btn-sm" id="searchbtn">
                                        <i class="fas fa-search mr-2"></i>Search
                                    </button>
                                </div>



                                <div class="col-6 col-sm-3 ">
                                    <label
                                        style="font-weight:normal;margin-bottom:0px;padding:0; visibility: hidden !important;">Add
                                        Record</label>
                                    <button class="btn btn-success btn-block btn-sm"
                                        style="background-color: #20c997; border-color: #20c997; color:white;"
                                        id="openModalBtn" data-toggle="modal" data-target="#addRecordModal">
                                        <i class="fas fa-plus mr-2"></i>Add Record
                                    </button>
                                </div>
                            </div>



                            <div id="accounts_table_res" class="table-responsive"
                                style="height: 45vh; overflow: auto; display: inline-block; margin-top: 50px; border-top: 1px solid gray;">
                                <table id="sp_cotdb" class="table table-sm table-head-fixed text-nowrap table-hover">
                                    <thead style="text-align: center;">
                                     
                                        <tr>
                                            <th>#</th>
                                            <th>Part Name</th>
                                            <th>Process</th>
                                            <th>Serial No.</th>
                                            <th>Lot No.</th>
                                            <th>Quantity</th>

                                            <th>Time Start</th>
                                            <th>Time End</th>
                                            <th>Inspected By</th>
                                            <th>Shift</th>
                                            <th>Inspection Date</th>
                                            <th>Total Minutes</th>
                                            <th>Outside Appearance</th>
                                            <th>Slit Condition</th>
                                            <th>Inside Appearance</th>
                                            <th>Color</th>
                                            <th>I Tolerance +</th>
                                            <th>I Tolerance -</th>
                                            <th>I Diameter Start</th>
                                            <th>I Diameter End</th>
                                            <th>O Tolerance +</th>
                                            <th>O Tolerance -</th>
                                            <th>O Diameter Start</th>
                                            <th>O Diameter End</th>
                                            <th>W Tolerance +</th>
                                            <th>W Tolerance -</th>
                                            <th>Q1 Start</th>
                                            <th>Q2 Start</th>
                                            <th>Q3 Start</th>
                                            <th>Q4 Start</th>
                                            <th>Q1 Middle</th>
                                            <th>Q2 Middle</th>
                                            <th>Q3 Middle</th>
                                            <th>Q4 Middle</th>
                                            <th>Q1 End</th>
                                            <th>Q2 End</th>
                                            <th>Q3 End</th>
                                            <th>Q4 End</th>
                                            <th>Using Round Bar</th>
                                            <th>Using Bare Hands</th>
                                            <th>Appearance Judgement</th>
                                            <th>Dimension Judgement</th>
                                            <th>NG Quantity</th>
                                            <th>Defect Type</th>
                                            <th>Confirm By</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody id="sp_cotdb_body" style="text-align: center; padding:20px;">
                                 
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-sm-center mt-3">
                                <button type="button" class="btn bg-gray-dark" id="btnLoadMore">Load more</button>
                            </div>
                        </div>
                    </div>
                </div>

    </section>
</div>


<?php include 'plugins/footer.php'; ?>
<?php include 'plugins/js/user_script.php'; ?>


<!-- Modal Structure -->
<div class="modal fade" id="dataModal" tabindex="-1" aria-labelledby="dataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #20c997; color: white;">
                <h5 class="modal-title" id="dataModalLabel">Start Point</h5>
                <button type="button" class="close" data-dismiss="modal" style="color:white" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalDataContent">
            </div>
            <div class="modal-footer d-flex justify-content-end">
                <button type="button" class="btn" style="background-color: #20c997; color: white;"
                    onclick="saveInspectionDetails()">Save</button>
            </div>
        </div>
    </div>
</div>





<script>

 
</script>

