@extends('layouts.master')

@section('content')
       
          <div class="content-panel-toggler">
            <i class="os-icon os-icon-grid-squares-22"></i><span>Sidebar</span>
          </div>
          <div class="content-i">
            <div class="content-box">
<div class="element-wrapper">
  <div class="element-box-tp">
    <h5 class="form-header">
     CLUB - LIST
    </h5>
    <div class="form-desc">
    </div>
    <div class="element-box-tp">
      <!--------------------
      START - Controls Above Table
      -------------------->
      <div class="controls-above-table">
        <div class="row">
          <div class="col-sm-6">
            <a class="btn btn-sm btn-secondary" href="#">Download CSV</a><a class="btn btn-sm btn-secondary" href="{{route('club.create')}}">Add Club</a>
<<<<<<< HEAD
=======
          </div>
          <div class="col-sm-6">
            <form class="form-inline justify-content-sm-end">
              <input class="form-control form-control-sm rounded bright" placeholder="Search" type="text">
            </form>
>>>>>>> 418ac8d7778bb0c65cbcec70a123b3e4b511c6b1
          </div>
        </div>
      </div>
      <!--------------------
      END - Controls Above Table
      ------------------          --><!--------------------
      START - Table with actions
      ------------------  -->
      <div class="table-responsive">
        <table class="table table-bordered table-lg table-v2 table-striped">
          <thead>
            <tr>
<<<<<<< HEAD
=======
             
>>>>>>> 418ac8d7778bb0c65cbcec70a123b3e4b511c6b1
              <th>
                Club Name
              </th>
              <th>
                Email
              </th>
              <th>
              Phone
              </th>
              <th>
              Country
              </th>
              <th>
              City
              </th>   
              <th>
                Affiliation with
              </th>
              <th>
               Status
              </th>
              <th>
               Actions
              </th>
              
            </tr>
          </thead>
          <tbody>
          @foreach ($club as $clubs)
            <tr>
<<<<<<< HEAD
=======
             
>>>>>>> 418ac8d7778bb0c65cbcec70a123b3e4b511c6b1
              <td>
              {{$clubs->name}}
              </td>
              <td>
              {{$clubs->email}}
              </td>
              <td>
              {{$clubs->phone}}
              </td>
              <td>
              {{$clubs->country_name->countryName}}
              </td>
              <td>
              {{$clubs->cities_name->city}}
              </td>
              <td>
              {{$clubs->affiliation}}
              </td>
              <td class="text-center">
                <div class="status-pill green" data-title="Complete" data-toggle="tooltip"></div>
              </td>
              <td class="row-actions">
                <a href="{{route('club.edit',$clubs->id)}}"><i class="os-icon os-icon-ui-49"></i></a>
                <form action="{{ route('club.destroy', $clubs->id ) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                <button class="trans_btn" type="submit" onclick="return confirm('Are you sure to delete this user?')"><i class="os-icon os-icon-ui-15"></i></button>
                              </form>
                              </td>
                            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!--------------------
      END - Table with actions
      ------------------            --><!--------------------
      START - Controls below table
      ------------------  -->
      <div class="controls-below-table">
        <div class="table-records-info">
          Showing records 1 - 5
        </div>
        <div class="table-records-pages">
        {{$club->links()}}
        </div>
      </div>
      <!--------------------
      END - Controls below table
      -------------------->
    </div>
  </div>
</div>
<<<<<<< HEAD
=======

            
>>>>>>> 418ac8d7778bb0c65cbcec70a123b3e4b511c6b1
            </div>
            <!--------------------
            START - Sidebar
            -------------------->
            <div class="content-panel">
              <div class="content-panel-close">
                <i class="os-icon os-icon-close"></i>
              </div><!--------------------
START - Support Agents
-------------------->

            </div>
            <!--------------------
            END - Sidebar
            -------------------->
          </div>
        </div>
      </div>
      <div class="display-type"></div>
    </div>
@endsection
