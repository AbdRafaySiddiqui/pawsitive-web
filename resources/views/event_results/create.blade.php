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
              <label class="col-form-label" for="">Class</label>
              <input class="form-control" name="class" id="class" placeholder="Enter class" type="text">
             
              </div>
            </div>
            <div class="col-sm-4">
            <div class="form-group">
          <label class="col-form-label" for="" >Select Breed </label>
          <select class="form-control select2" onchange="dogs_by_judge(this)" name="breed_id" id="breed_ide">
          <option>Select Breed</option>
                    <!-- <option> Select</option> -->
                    @foreach($total_breeds as $total_breed)
                        <option value="{{$total_breed->id}}">
                            {{$total_breed->name}}
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
      
    
    
               
      <div id='event_tbl'>
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
              Awards
              </th>
              <th>
              Judge
              </th>
            
              <!-- <th>
              Gender
              </th> -->
              <th>
              Action
              </th>
             
            </tr>
          </thead>
          <tbody>
            <tr>
              
              <td>

              <!-- <div class="col-md-12"> -->
              <select class="form-control select2 dog" name="dog_id[]" id="all_dogs">
              @foreach($dogs as $dog)
                <option  value="{{$dog->id}}">
               {{$dog->dog_name}}
                </option>
                @endforeach
              </select>
              <!-- </div> -->
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
                <input class="form-control" name="awards[]" placeholder="Enter Awards" type="text">
            </div>
              </td>
              <td>
             
             <div class="col-sm-12"> 
          
             <select class="form-control select2 select_judge" name="judge[]" id="judge">
             @foreach($total_judges as $judge)
               <option  value="{{$judge->id}}">
              {{$judge->full_name}}
               </option>
              @endforeach
             </select>
             
             <span class="form-control span_judge" id="judge_span" name="judge[]"></span>
            
             </div>
            </td>
            

           
              <td> <button id="add" name="add" class="btn btn-primary" type="button">Add</button></td>
            </tr>
            
          </tbody>
        </table>
        <button class="btn btn-primary"  type="submit"> Submit</button>
     </form>



      </div>
      </div>
      </div>

      </div>
    </div>
  </div>
</div>
@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
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
                            <select class="form-control select2" name="breed_id" class="breed_id">
                            <option></option>
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
                            <select class="form-control select2" name="sire_id" id="selUser"  >
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
                            <select class="form-control select2" name="dam_id" id="selUser_fe">
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
var breed_id=$('#breed_ide :selected').val();
        var gender=$('#gender_dog').val();
        console.log(selectId);
        $.ajax({
           type:'get',
           url:'http://localhost/pawsitive-web/api/dog/breed-dogs?breed_id='+breed_id,
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
         url:'http://localhost/pawsitive-web/api/event_results/judge?id='+id,
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
  $('#event_tbl').show();
  
});
 

function dogs_by_judge(select){
  
  $('#all_dogs').empty().append('<option value="0">Select Dog</option>');

        
//         return 'http://localhost/pawsitive-web/api/dog/breed-dogs?id='+id+'&gender='+gender;
var breed_id=$('#breed_ide :selected').val();
        var gender=$('#gender_dog').val();
        // console.log(breed_id);
        $.ajax({
           type:'get',
           url:'http://localhost/pawsitive-web/api/dog/breed-dogs?breed_id='+breed_id+'&gender='+gender,
           data:{id:breed_id},
           success:function(data)
           {
            
            if(data.dog.length > 0 ){
              for(let i = 0; i < data.dog.length; i++)
              {
              var x = document.getElementById('all_dogs');
                var option = document.createElement("option");
                option.text = data.dog[i].dog_name;
                option.value = data.dog[i].dog_id;
                x.add(option);
          }

            }
            else{
             
                
                var x = document.getElementById('all_dogs');
                var option = document.createElement("option");
                var dg=$('#all_dogs').append('<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add Dog</button>');
                console.log(dg);
              // option.html = '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add Dog</button>';
              option.text=dg;
              // option.value = 0;
              x.add(option);
            }
           }

        });

}       

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



    if($("#judge").is("select")) {
  $('#judge').empty().append('<option value="0">Select Judge</option>');
  }
var id=$('#event_id :selected').val();
var judge_id=$('#judge').text();

      // console.log(breed_id);
      $.ajax({
         type:'get',
         url:'http://localhost/pawsitive-web/api/event_results/judge?id='+id,
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
            
              judge_id.text = data.judge[i].full_name;
              judge_id.value = data.judge[i].judge_id;
              $('#judge_span').text(data.judge[i].full_name);
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

