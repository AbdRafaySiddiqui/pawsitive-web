@extends('layouts.master')

@section('content')
        <div class="content-w" style="width:100%">
    
          <div class="content-i">
            <div class="content-box"><div class="row">
  
  <div class="col-lg-12">
    <div class="element-wrapper">
      <h6 class="element-header">
      Edit Result Event
      </h6>
      <div class="element-box">
        <form id="my-form">
        @csrf
          <h5 class="form-header">
          Edit Result Event
          </h5>
          <div class="form-desc">
          </div>
         
          
            <div class="form-group row" style="align-items: center; justify-content: flex-start;">
            <label class="col-form-label col-sm-2" for=""> Event Name</label>
            <div class="col-sm-2">
            <span>{{ $event->name }}</span>
            <input type="hidden" name="event_id" id="event_id" value="{{ $event->id }}" class="form-control">
            </div>
        </div>
        <div id="ed_event_frm">
        <div class="row">
          <div class="col-sm-4">
          <div class="form-group">
              <label class="col-form-label" for="">Date</label>
                <input class="form-control" name="date" id="event-date" type="date" value="{{ $event->start_date }}">
              </div>
              </div>

                <div class="col-sm-4">
            <div class="form-group">
              <label class="col-form-label" for="">Club Name</label>
                <input class="form-control" name="date" id="club-name" placeholder="Enter Club" type="text" value="{{ $event->club_name->name }}">
              </div>
              </div>
          
              <div class="col-sm-4">
            <div class="form-group">
            <span>
              <label class="col-form-label" for="">Judge Name:</label><br>
                <?php $string = ""; ?>
                @foreach($event->judges as $judge)
                  
                    @if(empty($string))
                    
                      <?php $string .= $judge->getjudge->full_name; ?>
                    
                    @else
                    
                    <?php $string .= ', '.$judge->getjudge->full_name; ?>
                    @endif

                  @endforeach

                {{ $string }}</span>

                
              </div>
            </div>
            </div>
            <div class="row">
              <div class="col-sm-4">
            <div class="form-group">
              <label class="col-form-label" for="">Country Name</label>
                <input class="form-control" name="date" id="country-name" placeholder="Enter country" type="text" value="{{ $event->country_name->countryName }}">
              </div>
            </div>
            <div class="col-sm-4">
            <div class="form-group">
              <label class="col-form-label" for="">Class</label>
              <select class="form-control" onchange="fetchClassDogs(this)" name="class" id="class">
          <option>Select Class</option>
          @foreach($classes as $class)
    <option value="{{ $class->class }}" >{{ $class->class }}</option>
@endforeach

                </select>
              </div>
              
          </div>
          </div>
<div id="success-msg"> ff</div>

          <div class="table-responsive">

          <table class="table table-bordered table-lg table-v2 table-striped" id="class-results-table">
  <thead>
    <tr>
      <!-- <th>ID</th> -->
      <th>Breed</th>
      <th>Award</th>
      <th>Dog</th>
      <!-- <th>Event ID</th> -->
      <th>Grading</th>
      <th>Place</th>
      <th>Judge</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
  </tbody>
</table>
<button class="btn btn-primary" id="up_sub" type="submit"> Submit</button>
<button class="btn btn-primary" id="add" type="button"> Add Result</button>

</form>



      </div>
      </div>
      </div>
      
      </div>
    </div>
  </div>
</div>

            <!--           Modal -->
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
           

                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Result</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    <div class="modal-body">
                    <form action="{{ route('event_results.update', ':id') }}" method="post" id="editForm">

                          @csrf        
                          @method('PUT')
                          <div class="form-group row">
                              <label class="col-sm-4 col-form-label" for="">Award</label>
                              <div class="col-sm-8">
                                <input id="award" class="form-control" name="award" placeholder="Enter Award" type="text">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-sm-4 col-form-label" for=""> Grading</label>
                              <div class="col-sm-8">
                                <input   class="form-control" name="grading" type="text" id="grading">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-sm-4 col-form-label" for=""> Place</label>
                            <div class="col-sm-8">
                              <input class="form-control" type="text" name="place" id="place">
                            </div>
                          </div>

                          <div class="form-group row">
                              <label class="col-sm-4 col-form-label" for=""> Judge</label>
                            <div class="col-sm-8">
                              <select class="form-control" type="text" id="judge" name="judge">
                                <option value="">Select Judge</option>
                                @foreach($event->judges as $judge)
                                  <option value="{{ $judge->getjudge->id }}" selected>{{ $judge->getjudge->full_name }}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>

                          <div id="success-msg"> </div>
                          <div class="form-buttons-w mb-4">
                            <button class="btn btn-primary" id="m_sub" type="submit"> Submit</button>
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


    <script src="{{asset('public/select2-develop/dist/js/select2.full.min.js')}}"></script>
    <script src="{{asset('public/select2-develop/dist/js/i18n/pt-BR.js')}}"></script>

    <script type="text/javascript">

let j =0;
$('#add').click(function() {
          $('#up_sub').show();
          var selectId = 'all_dogsb_' + j; // Generate a unique ID for the select element
  var judgeId = 'all_judgeb_' + j; // Generate a unique ID for the select element
  var judge_span = 'judge_span_b' + j; // Generate a unique ID for the select element
  var breed_id = 'breed_ide_' + j; // Generate a unique ID for the select element
          $('#class-results-table').append(
`<tr>
<td>  </td>
<td>  <select class="form-control select2" name="breed_id" id="${breed_id}">
          <option>Select Breed</option>
                    <!-- <option> Select</option> -->
                    @foreach($total_breeds as $total_breed)
                        <option value="{{$total_breed->id}}">
                            {{$total_breed->name}}
                        </option>
                    @endforeach
                </select></td>
  <td>  <input class="form-control" name="awards[]" placeholder="Enter awards" type="text"></td>

<td><select class="form-control select2 dg" name="dog_id[]" id="${selectId}">
           

              <option  value="">
             
              </option>
              
              
            </select></td>
            <td>  <input class="form-control" name="grading[]" placeholder="Enter Grade" type="text"></td>
            <td>  <input class="form-control" name="place[]" placeholder="Enter place" type="text"></td>

            <td>

           
<select class="form-control select2" name="judge[]" id="${judgeId}">
            @foreach($event->judges as $judge)
             <option  value="{{ $judge->getjudge->id }}">{{ $judge->getjudge->full_name }}</option>
            @endforeach  
</select>
<span class="form-control" id="${judge_span}" name="judge[]"></span>
    
       
</td>






<td> <button id="remove" class="btn btn-danger">Remove</button></td>

           </tr>`
        
);

$('#' + judgeId).select2();
$('#'+breed_id).select2();

$('#' + selectId).select2({
  allowClear: true,
    placeholder: 'Select a dog',
    // language: {
    //   noResults: function (term) {
    //     return '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add Dog</button>';
    //   }
    // },
    minimumInputLength: 1,
    ajax: {
      url: function(){
        var breed_ide=$('#'+breed_id+' :selected').val();
        var  url='{{ URL::to('api/dog/breed-dogs?breed_id=') }}';
        return url+breed_ide;
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
    var id=$('#event_id').val();
    
          console.log(id);
          $.ajax({
             type:'get',
             url:'{{  url("api/event_results/judge") }}',
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
    j++;
        });
  function fetchClassDogs() {
    $('#add').show();

    $('#success-msg').hide();
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
        // row.append($('<td>', {text: item.id}));
        row.append($('<td>', {text: item.breed_name}));
        row.append($('<td>', {text: item.award_id}));
        row.append($('<td>', {text: item.dog_name}));
        row.append($('<td>', {text: item.grading}));
        row.append($('<td>', {text: item.place}));
        row.append($('<td>', {text: item.judge_name}));
        var editButton = $('<button>', {text: 'Edit', class: 'btn btn-primary btn-sm'});
        editButton.on('click', function() {
          // Show modal to edit the record
          $('#editModal').modal('show');
          $('#editForm').attr('action', "{{ route('event_results.update', ':id') }}".replace(':id', item.id));
          // Populate modal inputs with record data
          $('#award').val(item.award_id);
          $('#grading').val(item.grading);
          $('#place').val(item.place);
          // $('#judge').val(item.judge);
        });

    
        // var addButton = $('<button>', {text: 'Add', class: 'btn btn-primary btn-sm',id:'add', type:'button'});
        
        // row.append($('<td>').append());
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

// remove row 
$(document).on('click','#remove',function(){
$(this).parents('tr').remove();

});

$('#my-form').on('submit', function(e){
console.log('submit');
e.preventDefault();

$.ajax({
  url: '{{ URL::to('api/edit-event_result')}}',
  method: 'POST',
  data: $(this).serialize(),
  success: function(response){
    // Handle successful form submission
    
    // console.log(response);
// $('#class-results-table tbody').empty();
fetchClassDogs();
    $('#success-msg').show();
    $('#success-msg').html('<p class="success">'+response.message+'</p>');
    $('#up_sub').hide();
  },
  error: function(response,xhr, status, error){
    
  }
});

});


</script>

@endsection

