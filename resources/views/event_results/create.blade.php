@extends('layouts.master')

@section('content')
        <div class="content-w">
   
          <div class="content-i">
            <div class="content-box"><div class="row">
  
  <div class="col-lg-12">
    <div class="element-wrapper">
      <h6 class="element-header">
        Horizontal Form Layout
      </h6>
      <div class="element-box">
        <form action="{{ route('events_results.store') }}" method="post" >
        @csrf
          <h5 class="form-header">
          o	Enter Show Results
          </h5>
          <div class="form-desc">
           
          </div>
        
          <div class="form-group row">
              <label class="col-sm-4 col-form-label" for="">Select Dam</label>
              <div class="col-sm-8">
              <select class="form-control js-data-example-ajax" name="dam_id" id="selUser_fe">
              @foreach($dogs as $dog)
                <option  value="{{$femaleDog->id}}">
               {{$dog->dog_name}}
                </option>
                @endforeach
              </select>
              </div>
            </div>
         
          <div class="form-buttons-w mb-4">
            <button class="btn btn-primary" type="submit"> Submit</button>
          </div>
          @if(session()->has('message'))
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
@endsection
