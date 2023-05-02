@extends('layouts.master')

@section('content')
    <div class="content-w" style="width: 100%;">

        <div class="content-i">
            <div class="content-box">
                <div class="row">

                    <div class="col-lg-12">
                        <div class="element-wrapper">
                            <h6 class="element-header">
                                Event
                            </h6>
                            <div class="element-box">
                                <form action="{{ route('events.update', $events->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <h5 class="form-header">
                                        Event
                                    </h5>
                                    <div class="form-desc">
                                    </div>

                                    <div class="row">
                                      <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label" for="">Event Name</label>
                                            <input class="form-control" name="event_name" value="{{ $events->name }}" placeholder="Enter Event Name" type="text">
                                        </div>
                                      </div>
                                      <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label" for=""> Select Club</label>
                                            <select class="form-control" name="club_id" id="club_id">
                                              <option></option>
                                                @foreach ($total_clubs as $clubs)
                                                    @if($clubs->id == $events->club_id)
                                                      <option selected value="{{ $clubs->id }}">{{ $clubs->name }}</option>
                                                    @else
                                                      <option value="{{ $clubs->id }}">{{ $clubs->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                      </div>
                                      <div class="col-sm-4">
                                        <div class="form-group">
                                          <label class="col-form-label" for="">Select Judge</label>
                                              <select class="form-control js-data-example-ajax" name="judge_id"
                                                  id="selUser">
                                                  @foreach ($judges as $judge)
                                                    @foreach ($events->judges as $judges)
                                                      <option value="{{ $judge->id }}"
                                                          {{ $judge->id == $judges->judge_id ? 'selected' : '' }}>
  
  
                                                          {{ $judge->full_name }}
                                                      </option>
                                                    @endforeach
                                                  @endforeach
                                              </select>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="row">
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="">Start Date</label>
                                            <input class="form-control" name="start_date" placeholder="Enter Start Date" type="date" value="{{ $events->start_date }}">
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="">End Date</label>
                                            <input class="form-control" name="end_date" placeholder="Enter End Date" type="date" value="{{ $events->end_date }}">
                                        </div>
                                      </div>
                                    </div>

                                    <div class="row">
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for=""> Country</label>
                                            <select class="form-control" name="country" id="country_id">
                                              <option></option>
                                                @foreach ($total_countries as $countries)
                                                    <option value="{{ $countries->idCountry }}"
                                                        {{ $countries->idCountry == $events->country ? 'selected' : '' }}>
                                                        {{ $countries->countryName }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for=""> City</label>
                                            <select class="form-control" name="city" id="city_id">
                                              <option></option>
                                                @foreach ($total_cities as $cities)
                                                    <option value="{{ $cities->id }}"
                                                        {{ $cities->id == $events->city ? 'selected' : '' }}>

                                                        {{ $cities->city }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="form-buttons-w mb-4">
                                        <button class="btn btn-primary" type="submit"> Submit</button>
                                        <button class="btn btn-secondary" type="reset"> Reset</button>
                                        <a action="back" href="javascript: window.history.back();" class="btn btn-danger">
                                            <i class="fa fa-times"> </i><span> &nbsp; Cancel</span>
                                        </a>
                                    </div>
                                    @if (session()->has('message'))
                                        <div class="alert alert-success">
                                            {{ session()->get('message') }}
                                        </div>
                                    @endif
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            {!! implode('', $errors->all('<div>:message</div>')) !!}
                                        </div>
                                    @endif

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- start dog form  -->

                <!-- Button trigger modal -->


                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Judge</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="my-form">
                                    @csrf

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label" for="">Full Name</label>
                                        <div class="col-sm-8">
                                            <input id="full_name" class="form-control" name="full_name"
                                                placeholder="Enter Full Name" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label" for=""> Position In Club</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" name="position_in_club" id="position_in_club"
                                                placeholder="Enter Position In Club" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label" for=""> Image</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" type="file" id="img" name="img"
                                                accept="image/png, image/jpeg">
                                            <div id="preview_img"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label" for=""> Signature</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" type="file" id="sig" name="sig"
                                                accept="image/png, image/jpeg">
                                            <div id="preview_sig"></div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-4" for=""> Enter Description
                                            Below</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" cols="80" id="ckeditor1" name="description" rows="10"></textarea>
                                        </div>
                                    </div>


                                    <div class="form-buttons-w mb-4">
                                        <button class="btn btn-primary" id="m_sub" type="submit"> Submit</button>
                                        <button class="btn btn-secondary" type="reset"> Reset</button>
                                        <a action="back" href="javascript: window.history.back();"
                                            class="btn btn-danger">
                                            <i class="fa fa-times"> </i><span> &nbsp; Cancel</span>
                                        </a>
                                    </div>
                                    @if (session()->has('message'))
                                        <div class="alert alert-success">
                                            {{ session()->get('message') }}
                                        </div>
                                    @endif

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
                </form>


            </div>
        </div>
    </div>
    </div>
    <div class="display-type"></div>
    </div>

    <script src="{{ asset('public/select2-develop/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('public/select2-develop/dist/js/i18n/pt-BR.js') }}"></script>
    <script>

$('#club_id').select2({
            allowClear: true,
            tags: true,
            placeholder: 'Select a Club'
        });

        $('#country_id').select2({
            allowClear: true,
            tags: true,
            placeholder: 'Select a Country'
        });

        $('#city_id').select2({
            allowClear: true,
            tags: true,
            placeholder: 'Select a Country'
        });

        $('#selUser').select2({
            // allowClear: true,
            // placeholder: 'Select an item',
            text: 'hello',
            val: 3,
            language: {
                noResults: function(term) {
                    return '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add Judge</button>';
                }
            },
            escapeMarkup: function(markup) {
                return markup;
            },
            ajax: {
                type: "get",
                url: '{{ URL::to('api/search') }}',
                dataType: 'json',

                delay: 250,

                data: function(params) {
                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function(data) {
                    // console.log(data)
                    return {
                        results: $.map(data, function(item) {

                            return {
                                //  _token: CSRF_TOKEN,
                                text: item.full_name,
                                id: item.id,

                            }
                        })
                    };
                },

                cache: true
            }

        })




        // modal submit 
        $('#my-form').on('submit', function(e) {

            e.preventDefault();

            $.ajax({
                url: '{{ URL::to('/submit-form') }}',
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    // Handle successful form submission

                    console.log(response);
                    console.log(response.response.full_name);
                    console.log(response.response.message);
                    $('#selUser').append($('<option>', {
                        value: response.response.id,

                        text: response.response.full_name
                    }));
                    $('#selUser').val(response.response.id).trigger('change');
                    $('#success-msg').html('<p class="success">' + response.message + '</p>');
                },
                error: function(response, xhr, status, error) {

                    // Handle errors
                    var responJson = JSON.parse(response.responseText);
                    var responseJson = responJson.errors;
                    //  console.log(responJson.message);
                    $('#msg').append($('<p>', {
                        text: responseJson.description
                    }));
                    $('#msg').append($('<p>', {
                        text: responseJson.position_in_club
                    }));
                    $('#msg').append($('<p>', {
                        text: responseJson.full_name
                    }));

                    //   console.log(response);

                }
            });

        });
        $('#exampleModal').on('hidden.bs.modal', function() {
            $('#my-form')[0].reset(); // reset the form
            $('#msg').text(''); // clear the error message
        });
        $('#m_sub').on('click', function() {
            $('#msg').text(''); // clear the error message
        });
    </script>
@endsection
