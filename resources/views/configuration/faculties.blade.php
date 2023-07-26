@extends('layouts.app')

@section('extracss')
<link href="{{ asset('/assets/css-original/datatables.min.css')}}" rel="stylesheet" >

@endsection

@section('content')
<div class="content-wrapper">
        <div class="row mt-2 mb-2">
            <button type="button" class="btn btn-primary btn-sm" id="btnAddF" data-toggle="modal" data-target="#facultyModal">Add New Faculty/Division</button>
        </div>
        <h4>All Faculties/Divisions</h4>
        <table class="table table-bordered data-table-faculty">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th width="100px">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

</div>

<form id="facultyForm" name="facultyForm">
    <input type="hidden" name="fid" id="fid">
<div class="faculty modal fade" id="facultyModal" tabindex="-1" role="dialog" aria-labelledby="facultyLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="facultyLabel">Add Faculty/Division</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                    <div class="alert alert-danger" id="ferror" style="display:none" >
                    </div>
                    <div class="form-group row">
                      <label for="name" class="col-sm-3 col-form-label">Name:</label>
                      <div class="col-sm-9"><input type="text" class=" form-control form-control-sm" id="name" name="name" required></div>
                    </div>

            </div>
        </div>
        <div class="modal-footer">
          <button id="btnFClose" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" id="saveFBtn" class="btn btn-primary" value="add">Add Faculty</button>
        </div>
      </div>

    </div>
</div>
</form>
@endsection

@section('extrajs')
<script src="{{asset("/assets/js-original/datatables.min.js")}}"></script>
<script type="text/javascript">
$(function () {

    $("#btnAddF").on('click', function() {
        $("#facultyLabel").html("Add New Faculty");

        $("#facultyForm").trigger('reset');

        $("#saveFBtn").html("Add Faculty");
    });

        function editF(id)
        {

            $.get("/faculty/show/"+id, function(data){

                $("#name").val(data.name);
                $("#fid").val(id);



            }).fail(function(data){
                console.log(data);
            });

            $("#facultyLabel").html("Update Faculty")

            $("#saveFBtn").html("Update Details")
        }

        function delF(id)
        {
            $.ajax({
                type:'DELETE',
                url: "/faculty/delete/"+id,
                success: (data) => {
                    table.ajax.reload(null, false);
                },
                error: function(data){
                    console.log(data);
                }
            });
        }

    $('#facultyForm').submit(function(e) {
        e.preventDefault();
        $("#ferror").hide();
        var formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: "{{ route('faculty.save')}}",
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            success: (data) => {

                $("#ferror").hide();

                $("#btnFClose").click();

                table.ajax.reload(null, false);

                $("#facultyForm").trigger('reset');


            },
            error: function(data){

                if(data.status==422){
                var msg = "";
                $.each(data.responseJSON.errors, function(index,value){
                        msg+=value+"\n";
                });
                $("#ferror").html(msg);
                }
                $("#ferror").show();

            }
        });
    });


    var table = $('.data-table-faculty').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('faculty.index') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        // getting the click function to call edit on the datatable
        table.on('click', 'button', function (e) {
            let data = table.row(e.target.closest('tr')).data();
            editF(data.id)
        });

        table.on('click', 'a', function (e) {
            let data = table.row(e.target.closest('tr')).data();

            if(confirm("Are you sure you want to delete the item")==true)
            {
                delF(data.id)
            }

        });
});
  </script>
@endsection

