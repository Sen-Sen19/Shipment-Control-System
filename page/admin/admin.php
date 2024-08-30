<?php include 'plugins/navbar.php'; ?>
<?php include 'plugins/sidebar/admin_bar.php'; ?>


<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item active">Admin</li>
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
                                <i class="nav-icon fas fa-user"></i> ADMIN
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
                                <div class="col-sm-4">
                                    <label>&nbsp;</label>
                                    <button class="btn btn-block btn-success" style="background-color: #20c997; border-color: #20c997; color:white;" id="openModalBtn" data-toggle="modal" data-target="#addRecordModal">
                                        <i class="fas fa-plus mr-2"></i>Add Account
                                    </button>
                                </div>
                            </div>

                            <div class="row mt-5">
                                <div class="col-md-4 d-flex align-items-center">
                                    <label for="searchBox" class="sr-only">Search</label>
                                    <div class="input-group">
                                        <input type="text" id="searchBox" class="form-control" placeholder="Search by Username">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" id="searchReqBtn">
                                                <i class="fas fa-search mr-2"></i>Search
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8 d-flex justify-content-end align-items-center">
                              

                                <button class="btn btn-info mr-2" id="refreshPageBtn" onclick="refreshPage()" style="width: 20%;background-color:#f8f100; border-color:#cbc500; color:black;">          
                                                                <i class="fas fa-sync-alt mr-2"></i>Refresh
                                    </button>
                                    <button class="btn btn-danger mr-2" id="deleteBtn" style="width: 20%;">
                                       <i class="fas fa-trash mr-2"></i>Delete
                                    </button>
                                </div>
                            </div>

                            <div id="accounts_table_res" class="table-responsive" style="height: 45vh; overflow: auto; display: inline-block; margin-top: 50px; border-top: 1px solid gray;">
                                <table id="account" class="table table-sm table-head-fixed text-nowrap table-hover">
                                    <thead style="text-align: center;">
                                   
                                        <tr>
                                            <th>User Name</th>
                                            <th>Password</th>
                                            <th>Type</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody id="admin_body" style="text-align: center; padding:20px;">
                                      
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-sm-center">
                                <button type="button" class="btn bg-gray-dark" id="btnLoadMore">Load more</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<div class="modal fade" id="editRecordModal" tabindex="-1" role="dialog" aria-labelledby="editRecordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRecordModalLabel">Change Password</h5>
                </button>
            </div>
            <form id="editForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editUsername">Username</label>
                        <input type="text" class="form-control" id="editUsername" readonly>
                    </div>
                    <div class="form-group">
                        <label for="editType">Type</label>
                        <input type="text" class="form-control" id="editType" readonly>
                    </div>
                    <div class="form-group">
                        <label for="editPassword">Password</label>
                        <input type="text" class="form-control" id="editPassword">
                    </div>
                </div>
                <div class="modal-footer">
                   
                    <button type="button" class="btn btn-primary" style="background-color: #20c997; border-color: #20c997; color:white;" onclick="saveChanges()">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>


<script>
    $(document).ready(function() {
        $('#openModalBtn').click(function() {
          s
        });
    });

    function saveChanges() {
    var username = $('#editUsername').val();
    var newPassword = $('#editPassword').val();

   
    $.ajax({
        url: '../../process/update_password.php',
        method: 'POST',
        data: { username: username, newPassword: newPassword },
        success: function(response) {
          
            if (response.startsWith('Error')) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response
                });
            } else {
                Swal.fire({
                    icon: 'success',
                    title: 'Password updated successfully!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    $('#editRecordModal').modal('hide'); 
                    location.reload(); 
                });
            }
        },
        error: function(xhr, status, error) {
            console.error('Error updating password:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Failed to update password. You do not have permission to change the admin password.'
            });
        }
    });
}

    function refreshPage() {
       
        location.reload();
    }
</script>

<?php include 'plugins/admin_footer.php'; ?>
<?php include 'plugins/js/admin_script.php'; ?>

</body>
</html>
