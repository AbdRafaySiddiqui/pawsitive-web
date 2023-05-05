@extends('layouts.master')

@section('content')
    <div class="content-w " style="width:100%">

          <div class="content-panel-toggler">
            <i class="os-icon os-icon-grid-squares-22"></i><span>Sidebar</span>
          </div>
          <div class="content-i" style="100%">
            <div class="content-box">
<div class="element-wrapper">
  <div class="element-box-tp">
    <h5 class="form-header">
   BREEDS - LIST
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
            <a class="btn btn-sm btn-secondary" href="{{ route('download-breed-csv') }}">Download CSV</a><a class="btn btn-sm btn-secondary" href="{{route('breeds.create')}}">Add Breed</a>
          </div>
          <div class="col-sm-6">
              <label></label>
           <input type="text" class="form-control form-control" id="searchInput" placeholder="Search...">
          </div>

        </div>
      </div> 

                            <div class="table-responsive">
                                <table id="myTable" class="table table-bordered table-lg table-v2 table-striped">
                                    <thead>
                                        <tr>
                                            <th>
                                                S.no
                                            </th>
                                            <th>
                                                Breed Name
                                            </th>
                                            <th>
                                                Species
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

                                        @foreach ($breeds as $breed)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>
                                                    {{ $breed->name }}
                                                </td>
                                                @if($breed->status == 'Active')
              <td class="text-center">
                <div class="status-pill green" data-title="Complete" data-toggle="tooltip"></div>
              </td>
                            @else
                            <td class="text-center">
                <div class="status-pill red" data-title="Complete" data-toggle="tooltip"></div>
              </td>
                            @endif
                                                <td class="row-actions">
                                                    <a href="{{route('breeds.edit', $breed->id)}}"><i
                                                            class="os-icon os-icon-ui-49"></i></a>
                                                            <a href="{{ route('breeds.show', $breed->id) }}">
                                                        <i class="os-icon os-icon-grid-10"></i>
                                                    </a>
                                                    <form action="{{ route('breeds.destroy', $breed->id ) }}" method="post">
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


                            <div class="controls-below-table">
        <div class="table-records-info">
          Showing records 1 - 10
        </div>
        <div class="table-records-pages">
        {{$breeds->links()}}
        </div>
      </div>                     
               
    </div>
    </div>
    <div class="display-type"></div>
    </div>

    <script>
        
       $(document).ready(function() {
    $("#searchInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    // Fix for pagination links
    $(document).on('click', '.pagination a', function(event){
        event.preventDefault(); 
        var url = $(this).attr('href');
        $.ajax({
            url: url,
            success: function(data) {
                $('#myTable').html(data);
            }
        });
    });
});



        
    </script>
@endsection
