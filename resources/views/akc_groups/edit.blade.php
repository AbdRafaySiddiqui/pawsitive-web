@extends('layouts.master')

@section('content')
    <div class="content-w" style="width:100%">
        
        
        <div class="content-i">
            <div class="content-box">
                <div class="row">

                    <div class="col-lg-12">
                        <div class="element-wrapper">
                            <h6 class="element-header">
                                AKC - Edit
                            </h6>
                         
                            <div class="element-box">
                                <form action="{{ route('akc_groups.update', $akc->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <h5 class="form-header">
                                        Edit Group Name
                                    </h5>
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label" for="">Group Name</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" value="{{ $akc->name }}" name="name"
                                                placeholder="Group Name" type="text" required>
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

    <script>
        @if(Session::has('message'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.success("{{ session('message') }}");
  @endif 
    </script>
@endsection