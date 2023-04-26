@extends('layouts.master')

@section('content')
    <div class="content-w" style="width: 100%;">

        <div class="content-i">
            <div class="content-box">
                <div class="row">

                    <div class="col-lg-12">
                        <div class="element-wrapper">
                            <h6 class="element-header">
                                Users
                            </h6>
                            <div class="element-box">
                                <form action="{{ route('users.update', $user->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <h5 class="form-header">
                                        Edit User
                                    </h5>
                                    <div class="form-desc">
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label" for="">Name</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" name="name" value="{{ $user->name }}"
                                                type="text">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label" for="">Username</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" name="username" value="{{ $user->username }}"
                                                type="text">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label" for="">Email</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" name="email" value="{{ $user->email }}"
                                                type="email">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-4 col-form-label" for="">Password</label>
                                      <div class="col-sm-8">
                                          <input class="form-control" name="password" placeholder="Enter Password"
                                              type="password">
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <label class="col-sm-4 col-form-label" for="">Role</label>
                                      <div class="col-sm-8">
                                          <select class="form-control " name="role_id" id="role_id">
                                              <option></option>
                                              @foreach ($roles as $role)
                                                @if($role->id == $user->role_id)
                                                  <option selected value="{{ $role->id }}">{{ $role->name }}</option>
                                                @else
                                                  <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endif
                                              @endforeach
                                          </select>
                                      </div>
                                  </div>

                                    <div class="form-buttons-w mb-4">
                                        <button class="btn btn-primary" type="submit"> Submit</button>
                                    </div>
                                    @if (session()->has('message'))
                                        <div class="alert alert-success">
                                            {{ session()->get('message') }}
                                        </div>
                                    @endif


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
        $('#role_id').select2({
            allowClear: true,
            tags: true,
            placeholder: 'Select a Role'
        });
    </script>
@endsection
