@extends('layouts.master')

@section('content')
        <div class="content-w">
    
          <div class="content-i">
            <div class="content-box"><div class="row">
  
  <div class="col-lg-12">
    <div class="element-wrapper">
      <h6 class="element-header">
      Edit Judge
      </h6>
      <div class="element-box">
      <form action="{{ route('judges.update', $judge[0]->id) }}" method="post" enctype="multipart/form-data" >
        @csrf
        @method('PUT')
        <input type="hidden" id="idd" name="idd" value="{{$judge[0]->id}}"/>

          <h5 class="form-header">
          Edit Judge
          </h5>
          <div class="form-desc">
            Discharge best employed your phase each the of shine. Be met even reason consider logbook redesigns. Never a turned interfaces among asking
          </div>

          <div class="row">
                                        <div class="col-sm-6">
                                          <div class="form-group">
                                              <label class="col-form-label" for="">Full Name</label>
                                              <input class="form-control" value="{{$judge[0]->full_name}}" name="full_name" placeholder="Enter Name" type="text">
                                          </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                              <label class="col-form-label" for="">Position In Club</label>
                                              <input class="form-control" value="{{$judge[0]->position_in_club}}" name="position_in_club" placeholder="Enter Position In Club" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                          <div class="form-group">
                                              <label class="col-form-label" for="">Image</label>
                                              <img class="rounded img-thumbnail" id="preview" src="{{ URL::asset("/judge_images/{$judge[0]->image}") }}" alt="image not found" height="200" width="200" />
              <input class="form-control" type="file" id="img" name="img" accept="image/png, image/jpeg">
                                          </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                              <label class="col-form-label" for="">Signature</label>
                                              <img class="rounded img-thumbnail" src="{{ URL::asset("/judge_signatures/{$judge[0]->signature}") }}" alt="signature not found" height="200" width="200" />
                <input class="form-control" type="file" id="sig" name="sig" accept="image/png, image/jpeg">
                                            </div>
                                        </div>
                                    </div>











          
       
            <div class="form-group row">
            <label class="col-form-label col-sm-4" for=""> Enter Description Below</label>
            <div class="col-sm-8">
            <textarea class="form-control" cols="80" id="ckeditor1" name="description" rows="10">{{htmlspecialchars_decode($judge[0]->description)}}</textarea>
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

    <script>
    



    
function previewImages() {

  var preview = document.querySelector('#preview_img');
  
  if (this.files) {
    [].forEach.call(this.files, readAndPreview);
  }

  function readAndPreview(file) {

    // Make sure `file.name` matches our extensions criteria
    if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
      return alert(file.name + " is not an image");
    } // else...
    
    var reader = new FileReader();
    
    reader.addEventListener("load", function() {
      var image = new Image();
      image.height = 100;
      image.title  = file.name;
      image.src    = this.result;
      preview.appendChild(image);
    });
    
    reader.readAsDataURL(file);
    
  }

}
document.querySelector('#img').addEventListener("change", previewImages);
function previewSignature() {

  var preview = document.querySelector('#preview_sig');
  
  if (this.files) {
    [].forEach.call(this.files, readAndPreview);
  }

  function readAndPreview(file) {

    // Make sure `file.name` matches our extensions criteria
    if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
      return alert(file.name + " is not an image");
    } // else...
    
    var reader = new FileReader();
    
    reader.addEventListener("load", function() {
      var image = new Image();
      image.height = 100;
      image.title  = file.name;
      image.src    = this.result;
      preview.appendChild(image);
    });
    
    reader.readAsDataURL(file);
    
  }

}

document.querySelector('#sig').addEventListener("change", previewSignature);
    </script>
@endsection
