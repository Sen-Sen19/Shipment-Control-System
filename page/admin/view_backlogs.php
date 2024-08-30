<?php include 'plugins/navbar.php'; ?>
<?php include 'plugins/sidebar/admin_bar.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Back Logs</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <div class="col-12">
    <div id="accordion_qc_legend">
      <div class="card bg-light">
        <div class="card-header">
          <h4 class="card-title w-100">
            <a class="d-block w-100 text-black" data-toggle="collapse" href="#collapseDefectLegend">
              Back Logs Legend
            </a>
          </h4>
        </div>
        <div id="collapseDefectLegend" class="collapse show" data-parent="#accordion_qc_legend">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-4 col-lg-4 p-1 bg-danger" style="border: 1px solid black;">
                <center>Old Assy Date</center>
              </div>
              <div class="col-sm-4 col-lg-4 p-1 bg-warning" style="border: 1px solid black;">
                <center>Recent Assy Date</center>
              </div>
              <div class="col-sm-4 col-lg-4 p-1 bg-light" style="border: 1px solid black;">
                <center>Current Assy Date</center>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>


    <section class="content">
      <div class="container-fluid">
        <div class="row">
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card card-gray-dark card-outline">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user"></i> Back Logs Table</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="maximize">
                    <i class="fas fa-expand"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row mb-6">
                  <!-- <form onsubmit="return false;" action="" method=""> -->
                  <div class="col-sm-4">
                    <label>Section:</label>
                    <select id="section_search" class="form-control">
                      <option selected value="">All</option>
                    </select>
                  </div>
                  <div class="col-sm-4">
                    <label>Line No:</label>
                    <input type="text" id="line_no_search" class="form-control" autocomplete="off">
                  </div>
                  <div class="col-sm-4">
                    <label>Product No:</label>
                    <input type="text" id="product_no_search" class="form-control" autocomplete="off">
                  </div>

                  <div class="col-sm-4">
                    <label>Date From</label>
                    <input type="datetime-local" name="date_from" class="form-control" id="date_from_search">
                  </div>
                  <div class="col-sm-4">
                    <label>Date To</label>
                    <input type="datetime-local" name="date_to" class="form-control" id="date_to_search">
                  </div>
                  <div class="col-sm-2">
                    <label>&nbsp;</label>
                    <button class="btn btn-block btn-primary" id="searchReqBtn" onclick="search_backlogs()">Search</button>
                  </div>
                  <div class="col-sm-2">
                    <label>&nbsp;</label>
                    <button class="btn btn-block btn-success" id="searchReqBtn" onclick="export_accounts3()">Export</button>
                  </div>
                  <!-- </form> -->
                  <div class="card-body table-responsive p-0">
                    <table style="text-align:center;" class="table mt-3 table-head-fixed text-nowrap table-hover" id="checkbox_table">

                      <thead style="text-align:center;">
                        <!-- <th>
                        <input type="checkbox" name="" id="check_all"  onclick="select_all_func()">
                      </th> -->
                        <th style="max-width: 100px;">Line</th>
                        <th>Product_No</th>
                        <th>Lot</th>
                        <th>Order Qty</th>
                        <th>Due Date</th>
                        <th>Container</th>
                        <th>Destination</th>
                        <th>Remaining Qty</th>
                        <th>PD Output</th>
                        <th>Scanned</th>
                        <th>Production Date</th>
                        <th>Poly Size</th>
                        <th>Packing Qty</th>
                        <th>No of_Poly</th>
                        <th>Date Encode</th>
                        <th>Remarks</th>
                        <th>Container No</th>
                        <th>Section</th>

                      </thead>
                      <tbody class="mb-0" id="list_of_accounts" style="text-align:center;">
                        <tr>
                          <td colspan="11" style="text-align:center;">
                            <div class="spinner-border text-dark" role="status">
                              <span class="sr-only">Loading...</span>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>

                    <!-- <div id="load_more" class="text-center" style="display: none;">
                      <p class="badge badge-dark border border-outline p-3 mt-3 " style="cursor: pointer;">Load More...</p>
                    </div> -->
                    
                  </div>
                  
                </div>
                
                <div class="d-flex justify-content-sm-center">
    <button type="button" class="btn bg-gray-dark" id="load_more" style="display: none; margin-top: 10px; margin-bottom: 10px;" onclick="load_accounts(true)">Load More</button>
</div>
              </div>

              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div>
    </section>
  </div>


  <?php include 'plugins/footer.php'; ?>
  <?php include 'plugins/js/view_backlogs_script.php'; ?>