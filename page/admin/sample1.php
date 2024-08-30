<?php include 'plugins/navbar.php';?>
<?php include 'plugins/sidebar/admin_bar.php';?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Back Logs</h1>
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
  <!-- /.content-header -->
  <section class="content">
    <div class="container-fluid">
      <div class="row mb-4">
        <div class="col-6">
          <a href="#" class="btn btn-warning btn-block" data-toggle="modal" data-target="#import_data"><i class="fas fa-upload mr-2"></i>Import Data</a>
        </div>
        <div class="col-6">
          <a href="#" class="btn btn-warning btn-block" data-toggle="modal" data-target="#export_data"><i class="fas fa-upload mr-2"></i>Export Data</a>
        </div>
      </div>
    </div>
 </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card card-gray-dark card-outline">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-user"></i> Accounts Table</h3>
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
                <div class="col-sm-4">
                  <label>Section:</label>
                  <select id="section_search" class="form-control">
                    <option selected value="">All</option>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label>Line No:</label>
                  <select id="line_search" class="form-control">
                    <option selected value="">All</option>
                  </select>
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
                  <input type="datetime-local" name="date_from" class="form-control" id="date_from_search">
                 </div>
                 <div class="col-sm-2">
                  <label>&nbsp;</label>
                  <button class="btn btn-block btn-primary" id="searchReqBtn" onclick="search_accounts()"><i class="fas fa-search mr-2"></i>Search</button>
                </div>
                <div class="col-sm-2">
                  <label>&nbsp;</label>
                  <button class="btn btn-block btn-primary" id="searchReqBtn" onclick="search_accounts()"><i class="fas fa-search mr-2"></i>Export</button>
                </div>
                <div class="card-body table-responsive p-0">
            <table class="table col-12 mt-3 table-head-fixed text-nowrap table-hover" id="checkbox_table">
            
                <thead style="text-align:center;">
                      <!-- <th>
                        <input type="checkbox" name="" id="check_all"  onclick="select_all_func()">
                      </th> -->
                    <th>Line</th>
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
                <tbody class="mb-0" id="list_of_filter_country">
                    <tr>
                      <td colspan="6" style="text-align:center;">
                        <div class="spinner-border text-dark" role="status">
                          <span class="sr-only">Loading...</span>
                        </div>
                      </td>
                    </tr>
                </tbody>
            </table>
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

<?php include 'plugins/footer.php';?>
<?php include 'plugins/js/sample1_script.php'; ?>