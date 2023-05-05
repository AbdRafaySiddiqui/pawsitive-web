@extends('layouts.master')

@section('content')
    <div class="content-w"  style="width:100%">

        <div class="content-i">
            <div class="content-box">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="element-wrapper">
                            <h6 class="element-header">
                            Species - Create
                            </h6>
                            @if (session()->has('message'))
                                        <div class="alert alert-success">
                                            {{ session()->get('message') }}
                                        </div>
                                    @endif
                            <div class="element-box">
                                <form action="{{ route('species.store') }}" method="post">
                                    @csrf
                                    <h5 class="form-header">
                                        Create a new Specie - Create
                                    </h5>
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label" for="">Specie Name</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" name="name" placeholder="Enter Specie Name"
                                                type="text" required>
                                        </div>
                                    </div>

                                    <div class="form-buttons-w mb-4">
                                        <button class="btn btn-primary" type="submit"> Submit</button>
                                    </div>

                                </form>
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