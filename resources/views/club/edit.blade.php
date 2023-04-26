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
        Horizontal Form Layout
      </h6>
      <div class="element-box">
        <form action="{{ route('club.update', $et_club->id) }}" method="post" >
            @csrf
            @method('PUT') 
          <h5 class="form-header">
          Add Club
          </h5>
          <div class="form-desc">
            Discharge best employed your phase each the of shine. Be met even reason consider logbook redesigns. Never a turned interfaces among asking
          </div>
          <div class="form-group row">
              <label class="col-sm-4 col-form-label" for="">Club Name</label>
              <div class="col-sm-8">
                <input class="form-control" value="{{$et_club->name}}" name="name" placeholder="Club Name" type="text">
              </div>
            </div>
            <div class="form-group row">
          <label class="col-form-label col-sm-4" for="" > Countries</label>
          <div class="col-sm-8">
          <select class="form-control" name="country">
          @foreach($total_countries as $countries)
                <option value="{{$countries->idCountry}}"  {{ $countries->idCountry == $et_club->country ? 'selected' : '' }}>
               {{$countries->countryName}}
                </option>
                @endforeach
              </select>
            </div>
            </div>
          <div class="form-group row">
              <label class="col-sm-4 col-form-label" for=""> City</label>
              <div class="col-sm-8">
              <select class="form-control" name="city">
              @foreach($total_cities as $cities)
                <option  value="{{$cities->id}} "  {{ $cities->id == $et_club->city ? 'selected' : '' }}>
               {{$cities->city}}
                </option>
                @endforeach
              </select>
              </div>
            </div>
         
            <div class="form-group row">
            <label class="col-form-label col-sm-4" for=""> Your Email</label>
            <div class="col-sm-8">
              <input class="form-control" value="{{$et_club->email}}" name="email" placeholder="Enter email" type="email">
            </div>
          </div>
            <div class="form-group row">
              <label class="col-sm-4 col-form-label" for="">Phone</label>
              <div class="col-sm-8">
                <input class="form-control" value="{{$et_club->phone}}" name="phone" placeholder="Phone" type="text">
              </div>
            </div>
         
          
          <div class="form-group row">
            <label class="col-form-label col-sm-4" for="" > Affiliation with</label>
            <div class="col-sm-8">
            <input class="form-control" name="affiliation" value="{{$et_club->affiliation}}" placeholder="Affiliation with" type="text">
            </div>
          </div>
          <div class="form-group row">
              <label class="col-sm-4 col-form-label" for=""> Image</label>
              <div class="col-sm-8">
              <input class="form-control" type="file" id="img" name="image" accept="image/png, image/jpeg">
                <div id="preview_img"></div>
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
