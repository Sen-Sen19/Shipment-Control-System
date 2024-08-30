<?php include 'plugins/navbar.php';?>
<?php include 'plugins/sidebar/admin_bar.php';?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- Hidden file input -->
                    <input type="file" id="fileUpload" class="form-control" accept=".xlsx, .xls"
                        style="display: none;" />
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-sm-2">
                <button type="button" class="btn btn-primary w-100"
                    style="height: 31px; font-size: 14px; background-color: #525252; border-color: #525252;"
                    id="importButton">
                    <i class="fas fa-file-import"></i>&nbsp; &nbsp;Import
                </button>
            </div>

        </div>
    </div>

    <section class="content">
        <div class="col-sm-12">
            <div class="card card-gray-dark card-outline">
                <div class="card-header">
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
                        <div class="col-6 col-sm-4">
                            <label
                                style="font-weight: normal; margin-bottom:6%; padding: 0; color: #000; font-weight: bold;">
                                Date From
                            </label>
                            <input type="date" name="date_from" class="form-control form-control-sm" id="date_from">
                        </div>
                        <div class="col-6 col-sm-4">
                            <label
                                style="font-weight: normal;margin-bottom:6%; padding: 0; color: #000; font-weight: bold;">
                                Date To
                            </label>
                            <input type="date" name="date_to" class="form-control form-control-sm" id="date_to">
                        </div>
                        <div class="col-6 col-sm-4">
                            <label
                                style="font-weight: normal;margin-bottom:6%; padding: 0; color: #000; font-weight: bold; visibility:hidden">
                                Search
                            </label>
                            <button class="btn btn-primary btn-block btn-sm" id="generateBtn" style="background-color: #0F78DC; border-color: #0F78DC;" >
                               Search
                            </button>
                        </div>
                    </div>

                    <div id="accounts_table_res" class="table-responsive"
                        style="height: 50vh; overflow: auto; display: inline-block; margin-top: 20px; border-top: 1px solid gray; background-color: white; padding: 15px; border-radius: 10px;">
                        <table id="header_table" class="table table-sm table-head-fixed text-nowrap table-hover">
                            <thead style="text-align: center;">

                            </thead>
                            <tbody id="table_body" style="text-align: center; padding:20px;">
                            </tbody>
                        </table>
                    </div>

                    <div class="col-sm-2 ml-auto text-right">
                        <button type="button" class="btn btn-primary w-100" style="height: 31px; font-size: 14px; color:#fffff;background-color:#F4A261; border-color: #F4A261;">
                            <i class="fas fa-calculator"></i>&nbsp; &nbsp;Calculate
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</div>

<<<<<<<< HEAD:page/admin/production_plan.php

<?php include 'plugins/footer.php';?>
<?php include 'plugins/js/dashboard_script.php';?>
========
<script src="../../dist/js/xlsx.full.min.js"></script>
<script>
let parsedData = null;
let originalData = null;

document.getElementById('importButton').addEventListener('click', () => {
    document.getElementById('fileUpload').click();
});

document.getElementById('fileUpload').addEventListener('change', handleFile);

function handleFile(event) {
    const file = event.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = (e) => {
        const data = new Uint8Array(e.target.result);
        const workbook = XLSX.read(data, { type: 'array' });
        const sheetName = workbook.SheetNames[0];
        const sheet = workbook.Sheets[sheetName];
        parsedData = XLSX.utils.sheet_to_json(sheet, { header: 1 });
        originalData = [...parsedData];

        Swal.fire({
            title: 'Success!',
            text: 'File uploaded successfully! Displaying all data.',
            icon: 'success',
            showConfirmButton: false,
            timer: 1000,
            timerProgressBar: true
        });

        displayAllData();
    };
    reader.readAsArrayBuffer(file);
}

function parseDateString(dateString) {
    const [day, month, year] = dateString.split('-').map(Number);
    return (day && month && year) ? new Date(year, month - 1, day) : null;
}

function displayAllData() {
    const tableBody = document.getElementById('table_body');
    tableBody.innerHTML = '';

    if (!originalData || originalData.length === 0) return;

    const headers = originalData[0];
    const convertedHeaders = headers.map(header => (typeof header === 'number' ? formatHeader(header) : header));

    const headerRow = document.createElement('tr');
    convertedHeaders.forEach(header => {
        const th = document.createElement('th');
        th.textContent = header;
        headerRow.appendChild(th);
    });
    headerRow.appendChild(document.createElement('th')).textContent = 'Total';
    headerRow.appendChild(document.createElement('th')).textContent = '1st Month';

    tableBody.appendChild(headerRow);

    const rows = originalData.slice(1);
    rows.forEach(row => {
        const tr = document.createElement('tr');
        row.forEach(cell => {
            const td = document.createElement('td');
            td.textContent = cell;
            tr.appendChild(td);
        });

        const values = row.slice(5).map(cell => parseFloat(cell) || 0);
        const total = values.reduce((acc, value) => acc + value, 0);

        const totalCell = document.createElement('td');
        totalCell.textContent = total.toFixed(2);
        totalCell.style.color = 'red';
        tr.appendChild(totalCell);

        tableBody.appendChild(tr);
    });
}

function displayDataInRange(dateFrom, dateTo) {
    const tableBody = document.getElementById('table_body');
    tableBody.innerHTML = '';

    if (!originalData || originalData.length === 0) return;

    const headers = originalData[0];
    const convertedHeaders = headers.map(header => (typeof header === 'number' ? formatHeader(header) : header));

    let startIndex = -1;
    let endIndex = -1;

    convertedHeaders.forEach((header, index) => {
        const headerDate = parseDateString(header);
        if (headerDate) {
            if (headerDate >= dateFrom && startIndex === -1) startIndex = index;
            if (headerDate <= dateTo) endIndex = index;
        }
    });

    if (startIndex === -1 || endIndex === -1) {
        alert('No data found for the selected date range.');
        return;
    }

    const headerRow = document.createElement('tr');
    convertedHeaders.slice(0, 5).forEach(header => {
        const th = document.createElement('th');
        th.textContent = header;
        headerRow.appendChild(th);
    });
    convertedHeaders.slice(startIndex, endIndex + 1).forEach(header => {
        const th = document.createElement('th');
        th.textContent = header;
        headerRow.appendChild(th);
    });
    headerRow.appendChild(document.createElement('th')).textContent = 'Total';
    headerRow.appendChild(document.createElement('th')).textContent = '1st Month';
    tableBody.appendChild(headerRow);

    const rows = originalData.slice(1);
    rows.forEach(row => {
        const tr = document.createElement('tr');
        row.slice(0, 5).forEach(cell => {
            const td = document.createElement('td');
            td.textContent = cell;
            tr.appendChild(td);
        });

        const valuesInRange = row.slice(startIndex, endIndex + 1).map(cell => parseFloat(cell) || 0);
        const total = valuesInRange.reduce((acc, value) => acc + value, 0);

        row.slice(startIndex, endIndex + 1).forEach(cell => {
            const td = document.createElement('td');
            td.textContent = cell;
            tr.appendChild(td);
        });

        const totalCell = document.createElement('td');
        totalCell.textContent = total.toFixed(2);
        totalCell.style.color = 'red';
        tr.appendChild(totalCell);

        tableBody.appendChild(tr);
    });
}

document.getElementById('generateBtn').addEventListener('click', () => {
    const dateFrom = document.getElementById('date_from').value;
    const dateTo = document.getElementById('date_to').value;

    if (!dateFrom || !dateTo) {
        alert('Please select both Date From and Date To.');
        return;
    }

    const startDate = new Date(dateFrom);
    const endDate = new Date(dateTo);

    if (startDate > endDate) {
        alert('Date From cannot be after Date To.');
        return;
    }

    displayDataInRange(startDate, endDate);
});


displayAllData();

function formatHeader(value) {
    if (typeof value === 'number') {
        const date = excelDateToJSDate(value);
        return formatDate(date);
    }
    return value;
}

function excelDateToJSDate(serial) {
    const epoch = new Date(1899, 11, 30); // Excel's epoch date
    const date = new Date(epoch.getTime() + (serial * 24 * 60 * 60 * 1000));
    date.setDate(date.getDate() + 1);
    return date;
}

function formatDate(date) {
    if (date instanceof Date && !isNaN(date)) {
        const year = date.getFullYear();
        const month = ('0' + (date.getMonth() + 1)).slice(-2);
        const day = ('0' + date.getDate()).slice(-2);
        return `${day}-${month}-${year}`;
    }
    return '';
}

</script>

<?php include 'plugins/footer.php'; ?>
>>>>>>>> 9670bf7f3484589eb14185093b790c7eb4c797cd:page/user/dashboard.php
