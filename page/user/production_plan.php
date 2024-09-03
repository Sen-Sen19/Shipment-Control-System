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

  <div class="card-body">
  <div class="row mb-4">
            <div class="col-2">
              <input type="file" id="excelFileInput" accept=".xlsx, .xls" style="display:none;" />
              <button type="button" id="uploadButton" class="btn btn-primary btn-block">
                <i class="fas fa-upload"></i>
                Upload
              </button>
            </div>
           
          </div>




  <section class="content">
            <div class="col-sm-12">
                <div class="card card-gray-dark card-outline">
                    <div class="card-header">
                        <h3 class="card-title">

                            <span style="font-size: 16px;">Production Plan Table</span>
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






          <div style="background-color: #fefefe; padding: 10px; border-radius: 0 0 10px 10px;">
           
            <div id="accounts_table_res" class="table-responsive"
              style="height: 45vh; overflow: auto; display: inline-block; margin-top: 20px; border-top: 1px solid gray; background-color: white; padding: 15px; border-radius: 10px;">
              <table id="sp_cotdb" class="table table-sm table-head-fixed text-nowrap table-hover">
                <thead id="sp_cotdb_head" style="text-align: center;"></thead>
                <tbody id="sp_cotdb_body" style="text-align: center; padding:20px;"></tbody>
              </table>
            </div>
            <div id="loadingIndicator" style="display: none; text-align: center; margin-top: 20px;">
              <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
              </div>
              <p>Importing data, please wait...</p>
            </div>

            <div class="d-flex justify-content-sm-center mt-3">
              <button type="button" class="btn bg-gray-dark" id="btnLoadMore" style="display: none;">Load more</button>
            </div>
            <div id="totalRows" style="margin-top: 10px; font-weight: bold; text-align: left;">
              Total Rows: 0
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php include 'plugins/footer.php'; ?>
<script src="../../dist/js/xlsx.full.min.js"></script>
<script>
  const itemsPerPage = 20;
  let currentPage = 0;
  let allData = [];
  let isLoading = false;

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


      document.getElementById('loadingIndicator').style.display = 'block';

      const headers = json[0];
      if (!headers) {
        alert('No data found in the selected file.');
        document.getElementById('loadingIndicator').style.display = 'none';
        return;
      }

      const productNumberIndex = 10;
      const carKindIndex = 4;
      const carModelIndex = 1;

      const dateColumns = headers.map((header, index) => ({
        index,
        header,
        isDate: /\d{4}\/\d{2}\/\d{2}/.test(header) || /\d{2}\/\d{2}\/\d{4}/.test(header),
      })).filter(col => col.isDate);

      if (dateColumns.length === 0) {
        alert('No date columns found in the file.');
        document.getElementById('loadingIndicator').style.display = 'none';
        return;
      }

      json.slice(1).forEach(row => {
        const productNumber = row[productNumberIndex];
        const carKind = row[carKindIndex] || '';
        const carModel = row[carModelIndex] || '';

        dateColumns.forEach(col => {
          const date = col.header;
          const value = row[col.index] || 0;
          allData.push({
            carModel,
            carKind,
            productNumber,
            date,
            value
          });
        });
      });


      fetch('../../process/insertData.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(allData)
      })
        .then(response => response.json())
        .then(data => {
          console.log(data.message);

          document.getElementById('loadingIndicator').style.display = 'none';
          alert('Data imported successfully.');
          fetchData(0, itemsPerPage);
        })
        .catch(error => {
          console.error('Error:', error);

          document.getElementById('loadingIndicator').stisplay = 'none';
          alert('An error occurred while importing the data.');
        });
    };
    reader.readAsArrayBuffer(file);
  });
  function fetchData(page, itemsPerPage) {
    fetch('../../process/getData.php')
        .then(response => response.json())
        .then(data => {
            updateTable(data);
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
}

function updateTable(data) {
    const tableHead = document.getElementById('sp_cotdb_head');
    const tableBody = document.getElementById('sp_cotdb_body');

    
    tableHead.innerHTML = '';
    tableBody.innerHTML = '';

    if (data.length === 0) {
        tableBody.innerHTML = '<tr><td colspan="100%">No data available</td></tr>';
        return;
    }

    const headers = Object.keys(data[0]);
    let headerHtml = '<tr>';
    headers.forEach(header => {
        headerHtml += `<th>${header}</th>`;
    });
    headerHtml += '</tr>';
    tableHead.innerHTML = headerHtml;

  
    let rowsHtml = '';
    data.forEach(row => {
        rowsHtml += '<tr>';
        headers.forEach(header => {
            rowsHtml += `<td>${row[header]}</td>`;
        });
        rowsHtml += '</tr>';
    });
    tableBody.innerHTML = rowsHtml;

    document.getElementById('totalRows').innerText = `Total Rows: ${data.length}`;
}


fetchData(0, itemsPerPage);


  


</script>