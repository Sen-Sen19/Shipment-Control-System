<?php include 'plugins/navbar.php'; ?>
<?php include 'plugins/sidebar/user_bar.php'; ?>
<style>
    .modal-dialog {
        max-width: 80%;
    }

    /* Remove borders from the table */
    .table {
        border: none;
    }

    .table th, .table td {
        border: none; /* Remove borders from table cells */
    }
</style>

</style>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item active">Masterlist</li>
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
          
                <div style="background-color: #ffffff; padding: 10px; border-radius: 0 0 10px 10px;">
                    <h3 style="text-align: left; margin-top: 0px;">Masterlist</h3>
                    <div class="row" style="margin-bottom: 20px;">
                        <div class="col-sm-2">
                            <input type="text" class="form-control" placeholder="Product No." />
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" placeholder="Car Model Line No." />
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" placeholder="Line No." />
                        </div>
                        <div class="col-sm-3">
                            <button type="button" class="btn btn-primary w-100"> <i
                                    class="fas fa-search mr-2"></i>Search</button>
                        </div>
                        <div class="col-sm-3">
                            <button type="button" class="btn btn-danger w-100"> <i
                                    class="fas fa-trash mr-2"></i>Delete</button>
                        </div>
                    </div>
              <div class="row">
                <div class="col-sm-12">
                  <table class="table table-bordered table-hover">
                    <thead style="border-color: black;">
                    <tr>
                                    <th>ID</th>
                                    <th>Product Number</th>
                                    <th>Car Maker</th>
                                    <th>Line No</th>
                                    <th>Initial Secondary Process</th>
                                    <th>Final Process</th>
                                    <th>Poly Size</th>
                                </tr>
                    </thead>
                    <tbody id="employeeTableBody">
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document"> 
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Masterlist</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm" class="container-fluid">
                    <div class="form-row">
                        <div class="form-group col-lg-4 col-md-6">
                            <label for="editProductNo">Product No</label>
                            <input type="text" class="form-control" id="editProductNo" name="ProductNo">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label for="editcarMaker">Car Maker</label>
                            <input type="text" class="form-control" id="editcarMaker" name="carMaker">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label for="editlineNo">Line No</label>
                            <input type="text" class="form-control" id="editlineNo" name="lineNo">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-4 col-md-6">
                            <label for="editinitialSecondaryProcess">Initial Secondary Process</label>
                            <input type="text" class="form-control" id="editinitialSecondaryProcess" name="initialSecondaryProcess">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label for="editfinalProcess">Final Process</label>
                            <input type="text" class="form-control" id="editfinalProcess" name="finalProcess">
                        </div>
                        <div class="form-group col-lg-4 col-md-6">
                            <label for="editpolySize">Poly Size</label>
                            <input type="text" class="form-control" id="editpolySize" name="polySize">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="saveChanges">Update</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>


<script>
let offset = 0; 
const limit = 20; 
let loading = false;


function loadData() {
  if (loading) return; 
  loading = true; 

  fetch(`../../process/view_data.php?offset=${offset}`)
    .then(response => response.json())
    .then(data => {
      const tbody = document.getElementById('employeeTableBody');
      data.forEach(row => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td>${row.ID}</td>
          <td>${row.Product_No}</td>
          <td>${row.Car_Maker}</td>
          <td>${row.Line_No}</td>
          <td>${row.Initial_Secondary_Process}</td>
          <td>${row.Final_Process}</td>
          <td>${row.Poly_Size}</td>
        `;
        // Add a click event listener to the row
        tr.addEventListener('click', () => openEditModal(row));
        tbody.appendChild(tr);
      });

      if (data.length > 0) {
        offset += limit;
      } else {
        console.log('No more data to load.');
      }

      loading = false; // Reset loading state
    })
    .catch(error => {
      console.error('Error fetching data:', error);
      loading = false; // Reset loading state
    });
}


loadData(); 
function openEditModal(row) {
  // Set the values of the modal inputs based on the row data
  document.getElementById('editProductNo').value = row.Product_No;
  document.getElementById('editcarMaker').value = row.Car_Maker;
  document.getElementById('editlineNo').value = row.Line_No;
  document.getElementById('editinitialSecondaryProcess').value = row.Initial_Secondary_Process;
  document.getElementById('editfinalProcess').value = row.Final_Process;
  document.getElementById('editpolySize').value = row.Poly_Size;

  // Show the modal
  $('#editModal').modal('show');
}

window.addEventListener('scroll', () => {
  if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
    loadData();
  }
});
document.getElementById('saveChanges').addEventListener('click', () => {
  // Get the data from the form
  const productNo = document.getElementById('editProductNo').value;
  const carMaker = document.getElementById('editcarMaker').value;
  const lineNo = document.getElementById('editlineNo').value;
  const initialSecondaryProcess = document.getElementById('editinitialSecondaryProcess').value;
  const finalProcess = document.getElementById('editfinalProcess').value;
  const polySize = document.getElementById('editpolySize').value;

  // Send the data to the server
  fetch('../../process/edit_data.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: new URLSearchParams({
      ProductNo: productNo,
      carMaker: carMaker,
      lineNo: lineNo,
      initialSecondaryProcess: initialSecondaryProcess,
      finalProcess: finalProcess,
      polySize: polySize,
    }),
  })
  .then(response => response.json())
  .then(result => {
    if (result.success) {
      // Close the modal and reload data if the update was successful
      $('#editModal').modal('hide');
      document.getElementById('employeeTableBody').innerHTML = ''; // Clear the table body
      offset = 0; // Reset offset
      loadData(); // Reload data
    } else {
      console.error('Update failed:', result.error);
    }
  })
  .catch(error => {
    console.error('Error updating data:', error);
  });
});


</script>





<?php include 'plugins/footer.php'; ?>