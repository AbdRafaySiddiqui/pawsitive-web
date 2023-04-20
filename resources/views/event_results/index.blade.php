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
            <a class="btn btn-sm btn-secondary" href="#">Download CSV</a><a class="btn btn-sm btn-secondary" href="{{route('events_results.create')}}">Add Event</a>
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
       
              <th>
              S.no
              </th>
              <th>
              Event's Name
              </th>
              <th>
              Date
              </th>
              <th>
              Country
              </th>
            
              <th>
              City
              </th>
              <th>
              Club Name
              </th>
              <th>
              Judge Name
              </th>
              <th>
              Action
              </th>
             
              
            </tr>
          </thead>
          <tbody>
          <?php
                         $i = 1;
                        ?>
                      
          @foreach ($event as  $e)
            <tr>
            <td>{{ $i++ }}</td>
            
              
              <td>
              {{$e->name}}
              </td>
             
              
              <td>{{ $created=date('d-m-Y h:i:s', strtotime($e->date)) }}</td>
              @if(isset($e->cities_name->city))
                <td>{{$e->cities_name->city}}</td>
                @else
                <td></td>
              @endif

              @if(isset($e->cities_name->city))
              <td>
              {{$e->country_name->countryName}}
              </td>
              @else
                <td></td>
              @endif

              @if(isset($e->club_name->name))
              <td>
              {{$e->club_name->name}}
              </td>
              @else
                <td></td>
              @endif

              @if(isset($e->judge_name->full_name))
              <td>
              {{$e->judge_name->full_name}}
              </td>
              @else
                <td></td>
              @endif
              <td class="row-actions">
                <a href="{{route('events.edit',$e->id)}}"><i class="os-icon os-icon-ui-49"></i></a>
                <form action="{{ route('events.destroy', $e->id ) }}" method="post">
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
      <div class="controls-below-table">
        <div class="table-records-pages">
        {{$event->links()}}
        </div>
      </div>
   
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
