@extends('layouts.master')

@section('content')
    <div class="content-w" style="width:100%;">

        <div class="content-i">
            <div class="content-box">
                <div class="row">

                    <div class="col-lg-12">
                        <div class="element-wrapper">
                            <h6 class="element-header">
                                Add User
                            </h6>
                            <div class="element-box">
                                <form action="{{ route('users.store') }}" method="post">
                                    @csrf
                                    <h5 class="form-header">
                                        Add User
                                    </h5>
                                    <div class="form-desc">
                                    </div>



                                    <div class="row">
                                        <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label" for="">Name</label>
                                            <input class="form-control" name="name" placeholder="Enter Name" type="text">
                                        </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                            <label class="col-form-label" for="">Username</label>
                                            <input class="form-control" name="username" placeholder="Enter Username" type="text">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                            <label class="col-form-label" for="">Email</label>
                                            <input class="form-control" name="email" placeholder="Enter Email" type="email">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        
                                     
                                        <div class="col-sm-4">
                                         <div class="form-group">
                                            <label class="col-form-label" for="">Password</label>
                                            <input class="form-control" name="password" placeholder="Enter Password" type="password">
                                         </div>
                                        </div>
                                    


                                    <div class="col-sm-6">
                                          <div class="form-group">
                                              <label class="col-form-label" for=""> Role</label>
                                              <select class="form-control" name="role_id" id="role_id">
                                                  @foreach ($roles as $role)
                                                      <option value="{{ $role->id }}">
                                                          {{ $role->name }}
                                                      </option>
                                                  @endforeach
                                              </select>
                                          </div>
                                        </div>
                                        </div>


                                    <div class="form-buttons-w mb-4">
                                        <button class="btn btn-primary" type="submit"> Submit</button>
                                    </div>
                                 


                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="display-type"></div>
    </div>

    <script src="{{asset('public/select2-develop/dist/js/select2.full.min.js')}}"></script>
    <script src="{{asset('public/select2-develop/dist/js/i18n/pt-BR.js')}}"></script>

    <script type="text/javascript">
@if(Session::has('message'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.success("{{ session('message') }}");
  @endif 

        $('#role_id').select2({
            allowClear: true,
            tags: true,
            placeholder: 'Select a Role'
        });
    </script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
@endsection
