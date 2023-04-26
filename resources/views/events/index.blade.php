@extends('layouts.master')

@section('content')
    <!--------------------
            END - Main Menu
            -------------------->
    <div class="content-w" style="width:100%">

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
                                        <a class="btn btn-sm btn-secondary"
                                            href="{{ route('download-event-csv') }}">Download CSV</a><a
                                            class="btn btn-sm btn-secondary" href="{{ route('events.create') }}">Add
                                            Event</a>
                                    </div>
                                </div>
                            </div>
                            <!--------------------
          END - Controls Above Table
          ------------------          -->
                            <!--------------------
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
                                              Club Name
                                            </th>
                                            <th>
                                                Event's Name
                                            </th>
                                            <th>
                                                Date
                                            </th>
                                            <th>
                                                Location
                                            </th>
                                            
                                            <th>
                                                Judge(s)
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

                                        @foreach ($event as $e)
                                            <tr>
                                                <td>{{ $i++ }}</td>

                                                @if (isset($e->club_name->name))
                                                    <td>
                                                        {{ $e->club_name->name }}
                                                    </td>
                                                @else
                                                    <td></td>
                                                @endif
                                                <td>
                                                    {{ $e->name }}
                                                </td>


                                                <td>{{ $created = date('F d, Y', strtotime($e->start_date)) }}</td>
                                                @if (isset($e->cities_name->city))
                                                    <td>{{ $e->cities_name->city .', '.$e->country_name->countryName }}</td>
                                                @else
                                                    <td></td>
                                                @endif

                                                @if (isset($e->judges))
                                                    <td>
                                                      @foreach($e->judges as $judge)
                                                        {{ $judge->judge->full_name }}
                                                      @endforeach
                                                    </td>
                                                @else
                                                    <td></td>
                                                @endif
                                                <td>
                                                  <div class="row-actions">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                      <a href="{{ route('events.edit', $e->id) }}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="os-icon os-icon-ui-49"></i></a>
                                                      <form action="{{ route('events.destroy', $e->id) }}" method="post">
                                                          @csrf
                                                          @method('DELETE')
                                                          <button type="submit" class="trans_btn"
                                                              onclick="return confirm('Are you sure to delete this event?')"><i
                                                                  class="os-icon os-icon-ui-15"></i></button>
                                                      </form>
                                                    </div>
                                                  </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!--------------------
          END - Table with actions
          ------------------            -->
                            <!--------------------
          START - Controls below table
          ------------------  -->
                            <div class="controls-below-table">
                                <div class="table-records-pages">
                                    {{ $event->links() }}
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
                </div>
                <!--------------------
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
