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
          <h3 class="card-title"></h3>
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
  <div class="col-2">
    <input type="file" id="excelFileInput" accept=".xlsx, .xls" style="display:none;" />
    <button type="button" id="uploadButton" class="btn btn-primary btn-block">
      <i class="fas fa-upload"></i>
      Upload
    </button>
  </div>
  <div class="col-2">
  <button type="button" id="importButton" class="btn btn-primary btn-block" style="background-color: #F0D018; color: #000; border: none;">
    <i class="fas fa-upload"></i>
    Import
  </button>
</div>

</div>


          <div style="background-color: #fefefe; padding: 10px; border-radius: 0 0 10px 10px;">
            <h3 style="text-align: left; margin-top: 0px;">Production Plan Table</h3>
            <div id="accounts_table_res" class="table-responsive"
              style="height: 45vh; overflow: auto; display: inline-block; margin-top: 20px; border-top: 1px solid gray; background-color: white; padding: 15px; border-radius: 10px;">
              <table id="sp_cotdb" class="table table-sm table-head-fixed text-nowrap table-hover">
                <thead id="sp_cotdb_head" style="text-align: center;"></thead>
                <tbody id="sp_cotdb_body" style="text-align: center; padding:20px;"></tbody>
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
<script src="../../dist/js/xlsx.full.min.js"></script>
<script>
  document.getElementById('uploadButton').addEventListener('click', function () {
    document.getElementById('excelFileInput').click();
  });

  document.getElementById('excelFileInput').addEventListener('change', function (event) {
    const file = event.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function (e) {
      const data = new Uint8Array(e.target.result);
      const workbook = XLSX.read(data, { type: 'array' });
      const sheetName = workbook.SheetNames[0];
      const worksheet = workbook.Sheets[sheetName];
      const json = XLSX.utils.sheet_to_json(worksheet, { header: 1 });

      const headers = json[0];
      const productNumberIndex = 11;
      const carKindIndex = 6;
      const carModelIndex = 1;

      const dateColumns = headers.map((header, index) => ({
        index,
        header,
        isDate: /\d{4}\/\d{2}\/\d{2}/.test(header) || /\d{2}\/\d{2}\/\d{4}/.test(header),
      })).filter(col => col.isDate);

      const transformedData = [];
      const productNumbers = new Set();
      let rowId = 1;

      json.slice(1).forEach(row => {
        const productNumber = row[productNumberIndex];
        const carKind = row[carKindIndex] || '';
        const carModel = row[carModelIndex] || '';
        productNumbers.add(productNumber);
        dateColumns.forEach(col => {
          const date = col.header;
          const value = row[col.index] || 0;
          transformedData.push({
            id: rowId++,
            productNumber,
            carKind,
            carModel,
            date,
            value
          });
        });
      });

      fetch(`../../process/getCarMakers.php?productNos=${Array.from(productNumbers).join(',')}`)
        .then(response => response.json())
        .then(carMakers => {
          transformedData.forEach(row => {
            row.carMaker = carMakers[row.productNumber] || '';
          });

          displayTransformedData(transformedData);
        });
    };
    reader.readAsArrayBuffer(file);
  });

  function displayTransformedData(data) {
    const tableHead = document.getElementById('sp_cotdb_head');
    const tableBody = document.getElementById('sp_cotdb_body');

    tableHead.innerHTML = `
      <tr>
        <th>ID</th>
        <th>Car Model</th>
        <th>Car Maker</th>
        <th>Car Kind</th>
        <th>Product Number</th>
        <th>Date</th>
        <th>Value</th>
      </tr>
    `;

    tableBody.innerHTML = '';
    data.forEach(row => {
      const rowHtml = `
        <tr>
          <td>${row.id}</td>
          <td>${row.carModel}</td>
          <td>${row.carMaker}</td>
          <td>${row.carKind}</td>
          <td>${row.productNumber}</td>
          <td>${row.date}</td>
          <td>${row.value}</td>
        </tr>
      `;
      tableBody.insertAdjacentHTML('beforeend', rowHtml);
    });
  }
</script>