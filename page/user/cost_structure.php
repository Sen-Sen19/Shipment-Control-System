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
            <li class="breadcrumb-item active">Production Control</li>
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
            <span style="font-size: 16px;">Cost Structure Table</span>
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
            <div class="col-12 col-sm-3 mb-3">
              <label style="font-weight: bold;">Date From</label>
              <input type="date" name="date_from" class="form-control form-control-sm" id="date_from">
            </div>
            <div class="col-12 col-sm-3 mb-3">
              <label style="font-weight: bold;">Date To</label>
              <input type="date" name="date_to" class="form-control form-control-sm" id="date_to">
            </div>

            <div class="col-12 col-sm-3 mb-3">
              <label style="font-weight: bold;">Delivery Status</label>
              <select name="delivery_status" class="form-control form-control-sm" id="delivery_status">
                <option value="">Select User Type</option>
                <option value="not_delivery">Not Delivery</option>
                <option value="delivery_finish">Delivery Finish</option>
              </select>
            </div>

            <div class="col-12 col-sm-3 mb-3 d-flex align-items-end">
              <button class="btn btn-primary btn-block btn-sm" id="generatefsibdata" style="background-color: #0F78DC; border-color: #0F78DC;" onclick="get_fsib_data()">
                <i class="fas fa-search"></i>&nbsp;Search
              </button>
            </div>
          </div>

          <!-- <div class="card-body">
          <div class="row">
            <div class="col-2">
              <input type="file" id="excelFileInput" accept=".xlsx, .xls" style="display:none;" />
              <button type="button" id="uploadButton" class="btn btn-primary btn-block">
                <i class="fas fa-upload"></i>
                Upload
              </button>
            </div>
           
          </div> -->



          <div id="accounts_table_res" class="table-responsive" style="height: 55vh; overflow: auto; display: inline-block;  border-top: 1px solid gray;">
            <table id="sp_cotdb" class="table table-sm table-head-fixed text-nowrap table-hover">

              <thead style="text-align: center;">
                <tr>
                  <th>#</th>
                  <th>PO No</th>
                  <th>Product No</th>
                  <th>Lot No</th>
                  <th>Production Date</th>
                  <th>PO Qty</th>
                  <th>FG Scanned</th>
                  <th>Remain Order</th>
                  <th>Due Date</th>
                  <th>Destination</th>
                  <th>Mode of Shipment</th>
                  <th>Unit Price</th>
                  <th>Status</th>
                  <th>Ship</th>
                  <th>Air</th>
                </tr>

              </thead>

              <tbody id="sp_cotdb_body" style="text-align: center; padding:20px;">

              </tbody>
            </table>
          </div>
          <div style="background-color: #fefefe; padding: 10px; border-radius: 0 0 10px 10px;">

            <div id="loadingIndicator" style="display: none; text-align: center; margin-top: 20px;">
              <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
              </div>
              <p>Importing data, please wait...</p>
            </div>

            <div class="d-flex justify-content-sm-center mt-3">
              <button type="button" class="btn bg-gray-dark" id="btnLoadMore" style="display: none;">Load more</button>
            </div>
            <div id="totalRows" style="margin-top: 3px; font-weight: bold; text-align: left;">
              Total: <span id="row_count"></span>
              
            </div>
          </div>
        </div>
      </div>
  </section>
</div>

<?php include 'plugins/footer.php'; ?>
<?php include 'plugins/js/cost_structure_script.php'; ?>