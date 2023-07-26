@extends('layouts.app')

@section('extracss')
<link href="{{ asset('/assets/css-original/bootstrap.min.css')}}" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<link href="{{ asset('/assets/css-original/app.css')}}" rel="stylesheet" >

@yield('subcss')

@endsection

@section('content')
    <!--content wrapper-->
    <div class="content-wrapper">
     <div class="row">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="basic-tab" data-bs-toggle="tab" data-bs-target="#basic" type="button" role="tab" aria-controls="basic" aria-selected="true">Basic Information</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="nok-tab" data-bs-toggle="tab" data-bs-target="#nok" type="button" role="tab" aria-controls="nok" aria-selected="false">Next of Kin Details</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="education-tab" data-bs-toggle="tab" data-bs-target="#education" onclick="getAllEducationHistory()" type="button" role="tab" aria-controls="education" aria-selected="false">Education History</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="employment-tab" data-bs-toggle="tab" data-bs-target="#employment" onclick="getAllEmploymentHistory()" type="button" role="tab" aria-controls="employment" aria-selected="false">Employment History</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="promotion-tab" data-bs-toggle="tab" data-bs-target="#promotion" onclick="getAllPromotionHistory()" type="button" role="tab" aria-controls="promotion" aria-selected="false">Promotion History</button>
            </li>

            <li class="nav-item" role="presentation">
              <button class="nav-link" id="publication-tab" data-bs-toggle="tab" data-bs-target="#publication" onclick="getAllPublication()" type="button" role="tab" aria-controls="publication" aria-selected="false">Publications</button>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="basic" role="tabpanel" aria-labelledby="basic-tab">

                @include('personnel.partials.basic-details')

            </div>
            <div class="tab-pane fade" id="nok" role="tabpanel" aria-labelledby="nok-tab">

                @include('personnel.partials.next-of-kin')

            </div>
            <div class="tab-pane fade" id="education" role="tabpanel" aria-labelledby="education-tab">

                @include('personnel.partials.education-history')

            </div>
            <div class="tab-pane fade" id="employment" role="tabpanel" aria-labelledby="employment-tab">

                @include('personnel.partials.employment-history')

            </div>
            <div class="tab-pane fade" id="promotion" role="tabpanel" aria-labelledby="promotion-tab">

                @include('personnel.partials.promotion-history')

            </div>
            <div class="tab-pane fade" id="publication" role="tabpanel" aria-labelledby="publication-tab">

                @include('personnel.partials.publications')

            </div>
          </div>

     </div>

    </div>
    <!-- content-wrapper ends -->
@endsection

@section('extrajs')
<script src="{{asset("/assets/js-original/bootstrap.min.js")}}"></script>

<script>


// Next of Kin Details form handling
$('#nokForm').submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        type:'POST',
        url: "{{ route('nextofkin.save')}}",
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: (data) => {

            $("#nsurname").text(data.data.surname);
            $("#nothernames").text(data.data.othernames);
            $("#nphone").text(data.data.phone);
            $("#naddress").text(data.data.address);
            $("#nrelationship").text(data.data.relationship);
            $("#id").val(data.data.id);

            $("#nokForm").trigger('reset');
            $("#nokDisplay").show();
            $("#addBtn").hide();
            $("#btnClose").click();

        },
        error: function(data){
        console.log(data);
        }
    });
});


// Education History function

function getAllEducationHistory()
{

    $.get("/personnel/education-history/"+{{ $personnel->id}}, function(data){

        if(data!=null) {

            var rows = $.map(data.data, function(value, index) {
                var sn = index+1;
                return '<tr><td>*</td><td>'+
                        value['school_name'] +'</td><td>'+
                        value['qualification_obtained']+'</td><td>'+
                        value['year']+'</td><td>'+
                        '<button class="btn btn-sm btn-warning" onclick="editEH('+value['id']+')" type="button" data-toggle="modal" data-target="#ehistoryModal"><i class="mdi mdi-table-edit"></i>Edit</button><button class="btn btn-sm btn-danger" onclick="delEH('+value['id']+')" type="button"><i class="mdi mdi mdi-delete"></i>Delete</button></td></tr>';
            });

            $('#ehtable tbody').html(rows.join(''));

        }

        }).fail(function(data){

            console.log(data)

        });

}


$('#ehForm').submit(function(e) {
    e.preventDefault();
    $("#success").hide();
    $("#error").hide();
    var formData = new FormData(this);

    $.ajax({
        type:'POST',
        url: "{{ route('education-history.save')}}",
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: (data) => {

            $("#error").hide();

            $("#btnEHClose").click();
            getAllEducationHistory();
            $("#ehForm").trigger('reset');


        },
        error: function(data){

            if(data.status==422){

              var msg = "";

              $.each(data.responseJSON.errors, function(index,value){
                    msg+=value+"\n";
              });

              $("#error").html(msg);

            }


            $("#error").show();

        }
    });
});

function editEH(id)
{

    $.get("/education-history/show/"+id, function(data){

        $("#school_name").val(data.school_name);
        $("#qualification_obtained").val(data.qualification_obtained);
        $("#year").val(data.year);
        $("#ehid").val(id);



    }).fail(function(data){
        console.log(data);
    });

    $("#ehistoryLabel").html("Update Education History")

    $("#saveEHBtn").html("Update Details")
}

function delEH(id)
{
    $.ajax({
        type:'DELETE',
        url: "/education-history/delete/"+id,
        success: (data) => {
            getAllEducationHistory();
        },
        error: function(data){
            console.log(data);
        }
    });
}



// Employment History
$('#mhForm').submit(function(e) {
    e.preventDefault();
    $("#merror").hide();
    var formData = new FormData(this);

    $.ajax({
        type:'POST',
        url: "{{ route('employment-history.save')}}",
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: (data) => {

            $("#merror").hide();

            $("#btnMHClose").click();
            getAllEmploymentHistory();
            $("#mhForm").trigger('reset');


        },
        error: function(data){

            if(data.status==422){
              var msg = "";
              $.each(data.responseJSON.errors, function(index,value){
                    msg+=value+"\n";
              });
              $("#merror").html(msg);
            }
            $("#merror").show();

        }
    });
});

$("#btnAddMH").on('click', function() {
    $("#mhistoryLabel").html("Add Employment History");

    $("#mhForm").trigger('reset');

    $("#saveMHBtn").html("Add Employment History");
});

function editMH(id)
{

    $.get("/employment-history/show/"+id, function(data){

        $("#employer").val(data.employer);
        $("#employer_address").val(data.employer_address);
        $("#designation").val(data.designation);
        $("#start_date").val(data.start_date);
        $("#end_date").val(data.end_date);
        $("#mhid").val(id);



    }).fail(function(data){
        console.log(data);
    });

    $("#mhistoryLabel").html("Update Employment History")

    $("#saveMHBtn").html("Update Details")
}

function delMH(id)
{
    $.ajax({
        type:'DELETE',
        url: "/employment-history/delete/"+id,
        success: (data) => {
            getAllEmploymentHistory();
        },
        error: function(data){
            console.log(data);
        }
    });
}

function getAllEmploymentHistory()
{

    $.get("/personnel/employment-history/"+{{ $personnel->id}}, function(data){

        if(data!=null) {

            var rows = $.map(data.data, function(value, index) {
                var sn = index+1;
                return '<tr><td>'+ sn + '</td><td>'+
                        value['employer'] +'</td><td>'+
                        value['employer_address']+'</td><td>'+
                        value['designation']+'</td><td>'+
                        value['start_date']+'</td><td>'+
                        value['end_date']+'</td><td>'+
                        '<button class="btn btn-sm btn-warning" onclick="editMH('+value['id']+')" type="button" data-toggle="modal" data-target="#mhistoryModal"><i class="mdi mdi-table-edit"></i>Edit</button><button class="btn btn-sm btn-danger" onclick="delMH('+value['id']+')" type="button"><i class="mdi mdi mdi-delete"></i>Delete</button></td></tr>';
            });

            $('#mhtable tbody').html(rows.join(''));

        }

        }).fail(function(data){

            console.log(data)

        });

}


// Promotion History
$('#phForm').submit(function(e) {
    e.preventDefault();
    $("#perror").hide();
    var formData = new FormData(this);

    $.ajax({
        type:'POST',
        url: "{{ route('promotion-history.save')}}",
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: (data) => {

            $("#perror").hide();

            $("#btnPHClose").click();
            getAllPromotionHistory();
            $("#phForm").trigger('reset');

        },
        error: function(data){

            if(data.status==422){
              var msg = "";
              $.each(data.responseJSON.errors, function(index,value){
                    msg+=value+"\n";
              });
              $("#perror").html(msg);
            }
            $("#perror").show();

        }
    });
});

$("#btnAddPH").on('click', function() {
    $("#phistoryLabel").html("Add Promotion History");

    $("#phForm").trigger('reset');

    $("#savePHBtn").html("Add Promotion History");
});

function editPH(id)
{

    $.get("/promotion-history/show/"+id, function(data){

        $("#previous_designation").val(data.previous_designation);
        $("#new_designation").val(data.new_designation);
        $("#date").val(data.date);
        $("#effective_date").val(data.effective_date);
        $("#phid").val(id);



    }).fail(function(data){
        console.log(data);
    });

    $("#phistoryLabel").html("Update Promotion History")

    $("#savePHBtn").html("Update Details")
}

function delPH(id)
{
    $.ajax({
        type:'DELETE',
        url: "/promotion-history/delete/"+id,
        success: (data) => {
            getAllPromotionHistory();
        },
        error: function(data){
            console.log(data);
        }
    });
}

function getAllPromotionHistory()
{

    $.get("/personnel/promotion-history/"+{{ $personnel->id}}, function(data){

        if(data!=null) {

            var rows = $.map(data.data, function(value, index) {
                var sn = index+1;
                return '<tr><td>'+ sn + '</td><td>'+
                        value['previous_designation'] +'</td><td>'+
                        value['new_designation']+'</td><td>'+
                        value['date']+'</td><td>'+
                        value['effective_date']+'</td><td>'+
                        '<button class="btn btn-sm btn-warning" onclick="editPH('+value['id']+')" type="button" data-toggle="modal" data-target="#phistoryModal"><i class="mdi mdi-table-edit"></i>Edit</button><button class="btn btn-sm btn-danger" onclick="delPH('+value['id']+')" type="button"><i class="mdi mdi mdi-delete"></i>Delete</button></td></tr>';
            });

            $('#phtable tbody').html(rows.join(''));

        }

        }).fail(function(data){

            console.log(data)

        });

}

// Publications
$('#pubForm').submit(function(e) {
    e.preventDefault();
    $("#perror").hide();
    var formData = new FormData(this);

    $.ajax({
        type:'POST',
        url: "{{ route('publication.save')}}",
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: (data) => {

            $("#puberror").hide();

            $("#btnPubClose").click();
            getAllPublication();
            $("#pubForm").trigger('reset');

        },
        error: function(data){

            if(data.status==422){
              var msg = "";
              $.each(data.responseJSON.errors, function(index,value){
                    msg+=value+"\n";
              });
              $("#puberror").html(msg);
            }
            $("#puberror").show();

        }
    });
});

$("#btnAddPub").on('click', function() {
    $("#pubLabel").html("Add New Publication");

    $("#pubForm").trigger('reset');

    $("#savePubBtn").html("Add Publication");
});

function editPub(id)
{

    $.get("/publication/show/"+id, function(data){

        $("#title").val(data.title);
        $("#year_of_publication").val(data.year_of_publication);
        $("#authors").val(data.authors);
        $("#link").val(data.link);
        $("#pubid").val(id);



    }).fail(function(data){
        console.log(data);
    });

    $("#pubLabel").html("Update Publication")

    $("#savePubBtn").html("Update Details")
}

function delPub(id)
{
    $.ajax({
        type:'DELETE',
        url: "/publication/delete/"+id,
        success: (data) => {
            getAllPublication();
        },
        error: function(data){
            console.log(data);
        }
    });
}

function getAllPublication()
{

    $.get("/personnel/publication/"+{{ $personnel->id}}, function(data){

        if(data!=null) {

            var rows = $.map(data.data, function(value, index) {
                var sn = index+1;
                return '<tr><td>'+ sn + '</td><td>'+
                        value['title'] +'</td><td>'+
                        value['year_of_publication']+'</td><td>'+
                        value['authors']+'</td><td>'+
                       '<a href="'+value['link']+'" target="_blank">'+value['link']+'</a></td><td>'+
                        '<button class="btn btn-sm btn-warning" onclick="editPub('+value['id']+')" type="button" data-toggle="modal" data-target="#pubModal"><i class="mdi mdi-table-edit"></i>Edit</button><button class="btn btn-sm btn-danger" onclick="delPub('+value['id']+')" type="button"><i class="mdi mdi mdi-delete"></i>Delete</button></td></tr>';
            });

            $('#pubtable tbody').html(rows.join(''));

        }

        }).fail(function(data){

            console.log(data)

        });

}

</script>

@yield('subjs')
@endsection
