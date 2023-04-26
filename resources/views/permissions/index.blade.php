@extends('layouts.master')

@section('content')
        <!--------------------
        END - Main Menu
        -------------------->
        <div class="content-w">

          <div class="content-panel-toggler">
            <i class="os-icon os-icon-grid-squares-22"></i><span>Sidebar</span>
          </div>
          <div class="content-i">
            <div class="content-box">
<div class="element-wrapper">
  <div class="element-box-tp">
    <h5 class="form-header">
   Events List
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
            <a class="btn btn-sm btn-secondary" href="{{ route('download-event-csv') }}">Download CSV</a><a class="btn btn-sm btn-secondary" href="{{route('events.create')}}">Add Event</a>
          </div>
        </div>
      </div>
      <!--------------------
      END - Controls Above Table
      ------------------          --><!--------------------
      START - Table with actions
      ------------------  -->
      <div class="table-responsive">
                                    <table class="table table-bordered table-lg table-v2 table-striped" id="">
                                        <thead>
                                            <tr>
                                                <th >#</th>
                                                <th >Module Title</th>
                                                <th >Permission Name</th>
                                                <th >Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            @foreach($all as $ALL)
                                            <tr>
                                                <th >{{$i++}}</th>
                                                <td >{{$ALL->title}}</td>
                                                <td >{{$ALL->name}}</td>
                                                <td >
                                                    <a href="{{route('permissions.edit', $ALL->id)}}">
                                                    <i class="os-icon os-icon-ui-49"></i>
                                                    </a>
                                                    <form action="{{ route('permissions.destroy', $ALL->id ) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                                    <button type="submit" class="trans_btn" onclick="return confirm('Are you sure to delete this user?')"><i class="os-icon os-icon-ui-15"></i></button>
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

   
      <!--------------------
      END - Controls below table
      -------------------->
    </div>
  </div>
</div>
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
