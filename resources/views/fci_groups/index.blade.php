@extends('layouts.master')

@section('content')
    <div class="content-w" style="width:100%">
        
        <div class="content-i">
            <div class="content-box">
                <div class="element-wrapper">
                    <div class="element-box-tp">
                        <h5 class="form-header">
                        FCI - LIST
                        </h5>
                        <div class="form-desc">
                        </div>
                        <div class="element-box-tp">
                        <div class="controls-above-table">
        
        <div class="row">
          <div class="col-sm-6">
            <a class="btn btn-sm btn-secondary" href="#">Download CSV</a><a class="btn btn-sm btn-secondary" href="{{route('fci_groups.create')}}">Add FCI</a>
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
                                                Group Name
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
                                        <?php
                                        $i = 1;
                                        ?>

                                        @foreach ($fcis as $fci)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>
                                                    {{ $fci->name }}
                                                </td>
                                                <td class="text-center">
                                                    <div class="status-pill green" data-title="Complete"
                                                        data-toggle="tooltip"></div>
                                                </td>
                                                <td class="row-actions">
                                                    <a href="{{ route('fci_groups.edit', $fci->id) }}"><i
                                                            class="os-icon os-icon-ui-49"></i></a>
                                                    <form action="{{ route('fci_groups.destroy', $fci->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="trans_btn" type="submit"
                                                            onclick="return confirm('Are you sure to delete this user?')"><i
                                                                class="os-icon os-icon-ui-15"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
    
    <script  type="text/javascript">
    @if(Session::has('message'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.error("{{ session('message') }}");
  @endif 
</script>

@endsection