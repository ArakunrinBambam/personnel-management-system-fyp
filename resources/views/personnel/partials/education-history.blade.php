<form id="ehForm" name="ehForm" >
<input type="hidden" id="personnel_id" value="{{ $personnel->id}}" name="personnel_id">
<input type="hidden" id="ehid" name="ehid">

<div class="card">
    <div class="card-body">
    <h4 class="card-title">Education History</h4>
    <button type="button" class="btn btn-success btn-sm" id="btnAddEH" data-toggle="modal" data-target="#ehistoryModal">Add New Education History</button>
    <div class="table-responsive pt-3">
        <table class="table table-bordered" id="ehtable">
        <thead>
            <tr>
            <th>S/N</th>
            <th>School Name</th>
            <th>Qualification Obtained</th>
            <th>Date</th>
            <th>Actions</th>

            </tr>
        </thead>
        <tbody>

        </tbody>
        </table>
    </div>
    </div>
</div>

<div class="ehistory modal fade" id="ehistoryModal" tabindex="-1" role="dialog" aria-labelledby="ehistoryLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ehistoryLabel">Add Education History</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                    <div class="alert alert-danger" id="error" style="display:none" >
                    </div>
                    <div class="alert alert-success" id="success" style="display:none" >
                    </div>
                    <div class="form-group row">
                      <label for="Surname" class="col-sm-3 col-form-label">School</label>
                      <div class="col-sm-9"><input type="text" class=" form-control form-control-sm" id="school_name" name="school_name" required></div>

                    </div>
                    <div class="form-group row">
                      <label for="othernames" class="col-sm-3 col-form-label">Qualification Obtained:</label>
                      <div class="col-sm-9"><input type="text" class=" form-control form-control-sm" id="qualification_obtained" name="qualification_obtained" required></div>
                    </div>
                    <div class="form-group row">
                      <label for="relationship" class="col-sm-3 col-form-label">Year:</label>
                      <div class="col-sm-9"><input type="text" class=" form-control form-control-sm" id="year" name="year" required></div>
                    </div>
            </div>
        </div>
        <div class="modal-footer">
          <button id="btnEHClose" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" id="saveEHBtn" class="btn btn-primary" value="add">Add Education History</button>
        </div>
      </div>

    </div>
  </div>
</form>



