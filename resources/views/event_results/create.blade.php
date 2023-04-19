@extends('layouts.master')

@section('content')
        <div class="content-w">
    
          <div class="content-i">
            <div class="content-box"><div class="row">
  
  <div class="col-lg-12">
    <div class="element-wrapper">
      <h6 class="element-header">
       Add Event
      </h6>
      <div class="element-box">
        <!-- <form action="" method="post" enctype="multipart/form-data">
        @csrf -->
          <h5 class="form-header">
          Add Event
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
         
        <!-- </form> -->
      </div>
    </div>
  </div>
</div>

<div class="element-wrapper">
  <div class="element-box-tp">
    
    <div class="form-desc">
    </div>
    <div class="element-box-tp">
      <!--------------------
      START - Controls Above Table
      -------------------->
      <div class="controls-above-table">
        <div class="row">
          <div class="col-sm-6">
           
          </div>
          <div class="col-sm-6">
           
          </div>
        </div>
      </div>
   <!--------------------
      START - Table with actions
      ------------------  -->
      <div class="table-responsive">
      <form action="{{ route('event_results.store') }}" method="post">
                 @csrf
                 @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif

        <table class="table table-bordered table-lg table-v2 table-striped" id="table">
          <thead>
            <tr>
           
              <th>
             Dog
              </th>
              <th>
        Grade
              </th>
              <th>
              Place
              </th>
              <th>
              Judge
              </th>
              <th>
              Gender
              </th>
              <th>
              Action
              </th>
             
            </tr>
          </thead>
          <tbody>
            <tr>
              
              <td>

              <div class="col-md-12">
              <select class="form-control js-data-example-ajax dog" name="dog_id[]" id="all_dogs">
              @foreach($dogs as $dog)
                <option  value="{{$dog->id}}">
               {{$dog->dog_name}}
                </option>
                @endforeach
              </select>
              </div>
              </td>
              <td>
            
            <div class="col-sm-12"> 
              <input class="form-control" name="grading[]" placeholder="Enter Grade" type="text">
            </div>
              </td>
              <td>
              
              <div class="col-sm-12">
                <input class="form-control" name="place[]" placeholder="Enter Place" type="text">
            </div>
              </td>
              <td>
             
             <div class="col-sm-12"> 
             <select class="form-control js-data-example-ajax" name="judge[]" id="judge">
             @foreach($total_judges as $judge)
               <option  value="{{$judge->id}}">
              {{$judge->full_name}}
               </option>
               @endforeach
             </select>
             </div>
</td>
<td>
          <div class="col-sm-12">
          <select class="form-control" name="gender_dog[]">
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


</td>

              </td>
           
              <td> <button id="add" name="add" class="btn btn-primary" type="button">Add</button></td>
            </tr>
            
          </tbody>
        </table>
        <button class="btn btn-primary"  type="submit"> Submit</button>
        </form>
      </div>
      <!--           Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
           

  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Dog</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <div class="modal-body">
        <form id="my-form">
            @csrf        
            <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="">Dog Name</label>
                <div class="col-sm-8">
                  <input id="dog_name" class="form-control" name="dog_name" placeholder="Enter Dog Name" type="text">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label" for=""> DOB</label>
                <div class="col-sm-8">
                  <input   class="form-control" name="dob" id="dob" type="date">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label" for=""> Club Reg</label>
              <div class="col-sm-8">
                <input class="form-control" type="text" id="reg_no" name="reg_no">
              </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label" for=""> Microchip</label>
              <div class="col-sm-8">
                <input class="form-control" type="text" id="microchip" name="microchip" >
              </div>
            </div>


            <div class="form-group row">
                <label class="col-sm-4 col-form-label" for=""> Title</label>
              <div class="col-sm-8">
                  <input class="form-control" type="text" id="title" name="show_title" >
              </div>
            </div>


            <div class="form-group row">
                <label class="col-form-label col-sm-4" for=""> Achievements</label>
              <div class="col-sm-8">
                <textarea class="form-control" cols="80" id="achievements" name="achievements" rows="10"></textarea>
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
            <div class="form-group row">
              <label class="col-sm-4 col-form-label" for="">Select Breed</label>
              <div class="col-sm-8">
              <select class="form-control js-data-example-ajax" name="breed_id" class="breed_id">
              @foreach($total_breeds as $total_breed)
                <option  value="{{$total_breed->id}}">
               {{$total_breed->name}}
                </option>
                @endforeach
              </select>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-4 col-form-label" for="">Select Sire</label>
              <div class="col-sm-8">
              <select class="form-control js-data-example-ajax" name="sire_id" id="selUser"  >
              @foreach($maleDogs as $maleDog)
                <option  value="{{$maleDog->id}}">
               {{$maleDog->dog_name}}
                </option>
                @endforeach
              </select>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-4 col-form-label " for="">Select Dam</label>
              <div class="col-sm-8">
              <select class="form-control js-data-example-ajax" name="dam_id" id="selUser_fe">
              @foreach($femaleDogs as $femaleDog)
                <option  value="{{$femaleDog->id}}">
               {{$femaleDog->dog_name}}
                </option>
                @endforeach
              </select>
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

        </form>
      </div>
    </div>
  </div>
</div>
<!-- <script src="{{asset('public/bower_components/jquery/dist/jquery.min.js')}}"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->

    <script src="{{asset('public/select2-develop/dist/js/select2.full.min.js')}}"></script>
    <script src="{{asset('public/select2-develop/dist/js/i18n/pt-BR.js')}}"></script>

    <script>


      // var i=0;
      $('#judge').select2();
// $('.dg').select2();

$('#add').click(function(){
  // ++i;
$('#table').append(
`<tr>
<td><select class="form-control js-data-example-ajax dg" name="dog_id[]" id="all_dogs">
             
@foreach($dogs as $dog)
                <option  value="{{$dog->id}}">
               {{$dog->dog_name}}
                </option>
                @endforeach
                
              </select></td>
<td>  <input class="form-control" name="grading[]" placeholder="Enter Grade" type="text"></td>
<td>  <input class="form-control" name="place[]" placeholder="Enter place" type="text"></td>

<td><select class="form-control js-data-example-ajax" name="judge[]" id="judge">
             @foreach($total_judges as $judge)
               <option  value="{{$judge->id}}">
              {{$judge->full_name}}
               </option>
               @endforeach
             </select>
</td>
<td>  <select class="form-control" name="gender_dog[]">
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
            </td>
<td> <button id="remove" class="btn btn-danger">Remove</button></td>

             </tr>`
          
);
     

});

$('#all_dogs').select2({
    allowClear: true,
    placeholder: 'Select an items',
    language: {
      noResults: function (term) {
        return '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add Dog</button>';
      }
    },
    escapeMarkup: function(markup) {
      return markup;
    }
    ,
    ajax: {
      type: "get",
      url: '{{ URL::to('api/dog/all-dogs') }}',
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
  
                    text: item.dog_name,
                    id: item.id,
                    
                }
            })
        };
      },
      
      cache: true
    }
  });         
  // $('#table').find('#all_dogs').last().select2();
// $('.js-data-example-ajax').select2({
//   allowClear: true,
//     placeholder: 'Select an item',
//     language: {
//       noResults: function (term) {
//         return '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add Dog</button>';
//       }
//     },
//     escapeMarkup: function(markup) {
//       return markup;
//     }

//   });

$(document).on('click','#remove',function(){
$(this).parents('tr').remove();

});


$('#selUser').select2({
  dropdownParent: $("#exampleModal .modal-content"),
});


$('#selUser_fe').select2({
  dropdownParent: $("#exampleModal .modal-content")
});

// modal submit 
$('#my-form').on('submit', function(e){

e.preventDefault();

$.ajax({
  url: '{{ URL::to('/event-dog')}}',
  method: 'POST',
  data: $(this).serialize(),
  success: function(response){
    // Handle successful form submission
    
    // console.log(response);
    // console.log(response.response.full_name);
    // console.log(response.response.message);
    $('.dog').append($('<option>', {
    value: response.response.id,

    text: response.response.dog_name
  }));
    $('.dog').val(response.response.id).trigger('change'); 
    $('#success-msg').show();
    $('#success-msg').html('<p class="success">'+response.message+'</p>');
  },
  error: function(response,xhr, status, error){
    
    // Handle errors
    var responJson=JSON.parse(response.responseText);
    var responseJson=responJson.errors;
 //   console.log(responJson.message);
    //   $.map(responseJson, function(value) {
    $('#msg').append($('<p>',{
      text: responseJson.dog_name
    }));
    $('#msg').append($('<p>',{
      text: responseJson.dob
    }));
    $('#msg').append($('<p>',{
      text: responseJson.reg_no
    }));
    $('#msg').append($('<p>',{
      text: responseJson.microchip
    }));
    $('#msg').append($('<p>',{
      text: responseJson.gender
    }));
    $('#msg').append($('<p>',{
      text: responseJson.show_title
    }));
    $('#msg').append($('<p>',{
      text: responseJson.achievements
    }));

//     console.log(response);
   
  }
});

});

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
// clear modal 
$('#exampleModal').on('hidden.bs.modal', function () {
  $('#my-form')[0].reset(); // reset the form
  $('#msg').text(''); // clear the error message
});
$('#m_sub').on('click', function () {
  $('#msg').text(''); // clear the error message
});

</script>

@endsection

