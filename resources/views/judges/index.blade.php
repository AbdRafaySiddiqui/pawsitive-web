@extends('layouts.master')

@section('content')
    <!--------------------
            END - Main Menu
            -------------------->

        <!--------------------
        END - Main Menu
        -------------------->
        <div class="content-w" style="width:100%">

          <div class="content-panel-toggler">
            <i class="os-icon os-icon-grid-squares-22"></i><span>Sidebar</span>
        </div>
        <div class="content-i" style="100%">
            <div class="content-box">
    <h5 class="form-header">
      Judges List
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
            <a class="btn btn-sm btn-secondary" href="{{ route('download-judge-csv') }}">Download CSV</a><a class="btn btn-sm btn-secondary" href="{{route('judges.create')}}">Add Judge</a>
          </div>
          <div class="col-sm-6">
              <label></label>
            <input type="text" class="form-control form-control" id="searchInput" placeholder="Search...">
          </div>
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
<div class="table-responsive">
        <table id="myTable" class="table table-bordered table-lg table-v2 table-striped">
          
          <thead>
            <tr>

                                            <th>
                                                S.no
                                            </th>
                                            <th>
                                                Judge's Name
                                            </th>
                                            <th>
                                                Position
                                            </th>
                                            <th>
                                                Description.
                                            </th>

                                            <th>
                                                Actions
                                            </th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        ?>

                                        @foreach ($judge as $j)
                                            <tr>
                                                <td>{{ $i++ }}</td>


                                                <td>
                                                    {{ $j->full_name }}
                                                </td>

                                                <td>{{ $j->position_in_club }}</td>

                                                <td>{{ $j->description }}</td>



                                                <td class="row-actions">
                                                    <a href="{{ route('judges.edit', $j->id) }}"><i
                                                            class="os-icon os-icon-ui-49"></i></a>
                                                    <form action="{{ route('judges.destroy', $j->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="trans_btn"
                                                            onclick="return confirm('Are you sure to delete this user?')"><i
                                                                class="os-icon os-icon-ui-15"></i></button>
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

          <div class="controls-below-table">
        <div class="table-records-info">
          Showing records 1 - 10
        </div>
        <div class="table-records-pages">
        {{$judge->links()}}
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
