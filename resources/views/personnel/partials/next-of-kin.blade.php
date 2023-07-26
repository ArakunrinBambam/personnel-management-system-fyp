<form id="nokForm" name="nokForm" >

<input type="hidden" id="personnel_id" value="{{ $personnel->id}}" name="personnel_id">

<input type="hidden" id="id" name="id" @if($personnel->nextOfKin) value="{{$personnel->nextOfKin->id}}" @endif>

<div class="row" id="nokDisplay" style="display: none">
    <div class="col-md-8">
        <div class="card mb-3">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Surname</h6>
              </div>
              <div class="col-sm-9 text-secondary" id="nsurname">

              </div>

            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Other Names</h6>
              </div>
              <div class="col-sm-9 text-secondary" id="nothernames">

              </div>

            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Relationship</h6>
              </div>
              <div class="col-sm-9 text-secondary" id="nrelationship">

              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Phone</h6>
              </div>
              <div class="col-sm-9 text-secondary" id="nphone">

              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3" style="padding-right:0px">
                <h6 class="mb-0">Address</h6>
              </div>
              <div class="col-sm-9 text-secondary" id="naddress">

              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-12">
                <button type="button" class="btn btn-primary btn-sm" id="editBtn" data-toggle="modal" data-target="#nextofkinModal">Edit</button>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>


<button type="button" id="addBtn" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#nextofkinModal">
    Add Next of Kin
  </button>

<div class="nok modal fade" id="nextofkinModal" tabindex="-1" role="dialog" aria-labelledby="nokModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="nokModalLabel">Next of Kin Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                    <div class="form-group row">
                      <label for="Surname" class="col-sm-3 col-form-label">Surname:</label>
                      <div class="col-sm-9"><input type="text" class=" form-control form-control-sm" id="surname" name="surname" required></div>

                    </div>
                    <div class="form-group row">
                      <label for="othernames" class="col-sm-3 col-form-label">Othernames:</label>
                      <div class="col-sm-9"><input type="text" class=" form-control form-control-sm" id="othernames" name="othernames" required></div>
                    </div>
                    <div class="form-group row">
                      <label for="relationship" class="col-sm-3 col-form-label">Relationship:</label>
                      <div class="col-sm-9"><input type="text" class=" form-control form-control-sm" id="relationship" name="relationship" required></div>
                    </div>
                    <div class="form-group row">
                      <label for="phone" class="col-sm-3 col-form-label">Phone:</label>
                      <div class="col-sm-9"><input type="text" class=" form-control form-control-sm" id="phone" name="phone" required></div>
                    </div>
                    <div class="form-group row">
                      <label for="othernames" class="col-sm-3 col-form-label">Address:</label>
                      <div class="col-sm-9"><input type="text" class=" form-control form-control-sm" id="address" name="address" required></div>
                    </div>

            </div>
        </div>
        <div class="modal-footer">
          <button id="btnClose" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" id="saveBtn" class="btn btn-primary" value="add">Add Next of Kin</button>
        </div>
      </div>

    </div>
  </div>
</form>

@section('subjs')

<Script >
$(function() {



    var id = $("#id").val();

    if(id) {
        $("#nokDisplay").show();
        $("#addBtn").hide();
        getNextofkinDetails(id);
    }

    function getNextofkinDetails(id)
    {
        $.get('/nextofkin/show/'+id, function(data){

            if(data!=null) {

                $("#nsurname").text(data.surname);
                $("#nothernames").text(data.othernames);
                $("#nphone").text(data.phone);
                $("#naddress").text(data.address);
                $("#nrelationship").text(data.relationship);

            }

            }).fail(function(data){
            alert("error: "+data)
        });
    }


    $("#editBtn").on('click', function(e){
        $("#nokModalLabel").html("Update Next of Kin Details")

        $("#surname").val($("#nsurname").text());
        $("#othernames").val($("#nothernames").text());
        $("#relationship").val($("#nrelationship").text());
        $("#phone").val($("#nphone").text());
        $("#address").val($("#naddress").text());

        $("#saveBtn").html("Update Detials")
    });

});
</Script>

@endsection
