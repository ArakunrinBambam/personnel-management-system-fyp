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
        <div class="col-6 grid-margin">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Log a New Application</h4>
              <form class="form-sample" id="logappform" enctype="multipart/form-data" method="POST" action="{{ route('application.register') }}" >
                <input type="hidden" name="personnel_id" id="personnel_id" />
                    @csrf
                    <div class="alert alert-danger" id="error" style="display: none">

                    </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group ">
                        <div class="input-group">
                          <input type="text" class="form-control" id="staffno" name="staffno" placeholder="Staff No" value="{{ old('staffno')}}" aria-label="Staff No">
                          <div class="input-group-append">
                            <button class="btn btn-sm btn-primary" id="btnSearch" type="button">Search</button>
                          </div>
                        </div>
                      </div>
                  </div>

                </div>

                <div class="row">
                  <div class="col-md-12" >
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">{{ __('Surname ') }}</label>
                      <div class="col-sm-9">
                        <input name="surname" id="surname" type="text" class="form-control form-control-sm  @error('surname') is-invalid @enderror" value="{{ old('surname') }}" autocomplete="surname" autofocus disabled />
                        @error('surname')
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
                          <label class="col-sm-3 col-form-label">{{ __('Firstname') }}</label>
                          <div class="col-sm-9">
                            <input type="text" name="firstname" id="firstname" class="form-control form-control-sm @error('firstname') is-invalid @enderror" value="{{ old('firstname') }}" disabled />
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
                  <div class="col-md-12">
                    <div class="form-group row">
                      <label class="col-sm-5 col-form-label">Application Category</label>
                      <div class="col-sm-7">
                        <select name="category" class="form-control form-control-sm @error('category') is-invalid @enderror" value="{{ old('category') }}">
                            <option value="RequestForInformation" >Request For Information</option>
                            <option value="RequestForAction">Request For Action</option>
                            <option value="RequestForService">Request For Service</option>

                            @error('category')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                                             </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">{{__('Title')}}</label>
                        <div class="col-sm-9">
                          <input type="text" name="title" class="form-control form-control-sm @error('title') is-invalid @enderror" value="{{ old('title') }}" />
                          @error('title')
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
                        <div class="mb-3">
                            <label for="document" class="form-label">Choose Supporting Document</label>
                            <input class="form-control form-control-sm @error('document') is-invalid @enderror" id="document" name="document" value="{{ old('document')}}" type="file">
                            @error('document')
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


       $("#btnSearch").on('click', function() {

            var staffnum = $("#staffno").val();



            if(staffnum=="") {

                $("#error").show().html("Supply The Staff No to search");
            }else {
                $("#error").hide();

                $.ajax({
                    type:'POST',
                    url:'/personnel/staffno/search',
                    data: {
                        staffno: staffnum
                    },
                    success: (data) => {

                        if(data.success){

                            $("#personnel_id").val(data.data.id);
                            $("#surname").val(data.data.surname);
                            $("#firstname").val(data.data.firstname);

                            console.log(data.data.surname);

                        }else {
                            $("#error").show().html(data.message);
                        }

                    },
                    error: (data) => {
                        console.log(data);
                    }
                });


            }

       });

});

    </script>

@endsection

