@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="row">
          <div class="col-12 col-xl-8 mb-4 mb-xl-0">
            <h3 class="font-weight-bold">Hi {{ Auth::user()->name }}</h3>
            <h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span class="text-primary">3 unread alerts!</span></h6>
          </div>

        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-10 grid-margin transparent">
        <div class="row">
          <div class="col-md-6 mb-4 stretch-card transparent">
            <div class="card card-tale">
              <div class="card-body">
                <p class="mb-4">Total Number of Registered Personnels</p>
                <p class="fs-30 mb-2">{{ $total_no_of_personnels }}</p>

              </div>
            </div>
          </div>
          <div class="col-md-6 mb-4 stretch-card transparent">
            <div class="card card-dark-blue">
              <div class="card-body">
                <p class="mb-4">Total Number of Pending Applications</p>
                <p class="fs-30 mb-2">{{ $total_no_of_pending_application}}</p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
            <div class="card card-light-blue">
              <div class="card-body">
                <p class="mb-4">No of Faculties/Division</p>
                <p class="fs-30 mb-2">{{ $no_of_faculties}}</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 stretch-card transparent">
            <div class="card card-light-danger">
              <div class="card-body">
                <p class="mb-4">No of Departments</p>
                <p class="fs-30 mb-2">{{ $no_of_departments }}</p>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

@endsection
