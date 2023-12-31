@extends('layouts.master')

@section('content')
        <div class="content-w">
          <!--------------------
          START - Top Bar
          -------------------->
        <!--------------------
          START - Breadcrumbs
          -------------------->
          <ul class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.html">Home</a>
            </li>
            <li class="breadcrumb-item">
              <a href="index.html">Products</a>
            </li>
            <li class="breadcrumb-item">
              <span>Laptop with retina screen</span>
            </li>
          </ul>
          <!--------------------
          END - Breadcrumbs
          -------------------->
          <div class="content-i">
            <div class="content-box"><div class="row">
  
  <div class="col-lg-12">
    <div class="element-wrapper">
      <h6 class="element-header">
      Edit a Club:-
      </h6>
      <div class="element-box">
        <form action="{{ route('cities.update', $edit->id) }}" method="post" >
            @csrf
            @method('PUT') 
          <h5 class="form-header">
          Edit Club
          </h5>
          <div class="form-desc" style='visibility:hidden;'>
            Discharge best employed your phase each the of shine. Be met even reason consider logbook redesigns. Never a turned interfaces among asking
          </div>

          <div class="row">
          <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label" for="">City Name</label>
                                            <input class="form-control" value="{{$edit->city}}" name="name" placeholder="Enter City Name" type="text">
                                        </div>
                                        </div>
                                        <div class="col-sm-4">
                                          <div class="form-group">
                                              <label class="col-form-label" for=""> Countries</label>
                                              <select class="form-control" name="country" id="country">
                                                <option>Select Country</option>
                                                  @foreach ($total_countries as $countries)
                                                  <option value="{{$countries->idCountry}}"  {{ $countries->idCountry == $edit->country ? 'selected' : '' }}>
                                                          {{ $countries->countryName }}
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
    <script src="{{ asset('public/select2-develop/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('public/select2-develop/dist/js/i18n/pt-BR.js') }}"></script>
    <script>
        $('#country').select2();
    </script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
@endsection
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
