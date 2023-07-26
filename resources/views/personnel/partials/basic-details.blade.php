
    <div class="main-body">
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img @if(!$personnel->passport) src="{{asset('assets/images/no-image.png')}}" @else src="{{ asset('/passports/'.$personnel->passport)}}" @endif alt="{{$personnel->surname}}" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4>{{ $personnel->surname}}, {{$personnel->firstname}} {{$personnel->middlename}}</h4>
                      <p class="text-secondary mb-1">
                        Title: @foreach ($personnel->title as $title)
                            {{$title}} &nbsp;
                        @endforeach
                      </p>
                      <p class="text-secondary mb-1">{{ $personnel->designation}}</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card mt-3">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">StaffNo:</h6>
                    <span class="text-secondary">{{ $personnel->staffno}}</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">Establishment</h6>
                    <span class="text-secondary">{{ $personnel->establishment->name}}</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">Appointment Type:</h6>
                    <span class="text-secondary">{{ $personnel->appointment_type}}</span>
                  </li>

                </ul>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-2">
                      <h6 class="mb-0">Sex</h6>
                    </div>
                    <div class="col-sm-4 text-secondary">
                      {{ $personnel->sex}}
                    </div>
                    <div class="col-sm-3">
                      <h6 class="mb-0">LGA</h6>
                    </div>
                    <div class="col-sm-3 text-secondary">
                      {{ $personnel->lga->name}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-2">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-4 text-secondary">
                      {{ $personnel->email}}
                    </div>
                    <div class="col-sm-3">
                      <h6 class="mb-0">State</h6>
                    </div>
                    <div class="col-sm-3 text-secondary">
                      {{$personnel->lga->state->name}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-2">
                      <h6 class="mb-0">Phone</h6>
                    </div>
                    <div class="col-sm-4 text-secondary">
                     {{ $personnel->phone}}
                    </div>
                    <div class="col-sm-3" style="padding-right: 0px;">
                      <h6 class="mb-0">Date of Birth</h6>
                    </div>
                    <div class="col-sm-3 text-secondary" >
                      {{ $personnel->date_of_birth}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-2">
                      <h6 class="mb-0">Address</h6>
                    </div>
                    <div class="col-sm-4 text-secondary">
                      {{ $personnel->address}}
                    </div>
                    <div class="col-sm-3">
                      <h6 class="mb-0">Nationality</h6>
                    </div>
                    <div class="col-sm-3 text-secondary">
                      {{ $personnel->nationality}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-2" style="padding-right:0px">
                      <h6 class="mb-0">HomeTown</h6>
                    </div>
                    <div class="col-sm-4 text-secondary">
                     {{$personnel->hometown}}
                    </div>
                    <div class="col-sm-3 style="padding-right:0px">
                      <h6 class="mb-0">Marital Status</h6>
                    </div>
                    <div class="col-sm-3 text-secondary">
                     {{$personnel->marital_status}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-12">
                      <a class="btn btn-primary btn-sm" href="{{ route('personnel.edit',$personnel->id)}}">Edit</a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row gutters-sm">
                <div class="col-sm-12">
                  <div class="card h-100">
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h6 class="mb-0">Department</h6>
                        <span class="text-secondary">{{ $personnel->department->name}}</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h6 class="mb-0">Faculty</h6>
                        <span class="text-secondary">{{$personnel->department->faculty->name}}</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h6 class="mb-0">Date of First Appointment</h6>
                        <span class="text-secondary">{{ $personnel->date_of_first_appointment}}</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h6 class="mb-0">Date of Confirmation</h6>
                        <span class="text-secondary">{{ $personnel->date_of_confirmation}}</span>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

