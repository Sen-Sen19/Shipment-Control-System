<?php include 'plugins/navbar.php'; ?>
<?php include 'plugins/sidebar/user_bar.php'; ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Export </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item active">Export</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-gray-dark card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="nav-icon fas fa-file-export"></i> Export
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
                            <div class="row">
                                <div class="col-6 col-sm-2 ">
                                    <label style="font-weight: normal; margin-bottom:6%; padding: 0; color: #000; font-weight: bold;">Date From</label>
                                    <input type="date" name="date_from" class="form-control form-control-sm" id="date_from">
                                </div>
                                <div class="col-6 col-sm-2 ">
                                    <label style="font-weight: normal;margin-bottom:6%; padding: 0; color: #000; font-weight: bold;">Date To</label>
                                    <input type="date" name="date_to" class="form-control form-control-sm" id="date_to">
                                </div>


                                <div class="col-6 col-sm-2 ">
                                <label style="font-weight: normal; margin-bottom:6%; padding: 0; color: #000; font-weight: bold;">Shift</label>
                                <select id="shift_select" class="form-control" name="shift" style="height: 31px; font-size: 14px;">
  <option value="" selected disabled>Choose...</option>
  <option value="Dayshift">Dayshift</option>
  <option value="Nightshift">Nightshift</option>
</select>


            </div>




                                <div class="col-6 col-sm-2 ">
                                    <label style="font-weight: normal;margin-bottom:6%; padding: 0; color: #000; font-weight: bold; visibility:hidden">Search</label>
                                    <button class="btn btn-primary btn-block btn-sm" id="searchBtn">
                                        <i class="fas fa-search"></i> Search
                                    </button>
                                </div>
                                <div class="col-6 col-sm-2 ">
                                    <label style="font-weight: normal; margin-bottom:6%; padding: 0; color: #000; font-weight: bold; visibility:hidden">CSV</label>
                                    <button class="btn btn-warning btn-block btn-sm" id="exportReqBtn" onclick="exportTable()" style="background-color:#888484; border-color:#888484; color:white;">
                                        <i class="fas fa-file-export mr-2"></i> Export
                                    </button>
                                </div>

                                <div class="col-6 col-sm-2 ">
                                    <label style="font-weight: normal; margin-bottom:6%; padding: 0; color:  #000; font-weight: bold; visibility:hidden">PIDS</label>
                                    <button class="btn btn-danger btn-block btn-sm" id="pidsBtn" onclick="exportCSV()" >
    <i class="fas fa-file-download"></i> PIDS
</button>

                                </div>


                               
                            </div>
                            <div id="accounts_table_res" class="table-responsive" style="height: 60vh; overflow: auto; display: inline-block; margin-top: 50px; border-top: 1px solid gray;">
                                <table id="export_cotdb" class="table table-sm table-head-fixed text-nowrap table-hover">
                                    <thead style="text-align: center;">
                                        <tr>
                                            <th>#</th>
                                            <th>Part Name</th>
                                            <th>Process</th>
                                            <th>Lot No.</th>
                                            <th>Serial No</th>
                                            <th>Quantity</th>
                                            <th>Time Start</th>
                                            <th>Time End</th>
                                            <th>Total Minutes</th>
                                           
                                            
                                            <th>Inspection Date</th>
                                           
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
                                            <th>Inspected By</th>
                                            <th>Shift</th>
                                        </tr>
                                    </thead>
                                    <tbody id="export_cotdb_body" style="text-align: center; padding:20px;">
                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>



<?php include 'plugins/footer.php'; ?>
<?php include 'plugins/js/export_script.php'; ?>