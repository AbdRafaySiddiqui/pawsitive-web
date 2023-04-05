@extends('layouts.master')

@section('content')
    <!--------------------
            END - Main Menu
            -------------------->
    <div class="content-w">
        <!--------------------
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
                        <div class="form-desc">You can put a table tag inside an <code>.element-box-tp</code> class wrapper
                            and add <code>.table</code> class to it to get something like this:
                        </div>
                        <div class="element-box-tp">
                            <!--------------------
          START - Controls Above Table
          -------------------->
                            <div class="controls-above-table">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <a class="btn btn-sm btn-secondary" href="#">Download CSV</a><a
                                            class="btn btn-sm btn-secondary" href="{{ route('judges.create') }}">Add
                                            Judge</a><a class="btn btn-sm btn-danger " href="#">Delete</a>
                                    </div>
                                    <div class="col-sm-6">
                                        <form class="form-inline justify-content-sm-end">
                                            <input class="form-control form-control-sm rounded bright" placeholder="Search"
                                                type="text"><select class="form-control form-control-sm rounded bright">
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
                                                Judge's Name
                                            </th>
                                            <th>
                                                Status
                                            </th>
                                            <th>
                                                Created
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
                                                @if ($j->status == 1)
                                                    <td class="text-center">
                                                        <div class="status-pill green" data-title="Complete"
                                                            data-toggle="tooltip"></div>
                                                    </td>
                                                @else
                                                    <td class="text-center">
                                                        <div class="status-pill red" data-title="Complete"
                                                            data-toggle="tooltip"></div>
                                                    </td>
                                                @endif

                                                <td>{{ $created = date('d-m-Y h:i:s', strtotime($j->created_at)) }}</td>



                                                <td class="row-actions">
                                                    <a href="{{ route('judges.edit', $j->id) }}"><i
                                                            class="os-icon os-icon-ui-49"></i></a><a href="#"><i
                                                            class="os-icon os-icon-grid-10"></i></a>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="display-type"></div>
    </div>
@endsection
