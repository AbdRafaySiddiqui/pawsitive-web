@extends('layouts.master')
<style type="text/css">
.form-check label input { margin-right:20px; }
.no-drop {cursor: no-drop;}

</style>
@section('content')

  <div class="content-i">
  <div class="content-box">

  <div class="row">
  <div class="col-lg-12">
    <div class="element-wrapper">
      <h6 class="element-header">
        <a action="back" href="javascript: window.history.back();" class="btn btn-sm btn-secondary">
          <i class="fa fa-backward"> </i><span> &nbsp; Back</span>
        </a>
        &ensp; {{$judge[0]->full_name}}
      </h6>
      <div class="element-box">
        <input type="hidden" id="idd" name="idd" value="{{$judge[0]->id}}"/>

<div class="row">
            <div class="col-sm-3">
              <div class="form-group">
              <label for=""><strong>Image</strong></label>
              <br>
              @if($judge[0]->image == "")
                <img class="rounded img-thumbnail" src="{{ URL::asset('public/judge_images/image.svg') }}" alt="image not found" height="200" width="200" />
              @else
                <img class="rounded img-thumbnail" src="{{ URL::asset("public/judge_images/{$judge[0]->image}") }}" alt="image not found" height="200" width="200" />
              @endif
              </div>
              <div class="form-group">
              <label for=""><strong>Signature</strong></label>
              <br>
              @if($judge[0]->signature == "")
              <img class="rounded img-thumbnail" src="{{ URL::asset('public/judge_images/image.svg') }}" alt="signature not found" height="200" width="200" />
              @else
              <img class="rounded img-thumbnail" src="{{ URL::asset("public/judge_signatures/{$judge[0]->signature}") }}" alt="signature not found" height="200" width="200" />
              @endif
              </div>
            </div>
            <div class="col-sm-9">
              <div class="form-group">
                <h1 style="text-align: center;text-decoration: underline;">{{$judge[0]->full_name}}</h1>
              <br>
              <div class="text-center">
                <?php echo htmlspecialchars_decode($judge[0]->description); ?>
              </div>
          </div>
            </div>
          </div>

          
          
            
        </form>
          
      </div>
    </div>
  </div>

</div>
<script>



function Reload(this1) {
  // document.querySelector('#sire').value = 'Loading...'
  // document.getElementById("sire").value = 'Loading...';
  this1.innerHTML='<i class="fa fa-refresh fa-spin"></i>';
  // document.getElementById("sire").value = '';  

}

function Friendly_URLFunction() {
  var str = document.getElementById("dog_name").value;
  str = str.replace(/\s+/g, '-').toLowerCase();
  document.getElementById("friendly_URL").value = str;
  // console.log(str); // "sonic-free-games"
}
</script>
@endsection