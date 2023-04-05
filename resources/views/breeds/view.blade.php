@extends('layouts.master')
@section('content')
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Breeds</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Breeds</a></div>
                    <div class="breadcrumb-item">View</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">{{ $breed->name }}</h2>
                <p class="section-lead">View information about breed on this page.</p>

                <div class="row mt-sm-4">
                    <div class="col-12 col-md-12 col-lg-6">
                        <div class="card profile-widget">
                            <div class="profile-widget-header">
                                
                                <div class="profile-widget-items">
                                    <div class="profile-widget-item">
                                        <div class="profile-widget-item-label">Species</div>
                                        <div class="profile-widget-item-value">{{ $breed->species->name ?? "No Species Specified" }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-widget-description" style="text-align: -webkit-center">
                                <div class="form-group col-md-12 col-12">
                                    <label>Life Span :</label> {{ $breed->life_span.' years' }}
                                </div>
                                <div class="form-group col-md-12 col-12">
                                    <label>Country of Origin :</label> {{ $breed->countryorigin->countryName ?? '' }}
                                </div>
                                <div class="form-group col-md-12 col-12">
                                    <label>Height (in Male) :</label> {{ $breed->height_male.' CM' }}
                                </div>
                                <div class="form-group col-md-12 col-12">
                                    <label>Height (in Female) :</label> {{ $breed->height_female.' CM' }}
                                </div>
                                <div class="form-group col-md-12 col-12">
                                    <label>Weight (in Male) :</label> {{ $breed->weight_male.' KG' }}
                                </div>
                                <div class="form-group col-md-12 col-12">
                                    <label>Weight (in Female) : </label>{{ $breed->weight_female.' KG' }}
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4>Breed Details</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div id="accordion">
                                        
                                        <div class="accordion">
                                            <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-1" aria-expanded="true">
                                                <h4>About the Breed</h4>
                                            </div>
                                            <div class="accordion-body collapse show" id="panel-body-1" data-parent="#accordion">
                                                <p class="mb-0">{{ ($breed->about != "") ? $breed->about : "No Data" }}</p>
                                            </div>
                                        </div>

                                        <div class="accordion">
                                            <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-2">
                                                <h4>History</h4>
                                            </div>
                                            <div class="accordion-body collapse" id="panel-body-2" data-parent="#accordion">
                                                <p class="mb-0 ">
                                                        {{ ($breed->history != "") ? strip_tags(htmlspecialchars_decode($breed->history)) : "No Data" }}
                                                </p>
                                            </div>
                                        </div>
                                        
                                        <div class="accordion">
                                            <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-3">
                                                <h4>Personality</h4>
                                            </div>
                                            <div class="accordion-body collapse" id="panel-body-3" data-parent="#accordion">
                                                <p class="mb-0">{{ ($breed->personality != "") ? $breed->personality : "No Data" }}</p>
                                            </div>
                                        </div>
                                        
                                        <div class="accordion">
                                            <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-4">
                                                <h4>Health</h4>
                                            </div>
                                            <div class="accordion-body collapse" id="panel-body-4" data-parent="#accordion">
                                                <p class="mb-0">{{ ($breed->health != "") ? $breed->health : "No Data" }}</p>
                                            </div>
                                        </div>
                                        
                                        <div class="accordion">
                                            <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-5">
                                                <h4>Care</h4>
                                            </div>
                                            <div class="accordion-body collapse" id="panel-body-5" data-parent="#accordion">
                                                <p class="mb-0">{{ ($breed->care != "") ? $breed->care : "No Data" }}</p>
                                            </div>
                                        </div>

                                        <div class="accordion">
                                            <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-7">
                                                <h4>Feeding</h4>
                                            </div>
                                            <div class="accordion-body collapse" id="panel-body-7" data-parent="#accordion">
                                                <p class="mb-0">{{ ($breed->feeding != "") ? $breed->feeding : "No Data" }}</p>
                                            </div>
                                        </div>

                                        <div class="accordion">
                                            <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-8">
                                                <h4>Grooming</h4>
                                            </div>
                                            <div class="accordion-body collapse" id="panel-body-8" data-parent="#accordion">
                                                <p class="mb-0">{{ ($breed->grooming != "") ? $breed->grooming : "No Data" }}</p>
                                            </div>
                                        </div>

                                        <div class="accordion">
                                            <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-9">
                                                <h4>Children & Pets</h4>
                                            </div>
                                            <div class="accordion-body collapse" id="panel-body-9" data-parent="#accordion">
                                                <p class="mb-0">{{ ($breed->child_pets != "") ? $breed->child_pets : "No Data" }}</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Breed Ratings</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div id="accordion">
                                        <div class="accordion">
                                            <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-adapt" aria-expanded="true">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h4>Adaptability</h4>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <?php
                                                            for($i = 0; $i < floor($breed->adapt); $i++)
                                                            {
                                                                echo '<i class="fa-solid fa-star"></i>';
                                                            }
                                                            $plus = floor( $breed->adapt ).'.0';
                                                            if ($plus != $breed->adapt)
                                                            {
                                                                echo '<i class="fa-solid fa-star-half"></i>';
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-body collapse show" id="panel-body-adapt" data-parent="#accordion">
                                                @foreach($ratings as $rate)
                                                    @if($rate->group_name == 'adapt')
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                {{$rate->name}}
                                                            </div>
                                                            <div class="col-md-6">
                                                                <?php
                                                                    for($i = 0; $i < floor($rate->value); $i++)
                                                                    {
                                                                        echo '<i class="fa-solid fa-star"></i>';
                                                                    }
                                                                    $plus = floor( $rate->value ).'.0';
                                                                    if ($plus != $rate->value)
                                                                    {
                                                                        echo '<i class="fa-solid fa-star-half"></i>';
                                                                    }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="accordion">
                                            <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-overfriend" aria-expanded="true">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h4>Overall Friendliness</h4>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <?php
                                                            for($i = 0; $i < floor($breed->friendly); $i++)
                                                            {
                                                                echo '<i class="fa-solid fa-star"></i>';
                                                            }
                                                            $plus = floor( $breed->friendly ).'.0';
                                                            if ($plus != $breed->friendly)
                                                            {
                                                                echo '<i class="fa-solid fa-star-half"></i>';
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-body collapse show" id="panel-body-overfriend" data-parent="#accordion">
                                                @foreach($ratings as $rate)
                                                    @if($rate->group_name == 'friendly')
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                {{$rate->name}}
                                                            </div>
                                                            <div class="col-md-6">
                                                                <?php
                                                                    for($i = 0; $i < floor($rate->value); $i++)
                                                                    {
                                                                        echo '<i class="fa-solid fa-star"></i>';
                                                                    }
                                                                    $plus = floor( $rate->value ).'.0';
                                                                    if ($plus != $rate->value)
                                                                    {
                                                                        echo '<i class="fa-solid fa-star-half"></i>';
                                                                    }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="accordion">
                                            <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-hg" aria-expanded="true">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h4>Health and Grooming Needs</h4>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <?php
                                                            for($i = 0; $i < floor($breed->health_groom); $i++)
                                                            {
                                                                echo '<i class="fa-solid fa-star"></i>';
                                                            }
                                                            $plus = floor( $breed->health_groom ).'.0';
                                                            if ($plus != $breed->health_groom)
                                                            {
                                                                echo '<i class="fa-solid fa-star-half"></i>';
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-body collapse show" id="panel-body-hg" data-parent="#accordion">
                                                @foreach($ratings as $rate)
                                                    @if($rate->group_name == 'health_groom')
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                {{$rate->name}}
                                                            </div>
                                                            <div class="col-md-6">
                                                                <?php
                                                                    for($i = 0; $i < floor($rate->value); $i++)
                                                                    {
                                                                        echo '<i class="fa-solid fa-star"></i>';
                                                                    }
                                                                    $plus = floor( $rate->value ).'.0';
                                                                    if ($plus != $rate->value)
                                                                    {
                                                                        echo '<i class="fa-solid fa-star-half"></i>';
                                                                    }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="accordion">
                                            <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-train" aria-expanded="true">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h4>Trainability</h4>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <?php
                                                            for($i = 0; $i < floor($breed->train); $i++)
                                                            {
                                                                echo '<i class="fa-solid fa-star"></i>';
                                                            }
                                                            $plus = floor( $breed->train ).'.0';
                                                            if ($plus != $breed->train)
                                                            {
                                                                echo '<i class="fa-solid fa-star-half"></i>';
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-body collapse show" id="panel-body-train" data-parent="#accordion">
                                                @foreach($ratings as $rate)
                                                    @if($rate->group_name == 'train')
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                {{$rate->name}}
                                                            </div>
                                                            <div class="col-md-6">
                                                                <?php
                                                                    for($i = 0; $i < floor($rate->value); $i++)
                                                                    {
                                                                        echo '<i class="fa-solid fa-star"></i>';
                                                                    }
                                                                    $plus = floor( $rate->value ).'.0';
                                                                    if ($plus != $rate->value)
                                                                    {
                                                                        echo '<i class="fa-solid fa-star-half"></i>';
                                                                    }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="accordion">
                                            <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-physical" aria-expanded="true">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h4>Physical Needs</h4>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <?php
                                                            for($i = 0; $i < floor($breed->physical); $i++)
                                                            {
                                                                echo '<i class="fa-solid fa-star"></i>';
                                                            }
                                                            $plus = floor( $breed->physical ).'.0';
                                                            if ($plus != $breed->physical)
                                                            {
                                                                echo '<i class="fa-solid fa-star-half"></i>';
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-body collapse show" id="panel-body-physical" data-parent="#accordion">
                                                @foreach($ratings as $rate)
                                                    @if($rate->group_name == 'physical')
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                {{$rate->name}}
                                                            </div>
                                                            <div class="col-md-6">
                                                                <?php
                                                                    for($i = 0; $i < floor($rate->value); $i++)
                                                                    {
                                                                        echo '<i class="fa-solid fa-star"></i>';
                                                                    }
                                                                    $plus = floor( $rate->value ).'.0';
                                                                    if ($plus != $rate->value)
                                                                    {
                                                                        echo '<i class="fa-solid fa-star-half"></i>';
                                                                    }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <a href="{{ route('breeds.index') }}" class="btn btn-danger" type="button">Go Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection