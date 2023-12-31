@extends('layouts.master')

@section('content')
        <div class="content-w">
 
          <div class="content-i">
            <div class="content-box"><div class="row">
  
  <div class="col-lg-12">
    <div class="element-wrapper">
      <h6 class="element-header">
      Event Result
      </h6>
      <div class="element-box">
        <form action="{{ route('events.update', $events->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
                    
          <h5 class="form-header">
            Event Result
          </h5>
          <div class="form-desc">
            Discharge best employed your phase each the of shine. Be met even reason consider logbook redesigns. Never a turned interfaces among asking
          </div>
          <div class="form-group row">
              <label class="col-sm-4 col-form-label" for="">Event Name</label>
              <div class="col-sm-8">
                <input class="form-control" name="event_name" value="{{$events->name}}" placeholder="Enter Event Name" type="text">
              </div>
            </div>
       
          <div class="form-group row">
          <label class="col-form-label col-sm-4" for=""> Select Club</label>
          <div class="col-sm-8">
          <select class="form-control" name="club_id">
          @foreach($total_clubs as $clubs)
                <option value="{{$clubs->id}}">
               {{$clubs->name}}
                </option>
                @endforeach
              </select>
            </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-4 col-form-label" for=""> Country</label>
              <div class="col-sm-8">
              <select class="form-control" name="country">
              @foreach($total_countries as $countries)
                <option  value="{{$countries->idCountry}}" {{ $countries->idCountry == $events->country ? 'selected' : '' }}>
               {{$countries->countryName}}
                </option>
                @endforeach
              </select>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-4 col-form-label" for=""> City</label>
              <div class="col-sm-8">
              <select class="form-control" name="city">
              @foreach($total_cities as $cities)
                <option  value="{{$cities->id}}" {{ $cities->id == $events->city ? 'selected' : '' }}>
                  
               {{$cities->city}}
                </option>
                @endforeach
              </select>
              </div>
            </div>
          
           
            <div class="form-group row">
              <label class="col-sm-4 col-form-label" for="">Date</label>
              <div class="col-sm-8">
                <input class="form-control" name="date" placeholder="Enter DOB" type="date" value="{{ $created=date('Y-m-d', strtotime($events->date)) }}">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-4 col-form-label" for="" >Select Judge</label>
              <div class="col-sm-8">
              <select class="form-control js-data-example-ajax" name="judge_id" id="selUser"  >
              @foreach($judges as $judge)
                <option  value="{{$judge->id}}" {{ $judge->id  == $events->judge_id  ? 'selected' : '' }}>


               {{$judge->full_name}}
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
      


        </form>
      </div>
    </div>
  </div>
</div>
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
      <form id="my-form">
        @csrf
         
          <div class="form-group row">
              <label class="col-sm-4 col-form-label" for="">Full Name</label>
              <div class="col-sm-8">
                <input id="full_name" class="form-control" name="full_name" placeholder="Enter Full Name" type="text">
              </div>
            </div>
          <div class="form-group row">
              <label class="col-sm-4 col-form-label" for=""> Position In Club</label>
              <div class="col-sm-8">
                <input   class="form-control" name="position_in_club" id="position_in_club" placeholder="Enter Position In Club" type="text">
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
            <textarea class="form-control" cols="80" id="ckeditor1" name="description" rows="10"></textarea>
            </div>
          </div>
           
         
          <div class="form-buttons-w mb-4">
            <button class="btn btn-primary" id="m_sub" type="submit"> Submit</button>
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
    
    <script src="{{asset('public/select2-develop/dist/js/select2.full.min.js')}}"></script>
    <script src="{{asset('public/select2-develop/dist/js/i18n/pt-BR.js')}}"></script>
<script>
  
@if(Session::has('message'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.success("{{ session('message') }}");
  @endif
  
  $('#selUser').select2({
    // allowClear: true,
    // placeholder: 'Select an item',
    text:'hello',
    val:3,
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
        //  console.log(responJson.message);
          $('#msg').append($('<p>',{
            text: responseJson.description
          }));
          $('#msg').append($('<p>',{
            text: responseJson.position_in_club
          }));
          $('#msg').append($('<p>',{
            text: responseJson.full_name
          }));

       //   console.log(response);
         
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
   
@endsection
