@extends('layouts.master')

@section('content')


        <div class="content-w">
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
        <form action="{{ route('event_result.store') }}" method="post">
        @csrf
   
                    
          <h5 class="form-header">
            Horizontal Layout
          </h5>
          <div class="form-desc">
            Discharge best employed your phase each the of shine. Be met even reason consider logbook redesigns. Never a turned interfaces among asking
          </div>
       
          <div class="form-group row">
            <label class="col-form-label col-sm-4" for=""> Select Event</label>
            <div class="col-sm-8">
                <select class="form-control" name="event_id" id="event_id">
                    <option value=""> Select Event </option>
                    @foreach($Events as $Event)
                        <option value="{{$Event->id}}">
                            {{$Event->name}}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
              <label class="col-sm-4 col-form-label" for="">Date</label>
              <div class="col-sm-8">
                <input class="form-control" name="date" id="event-date" type="date">
              </div>
            </div>


                <input class="form-control" style="display: none;" name="date" id="club-id" placeholder="Enter Club" type="text">

                <input class="form-control" style="display: none;" name="date" id="judge-id" placeholder="Enter Judge" type="text">
              
                <input class="form-control" style="display: none;" name="date" id="country" placeholder="Enter country" type="text">
              

            <div class="form-group row">
              <label class="col-sm-4 col-form-label" for="">Club Name</label>
              <div class="col-sm-8">
                <input class="form-control" name="date" id="club-name" placeholder="Enter Club" type="text">
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-4 col-form-label" for="">judge Name</label>
              <div class="col-sm-8">
                <input class="form-control" name="date" id="judge-name" placeholder="Enter judge" type="text">
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-4 col-form-label" for="">Country Name</label>
              <div class="col-sm-8">
                <input class="form-control" name="date" id="country-name" placeholder="Enter country" type="text">
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-4 col-form-label" for="">Class</label>
              <div class="col-sm-8">
                <input class="form-control" name="date" id="country-name" placeholder="Enter Class" type="text">
              </div>
            </div>

            <div class="form-group row">
          <label class="col-form-label col-sm-4" for="" > Gender</label>
          <div class="col-sm-8">
          <select class="form-control" name="gender">
          <option value="">
                  Select One
                </option>
                <option value="Male">
                  Male
                </option>
                <option value="Female">
                Female
                </option>
              </select>
            </div>
            </div>

        <div id="event-details-container"></div>
        



            
            <div class="form-buttons-w mb-4">
            <button class="btn btn-primary" type="submit"> Submit</button>
            <button class="btn btn-secondary" type="reset"> Reset</button>
            <a action="back" href="javascript: window.history.back();" class="btn btn-danger">
              <i class="fa fa-times"> </i><span> &nbsp; Cancel</span>
            </a>
          </div>
          @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
@if($errors->any())
<div class="alert alert-danger">
    {!! implode('', $errors->all('<div>:message</div>')) !!}
    </div>
@endif

        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


        <script>
          function fetchClubDetails(clubId) {
    $.ajax({
        url: '{{ route("club_details", ":club_id") }}'.replace(':club_id', clubId),
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            // Set value of club name input field
            $('#club-name').val(response.name);
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
}

function fetchJudgeDetails(judgeId) {
    $.ajax({
        url: '{{ route("judge_details", ":judge_id") }}'.replace(':judge_id', judgeId),
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            // Set value of club name input field
            $('#judge-name').val(response.full_name);
            // console.log(response);
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
}

function fetchCountryDetails(countryId) {
    $.ajax({
        url: '{{ route("country_details", ":idCountry") }}'.replace(':idCountry', countryId),
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            $('#country-name').val(response.countryName);
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
}

$('#event_id').on('change', function() {
    var event_id = $('#event_id').val();

    // Make AJAX request to fetch event details
    $.ajax({
        url: '{{ route("event_details", ":event_id") }}'.replace(':event_id', event_id),
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            // Update HTML content of container element with event details
            // Set values of input fields
            $('#event-date').val(response.date);
            $('#club-id').val(response.club_id);
            $('#judge-id').val(response.judge_id);
            $('#country').val(response.country);

            // Fetch club details using club_id
            fetchClubDetails(response.club_id);
            fetchJudgeDetails(response.judge_id);
            fetchCountryDetails(response.country);
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
});


</script>
            <!-- start dog form  -->

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Judge</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form  id="my-form">
        @csrf
         
          <div class="form-group row">
              <label class="col-sm-4 col-form-label" for="">Full Name</label>
              <div class="col-sm-8">
                <input id="full_name" class="form-control"  name="full_name" placeholder="Enter Full Name" type="text">
              </div>
            </div>
          <div class="form-group row">
              <label class="col-sm-4 col-form-label" for=""> Position In Club</label>
              <div class="col-sm-8">
                <input   class="form-control"  name="position_in_club" id="position_in_club" placeholder="Enter Position In Club" type="text">
              </div>
            </div>
          <div class="form-group row">
              <label class="col-sm-4 col-form-label" for=""> Image</label>
              <div class="col-sm-8">
              <input class="form-control" type="file" id="img" name="img" accept="image/png, image/jpeg">
                <div id="preview_img"></div>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-4 col-form-label" for=""> Signature</label>
              <div class="col-sm-8">
              <input class="form-control" type="file" id="sig" name="sig" accept="image/png, image/jpeg">
                <div id="preview_sig"></div>
              </div>
            </div>
       
            <div class="form-group row">
            <label class="col-form-label col-sm-4" for=""> Enter Description Below</label>
            <div class="col-sm-8">
            <textarea class="form-control"  cols="80" id="ckeditor1" name="description" rows="10"></textarea>
            </div>
          </div>
           
         <div id="success-msg"> </div>
         <div id="msg"> </div>
          <div class="form-buttons-w mb-4">
            <button class="btn btn-primary" id="m_sub" type="submit"> Submit</button>
            <button class="btn btn-secondary" type="reset"> Reset</button>
            <a action="back" href="javascript: window.history.back();" class="btn btn-danger">
              <i class="fa fa-times"> </i><span> &nbsp; Cancel</span>
            </a>
          </div>

      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
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
    
    
    <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
    <script src="{{asset('public/select2-develop/dist/js/select2.full.min.js')}}"></script>
    <script src="{{asset('public/select2-develop/dist/js/i18n/pt-BR.js')}}"></script>


<script>
  $('#selUser').select2({
    allowClear: true,
    placeholder: 'Select an item',
    language: {
      noResults: function (term) {
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
   
       data: function (params) {
              return {
                  q: $.trim(params.term)
              };   
          },
      processResults: function (data) {
        // console.log(data)
        return {
          results:  $.map(data, function (item) {
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
  $('#my-form').on('submit', function(e){

      e.preventDefault();

      $.ajax({
        url: '{{ URL::to('/submit-form')}}',
        method: 'POST',
        data: $(this).serialize(),
        success: function(response){
          // Handle successful form submission
          
          console.log(response);
          console.log(response.response.full_name);
          console.log(response.response.message);
          $('#selUser').append($('<option>', {
          value: response.response.id,

          text: response.response.full_name
        }));
          $('#selUser').val(response.response.id).trigger('change'); 
          $('#success-msg').html('<p class="success">'+response.message+'</p>');
        },
        error: function(response,xhr, status, error){
          
          // Handle errors
          var responJson=JSON.parse(response.responseText);
          var responseJson=responJson.errors;
       //   console.log(responJson.message);
          //   $.map(responseJson, function(value) {
          $('#msg').append($('<p>',{
            text: responseJson.description
          }));
          $('#msg').append($('<p>',{
            text: responseJson.position_in_club
          }));
          $('#msg').append($('<p>',{
            text: responseJson.full_name
          }));

     //     console.log(response);
         
        }
      });

    });
    $('#exampleModal').on('hidden.bs.modal', function () {
  $('#my-form')[0].reset(); // reset the form
  $('#msg').text(''); // clear the error message
});
$('#m_sub').on('click', function () {
  $('#msg').text(''); // clear the error message
});

</script>

<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> -->

@endsection
