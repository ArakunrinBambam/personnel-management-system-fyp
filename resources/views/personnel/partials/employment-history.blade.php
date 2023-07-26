<form id="mhForm" name="mhForm" >
    <input type="hidden" id="personnel_id" value="{{ $personnel->id}}" name="personnel_id">
    <input type="hidden" id="mhid" name="mhid">

    <div class="card">
        <div class="card-body">
        <h4 class="card-title">Employment History</h4>
        <button type="button" class="btn btn-success btn-sm" id="btnAddMH" data-toggle="modal" data-target="#mhistoryModal">Add New Employment History</button>
        <div class="table-responsive pt-3">
            <table class="table table-bordered" id="mhtable">
            <thead>
                <tr>
                <th>S/N</th>
                <th>Employer</th>
                <th>Employer Address</th>
                <th>Designation</th>
                <th>From</th>
                <th>To</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
            </table>
        </div>
        </div>
    </div>

    <div class="mhistory modal fade" id="mhistoryModal" tabindex="-1" role="dialog" aria-labelledby="mhistoryLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="mhistoryLabel">Add Employment History</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                        <div class="alert alert-danger" id="merror" style="display:none" >
                        </div>
                        <div class="form-group row">
                          <label for="employer" class="col-sm-3 col-form-label">Employer</label>
                          <div class="col-sm-9"><input type="text" class=" form-control form-control-sm" id="employer" name="employer" required></div>

                        </div>
                        <div class="form-group row">
                          <label for="employer_address" class="col-sm-3 col-form-label">Emp-Address</label>
                          <div class="col-sm-9"><input type="text" class=" form-control form-control-sm" id="employer_address" name="employer_address" required></div>
                        </div>
                        <div class="form-group row">
                          <label for="designation" class="col-sm-3 col-form-label">Designation</label>
                          <div class="col-sm-9"><input type="text" class=" form-control form-control-sm" id="designation" name="designation" required></div>
                        </div>
                        <div class="form-group row">
                          <label for="start_date" class="col-sm-3 col-form-label">From</label>
                          <div class="col-sm-9"><input type="text" class=" form-control form-control-sm" id="start_date" name="start_date" required></div>
                        </div>
                          <div class="form-group row">
                          <label for="end_date" class="col-sm-3 col-form-label">To</label>
                          <div class="col-sm-9"><input type="text" class=" form-control form-control-sm" id="end_date" name="end_date" required></div>
                        </div>


                </div>
            </div>
            <div class="modal-footer">
              <button id="btnMHClose" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" id="saveMHBtn" class="btn btn-primary" value="add">Add Employment History</button>
            </div>
          </div>

        </div>
    </div>

</form>



