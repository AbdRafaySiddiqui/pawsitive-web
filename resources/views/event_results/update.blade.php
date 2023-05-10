@extends('layouts.master')

@section('content')
        <div class="content-w">
    
          <div class="content-i">
            <div class="content-box">
              <div class="row">
  
  <div class="col-lg-12">
    <div class="element-wrapper">
      <h6 class="element-header">
       Add Event Result
      </h6>
      <div class="element-box">
     
          <h5 class="form-header">
          Add Event Result
          </h5>
          <div class="form-desc">
          </div>
         <form action="{{ route('event_results.store') }}" method="post">
        @csrf
          
            <div class="form-group row">
            <label class="col-form-label col-sm-4" for=""> Select Event</label>
            <div class="col-sm-8">
                <select class="form-control select2" name="event_id" id="event_id">
                    <option>Select Event</option>
                    @foreach($Events as $Event)
                        <option value="{{$Event->id}}">
                            {{$Event->name}} | {{ (isset($Event->club_name->name)) ? '('.$Event->club_name->name.')' : ''}} | {{date('F d, Y',strtotime($Event->start_date))}}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
           
        <div id="event_frm">
        <div class="row">
          <div class="col-sm-4">
          <div class="form-group">
              <label class="col-form-label" for="">Date</label>
                <input class="form-control" name="date" id="event-date" type="date">
              </div>
              </div>

                <div class="col-sm-4">
            <div class="form-group">
              <label class="col-form-label" for="">Club Name</label>
                <input class="form-control" name="date" id="club-name" placeholder="Enter Club" type="text">
              </div>
              </div>
          
              <div class="col-sm-4">
            <div class="form-group">
              <label class="col-form-label" for="">Judge Name</label>
                <input class="form-control" name="date" id="judge-name" placeholder="Enter judge" type="text">
              </div>
            </div>
            </div>
            <div class="row">
              <div class="col-sm-4">
            <div class="form-group">
              <label class="col-form-label" for="">Country Name</label>
                <input class="form-control" name="date" id="country-name" placeholder="Enter country" type="text">
              </div>
            </div>
            <div class="col-sm-4">
            <div class="form-group">
          <label class="col-form-label" for="" >Select Class </label>
          <select class="form-control" onchange="fetchClassDogs(this)" name="class" id="class">
          <option>Select Class</option>
                </select>
            </div>
            </div>
            </div>

            <!-- <div class="form-group row mt-4">
            <label class="col-form-label col-sm-4" for=""> Gender</label>
            <div class="col-sm-8">
            <select class="form-control" name="gender_dog"   id="gender_dog">
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
        </div> -->
          
     

        <div class="table-responsive">
      
    
    
               
      <table class="table table-bordered table-lg table-v2 table-striped" id="class-results-table">
  <thead>
    <tr>
      <th>Breed</th>
      <th>Award</th>
      <th>Dog</th>
      <th>Grading</th>
      <th>Place</th>
      <th>Judge</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
  </tbody>
</table>




      </div>
      </div>
      </div>
      
      </div>
    </div>
  </div>
</div>
            <script>



</script>

<!-- <script src="{{asset('public/bower_components/jquery/dist/jquery.min.js')}}"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->


    <script src="{{asset('public/select2-develop/dist/js/select2.full.min.js')}}"></script>
    <script src="{{asset('public/select2-develop/dist/js/i18n/pt-BR.js')}}"></script>

    <script type="text/javascript">
 

function fetchClassDogs() {
  var selectedClass = $('#class').val();
  $.ajax({
    type: 'get',
    url: '{{ route("class-dogs") }}',
    data: { class: selectedClass },
    success: function(data) {
      console.log(data);
      var tableBody = $('#class-results-table tbody');
      tableBody.empty();
      $.each(data.class, function(i, item) {
        var row = $('<tr>');
        row.append($('<td>', {text: item.breed_name}));
        row.append($('<td>', {text: item.award_id}));
        row.append($('<td>', {text: item.dog_name}));
        // row.append($('<td>', {text: item.event_id}));
        row.append($('<td>', {text: item.grading}));
        row.append($('<td>', {text: item.place}));
        row.append($('<td>', {text: item.judge}));
        var editButton = $('<button>', {text: 'Edit', class: 'btn btn-primary btn-sm'});
        editButton.on('click', function() {
          // Show modal to edit the record
        });
        row.append($('<td>').append(editButton));
        tableBody.append(row);
      });
    },
    error: function(xhr, status, error) {
      console.log(xhr.responseText);
    }
  });

}

// Bind the update function to the change event of the class dropdown
$('#class').on('change', fetchClassDogs);



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
function fetchCountryDetails(idCountry) {
    $.ajax({
        url: '{{ route("country_details", ":idCountry") }}'.replace(':idCountry', idCountry),
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            $('#country-name').val(response.countryName);
            console.log(idCountry);
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
}


$.ajax({
  type: 'get',
  url: '{{ route("class-dogs") }}',
  dataType: 'json',
  success: function(data) {
    var classDropdown = $('#class');
    classDropdown.empty();
    classDropdown.append('<option>Select Class</option>');
    $.each(data.class, function(i, item) {
      classDropdown.append($('<option>', {
        value: item,
        text: item
      }));
    });
  },
  error: function(xhr, status, error) {
    console.log(xhr.responseText);
  }
});



$('#event_id').on('change', function() {
  $('#event_frm').show();
    var event_id = $('#event_id').val();
    // Make AJAX request to fetch event details
    $.ajax({
        url: '{{ route("event_details", ":event_id") }}'.replace(':event_id', event_id),
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            // Update HTML content of container element with event details
            // Set values of input fields
            $('#event-date').val(response.start_date);
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




  $('#judge').empty().append('<option value="0">Select Judge</option>');

var id=$('#event_id :selected').val();
var judge_id=$('#judge').text();
      // console.log(breed_id);
      $.ajax({
         type:'get',
         url:'{{ route("event_judge") }}' + '?id=' + id,
         data:{id:id},
         success:function(data)
         {

            for(let i = 0; i < data.judge.length; i++)
            {
              if(data.judge.length <= 1) {

                $('#judge').select2('destroy');
                $('#judge').hide();

                // $('#judge').removeClass('select2');
                
                $('#judge_span').show();
              
              var x = document.getElementById('judge_span');
            
              judge_span.text = data.judge[i].full_name;
              judge_span.value = data.judge[i].judge_id;
              $('#judge_span').text(data.judge[i].full_name);
              $('#judge_span').value(data.judge[i].judge_id);
              // x.add(judge_id);
            
          }else{
            $('#judge_span').hide();
            $('#judge').show();
            $('#judge').select2();
              // $('#judge').addClass('select2');
              
              var x = document.getElementById('judge');
              var option = document.createElement("option");
              option.text = data.judge[i].full_name;
              option.value = data.judge[i].judge_id;
              
              x.add(option);
            }
            }
         }
      });
 
});

function verify_if_dog(select) {
  if (select.value == 'new_dog') {
    $('#exampleModal').modal('show');
  }
}

// Bind the event listener to the select element
$('#all_dogs').on('change', function() {
  $('#exampleModal').removeData(); // Remove any existing data from the modal
});

</script>

@endsection

