<div class="modal fade bd-example-modal-xl" id="update_account" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">
          <b>Update Account Details</b>
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="update_account_form">
        <div class="modal-body">
          <div class="row mb-2">
            <div class="col-4">
              <input type="hidden" id="id_account_update" class="form-control">
              <label>Employee No:</label><label style="color: red;">*</label>
              <input type="text" id="employee_no_update" maxlength="20" class="form-control" autocomplete="off"
                required>
            </div>
            <div class="col-4">
              <label>Full Name:</label><label style="color: red;">*</label>
              <input type="text" id="full_name_update" maxlength="50" class="form-control" autocomplete="off" required>
            </div>
            <div class="col-4">
              <label>Username:</label><label style="color: red;">*</label>
              <input type="text" id="username_update" maxlength="50" class="form-control" autocomplete="off">
            </div>
          </div>
          <div class="row">
            <div class="col-4">
              <label>Password:</label><label style="color: red;">*</label>
              <input type="password" id="password_update" maxlength="50" class="form-control" autocomplete="off">
            </div>
            <div class="col-4">
              <label>Section:</label><label style="color: red;">*</label>
              <input type="text" id="section_update" maxlength="50" class="form-control" autocomplete="off">
            </div>
            <div class="col-4">
              <label>User Type:</label><label style="color: red;">*</label>
              <select id="user_type_update" class="form-control" required>
                <option value="">Select User Type</option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
              </select>
            </div>
          </div>
          <br>
          <hr>
          <div class="row">
            <div class="col-9">
              <div class="float-left">
                <button type="submit" id="btnDeleteAccount" name="btn_delete_account"
                  class="btn btn-danger">Delete</button>
              </div>
            </div>
            <div class="col-3">
              <div class="float-right">
                <button type="submit" id="btnUpdateAccount" name="btn_update_account"
                  class="btn btn-success">Update</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>