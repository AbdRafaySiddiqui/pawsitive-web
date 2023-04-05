@extends('layouts.master')

@section('content')
    <div class="content-w " style="width:100%">
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
    <div class="form-desc">You can put a table tag inside an <code>.element-box-tp</code> class wrapper and add <code>.table</code> class to it to get something like this:
    </div>
    <div class="element-box-tp">
      <!--------------------
      START - Controls Above Table
      -------------------->
      <div class="controls-above-table">
        <div class="row">
          <div class="col-sm-6">
            <a class="btn btn-sm btn-secondary" href="#">Download CSV</a><a class="btn btn-sm btn-secondary" href="{{route('breeds.create')}}">Add Breed</a><a class="btn btn-sm btn-danger " href="#">Delete</a>
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

    

                            <div class="table-responsive">
                                <table class="table table-bordered table-lg table-v2 table-striped">
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
<<<<<<< HEAD
                                                @if($breeds->status == 'Active')
              <td class="text-center">
                <div class="status-pill green" data-title="Complete" data-toggle="tooltip"></div>
              </td>
                            @else
                            <td class="text-center">
                <div class="status-pill red" data-title="Complete" data-toggle="tooltip"></div>
              </td>
                            @endif
=======
                                                <td class="text-center">
                                                    @if(isset($breed->species->name))
                                                    {{$breed->species->name}}
                                                    @endif
                                                </td>
>>>>>>> 607bc2251d41f382b9c44fe25b44dbf0ee928d5c
                                                <td class="row-actions">
                                                    <a href="{{ route('breeds.show', $breed->id) }}"><i
                                                            class="os-icon os-icon-ui-49"></i></a><a href="#"><i
                                                            class="os-icon os-icon-grid-10"></i></a>
                                                            <a href="{{route('breeds.edit', $breed->id)}}" class="btn btn-icon btn-secondary">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="{{route('br_del', $breed->id)}}" class="btn btn-icon btn-danger">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
               
    </div>
    </div>
    <div class="display-type"></div>
    </div>
@endsection
