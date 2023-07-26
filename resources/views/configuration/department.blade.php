@extends('layouts.app')

@section('extracss')
<link href="{{ asset('/assets/css-original/datatables.min.css')}}" rel="stylesheet" >

@endsection

@section('content')
<div class="content-wrapper">
        <div class="row mt-2 mb-2">
            <button type="button" class="btn btn-primary btn-sm" id="btnAddD" data-toggle="modal" data-target="#departmentModal">Add New Department</button>
        </div>
        <h4>All Departments</h4>
        <table class="table table-bordered data-table-department">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Faculty</th>
                    <th>Name</th>
                    <th width="100px">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

</div>

<form id="departmentForm" name="departmentForm">
    <input type="hidden" name="did" id="did">
<div class="department modal fade" id="departmentModal" tabindex="-1" role="dialog" aria-labelledby="departmentLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="departmentLabel">Add Department</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                    <div class="alert alert-danger" id="ferror" style="display:none" >
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Faculty</label>
                        <div class="col-sm-9">
                          <select name="faculty_id" id="faculty_id" class="form-control form-control-sm @error('faculty_id') is-invalid @enderror">
                           @foreach ($faculties as $faculty)
                                <option value="{{ $faculty->id}}">{{ $faculty->name}}</option>
                           @endforeach


                          </select>
                        </div>
                    </div>

                    <div class="form-group row">
                      <label for="name" class="col-sm-3 col-form-label">Name:</label>
                      <div class="col-sm-9"><input type="text" class=" form-control form-control-sm" id="name" name="name" required></div>
                    </div>

            </div>
        </div>
        <div class="modal-footer">
          <button id="btnDClose" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" id="saveDBtn" class="btn btn-primary" value="add">Add Department</button>
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

    $("#btnAddD").on('click', function() {
        $("#departmentLabel").html("Add New Department");

        $("#departmentForm").trigger('reset');

        $("#saveDBtn").html("Add Department");
    });

        function editF(id)
        {

            $.get("/department/show/"+id, function(data){

                $("#name").val(data.name);
                $("#did").val(id);
                $("#faculty_id option[value="+data.faculty_id+"]").attr('selected','selected');
                // $("#faculty_id")


            }).fail(function(data){
                console.log(data);
            });

            $("#departmentLabel").html("Update Department")

            $("#saveDBtn").html("Update Details")
        }

        function delF(id)
        {
            $.ajax({
                type:'DELETE',
                url: "/department/delete/"+id,
                success: (data) => {
                    table.ajax.reload(null, false);
                },
                error: function(data){
                    console.log(data);
                }
            });
        }

    $('#departmentForm').submit(function(e) {
        e.preventDefault();
        $("#derror").hide();
        var formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: "{{ route('department.save')}}",
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            success: (data) => {

                $("#derror").hide();

                $("#btnDClose").click();

                table.ajax.reload(null, false);

                $("#departmentForm").trigger('reset');


            },
            error: function(data){

                if(data.status==422){
                var msg = "";
                $.each(data.responseJSON.errors, function(index,value){
                        msg+=value+"\n";
                });
                $("#derror").html(msg);
                }
                $("#derror").show();

            }
        });
    });


    var table = $('.data-table-department').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('department.index') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'faculty.name', name: 'faculty'},
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

