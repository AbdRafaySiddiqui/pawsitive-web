@extends('layouts.master')

@section('content')
        <!--------------------
        END - Main Menu
        -------------------->
        <div class="content-w">

          <div class="content-panel-toggler">
            <i class="os-icon os-icon-grid-squares-22"></i><span>Sidebar</span>
          </div>
          <div class="content-i" style="width:100%">
            <div class="content-box">
<div class="element-wrapper">
  <div class="element-box-tp">
    <h5 class="form-header">
     DOGS - LIST
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
            <a class="btn btn-sm btn-secondary" href="{{ route('download-dog-csv') }}">Download CSV</a><a class="btn btn-sm btn-secondary" href="{{route('dogs.create')}}">Add Dog</a>
          </div>
          <div class="col-sm-6">
              <label></label>
            <input type="text" class="form-control form-control" id="searchInput" placeholder="Search...">
          </div>
        </div>
      </div>
      <!--------------------
      END - Controls Above Table
      ------------------          --><!--------------------
      START - Table with actions
      ------------------  -->
      <div class="table-responsive">
        <table id="myTable" class="table table-bordered table-lg table-v2 table-striped">
          <thead>
            <tr>
              <th>
                S.no
              </th>
              <th>
                Dog Name
              </th>
              <th>
               DOB
              </th>
              <th>
               Gender
              </th>
              <th>
              Microchip
              </th>
              <th>
              Club Reg #
              </th>
              <th>
              Show Title
              </th>
              <th>
              Achievements
              </th>
              <th>
              Status
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
        
          @foreach ($dog as $dogs)
            <tr>
              <td>{{ $i++ }}</td>
              <td>
              {{$dogs->dog_name}}
              </td>
              <td>
              {{$dogs->dob}}
              </td>
              <td>
              {{$dogs->gender}}
              </td>
              <td>
              {{$dogs->microchip}}
              </td>
              <td>
              {{$dogs->reg_no}}
              </td>
              <td>
              {{$dogs->achievements}}
              </td>
              <td>
              {{$dogs->show_title}}
              </td>
             
              @if($dogs->status == 'Active')
              <td class="text-center">
                <div class="status-pill green" data-title="Complete" data-toggle="tooltip"></div>
              </td>
                            @else
                            <td class="text-center">
                <div class="status-pill red" data-title="Complete" data-toggle="tooltip"></div>
              </td>
                            @endif
              
              <td class="row-actions">
                <a href="{{route('dogs.edit',$dogs->id)}}"><i class="os-icon os-icon-ui-49"></i></a>
                <form action="{{ route('dogs.destroy', $dogs->id ) }}" method="post">
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
        {{$dog->links()}}
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

    
    <script>
         $(document).ready(function(){
  $("#searchInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
    </script>
    @endsection
