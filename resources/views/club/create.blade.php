@extends('layouts.master')

@section('content')
        <div class="content-w">
        
          <div class="content-i">
            <div class="content-box"><div class="row">
  
  <div class="col-lg-12">
    <div class="element-wrapper">
      <h6 class="element-header">
      Add Club
      </h6>
      <div class="element-box">
        <form action="{{ route('club.store') }}" method="post" enctype="multipart/form-data">
        @csrf
          <h5 class="form-header">
            Add Club
          </h5>
          <div class="form-desc">
            Discharge best employed your phase each the of shine. Be met even reason consider logbook redesigns. Never a turned interfaces among asking
          </div>
          <div class="form-group row">
              <label class="col-sm-4 col-form-label" for="">Club Name</label>
              <div class="col-sm-8">
                <input class="form-control" name="name" placeholder="Club Name" type="text">
              </div>
            </div>
            <div class="form-group row">
  <label class="col-form-label col-sm-4" for="" name="countries"> Countries</label>
  <div class="col-sm-8">
    <select class="form-control" name="country" id="country-dropdown">
      <option value="">Select Country</option>
    </select>
  </div>
</div>
<div class="form-group row">
  <label class="col-sm-4 col-form-label" for=""> City</label>
  <div class="col-sm-8">
    <select class="form-control" name="city" id="city-dropdown">
      <option value="">Select City</option>
    </select>
  </div>
</div>

            <div class="form-group row">
            <label class="col-form-label col-sm-4" for=""> Your Email</label>
            <div class="col-sm-8">
              <input class="form-control" name="email" placeholder="Enter email" type="email">
            </div>
          </div>
            <div class="form-group row">
              <label class="col-sm-4 col-form-label" for="">Phone</label>
              <div class="col-sm-8">
                <input class="form-control" name="phone" placeholder="Phone" type="tel" >
              </div>
            </div>
          
          <div class="form-group row">
            <label class="col-form-label col-sm-4" for="" name="affiliation"> Affiliation with</label>
            <div class="col-sm-8">
            <input class="form-control" name="affiliation" placeholder="Affiliation with" type="text">
            </div>
          </div>
          <div class="form-group row">
              <label class="col-sm-4 col-form-label" for=""> Image</label>
              <div class="col-sm-8">
              <input class="form-control" type="file" id="img" name="img" accept="image/png, image/jpeg">
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

    <script>

// JavaScript
$(document).ready(function() {
  $('#country-dropdown').change(function() {
    var countryId = $(this).val();
    if (countryId) {
      $.ajax({
        url: '/api/countries/' + countryId + '/cities',
        type: 'GET',
        success: function(response) {
          var cityDropdown = $('#city-dropdown');
          cityDropdown.empty();
          cityDropdown.append($('<option>').text('Select City').attr('value', ''));
          $.each(response.cities, function(index, city) {
            cityDropdown.append($('<option>').text(city.city).attr('value', city.id));
          });
        }
      });
    }
  });
});



function previewImages() {

var preview = document.querySelector('#preview_img');

if (this.files) {
  [].forEach.call(this.files, readAndPreview);
}

function readAndPreview(file) {

  // Make sure `file.name` matches our extensions criteria
  if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
    return alert(file.name + " is not an image");
  } // else...
  
  var reader = new FileReader();
  
  reader.addEventListener("load", function() {
    var image = new Image();
    image.height = 100;
    image.title  = file.name;
    image.src    = this.result;
    preview.appendChild(image);
  });
  
  reader.readAsDataURL(file);
  
}

}

    </script>
@endsection
