@extends('layouts.master')

@section('content')
        <div class="content-w">
        
          <div class="content-i">
            <div class="content-box"><div class="row">
  
  <div class="col-lg-12">
    <div class="element-wrapper">
      <h6 class="element-header">
      Create a new club.
      </h6>
      <div class="element-box">
        <form action="{{ route('club.store') }}" method="post" enctype="multipart/form-data">
        @csrf
          <h5 class="form-header">
            Create a new club.
          </h5>
          <div class="form-desc" style='visibility:hidden;'>
            Discharge best employed your phase each the of shine. Be met even reason consider logbook redesigns. Never a turned interfaces among asking
          </div>


                                    <div class="row">
                                      <div class="col-sm-4">
                                        <div class="form-group">
                                          <label class="col-form-label" for="">Club Name</label>
                                          <input class="form-control" name="name" placeholder="Enter Club Name" type="text">
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
                                        <div class="col-sm-4">
                                          <div class="form-group">
                                              <label class="col-form-label" for=""> City</label>
                                              <select class="form-control" name="city" id="city">
                                              <option value="">Select City</option>
                                              </select>
                                          </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                      <div class="col-sm-4">
                                        <div class="form-group">
                                          <label class="col-form-label" for="">Your Email</label>
                                          <input class="form-control" name="email" placeholder="Enter Your Email" type="email">
                                        </div>
                                      </div>
                                      <div class="col-sm-4">
                                        <div class="form-group">
                                          <label class="col-form-label" for="">Your Address</label>
                                          <input class="form-control" name="address" placeholder="Enter Your Address" type="text">
                                        </div>
                                      </div>
                                      <div class="col-sm-4">
                                        <div class="form-group">
                                          <label class="col-form-label" for="">Your Phone</label>
                                          <input class="form-control" name="phone" placeholder="Enter Your Phone" type="tel">
                                        </div>
                                      </div>
                                    </div>

                                    <div class="row">
                                      <div class="col-sm-4">
                                        <div class="form-group">
                                          <label class="col-form-label" for="">Affiliation with</label>
                                          <input class="form-control" name="affiliation" placeholder="Enter Your affiliation" type="text">
                                        </div>
                                      </div>
                                      <div class="col-sm-4">
                                        <div class="form-group">
                                          <label class="col-form-label" for="">Your Website</label>
                                          <input class="form-control" name="website" placeholder="Enter Your website" type="text">
                                        </div>
                                      </div>
                                      <div class="col-sm-4">
                                        <div class="form-group">
                                          <label class="col-form-label" for="">Your Phone</label>
                                          <input class="form-control" type="file" id="img" name="img" accept="image/png, image/jpeg">
                                          <div id="preview_img"></div>
                                          </div>
                                        </div>
                                      </div>
                                    
          <div class="form-buttons-w mb-4">
            <button class="btn btn-primary" type="submit"> Submit</button>
          </div>
        
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


// JavaScript
    $(document).ready(function() {
        $('#country').on('change', function() {
            var idCountry = $(this).val();
            if(idCountry) {
                $.ajax({
                    url: "{{ url('api/cities') }}/"+idCountry,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('#city').empty();
                        $('#city').append('<option value="">Select City</option>');
                        $.each(data, function(key, value) {
                            $('#city').append('<option value="'+ value.id +'">'+ value.city +'</option>');
                        });
                        $('#city').prop('disabled', false);
                    }
                });
            } else {
                $('#city').empty();
                $('#city').prop('disabled', true);
            }
        });
    });

    </script>

    
    <script src="{{ asset('public/select2-develop/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('public/select2-develop/dist/js/i18n/pt-BR.js') }}"></script>

    <script>

        $('#club_id').select2({
            allowClear: true,
            tags: true,
            placeholder: 'Select a Club'
        });

        $('select[name="country"]').select2({
            allowClear: true,
            tags: true,
            placeholder: 'Select a Country'
        }).on('select2:select', function (e) {
            $(this).trigger('change');
        });


        $('select[name="city"]').select2({
            allowClear: true,
            tags: true,
            placeholder: 'Select a City'
        });
    </script>



<script>

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

<script src="//ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
@endsection
