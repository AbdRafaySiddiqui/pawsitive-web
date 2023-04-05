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
      Table without wrapper
    </h5>
    <div class="form-desc">You can put a table tag inside an <code>.element-box-tp</code> class wrapper and add <code>.table</code> class to it to get something like this:
    </div>
    <div class="element-box-tp">
      <!--------------------
      START - Controls Above Table
      -------------------->
      <div class="controls-above-table">
        <div class="row">
          <div class="col-sm-6">
            <a class="btn btn-sm btn-secondary" href="#">Download CSV</a><a class="btn btn-sm btn-secondary" href="{{route('club.create')}}">Add Club</a><a class="btn btn-sm btn-danger" href="#">Delete</a>
          </div>
          <div class="col-sm-6">
            <form class="form-inline justify-content-sm-end">
              <input class="form-control form-control-sm rounded bright" placeholder="Search" type="text"><select class="form-control form-control-sm rounded bright">
                <option selected="selected" value="">
                  Select Status
                </option>
                <option value="Pending">
                  Pending
                </option>
                <option value="Active">
                  Active
                </option>
                <option value="Cancelled">
                  Cancelled
                </option>
              </select>
            </form>
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
              <th class="text-center">
                <input class="form-control" type="checkbox">
              </th>
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
              <td class="text-center">
                <input class="form-control" type="checkbox">
              </td>
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
              {{$clubs->country}}
              </td>
              <td>
              {{$clubs->city}}
              </td>
              <td>
              {{$clubs->affiliation}}
              </td>
              <td class="text-center">
                <div class="status-pill green" data-title="Complete" data-toggle="tooltip"></div>
              </td>
              <td class="row-actions">
                <a href="{{route('club.edit',$clubs->id)}}"><i class="os-icon os-icon-ui-49"></i></a><a href="#"><i class="os-icon os-icon-grid-10"></i></a>
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
      ------------------            -->
    </div>
  </div>
</div>

          </div>
        </div>
      </div>
      <div class="display-type"></div>
    </div>
@endsection
