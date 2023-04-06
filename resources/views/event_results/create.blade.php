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
        <form action="{{ route('event_results.store') }}" method="post" enctype="multipart/form-data">
        @csrf
          <h5 class="form-header">
            Horizontal Layout
          </h5>
          <div class="form-desc">
            Discharge best employed your phase each the of shine. Be met even reason consider logbook redesigns. Never a turned interfaces among asking
          </div>
          
          <div class="form-group row">
              <label class="col-sm-4 col-form-label" for="">Select Dog</label>
              <div class="col-sm-8">
              <select class="form-control js-data-example-ajax" name="dog_id" id="all_dogs">
              @foreach($dogs as $dog)
                <option  value="{{$dog->id}}">
               {{$dog->dog_name}}
                </option>
                @endforeach
              </select>
              </div>
            </div>
         
            <div class="form-group row">
              <label class="col-sm-4 col-form-label" for="">Grade</label>
              <div class="col-sm-8">
                <input class="form-control" name="grade" placeholder="Enter Event Name" type="text">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-4 col-form-label" for="">Place</label>
              <div class="col-sm-8">
                <input class="form-control" name="place" placeholder="Enter Event Name" type="text">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-4 col-form-label" for="">Select Judge</label>
              <div class="col-sm-8">
              <select class="form-control" name="judge">
              @foreach($dogs as $dog)
                <option  value="{{$dog->id}}">
               {{$dog->dog_name}}
                </option>
                @endforeach
              </select>
              </div>
            </div>
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

       <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
              <select class="form-control js-data-example-ajax" name="breed_id" id="breed_id">
              @foreach($total_breeds as $total_breed)
                <option  value="{{$total_breed->id}}">
               {{$total_breed->name}}
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script src="{{asset('public/select2-develop/dist/js/select2.full.min.js')}}"></script>
    <script src="{{asset('public/select2-develop/dist/js/i18n/pt-BR.js')}}"></script>

    <script>
  $('#all_dogs').select2({
    allowClear: true,
    placeholder: 'Select an item',
    language: {
      noResults: function (term) {
        return '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add Dog</button>';
      }
    },
    escapeMarkup: function(markup) {
      return markup;
    },
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
    
  }).on('select2:open', function() {
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
    $('#all_dogs').append($('<option>', {
    value: response.response.id,

    text: response.response.dog_name
  }));
    $('#all_dogs').val(response.response.id).trigger('change'); 
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

