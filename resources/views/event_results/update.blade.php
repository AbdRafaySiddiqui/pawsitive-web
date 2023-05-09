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
           
                <input class="form-control" style="display: none;" name="date" id="club-id" placeholder="Enter Club" type="text">
                <input class="form-control" style="display: none;" name="date" id="judge-id" placeholder="Enter Judge" type="text">
                <input class="form-control" style="display: none;" name="date" id="country" placeholder="Enter country" type="text">

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
          <select class="form-control select2" onchange="fetchClassDogs(this)" name="class" id="class">
          <option>Select Class</option>
                    <!-- <option> Select</option> -->
                    @foreach($classes as $class)
                        <option value="{{$class->class}}">
                            {{$class->class}}
                        </option>
                    @endforeach
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
      
    
    
               
      <table id="class-results-table">
  <thead>
    <tr>
      <th>Breed ID</th>
      <th>Award ID</th>
      <th>Dog ID</th>
      <th>Event ID</th>
      <th>Grading</th>
      <th>Place</th>
      <th>Judge</th>
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

      
  let i = 0; // Counter for generating unique IDs

$('#add').click(function(){
  
  var selectId = 'all_dogsb_' + i; // Generate a unique ID for the select element
  var judgeId = 'all_judgeb_' + i; // Generate a unique ID for the select element
  var judge_span = 'judge_span_b' + i; // Generate a unique ID for the select element

  var breed_id=$('#breed_id :selected').val();
  
$('#table').append(
`<tr>
<td><select class="form-control select2 dg" name="dog_id[]" id="${selectId}">
           
@foreach($dogs as $dog)
              <option  value="{{$dog->id}}">
             {{$dog->dog_name}}
              </option>
              @endforeach
              
            </select></td>
<td>  <input class="form-control" name="grading[]" placeholder="Enter Grade" type="text"></td>
<td>  <input class="form-control" name="place[]" placeholder="Enter place" type="text"></td>
<td>  <input class="form-control" name="awards[]" placeholder="Enter awards" type="text"></td>

<td>

           
<select class="form-control select2" name="judge[]" id="${judgeId}">
           @foreach($total_judges as $judge)
             <option  value="{{$judge->id}}">
            {{$judge->full_name}}
             </option>
           
         @endforeach  </select>
         
             <span class="form-control" id="${judge_span}" name="judge[]"></span>
       
</td>

<td> <button id="remove" class="btn btn-danger">Remove</button></td>

           </tr>`
        
);

$('#' + judgeId).select2();

$('#' + selectId).select2();


  
  $('#' +selectId).empty().append('<option value="0">Select Dog</option>');

        
//         return 'http://localhost/pawsitive-web/api/dog/breed-dogs?id='+id+'&gender='+gender;
var breed_id=$('#breed_id :selected').val();
        var gender=$('#gender_dog').val();
        console.log(selectId);
        $.ajax({
           type:'get',
           url:'{{ route("breed-dogs") }}' + '?breed_id=' + breed_id,
           data:{id:breed_id},
           success:function(data)
           {
              for(let i = 0; i < data.dog.length; i++)
              {
                
                var x = document.getElementById(selectId);
                var option = document.createElement("option");
                option.text = data.dog[i].dog_name;
                option.value = data.dog[i].dog_id;
                x.add(option);
                console.log(data);
              }
           }
      
      });

  

  $('#'+judgeId).empty().append('<option value="0">Select Judge</option>');
      

  // var judge_id=$('#judge').text();
  // var judge_span=$('#judge_span').text();
var id=$('#event_id :selected').val();

      // console.log(breed_id);
      $.ajax({
         type:'get',
         url:'{{ route("event_judge") }}' + '?id=' + id,
         data:{id:id},
         success:function(data)
         {
          for(let i = 0; i < data.judge.length; i++)
            {
              if(data.judge.length <=1) {
$('#'+judgeId).select2('destroy');
$('#'+judgeId).hide();
$('#'+judge_span).show();
              
              var x = document.getElementById(judgeId);
            
              judge_span.text = data.judge[i].full_name;
              judge_span.value = data.judge[i].judge_id;
              $('#'+judge_span).text(data.judge[i].full_name);
              // x.add(judge_id);
            }else{
              $('#'+judge_span).hide();
              var x = document.getElementById(judgeId);
              var option = document.createElement("option");
              option.text = data.judge[i].full_name;
              option.value = data.judge[i].judge_id;
              
              x.add(option);
            }
            }

         
         }
 
 
});
   i++; // Increment the counter for the next iteration
   
});


        $('#event_id').select2({
            allowClear: true,
            tags: true,
            placeholder: 'Select an Event'
        });


$('#breed_ide').on('change', function() {
  
});
 

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
        row.append($('<td>', {text: item.breed_id}));
        row.append($('<td>', {text: item.award_id}));
        row.append($('<td>', {text: item.dog_id}));
        row.append($('<td>', {text: item.event_id}));
        row.append($('<td>', {text: item.grading}));
        row.append($('<td>', {text: item.place}));
        row.append($('<td>', {text: item.judge}));
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

