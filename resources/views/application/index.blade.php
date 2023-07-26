@extends('layouts.app')

@section('extracss')
<link href="{{ asset('/assets/css-original/datatables.min.css')}}" rel="stylesheet" >

@endsection

@section('content')
<div class="content-wrapper">

        <h4>All Applications</h4>
        <table class="table table-bordered data-table-app">
            <thead>
                <tr>
                    <th>No</th>
                    <th>StaffNo</th>
                    <th>Surname</th>
                    <th>Firstname</th>
                    <th>category</th>
                    <th>title</th>
                    <th>status</th>
                    <th>Document</th>
                    <th>remark</th>
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

        var table = $('.data-table-app').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('application.index') }}",
          columns: [
              {data: 'id', name: 'id'},
              {data: 'personnel.staffno', name: 'staffno', orderable: false, searchable: false},
              {data: 'personnel.surname', name: 'Surname', orderable: false, searchable: false},
              {data: 'personnel.firstname', name: 'Firstname', orderable: false, searchable: false},
              {data: 'category', name: 'category'},
              {data: 'title', name: 'title'},
              {data: 'status', name: 'status'},
              {data: 'supporting_document', name: 'Document', render: function (data, type, full, meta){
                return "<a href=/documents/"+data+" target='_blank'>Download</a>";
              }},
              {data: 'remark', name: 'remark'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });

    });
  </script>
@endsection

