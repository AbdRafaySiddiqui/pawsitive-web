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
        <form action="{{ route('club.update', $et_club->id) }}" method="post" >
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
                                            <label class="col-form-label" for="">Club Name</label>
                                            <input class="form-control" value="{{$et_club->name}}" name="name" placeholder="Enter Name" type="text">
                                        </div>
                                        </div>
                                        <div class="col-sm-4">
                                          <div class="form-group">
                                              <label class="col-form-label" for=""> Countries</label>
                                              <select class="form-control" name="country" id="country">
<<<<<<< HEAD
                                                  @foreach ($total_countries as $countries)
                                                  <option value="{{$countries->idCountry}}"  {{ $countries->idCountry == $et_club->country ? 'selected' : '' }}>
                                                          {{ $countries->countryName }}
=======
                                                  @foreach ($countries as $country)
                                                      <option value="{{ $country->idCountry }}">
                                                          {{ $country->countryName }}
>>>>>>> 886435092e88f404d9488d9c185bec45eb7ecbcb
                                                      </option>
                                                  @endforeach
                                              </select>
                                          </div>
                                        </div>
                                        <div class="col-sm-4">
                                          <div class="form-group">
                                              <label class="col-form-label" for=""> Cities</label>
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
                                            <input class="form-control" value="{{$et_club->email}}" name="email" placeholder="Enter Name" type="email">
                                        </div>
                                      </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                            <label class="col-form-label" for="">Phone</label>
                                            <input class="form-control" value="{{$et_club->phone}}" name="phone" placeholder="Enter Username" type="text">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                            <label class="col-form-label" for="">Affiliation with</label>
<<<<<<< HEAD
                                            <input class="form-control" value="{{$et_club->affiliation}}" name="affiliation" placeholder="Enter Email" type="text">
=======
                                            <input class="form-control" value="{{$et_club->affiliation}}" name="affiliation" placeholder="Enter Affiliation." type="text">
>>>>>>> 886435092e88f404d9488d9c185bec45eb7ecbcb
                                            </div>
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
@endsection
