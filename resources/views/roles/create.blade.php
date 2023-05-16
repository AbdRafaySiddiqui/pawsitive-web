@extends('layouts.master')

@section('content')

<div class="content-w">
        
          <div class="content-i">
            <div class="content-box"><div class="row">
  
  <div class="col-lg-12">
    <div class="element-wrapper">
      <h6 class="element-header">
      Roles
      </h6>
      <div class="element-box">
        <form action="{{ route('roles.store') }}" method="post">
        @csrf
   
                    
          <h5 class="form-header">
          Create New Role
          </h5>
          <div class="form-desc">
            Discharge best employed your phase each the of shine. Be met even reason consider logbook redesigns. Never a turned interfaces among asking
          </div>
          <div class="row">
                                        <div class="col-md-6">                
                                            <div class="form-group">
                                                <label>Role Name</label>
                                                <input type="text" class="form-control" name="name" id="name">
                                            </div>
                                        </div>
                                        {{--
                                        <div class="col-md-6">                
                                            <div class="form-group">
                                                <label>Permissions</label>
                                                <select class="form-control select2" tabindex="-1" aria-hidden="true" name="permission_id[]" id="permission_id" multiple>
                                                    <option value="0">{{'Select Permission(s)'}}</option>
                                                @foreach($permissions as $pers)
                                                    <option value="{{$pers->id}}">{{$pers->name}}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div> --}}
                                    </div>

                                    <?php $prev = ''; ?>
                                    @foreach($permissions as $perm)
                                    @if($prev != $perm->module_id)
                                    <?php $prev = $perm->module_id; ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div id="accordion" class="mb-4">
                                                    <div class="accordion">
                                                        <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-{{ $perm->module_id }}" aria-expanded="true">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <h4>{{ $perm->title.' - (Permissions)' }}</h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="accordion-body collapse show" id="panel-body-{{ $perm->module_id }}" data-parent="#accordion">
                                                            @foreach($permissions as $perm1)
                                                                @if($perm1->module_id == $prev)
                                                                    <div class="row">
                                                                        <div class="col-sm-1 col-form-label"></div>
                                                                        <div class="col-sm-3 col-form-label">{{ $perm1->name }}</div>
                                                                        
                                                                        <div class="col-sm-5 col-form-label">{{ '' }}</div>
                                                                        
                                                                        <div class="col-sm-3 col-form-label">
                                                                            <div class="form-check">
                                                                                    <input class="form-check-input" name="permission_id[]" id="permission_id" value="{{ $perm1->id }}" type="checkbox">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                        <div class="card mb-1 d-none">
                                                            <div class="card-header no-border" id="{{ $perm->module_id }}" style="background-color:darkturquoise; text-align:-webkit-center;" data-toggle="collapse" data-target="#collapse{{ $perm->module_id }}" aria-expanded="true" aria-controls="collapseOne">
                                                                <span style="color:white; font-weight:900; font-size:20px; text-align:-webkit-center;" >
                                                                    {{ $perm->title.' - (Permissions)' }}
                                                                </span>
                                                            </div>
                                                            <div id="collapse{{ $perm->module_id }}" class="collapse" aria-labelledby="{{ $perm->module_id }}" data-parent="#accordion">
                                                                <div class="card-body">
                                                                    @foreach($permissions as $perm1)
                                                                    @if($perm1->module_id == $prev)
                                                                    <div class="row">
                                                                        <div class="col-sm-1 col-form-label"></div>
                                                                        <div class="col-sm-3 col-form-label">{{ $perm1->name }}</div>
                                                                        
                                                                        <div class="col-sm-5 col-form-label">{{ '' }}</div>
                                                                        
                                                                        <div class="col-sm-3 col-form-label">
                                                                            <div class="form-check">
                                                                                    <input class="form-check-input" name="permissions[]" id="permissions" value="{{ $perm1->id }}" type="checkbox">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    @endif
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @endforeach
            <div class="form-buttons-w mb-4">
            <button class="btn btn-primary" type="submit"> Submit</button>
  <a href="{{route('roles.index')}}" class="btn btn-danger">
              <i class="fa fa-times"> </i><span> &nbsp; Cancel</span>
            </a>
          </div>
          

        </form>
      </div>
    </div>
  </div>
</div>


<script>
    @if(Session::has('success'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.success("{{ session('success') }}");
  @endif 
</script>
@endsection
