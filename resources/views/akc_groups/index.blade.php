@extends('layouts.master')

@section('content')
    <div class="content-w" style="width:100%">
        
        <div class="content-i">
            <div class="content-box">
                <div class="element-wrapper">
                    <div class="element-box-tp">
                        <h5 class="form-header">
                            AKC - LIST
                        </h5>
                        <div class="form-desc">
                        </div>
                        <div class="element-box-tp">
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

                                        @foreach ($akcs as $akc)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>
                                                    {{ $akc->name }}
                                                </td>
                                                <td class="text-center">
                                                    <div class="status-pill green" data-title="Complete"
                                                        data-toggle="tooltip"></div>
                                                </td>
                                                <td class="row-actions">
                                                    <a href="{{ route('akc_groups.edit', $akc->id) }}"><i
                                                            class="os-icon os-icon-ui-49"></i></a><a href="#"><i
                                                            class="os-icon os-icon-grid-10"></i></a>
                                                    <form action="{{ route('akc_groups.destroy', $akc->id) }}"
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
@endsection