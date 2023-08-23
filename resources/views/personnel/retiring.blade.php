@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
    <h4 class="card-title">Personnel Retiring Soon By Age</h4>
    <div class="table-responsive pt-3">
        <table class="table table-bordered" id="phtable">
        <thead>
            <tr>
            <th>S/N</th>
            <th>Surname</th>
            <th>Firstname</th>
            <th>MiddleName</th>
            <th>Age</th>
            <th>Years In Service</th>
            <th>Faculty/Division</th>
            <th>Department</th>
            </tr>
        </thead>
        <tbody>
            @php $i=0 @endphp
            @foreach ($retiringbyage as $personnel)
                <tr>
                    <td> {{ ++$i }} </td>
                    <td> {{$personnel->surname}}</td>
                    <td> {{$personnel->firstname}}</td>
                    <td> {{$personnel->middlename}}</td>
                    <td> {{$personnel->age}}</td>
                    <td> {{$personnel->serviceyears}}</td>
                    <td> {{$personnel->department->faculty->name}}</td>
                    <td> {{$personnel->department->name}}</td>
                </tr>
            @endforeach
        </tbody>
        </table>
    </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
    <h4 class="card-title">Personnel Retiring Soon By Service Year</h4>
    <div class="table-responsive pt-3">
        <table class="table table-bordered" id="phtable">
        <thead>
            <thead>
                <tr>
                <th>S/N</th>
                <th>Surname</th>
                <th>Firstname</th>
                <th>MiddleName</th>
                <th>Age</th>
                <th>Years In Service</th>
                <th>Faculty/Division</th>
                <th>Department</th>
                </tr>
            </thead>
        </thead>
        <tbody>
            @php $i=0 @endphp
            @foreach ($retiringbyservice as $personnel)
                <tr>
                    <td> {{ ++$i }} </td>
                    <td> {{$personnel->surname}}</td>
                    <td> {{$personnel->firstname}}</td>
                    <td> {{$personnel->middlename}}</td>
                    <td> {{$personnel->age}}</td>
                    <td> {{$personnel->serviceyears}}</td>
                    <td> {{$personnel->department->faculty->name}}</td>
                    <td> {{$personnel->department->name}}</td>
                </tr>
            @endforeach
        </tbody>
        </table>
    </div>
    </div>
</div>
@endsection
