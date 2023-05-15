@extends('layouts.master')

@section('content')
        <div class="content-w">
          <!--------------------
          START - Top Bar
          -------------------->
          <div class="top-bar color-scheme-transparent">
            <!--------------------
            START - Top Menu Controls
            -------------------->
            <div class="top-menu-controls">
              <div class="element-search autosuggest-search-activator">
                <input placeholder="Start typing to search..." type="text">
              </div>
              <!--------------------
              START - Messages Link in secondary top menu
              -------------------->
              <div class="messages-notifications os-dropdown-trigger os-dropdown-position-left">
                <i class="os-icon os-icon-mail-14"></i>
                <div class="new-messages-count">
                  12
                </div>
                <div class="os-dropdown light message-list">
                  <ul>
                    <li>
                      <a href="#">
                        <div class="user-avatar-w">
                          <img alt="" src="img/avatar1.jpg">
                        </div>
                        <div class="message-content">
                          <h6 class="message-from">
                            John Mayers
                          </h6>
                          <h6 class="message-title">
                            Account Update
                          </h6>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <div class="user-avatar-w">
                          <img alt="" src="img/avatar2.jpg">
                        </div>
                        <div class="message-content">
                          <h6 class="message-from">
                            Phil Jones
                          </h6>
                          <h6 class="message-title">
                            Secutiry Updates
                          </h6>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <div class="user-avatar-w">
                          <img alt="" src="img/avatar3.jpg">
                        </div>
                        <div class="message-content">
                          <h6 class="message-from">
                            Bekky Simpson
                          </h6>
                          <h6 class="message-title">
                            Vacation Rentals
                          </h6>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <div class="user-avatar-w">
                          <img alt="" src="img/avatar4.jpg">
                        </div>
                        <div class="message-content">
                          <h6 class="message-from">
                            Alice Priskon
                          </h6>
                          <h6 class="message-title">
                            Payment Confirmation
                          </h6>
                        </div>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              <!--------------------
              END - Messages Link in secondary top menu
              --------------------><!--------------------
              START - Settings Link in secondary top menu
              -------------------->
              <div class="top-icon top-settings os-dropdown-trigger os-dropdown-position-left">
                <i class="os-icon os-icon-ui-46"></i>
                <div class="os-dropdown">
                  <div class="icon-w">
                    <i class="os-icon os-icon-ui-46"></i>
                  </div>
                  <ul>
                    <li>
                      <a href="users_profile_small.html"><i class="os-icon os-icon-ui-49"></i><span>Profile Settings</span></a>
                    </li>
                    <li>
                      <a href="users_profile_small.html"><i class="os-icon os-icon-grid-10"></i><span>Billing Info</span></a>
                    </li>
                    <li>
                      <a href="users_profile_small.html"><i class="os-icon os-icon-ui-44"></i><span>My Invoices</span></a>
                    </li>
                    <li>
                      <a href="users_profile_small.html"><i class="os-icon os-icon-ui-15"></i><span>Cancel Account</span></a>
                    </li>
                  </ul>
                </div>
              </div>
              <!--------------------
              END - Settings Link in secondary top menu
              --------------------><!--------------------
              START - User avatar and menu in secondary top menu
              -------------------->
              <div class="logged-user-w">
                <div class="logged-user-i">
                  <div class="avatar-w">
                    <img alt="" src="img/avatar1.jpg">
                  </div>
                  <div class="logged-user-menu color-style-bright">
                    <div class="logged-user-avatar-info">
                      <div class="avatar-w">
                        <img alt="" src="img/avatar1.jpg">
                      </div>
                      <div class="logged-user-info-w">
                        <div class="logged-user-name">
                          Maria Gomez
                        </div>
                        <div class="logged-user-role">
                          Administrator
                        </div>
                      </div>
                    </div>
                    <div class="bg-icon">
                      <i class="os-icon os-icon-wallet-loaded"></i>
                    </div>
                    <ul>
                      <li>
                        <a href="apps_email.html"><i class="os-icon os-icon-mail-01"></i><span>Incoming Mail</span></a>
                      </li>
                      <li>
                        <a href="users_profile_big.html"><i class="os-icon os-icon-user-male-circle2"></i><span>Profile Details</span></a>
                      </li>
                      <li>
                        <a href="users_profile_small.html"><i class="os-icon os-icon-coins-4"></i><span>Billing Details</span></a>
                      </li>
                      <li>
                        <a href="#"><i class="os-icon os-icon-others-43"></i><span>Notifications</span></a>
                      </li>
                      <li>
                        <a href="#"><i class="os-icon os-icon-signs-11"></i><span>Logout</span></a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <!--------------------
              END - User avatar and menu in secondary top menu
              -------------------->
            </div>
            <!--------------------
            END - Top Menu Controls
            -------------------->
          </div>
          <!--------------------
          END - Top Bar
          --------------------><!--------------------
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
      Add Dog
      </h6>
      <div class="element-box">
        <form action="{{ route('dogs.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <h5 class="form-header">
            Add Dog
          </h5>
          <div class="form-desc">
            Discharge best employed your phase each the of shine. Be met even reason consider logbook redesigns. Never a turned interfaces among asking
          </div>
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
              <select class="form-control js-data-example-ajax" name="reg_with" id="reg_with">
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
              <select class="form-control js-data-example-ajax" name="dog_owner" id="dog_owner">
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
              <select class="form-control js-data-example-ajax" name="is_champion">         
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
                
                <input class="form-control" name="profile_photo" placeholder="Enter Profile Photo" type="file">
              </div>
            </div>
          
         
          <div class="form-buttons-w mb-4">
            <button class="btn btn-primary" type="submit"> Submit</button>
          </div>
      


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
      <form id="my-form-male">
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
              <select class="form-control js-data-example-ajax" name="breed_id" id="breed_idm">
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
              <select class="form-control js-data-example-ajax" name="sire_id" id="selUserm">
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
              <select class="form-control js-data-example-ajax" name="dam_id" id="selUserm_fe">
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
              <select class="form-control select2" name="reg_with" id="reg_withm">
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
              <select class="form-control select2" name="dog_owner" id="dog_ownerm">
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
                            <button class="btn btn-primary" id="m_sub_male" type="submit"> Submit</button>
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

<div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Dam</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <div class="modal-body">
    <form id="my-form-female">
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
              <select class="form-control js-data-example-ajax" name="breed_id" id="breed_idf">
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
              <select class="form-control js-data-example-ajax" name="sire_id" id="selUserf">
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
              <select class="form-control js-data-example-ajax" name="dam_id" id="selUserf_fe">
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
              <select class="form-control select2" name="reg_with" id="reg_withf">
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
              <select class="form-control select2" name="dog_owner" id="dog_ownerf">
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
                            <button class="btn btn-primary" id="m_sub_female" type="submit"> Submit</button>
                            <button class="btn btn-secondary" type="reset"> Reset</button>
                            <a action="back" href="javascript: window.history.back();" class="btn btn-danger">
                              <i class="fa fa-times"> </i><span> &nbsp; Cancel</span>
                            </a>
                          </div>

                      </form>
  </div>
</div>
</div>





    <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
    
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
        //   console.log(data.dog.data);
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
  
  placeholder: 'Select a dog',
    // allowClear: true,
    // width: '100%',

    language: {
      noResults: function (term) {
        return '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal2">Add Dog</button>';
      }
    },
 
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
        //   console.log(data.dog.data);
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


$('#reg_with').select2();
$('#breed_id').select2();
$('#dog_owner').select2();



// modal male form submit 
$('#my-form-male').on('submit', function(e){

e.preventDefault();

var form = $('#my-form-male')[0];

var data = new FormData(form);

$.ajax({
  url: '{{ URL::to('/submit-Dogform')}}',
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
    // $('#success-msg').show();
    // $('#success-msg').html('<p class="success">'+response.message+'</p>');
    toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
    toastr.success(response.message);
  },
  error: function(response,xhr, status, error){
    
    // Handle errors
    var responJson=JSON.parse(response.responseText);
    var responseJson=responJson.errors;
  //  console.log(responJson.message);
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
// modal male form submit 
$('#my-form-female').on('submit', function(e){

e.preventDefault();

var form = $('#my-form-female')[0];

var data = new FormData(form);

$.ajax({
  url: '{{ URL::to('/submit-Dogform-Female')}}',
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
    // $('#success-msg').show();
    // $('#success-msg').html('<p class="success">'+response.message+'</p>');
    toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
    toastr.success(response.message);
  },
  error: function(response,xhr, status, error){
    
    // Handle errors
    var responJson=JSON.parse(response.responseText);
    var responseJson=responJson.errors;
  //  console.log(responJson.message);
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


$('#m_sub_male').on('click', function() {
            // $('#my-form')[0].reset(); 
            $('#msg').text(''); // clear the error message
        });
$('#m_sub_female').on('click', function() {
            // $('#my-form')[0].reset(); 
            $('#msg').text(''); // clear the error message
        });
        
        // clear modal
        $('.close').on('click', function() {
            // console.log('hide');
            $('#my-form-male')[0].reset(); // reset the form
            $('#my-form-female')[0].reset(); // reset the form
            $('#msg').text(''); // clear the error message
        });
        

        $('#selUserm').select2({
  
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
        var breed_id=$('#breed_idm :selected').val();
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
          // console.log(data.dog.data);
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
$('#selUserm_fe').select2({
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
        var breed_id=$('#breed_idm :selected').val();
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
          // console.log(data.dog.data);
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
// for male 
$('#breed_idm').select2({
  dropdownParent: $("#exampleModal .modal-content")
  
});
$('#dog_ownerm').select2({
  dropdownParent: $("#exampleModal .modal-content")
  
});

$('#reg_withm').select2({
  dropdownParent: $("#exampleModal .modal-content")
  
});
$('#selUserm_fe').select2({
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
        var breed_id=$('#breed_idm :selected').val();
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
          $('#selUserm_fe').empty();
        }
  
    },
    templateSelection: function(dog) {
        return dog.dog_name || dog.text;
       
    }
  
});
$('#selUserm').select2({
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
        var breed_id=$('#breed_idm :selected').val();
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
          $('#selUserm').empty();
        }
  
    },
    templateSelection: function(dog) {
        return dog.dog_name || dog.text;
       
    }
  
});

// for female 
$('#breed_idf').select2({
  dropdownParent: $("#Modal2 .modal-content")
  
});
$('#dog_ownerf').select2({
  dropdownParent: $("#Modal2 .modal-content")
  
});

$('#reg_withf').select2({
  dropdownParent: $("#Modal2 .modal-content")
  
});
$('#selUserf').select2({
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
        var breed_id=$('#breed_idf :selected').val();
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
$('#selUserf_fe').select2({
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
        var breed_id=$('#breed_idf :selected').val();
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
          $('#selUserf_fe').empty();
        }
  
    },
    templateSelection: function(dog) {
        return dog.dog_name || dog.text;
       
    }
  
});

</script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.js"></script>

@endsection