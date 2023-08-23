@extends('layouts.app')

@section('extracss')
<link href="{{ asset('/assets/css-original/datatables.min.css')}}" rel="stylesheet" >

@endsection

@section('content')
<div class="content-wrapper">

        <h4>All Personnels</h4>
        <table class="table table-bordered data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Passport</th>
                    <th>StaffNo</th>
                    <th>Surname</th>
                    <th>FirstName</th>
                    <th>MiddleName</th>
                    <th>Email</th>

                    <th width="100px">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

</div>

@endsection

@section('extrajs')
<script src="{{asset("/assets/js-original/datatables.min.js")}}"></script>
<script type="text/javascript">
    $(function () {

      var table = $('.data-table').DataTable({
          dom: 'Bfrtip',
          buttons: [
                'print'
            ],
          processing: true,
          serverSide: true,
          ajax: "{{ route('personnel.index') }}",
          columns: [
              {data: 'id', name: 'id'},
              {data: 'passport', name: 'passport', render: function (data, type, full, meta) {
                return "<img src=/passports/" + data + " height=\"50\"/>";
    },},
              {data: 'staffno', name: 'staffno'},
              {data: 'surname', name: 'surname'},
              {data: 'firstname', name: 'firstname'},
              {data: 'middlename', name: 'middlename'},
              {data: 'email', name: 'email'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });

    });
  </script>
@endsection

