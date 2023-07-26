<form id="phForm" name="phForm" >
    <input type="hidden" id="personnel_id" value="{{ $personnel->id}}" name="personnel_id">
    <input type="hidden" id="phid" name="phid">

    <div class="card">
        <div class="card-body">
        <h4 class="card-title">Promotion History</h4>
        <button type="button" class="btn btn-success btn-sm" id="btnAddPH" data-toggle="modal" data-target="#phistoryModal">Add Promotion History</button>
        <div class="table-responsive pt-3">
            <table class="table table-bordered" id="phtable">
            <thead>
                <tr>
                <th>S/N</th>
                <th>Previous Designation</th>
                <th>New Designation</th>
                <th>Date</th>
                <th>Effective Date</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
            </table>
        </div>
        </div>
    </div>

    <div class="phistory modal fade" id="phistoryModal" tabindex="-1" role="dialog" aria-labelledby="phistoryLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="phistoryLabel">Add Promotion History</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                        <div class="alert alert-danger" id="perror" style="display:none" >
                        </div>
                        <div class="alert alert-success" id="psuccess" style="display:none" >
                        </div>
                        <div class="form-group row">
                          <label for="previous_designation" class="col-sm-3 col-form-label">Previous Designation</label>
                          <div class="col-sm-9">
                            <select name="previous_designation" id="previous_designation" class="form-control form-control-sm">
                                <option value="0">Please Select</option>
                                @include('partials.designation')
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="new_designation" class="col-sm-3 col-form-label">New Designation</label>
                          <div class="col-sm-9">
                            <select name="new_designation" id="new_designation" class="form-control form-control-sm">
                                <option value="0">Please Select</option>
                                @include('partials.designation')
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="date" class="col-sm-3 col-form-label">Date</label>
                          <div class="col-sm-9"><input type="date" class=" form-control form-control-sm" id="date" name="date" pattern="\d{4}-\d{2}-d{2}" required></div>
                        </div>
                        <div class="form-group row">
                          <label for="effective_date" class="col-sm-3 col-form-label">Effective Date</label>
                          <div class="col-sm-9"><input type="date" class=" form-control form-control-sm" id="effective_date" name="effective_date" pattern="\d{4}-\d{2}-d{2}" required></div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
              <button id="btnPHClose" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" id="savePHBtn" class="btn btn-primary" value="add">Add Promotion History</button>
            </div>
          </div>

        </div>
      </div>
    </form>



