@extends('layouts.master')

@section('content')
        <div class="content-w">
        
          <div class="content-i">
            <div class="content-box"><div class="row">
  
  <div class="col-lg-12">
    <div class="element-wrapper">
      <h6 class="element-header">
      Add a new City.
      </h6>
      <div class="element-box">
        <form action="{{ route('cities.store') }}" method="post" enctype="multipart/form-data">
        @csrf
          <h5 class="form-header">
          Add a new City.
          </h5>
          <div class="form-desc" style='visibility:hidden;'>
            Discharge best employed your phase each the of shine. Be met even reason consider logbook redesigns. Never a turned interfaces among asking
          </div>


                                    <div class="row">
                                      <div class="col-sm-4">
                                        <div class="form-group">
                                          <label class="col-form-label" for="">City Name</label>
                                          <input class="form-control" name="name" placeholder="Enter City Name" type="text">
                                        </div>
                                      </div>
                                      <div class="col-sm-4">
                                          <div class="form-group">
                                              <label class="col-form-label" for=""> Country</label>
                                              <select class="form-control" name="country" id="country">
                                                  @foreach ($countries as $country)
                                                      <option value="{{ $country->idCountry }}">
                                                          {{ $country->countryName }}
                                                      </option>
                                                  @endforeach
                                              </select>
                                          </div>
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
@endsection
