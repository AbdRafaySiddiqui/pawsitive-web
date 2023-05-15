@extends('layouts.master')

@section('content')
<div class="content-w" style="width:100%">
          <div class="content-panel-toggler">
            <i class="os-icon os-icon-grid-squares-22"></i><span>Sidebar</span>
          </div>
          <div class="content-i">
            <div class="content-box">
<div class="element-wrapper">
  <div class="element-box-tp">
    <h5 class="form-header">
     CITIES - LIST
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
            <!-- <a class="btn btn-sm btn-secondary" href="{{ route('download-club-csv') }}">Download CSV</a> -->
            
            <a class="btn btn-sm btn-secondary" href="{{route('cities.create')}}">Add City</a>
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
                City
              </th>
              <th>
              Country
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
          @foreach ($cities as $city)
            <tr>
              <td>
              {{$city->city}}
              </td>
              <td>
              <?php
        $countryName = DB::table('countries')
                          ->where('idCountry', $city->country)
                          ->value('countryName');
        echo $countryName;
    ?>
              </td>
              <td class="text-center">
                <div class="status-pill green" data-title="Complete" data-toggle="tooltip"></div>
              </td>
              <td class="row-actions">
                <a href="{{route('cities.edit',$city->id)}}"><i class="os-icon os-icon-ui-49"></i></a>
                <form action="{{ route('cities.destroy', $city->id ) }}" method="post">
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

      <div class="controls-below-table">
        <div class="table-records-info">
          Showing records 1 - 5
        </div>
        <div class="table-records-pages">
        {{$cities->links()}}
        </div>
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

          </div>
        </div>
      </div>
      <div class="display-type"></div>
    </div>
@endsection
