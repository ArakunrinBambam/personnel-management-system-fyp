@extends('layouts.app')

@section('extracss')
<link href="{{ asset('/assets/css-original/datatables.min.css')}}" rel="stylesheet" >

@endsection

@section('content')
<div class="content-wrapper">
        <div class="row mt-2 mb-2">
            <button type="button" class="btn btn-primary btn-sm" id="btnAddF" data-toggle="modal" data-target="#userModal">Add New Officer</button>
        </div>
        <h4>All Personnel Officers</h4>
        <table class="table table-bordered data-table-user">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th width="100px">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

</div>

<form id="userForm" name="userForm">
    <input type="hidden" name="uid" id="uid">
<div class="user modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="userLabel">Add Officer</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                    <div class="alert alert-danger" id="uerror" style="display:none" >
                    </div>
                    <div class="form-group row">
                      <label for="name" class="col-sm-3 col-form-label">Name:</label>
                      <div class="col-sm-9"><input type="text" class=" form-control form-control-sm" id="name" name="name" required></div>
                    </div>
                    <div class="form-group row">
                      <label for="email" class="col-sm-3 col-form-label">Email:</label>
                      <div class="col-sm-9"><input type="text" class=" form-control form-control-sm" id="email" name="email" required></div>
                    </div>
                    <div class="form-group row">
                      <label for="password" class="col-sm-3 col-form-label">Password:</label>
                      <div class="col-sm-9"><input type="password" class=" form-control form-control-sm" id="password" name="password" required></div>
                    </div>
                    <div class="form-group row">
                      <label for="password_confirmation" class="col-sm-3 col-form-label">Confirm Password:</label>
                      <div class="col-sm-9"><input type="password" class=" form-control form-control-sm" id="password_confirmation" name="password_confirmation" required></div>
                    </div>

            </div>
        </div>
        <div class="modal-footer">
          <button id="btnUClose" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" id="saveUBtn" class="btn btn-primary" value="add">Add Officer</button>
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
        $("#userLabel").html("Add New user");

        $("#userForm").trigger('reset');

        $("#saveFBtn").html("Add user");
    });

        function editF(id)
        {

            $.get("/user/show/"+id, function(data){

                $("#name").val(data.name);
                $("#email").val(data.email);
                $("#password").val(data.password);
                $("#password_confirmation").val(data.password);
                $("#uid").val(id);



            }).fail(function(data){
                console.log(data);
            });

            $("#userLabel").html("Update Officer")

            $("#saveFBtn").html("Update Details")
        }

        function delF(id)
        {
            $.ajax({
                type:'DELETE',
                url: "/user/delete/"+id,
                success: (data) => {
                    table.ajax.reload(null, false);
                },
                error: function(data){
                    console.log(data);
                }
            });
        }

    $('#userForm').submit(function(e) {
        e.preventDefault();
        $("#ferror").hide();
        var formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: "{{ route('user.save')}}",
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            success: (data) => {

                $("#uerror").hide();

                $("#btnUClose").click();

                table.ajax.reload(null, false);

                $("#userForm").trigger('reset');


            },
            error: function(data){

                if(data.status==422){
                var msg = "";
                $.each(data.responseJSON.errors, function(index,value){
                        msg+=value+"\n";
                });
                $("#uerror").html(msg);
                }
                $("#uerror").show();

            }
        });
    });


    var table = $('.data-table-user').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('user.index') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'name'},
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

