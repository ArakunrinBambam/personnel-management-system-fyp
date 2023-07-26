<form id="pubForm" name="pubForm" >
    <input type="hidden" id="personnel_id" value="{{ $personnel->id}}" name="personnel_id">
    <input type="hidden" id="pubid" name="pubid">

    <div class="card">
        <div class="card-body">
        <h4 class="card-title">List of Publications</h4>
        <button type="button" class="btn btn-success btn-sm" id="btnAddPub" data-toggle="modal" data-target="#pubModal">Add New Publication</button>
        <div class="table-responsive pt-3">
            <table class="table table-bordered" id="pubtable">
            <thead>
                <tr>
                <th>S/N</th>
                <th>Title</th>
                <th>Year of Publication</th>
                <th>Authors</th>
                <th>link</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
            </table>
        </div>
        </div>
    </div>

    <div class="pub modal fade" id="pubModal" tabindex="-1" role="dialog" aria-labelledby="pubLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="pubLabel">Add New Publication</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                        <div class="alert alert-danger" id="puberror" style="display:none" >
                        </div>
                        <div class="form-group row">
                          <label for="title" class="col-sm-3 col-form-label">Title</label>
                          <div class="col-sm-9"><input type="text" class=" form-control form-control-sm" id="title" name="title" required></div>

                        </div>
                        <div class="form-group row">
                          <label for="year_of_publication" class="col-sm-5 col-form-label">Year of Publication</label>
                          <div class="col-sm-7"><input type="text" class=" form-control form-control-sm" id="year_of_publication" name="year_of_publication" required></div>
                        </div>
                        <div class="form-group row">
                          <label for="authors" class="col-sm-3 col-form-label">Authors</label>
                          <div class="col-sm-9"><input type="text" class=" form-control form-control-sm" id="authors" name="authors" required></div>
                        </div>
                        <div class="form-group row">
                          <label for="link" class="col-sm-3 col-form-label">Link</label>
                          <div class="col-sm-9"><input type="text" class=" form-control form-control-sm" id="link" name="link" ></div>
                        </div>



                </div>
            </div>
            <div class="modal-footer">
              <button id="btnPubClose" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" id="savePubBtn" class="btn btn-primary" value="add">Add New Publication</button>
            </div>
          </div>

        </div>
      </div>
    </form>



