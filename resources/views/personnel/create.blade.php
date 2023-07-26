@extends('layouts.app')

@section('content')
    <!--content wrapper-->
    <div class="content-wrapper">
      <div class="row">
    @if(Session::has('success'))
        <div class="alert alert-success"> {{ Session::get('success')}}</div>
    @endif

      </div>
      <div class="row">
            <div class="col-12 grid-margin">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Add New Personnel</h4>
              <form class="form-sample" enctype="multipart/form-data" method="POST" action="{{ route('personnel.register') }}" >
                    @csrf
                <p class="card-description">
                  Personal info
                </p>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group row">
                      <label class="col-sm-1 col-form-label">{{ __('Title ') }}</label>
                      <div class="col-sm-11">
                        <div class="row">
                            @foreach ($titles as $title )
                            <div class="form-check form-check-inline col-md-1">
                                <label class="form-check-label">
                                  <input type="checkbox" name="title[]" value="{{ $title }}" class="form-check-input" >
                                  {{ $title }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>
                  </div>
                  {{-- <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">{{ __('Firstname') }}</label>
                      <div class="col-sm-9">
                        <input type="text" name="firstname" class="form-control form-control-sm @error('firstname') is-invalid @enderror" value="{{ old('firstname') }}" />
                        @error('firstname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>
                  </div> --}}
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">{{ __('Surname ') }}</label>
                      <div class="col-sm-9">
                        <input name="surname" type="text" class="form-control form-control-sm  @error('surname') is-invalid @enderror" value="{{ old('surname') }}" autocomplete="surname" autofocus />
                        @error('surname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">{{ __('Firstname') }}</label>
                      <div class="col-sm-9">
                        <input type="text" name="firstname" class="form-control form-control-sm @error('firstname') is-invalid @enderror" value="{{ old('firstname') }}" />
                        @error('firstname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">{{__('MiddleName')}}</label>
                      <div class="col-sm-9">
                        <input type="text" name="middlename" class="form-control form-control-sm @error('middlename') is-invalid @enderror" value="{{ old('middlename') }}" />
                        @error('middlename')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Staff No</label>
                      <div class="col-sm-9">
                        <input type="text" name="staffno" class="form-control form-control-sm @error('staffno') is-invalid @enderror" value="{{ old('staffno') }}" />
                        @error('staffno')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Sex</label>
                      <div class="col-sm-9">
                        <select name="sex" class="form-control form-control-sm @error('sex') is-invalid @enderror" value="{{ old('sex') }}">
                            @error('sex')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          <option>Male</option>
                          <option>Female</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Date of Birth</label>
                      <div class="col-sm-9">
                        <input name="date_of_birth" class="form-control form-control-sm @error('date_of_birth') is-invalid @enderror" value="{{ old('date_of_birth') }}" placeholder="YYYY-mm-dd"/>
                            @error('date_of_birth')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{__('Phone')}}</label>
                        <div class="col-sm-9">
                          <input type="text" name="phone" class="form-control form-control-sm @error('phone') is-invalid @enderror" value="{{ old('phone') }}" />
                          @error('phone')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{__('Email')}}</label>
                        <div class="col-sm-9">
                          <input type="email" name="email" class="form-control form-control-sm @error('email') is-invalid @enderror" value="{{ old('email') }}" />
                          @error('email')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                      </div>
                    </div>
                  </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Nationality</label>
                      <div class="col-sm-9">
                        <select name="nationality" class="form-control form-control-sm @error('nationality') is-invalid @enderror" value="{{ old('nationality') }}">
                          <option>Nigerian</option>
                          <option>Non-Nigeria</option>
                        </select>
                        @error('nationality')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label">Marital Status</label>
                      <div class="col-sm-8">
                        <select name="marital_status" class="form-control form-control-sm @error('marital_status') is-invalid @enderror" value="{{ old('marital_status') }}">
                          <option>Single</option>
                          <option>Married</option>
                          <option>Others</option>
                        </select>
                        @error('marital_status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">State</label>
                      <div class="col-sm-9">
                        <select name="state" id="state" class="form-control form-control-sm @error('state') is-invalid @enderror" value="{{ old('state') }}">
                            <option value="0">Please select</option>
                            @foreach ($states as $state )
                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                            @endforeach
                        </select>
                        @error('state')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">LGA</label>
                      <div class="col-sm-9">
                        <select id="lga_id" name="lga_id" class="form-control form-control-sm @error('lga_id') is-invalid @enderror" value="{{ old('lga_id') }}">
                          <option value="0">Select LGA</option>

                        </select>
                        @error('lga_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Address</label>
                          <div class="col-sm-10 ">
                            <input type="text" name="address" class="form-control form-control-sm @error('address') is-invalid @enderror" value="{{ old('address') }}" />
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">HomeTown</label>
                          <div class="col-sm-9">
                            <input type="text" name="hometown" class="form-control form-control-sm @error('hometown') is-invalid @enderror" value="{{ old('hometown') }}" />
                            @error('hometown')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Designation</label>
                                <div class="col-sm-8">
                                    <select name="designation" class="form-control form-control-sm @error('designation') is-invalid @enderror" value="{{ old('designation') }}">
                                        <option value="0">Please Select</option>
                                        @foreach ($designations as $designation)
                                            <option >{{ $designation }}</option>
                                        @endforeach
                                        {{-- @include('partials.designation') --}}
                                    </select>
                                    @error('designation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Establishment</label>
                          <div class="col-sm-8">
                            <select name="establishment_id" id="establishment_id" class="form-control form-control-sm @error('establishment_id') is-invalid @enderror" value="{{ old('establishment_id') }}">

                              @foreach ($establishments as $establishment )
                                 <option value="{{ $establishment->id }}">{{ $establishment->name }}</option>
                              @endforeach
                            </select>
                            @error('establishment_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        </div>
                      </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Faculty/Division</label>
                        <div class="col-sm-8">
                          <select id="faculty" name="faculty" class="form-control form-control-sm @error('faculty') is-invalid @enderror" value="{{ old('faculty') }}">
                            <option value="0">Please select</option>
                            @foreach ($faculties as $faculty )
                                <option value="{{ $faculty->id }}">{{ $faculty->name}}</option>
                            @endforeach
                          </select>
                          @error('faculty')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                      </div>
                    </div>

                  </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Department/Unit</label>
                          <div class="col-sm-8">
                            <select id="department_id" name="department_id" class="form-control form-control-sm @error('department_id') is-invalid @enderror" value="{{ old('department_id') }}">
                                <option value="0">Please Select</option>
                            </select>
                            @error('department_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Appointment Type</label>
                          <div class="col-sm-8">
                            <select name="appointment_type" class="form-control form-control-sm @error('appointment_type') is-invalid @enderror" value="{{ old('appointment_type') }}">
                              <option>Permanent</option>
                              <option>Temporary</option>
                              <option>Contract</option>
                            </select>
                            @error('department_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-6 col-form-label">Date of First Appointment</label>
                          <div class="col-sm-6">
                            <input name="date_of_first_appointment" class="form-control form-control-sm @error('date_of_first_appointment') is-invalid @enderror" value="{{ old('date_of_first_appointment') }}" placeholder="YYYY-mm-dd"/>
                                @error('date_of_first_appointment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-5 col-form-label">Date of Confirmation</label>
                          <div class="col-sm-7">
                            <input name="date_of_confirmation" class="form-control form-control-sm @error('date_of_confirmation') is-invalid @enderror" value="{{ old('date_of_confirmation') }}" placeholder="YYYY-mm-dd"/>
                                @error('date_of_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                          </div>
                        </div>
                      </div>
                </div>

                <div class="row">
                    <div class="col-md-6" style="text-align: center">
                        <img id="preview-passport-upload" src="{{ asset('assets/images/no-image.png') }}"
                        alt="preview image" style="max-height: 250px;"/>
                    </div>
                    <div class="col-md-6" style="text-align: center">
                        <img id="preview-signature-upload" src="{{ asset('assets/images/no-image.png') }}"
                        alt="preview image" style="max-height: 250px;"/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="passport_image" class="form-label">Choose Passport</label>
                            <input class="form-control form-control-sm @error('passport_image') is-invalid @enderror" id="passport_image" name="passport_image" value="{{ old('passport_image')}}" type="file">
                            @error('passport_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="signature" class="form-label">Choose Signature</label>
                            <input class="form-control form-control-sm @error('signature_image') is-invalid @enderror" id="signature_image" name="signature_image" value="{{ old('signature_image')}}" type="file">
                            @error('signature_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <button type="submit" class="btn btn-block btn-primary mr-2">Submit</button>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- content-wrapper ends -->
@endsection

@section('extrajs')
 {{-- <script src="{{asset("/assets/js/file-upload.js")}}"></script> --}}

 <script type="text/javascript">

    $(document).ready(function (e) {


       $('#passport_image').change(function(){

        let reader = new FileReader();

        reader.onload = (e) => {

          $('#preview-passport-upload').attr('src', e.target.result);
        }

        reader.readAsDataURL(this.files[0]);

       });

    });

    $(document).ready(function (e) {


    $('#signature_image').change(function(){

        let reader = new FileReader();

        reader.onload = (e) => {

        $('#preview-signature-upload').attr('src', e.target.result);
        }

        reader.readAsDataURL(this.files[0]);

    });

});

    </script>

@endsection

