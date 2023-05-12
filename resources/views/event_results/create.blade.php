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
          <select class="form-control select2" name="breed_id" id="breed_ide">
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

              <div class="col-md-12">
              <select class="form-control select2 dog"  name="dog_id[]" id="all_dogs">
           
                <option  value="">
               Select Dog
                </option>
        
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
                <input class="form-control" name="dog_name" placeholder="Enter Dog Name" type="text">
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-4 col-form-label" for="">Select Breed</label>
              <div class="col-sm-8">
              <select class="form-control js-data-example-ajax" name="breed_id" id="breed_id">
              @foreach($total_breeds as $total_breed)
                <option  value="{{$total_breed->id}}">
               {{$total_breed->name}}
                </option>
                @endforeach
              </select>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-4 col-form-label" for="">Breeder</label>
              <div class="col-sm-8">
                <input class="form-control" name="breeder" placeholder="Enter Breeder" type="text">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-4 col-form-label" for="">Select Sire</label>
              <div class="col-sm-8">
              <select class="form-control js-data-example-ajax" name="sire_id" id="selUser">
              @foreach($maleDogs as $maleDog)
                <option  value="{{$maleDog->id}}">
               {{$maleDog->dog_name}}
                </option>
                @endforeach
              </select>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-4 col-form-label" for="">Select Dam</label>
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

          <div class="form-group row">
              <label class="col-sm-4 col-form-label" for="">DOB</label>
              <div class="col-sm-8">
                <input class="form-control" name="dob" placeholder="Enter DOB" type="date">
              </div>
            </div>
          <div class="form-group row">
              <label class="col-sm-4 col-form-label" for="">Club Reg #</label>
              <div class="col-sm-8">
                <input class="form-control" name="reg_no" placeholder="Enter Club Reg #" type="text">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-4 col-form-label" for="">Registered With</label>
              <div class="col-sm-8">
              <select class="form-control select2" name="reg_with" id="reg_with">
                <option value="">Select Registered With</option>
              @foreach($total_clubs as $total_club)
                <option  value="{{$total_club->id}}">
               {{$total_club->name}}
                </option>
                @endforeach
              </select>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-4 col-form-label" for="">Dog Owner</label>
              <div class="col-sm-8">
              <select class="form-control select2" name="dog_owner" id="dog_owner">
                <option value="">Select Dog Owner</option>
              @foreach($total_owners as $total_owner)
                <option  value="{{$total_owner->id}}">
               {{$total_owner->username}}
                </option>
                @endforeach
              </select>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-4 col-form-label" for="">Is Champion</label>
              <div class="col-sm-8">
              <select class="form-control" name="is_champion" id="is_champion">         
              <option value="">Select</option>
                <option  value="Yes">Yes   </option>
                <option  value="No">No   </option>
        
              </select>
              </div>
            </div>

          <div class="form-group row">
              <label class="col-sm-4 col-form-label" for="">Microchip</label>
              <div class="col-sm-8">
                <input class="form-control" name="microchip" placeholder="Enter Microchip" type="text">
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
            <label class="col-form-label col-sm-4" for="">Show Title</label>
            <div class="col-sm-8">
              <input class="form-control" name="show_title" placeholder="Enter Show Title" type="text">
            </div>
          </div>
          <div class="form-group row">
              <label class="col-sm-4 col-form-label" for="">Achievements </label>
              <div class="col-sm-8">
                <textarea class="form-control" name="achievements" id="" cols="30" rows="10"></textarea>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-4 col-form-label" for="">Profile Photo</label>
              <div class="col-sm-8">
                
                <input class="form-control" id="profile_photo" name="profile_photo" placeholder="Enter Profile Photo" type="file">
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

      
  var i = 0; // Counter for generating unique IDs

$('#add').click(function(){
  var selectId = 'all_dogsb_' + i; // Generate a unique ID for the select element
  var judgeId = 'all_judgeb_' + i; // Generate a unique ID for the select element
  var judge_span = 'judge_span_b' + i; // Generate a unique ID for the select element
$('#table').append(
`<tr>
<td><select class="form-control select2 dg" name="dog_id[]" id="${selectId}">
           

              <option  value="">
            
              </option>
           
              
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

// $('#' + selectId).select2();

$('#' + selectId).select2({
  allowClear: true,
    placeholder: 'Select a dog',
    language: {
      noResults: function (term) {
        return '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add Dog</button>';
      }
    },
    minimumInputLength: 3,
    ajax: {
      url: function(){
        var breed_id=$('#breed_ide :selected').val();
        var  url='{{ URL::to('api/dog/breed-dogs?breed_id=') }}';
        return url+breed_id;
      },
        dataType: 'json',
        delay: 250,
        data: function(params) {
            return {
                q: params.term,
                page: params.page || 1
            };
        },
        processResults: function(data, params) {
          console.log(data.dog.data);
            params.page = params.page || 1;
            return {
                results: data.dog.data,
                pagination: {
                    more: (params.page * 30) < data.total_count
                }
            };
        },
        cache: true
    },
    escapeMarkup: function(markup) {
        return markup;
    },
    templateResult: function(dog) {
        if (dog.loading) {
         
           return  dog.text;
         
        }
        var markup = "<option>" + dog.dog_name + "</option>";
        return markup;
    },
    templateSelection: function(dog) {
        return dog.dog_name || dog.text;
    }
});

  
  $('#' +selectId).empty().append('<option value="0">Select Dog</option>');

        

  

  $('#'+judgeId).empty().append('<option value="0">Select Judge</option>');
      

  // var judge_id=$('#judge').text();
  // var judge_span=$('#judge_span').text();
var id=$('#event_id :selected').val();

      // console.log(breed_id);
      $.ajax({
         type:'get',
         url:'{{  url("api/dog/event_judge") }}',
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
   
});


        $('#event_id').select2({
            allowClear: true,
            tags: true,
            placeholder: 'Select an Event'
        });


$('#breed_ide').on('change', function() {
  $('#event_tbl').show();
  $('#all_dogs').empty().append('<option value="0">Select Dog</option>');
 
  $('#all_dogs').select2({
    placeholder: 'Select a dog',
    // allowClear: true,
    // width: '100%',

    language: {
      noResults: function (term) {
        return '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add Dog</button>';
      }
    },
 
    minimumInputLength: 1,
    ajax: {
      url: function(){
        var breed_id=$('#breed_ide :selected').val();
        var  url='{{ URL::to('api/dog/breed-dogs?breed_id=') }}';
        return url+breed_id;
      },
        dataType: 'json',
        delay: 250,
        data: function(params) {
            return {
                q: params.term,
                page: params.page || 1
            };
        },
        processResults: function(data, params) {
          console.log(data.dog.data);
          // debugger;
    // $('#all_dogs').val(null).trigger('change');
            params.page = params.page || 1;
            return {
                results: data.dog.data,
                
                pagination: {
                    more: (params.page * 30) < data.total_count
                }
            };
        },
        cache: false
    },
    escapeMarkup: function(markup) {
        return markup;
    },
    templateResult: function(dog) {
        if (dog.loading) {
         
           return  dog.text;
         
        }
        var markup = "<option value="+ dog.id +">" + dog.dog_name + "</option>";
        return markup;
        if(dog.dog_name){
          $('#all_dogs').empty();
        }
  
    },
    templateSelection: function(dog) {
        return dog.dog_name || dog.text;
       
    }
});

  }); 

  $( document ).ready(function() {
    $('#all_dogs').on('change', function() {
      
    var id =$('#all_dogs').val();
    console.log( id );
    });
//     $("#all_dogs > option").removeAttr("selected");
// $("#all_dogs").trigger("change");

i++; // Increment the counter for the next iteration
  
});

      

$(document).on('click','#remove',function(){
$(this).parents('tr').remove();

});

$('#exampleModal').on('shown.bs.modal', function () {
  $('#selUser').select2({
  
  dropdownParent: $("#exampleModal .modal-content"),
  placeholder: 'Select a dog',
    // allowClear: true,
    // width: '100%',

    // language: {
    //   noResults: function (term) {
    //     return '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add Dog</button>';
    //   }
    // },
 
    // minimumInputLength: 1,
    ajax: {
      url: function(){
        var breed_id=$('#breed_id :selected').val();
        var  url='{{ URL::to('api/dog/male-dogs?breed_id=') }}';
        return url+breed_id;
      },
        dataType: 'json',
        delay: 250,
        data: function(params) {
            return {
                q: params.term,
                page: params.page || 1
            };
        },
        processResults: function(data, params) {
          console.log(data.dog.data);
          // debugger;
    // $('#all_dogs').val(null).trigger('change');
            params.page = params.page || 1;
            return {
                results: data.dog.data,
                
                pagination: {
                    more: (params.page * 30) < data.total_count
                }
            };
        },
        cache: false
    },
    escapeMarkup: function(markup) {
        return markup;
    },
    templateResult: function(dog) {
        if (dog.loading) {
         
           return  dog.text;
         
        }
        var markup = "<option value="+ dog.id +">" + dog.dog_name + "</option>";
        return markup;
        if(dog.dog_name){
          $('#selUser').empty();
        }
  
    },
    templateSelection: function(dog) {
        return dog.dog_name || dog.text;
       
    }
  
});

$('#selUser_fe').select2({
  dropdownParent: $("#exampleModal .modal-content"),
  placeholder: 'Select a dog',
    // allowClear: true,
    // width: '100%',

    // language: {
    //   noResults: function (term) {
    //     return '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add Dog</button>';
    //   }
    // },
 
    minimumInputLength: 1,
    ajax: {
      url: function(){
        var breed_id=$('#breed_id :selected').val();
        var  url='{{ URL::to('api/dog/female-dogs?breed_id=') }}';
        return url+breed_id;
      },
        dataType: 'json',
        delay: 250,
        data: function(params) {
            return {
                q: params.term,
                page: params.page || 1
            };
        },
        processResults: function(data, params) {
          console.log(data.dog.data);
          // debugger;
    // $('#all_dogs').val(null).trigger('change');
            params.page = params.page || 1;
            return {
                results: data.dog.data,
                
                pagination: {
                    more: (params.page * 30) < data.total_count
                }
            };
        },
        cache: false
    },
    escapeMarkup: function(markup) {
        return markup;
    },
    templateResult: function(dog) {
        if (dog.loading) {
         
           return  dog.text;
         
        }
        var markup = "<option value="+ dog.id +">" + dog.dog_name + "</option>";
        return markup;
        if(dog.dog_name){
          $('#selUser_fe').empty();
        }
  
    },
    templateSelection: function(dog) {
        return dog.dog_name || dog.text;
       
    }
});
$('#breed_id').select2({
  dropdownParent: $("#exampleModal .modal-content")
  
});
$('#dog_owner').select2({
  dropdownParent: $("#exampleModal .modal-content")
  
});
$('#is_champion').select2({
  dropdownParent: $("#exampleModal .modal-content")
  
});
$('#reg_with').select2({
  dropdownParent: $("#exampleModal .modal-content")
  
});

});


// modal submit 
$('#my-form').on('submit', function(e){

e.preventDefault();

var form = $('#my-form')[0];

var data = new FormData(form);

$.ajax({
  url: '{{ URL::to('/event-dog')}}',
  method: 'POST',
  enctype: 'multipart/form-data',
  data: data,
  contentType: false,
  processData: false,
  cache: false,
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
   console.log(responJson.message);
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
        url: '{{ url("api/event_details", ":event_id") }}'.replace(':event_id', event_id),
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
         url:'{{ route("event_judge") }}',
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
// clear modal 
$('#exampleModal').on('hidden.bs.modal', function () {
  $('#my-form')[0].reset(); // reset the form
  $('#msg').text(''); // clear the error message
  $('#success-msg').hide();

});
$('#m_sub').on('click', function () {
  // $('#my-form')[0].reset(); 
  // $('#success-msg').empty();
  $('#msg').text(''); // clear the error message
});


// function verify_if_dog(select) {
//   if (select.value == 'new_dog') {
//     $('#exampleModal').modal('show');
//   }
// }


</script>

@endsection

