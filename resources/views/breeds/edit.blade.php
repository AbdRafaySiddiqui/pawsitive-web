@extends('layouts.master')

@section('content')
    <div class="content-w" style="width:100%">
        
        
        <div class="content-i">
            <div class="content-box">
                <div class="row">

                    <div class="col-lg-12">
                        <div class="element-wrapper">
                            <h6 class="element-header">
                                Breeds - Edit
                            </h6>
                            @if (session()->has('message'))
                                        <div class="alert alert-success">
                                            {{ session()->get('message') }}
                                        </div>
                                    @endif
                            <div class="element-box">
                            <form action="{{ route('breeds.edit', $breed->id) }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Breed Name</label>
                                                <input type="text" class="form-control" name="name" id="name"
                                                    value="{{ $breed->name }}" required>
                                            </div>
                                        </div>
                                        
                                     
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Variations (Seperate by ';')</label>
                                                <input type="text" class="form-control" name="variations" id="variations"
                                                    placeholder="For e.g. Black Brown;White;Black"
                                                    value="{{ $breed->variations }}">
                                            </div>
                                        </div>

                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Clubs</label>
                                                <?php $poof = explode(',', $breed->club_id); ?>
                                                <select class="form-control select2" tabindex="-1" aria-hidden="true"
                                                    name="club_id[]" id="club_id" multiple>
                                                    <option value="0">{{ 'Select Club' }}</option>
                                                    @foreach ($clubs as $club)
                                                        @if (in_array($club->id, $poof))
                                                            <option selected value="{{ $club->id }}">
                                                                {{ $club->name }}</option>
                                                        @else
                                                            <option value="{{ $club->id }}">{{ $club->name }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>AKC Group</label>
                                                <select class="form-control select2" tabindex="-1" aria-hidden="true"
                                                    name="akc_group" id="akc_group">
                                                    <option value="0">{{ 'Select AKC Group' }}</option>
                                                    @foreach ($AKC as $akc)
                                                        @if ($akc->id == $breed->akc_group)
                                                            <option selected value="{{ $akc->id }}">
                                                                {{ $akc->name }}</option>
                                                        @else
                                                            <option value="{{ $akc->id }}">{{ $akc->name }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-1"></div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>CFA ?</label>
                                                <div class="custom-switches mt-2">
                                                    <label class="custom-switch" style="margin-right:20px;">
                                                        <input type="radio" name="cfa_group" @if($breed->cfa_group == 'Yes') checked @endif value="Yes" class="custom-switch-input">
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description">Yes</span>
                                                    </label>
                                                    <label class="custom-switch">
                                                        <input type="radio" name="cfa_group" @if($breed->cfa_group == 'No') checked @endif value="No" class="custom-switch-input">
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description">No</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-1"></div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>FCI Group</label>
                                                <select class="form-control select2" tabindex="-1" aria-hidden="true"
                                                    name="fci_group" id="fci_group">
                                                    <option value="0">{{ 'Select FCI Group' }}</option>
                                                    @foreach ($FCI as $fci)
                                                        @if ($fci->id == $breed->fci_group)
                                                            <option selected value="{{ $fci->id }}">
                                                                {{ $fci->name }}</option>
                                                        @else
                                                            <option value="{{ $fci->id }}">{{ $fci->name }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <hr>
                                        </div>
                                        <?php
                                        $height_male = explode(' TO ', $breed->height_male);
                                        $height_male1 = $height_male[0];
                                        $height_male2 = $height_male[1];
                                        
                                        $height_female = explode(' TO ', $breed->height_female);
                                        $height_female1 = $height_female[0];
                                        $height_female2 = $height_female[1];
                                        
                                        $weight_male = explode(' TO ', $breed->weight_male);
                                        $weight_male1 = $weight_male[0];
                                        $weight_male2 = $weight_male[1];
                                        
                                        $weight_female = explode(' TO ', $breed->weight_female);
                                        $weight_female1 = $weight_female[0];
                                        $weight_female2 = $weight_female[1];
                                        
                                        $life_span = explode(' TO ', $breed->life_span);
                                        $life_span1 = $life_span[0];
                                        $life_span2 = $life_span[1];
                                        ?>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Height</label>
                                                <br>
                                                <input type="number" class="form-control col-md-2 float-left"
                                                    name="height_male1" id="height_male1" value="{{ $height_male1 }}">
                                                <span class="float-left" style="padding:10px;"><strong>To</strong></span>
                                                <input type="number" class="form-control col-md-2 float-left"
                                                    name="height_male2" id="height_male2" value="{{ $height_male2 }}">
                                                <span class="float-left" style="padding:10px;"><strong>CM
                                                        (MALE)</strong></span>
                                                <br>
                                                <br>
                                                <br>
                                                <input type="number" class="form-control col-md-2 float-left"
                                                    name="height_female1" id="height_female1"
                                                    value="{{ $height_female1 }}">
                                                <span class="float-left" style="padding:10px;"><strong>To</strong></span>
                                                <input type="number" class="form-control col-md-2 float-left"
                                                    name="height_female2" id="height_female2"
                                                    value="{{ $height_female2 }}">
                                                <span class="float-left" style="padding:10px;"><strong>CM
                                                        (FEMALE)</strong></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Weight</label>
                                                <br>
                                                <input type="number" class="form-control col-md-2 float-left"
                                                    name="weight_male1" id="weight_male1" value="{{ $weight_male1 }}">
                                                <span class="float-left" style="padding:10px;"><strong>To</strong></span>
                                                <input type="number" class="form-control col-md-2 float-left"
                                                    name="weight_male2" id="weight_male2" value="{{ $weight_male2 }}">
                                                <span class="float-left" style="padding:10px;"><strong>KG
                                                        (MALE)</strong></span>
                                                <br>
                                                <br>
                                                <br>
                                                <input type="number" class="form-control col-md-2 float-left"
                                                    name="weight_female1" id="weight_female1"
                                                    value="{{ $weight_female1 }}">
                                                <span class="float-left" style="padding:10px;"><strong>To</strong></span>
                                                <input type="number" class="form-control col-md-2 float-left"
                                                    name="weight_female2" id="weight_female2"
                                                    value="{{ $weight_female2 }}">
                                                <span class="float-left" style="padding:10px;"><strong>KG
                                                        (FEMALE)</strong></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top:20px;">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Life Span</label>
                                                <br>
                                                <input type="number" class="form-control col-md-2 float-left"
                                                    name="life_span1" id="life_span1" value="{{ $life_span1 }}">
                                                <span class="float-left" style="padding:10px;"><strong>To</strong></span>
                                                <input type="number" class="form-control col-md-2 float-left"
                                                    name="life_span2" id="life_span2" value="{{ $life_span2 }}">
                                                <span class="float-left"
                                                    style="padding:10px;"><strong>YEARS</strong></span>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Country of Origin</label>
                                                <select class="form-control select2" tabindex="-1" aria-hidden="true"
                                                    name="country" id="country">
                                                    <option value="0">{{ 'Select Country' }}</option>
                                                    @foreach ($countries as $country)
                                                        @if ($country->idCountry == $breed->country)
                                                            <option selected value="{{ $country->idCountry }}">
                                                                {{ $country->countryName }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $country->idCountry }}">
                                                                {{ $country->countryName }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 d-none">
                                            <span>
                                                <hr>
                                                <center>
                                                    <legend>Media Uploaded</legend>
                                                </center>
                                                <hr>
                                            </span>
                                        </div>
                                        <?php $imgcount = 0; $vidcount = 0; ?>
                                        <div class="col-md-6 d-none">
                                            <div class="form-group">
                                                <label>Videos</label>
                                                <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#upload_videos">
                                                    Add Video(s)
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-6 d-none">
                                            <div class="form-group">
                                                <label>Images</label>
                                                <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#upload_videos">
                                                    Add Image(s)
                                                </button>
                                            </div>
                                    </div>

                                   
                                    <div class="row">
                                        <div class="col-md-12">
                                            <span>
                                                <hr>
                                                <center>
                                                    <legend>Rating 1 to 5 Bones </legend>
                                                </center>
                                                <hr>
                                            </span>
                                        </div>

                                        <!-- for testing purposer start -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <center>
                                                    <h5>Adaptability
                                                        <span id="rangeres1" class="badge badge-success"
                                                            style="font-size:15px;">
                                                            {{ number_format($breed->adapt, 1) }}
                                                        </span>
                                                    </h5>
                                                </center>
                                                <br>

                                                <?php $i = 0;
                                                $I = 0;
                                                $total = 0; ?>


                                                <!-- 2nd star rating  -->
                                                <div class="appartmentLivingDiv" style="text-align:center;">
                                                    <!-- <div style="display: flex; gap:10px"> -->
                                                    @foreach ($adapt_bones as $ab)
                                                        <div>
                                                            <!-- <p style="margin: 0px;">Suited To Apartment Living </p> -->
                                                            <p style="margin: 0px;">
                                                                <label>{{ $ab->name }}
                                                                    <span id="rangeadp-{{ ++$I }}"
                                                                        class="badge badge-primary"
                                                                        style="font-size:15px;">
                                                                        {{ number_format($ab->value, 1) }}
                                                                    </span>
                                                                </label>
                                                            </p>
                                                            <!-- <div class="badge badge-primary">
                                                            <span id="demo"></span>
                                                        </div> -->
                                                        </div>
                                                        <div class="rating">
                                                            <input type="hidden" name="adp[{{ $ab->id }}]"
                                                                id="adp-{{ ++$i }}-value"
                                                                value="{{ $ab->value }}" />
                                                            <label>
                                                                @if ($ab->value >= 1)
                                                                    <input type="radio"
                                                                        name="adpstar-{{ $i }}"
                                                                        id="adp-{{ $i }}" value="1"
                                                                        checked onchange="rangeadp(this)" />
                                                                @else
                                                                    <input type="radio"
                                                                        name="adpstar-{{ $i }}"
                                                                        id="adp-{{ $i }}" value="1"
                                                                        onchange="rangeadp(this)" />
                                                                @endif
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>
                                                                @if ($ab->value >= 2)
                                                                    <input type="radio"
                                                                        name="adpstar-{{ $i }}"
                                                                        id="adp-{{ $i }}" value="2"
                                                                        checked onchange="rangeadp(this)" />
                                                                @else
                                                                    <input type="radio"
                                                                        name="adpstar-{{ $i }}"
                                                                        id="adp-{{ $i }}" value="2"
                                                                        onchange="rangeadp(this)" />
                                                                @endif
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>
                                                                @if ($ab->value >= 3)
                                                                    <input type="radio"
                                                                        name="adpstar-{{ $i }}"
                                                                        id="adp-{{ $i }}" value="3"
                                                                        checked onchange="rangeadp(this)" />
                                                                @else
                                                                    <input type="radio"
                                                                        name="adpstar-{{ $i }}"
                                                                        id="adp-{{ $i }}" value="3"
                                                                        onchange="rangeadp(this)" />
                                                                @endif
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>
                                                                @if ($ab->value >= 4)
                                                                    <input type="radio"
                                                                        name="adpstar-{{ $i }}"
                                                                        id="adp-{{ $i }}" value="4"
                                                                        checked onchange="rangeadp(this)" />
                                                                @else
                                                                    <input type="radio"
                                                                        name="adpstar-{{ $i }}"
                                                                        id="adp-{{ $i }}" value="4"
                                                                        onchange="rangeadp(this)" />
                                                                @endif
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>
                                                                @if ($ab->value >= 5)
                                                                    <input type="radio"
                                                                        name="adpstar-{{ $i }}"
                                                                        id="adp-{{ $i }}" value="5"
                                                                        checked onchange="rangeadp(this)" />
                                                                @else
                                                                    <input type="radio"
                                                                        name="adpstar-{{ $i }}"
                                                                        id="adp-{{ $i }}" value="5"
                                                                        onchange="rangeadp(this)" />
                                                                @endif
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                        </div>
                                                        @php $total += $ab->value; @endphp
                                                    @endforeach
                                                    <input type="hidden" name="adapt" id="adapt"
                                                        value="{{ $breed->adapt }}" />
                                                </div>

                                            </div>
                                        </div>

                                        <!-- for testing purposer end -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <center>
                                                    <h5>Overall Friendliness
                                                        <span id="rangeres2" class="badge badge-success"
                                                            style="font-size:15px;">
                                                            {{ number_format($breed->friendly, 1) }}
                                                        </span>
                                                    </h5>
                                                </center>
                                                <br>

                                                <?php $i = 0;
                                                $I = 0;
                                                $total = 0; ?>
                                                <div class="appartmentLivingDiv" style="text-align:center;">

                                                    @foreach ($friendly_bones as $fb)
                                                        <div>
                                                            <!-- <p style="margin: 0px;">Suited To Apartment Living </p> -->
                                                            <p style="margin: 0px;">
                                                                <label>{{ $fb->name }}
                                                                    <span id="rangeadp-{{ ++$I }}"
                                                                        class="badge badge-primary"
                                                                        style="font-size:15px;">
                                                                        {{ number_format($fb->value, 1) }}
                                                                    </span>
                                                                </label>
                                                            </p>
                                                            <!-- <div class="badge badge-primary">
                                                            <span id="demo"></span>
                                                        </div> -->
                                                        </div>
                                                        <div class="rating">
                                                            <input type="hidden" name="frn[{{ $fb->id }}]"
                                                                id="frn-{{ ++$i }}-value"
                                                                value="{{ $fb->value }}" />
                                                            <label>
                                                                @if ($fb->value >= 1)
                                                                    <input type="radio"
                                                                        name="frnstar-{{ $i }}"
                                                                        id="frn-{{ $i }}" value="1"
                                                                        checked onchange="rangefrn(this)" />
                                                                @else
                                                                    <input type="radio"
                                                                        name="frnstar-{{ $i }}"
                                                                        id="frn-{{ $i }}" value="1"
                                                                        onchange="rangefrn(this)" />
                                                                @endif
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>
                                                                @if ($fb->value >= 2)
                                                                    <input type="radio"
                                                                        name="frnstar-{{ $i }}"
                                                                        id="frn-{{ $i }}" value="2"
                                                                        checked onchange="rangefrn(this)" />
                                                                @else
                                                                    <input type="radio"
                                                                        name="frnstar-{{ $i }}"
                                                                        id="frn-{{ $i }}" value="2"
                                                                        onchange="rangefrn(this)" />
                                                                @endif
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>
                                                                @if ($fb->value >= 3)
                                                                    <input type="radio"
                                                                        name="frnstar-{{ $i }}"
                                                                        id="frn-{{ $i }}" value="3"
                                                                        checked onchange="rangefrn(this)" />
                                                                @else
                                                                    <input type="radio"
                                                                        name="frnstar-{{ $i }}"
                                                                        id="frn-{{ $i }}" value="3"
                                                                        onchange="rangefrn(this)" />
                                                                @endif
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>
                                                                @if ($fb->value >= 4)
                                                                    <input type="radio"
                                                                        name="frnstar-{{ $i }}"
                                                                        id="frn-{{ $i }}" value="4"
                                                                        checked onchange="rangefrn(this)" />
                                                                @else
                                                                    <input type="radio"
                                                                        name="frnstar-{{ $i }}"
                                                                        id="frn-{{ $i }}" value="4"
                                                                        onchange="rangefrn(this)" />
                                                                @endif
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>
                                                                @if ($fb->value >= 5)
                                                                    <input type="radio"
                                                                        name="frnstar-{{ $i }}"
                                                                        id="frn-{{ $i }}" value="5"
                                                                        checked onchange="rangefrn(this)" />
                                                                @else
                                                                    <input type="radio"
                                                                        name="frnstar-{{ $i }}"
                                                                        id="frn-{{ $i }}" value="5"
                                                                        onchange="rangefrn(this)" />
                                                                @endif
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                        </div>
                                                        @php $total += $fb->value; @endphp
                                                    @endforeach
                                                    <input type="hidden" name="friendly" id="friendly"
                                                        value="{{ $breed->friendly }}" />
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <center>
                                                    <h5>Health And Grooming Needs
                                                        <span id="rangeres3" class="badge badge-success"
                                                            style="font-size:15px;">
                                                            {{ number_format($breed->health_groom, 1) }}
                                                        </span>
                                                    </h5>
                                                </center>
                                                <br>

                                                <?php $i = 0;
                                                $I = 0;
                                                $total = 0; ?>

                                                <div class="appartmentLivingDiv" style="text-align:center;">
                                                    @foreach ($hg_bones as $hg)
                                                        <div>
                                                            <!-- <p style="margin: 0px;">Suited To Apartment Living </p> -->
                                                            <p style="margin: 0px;">
                                                                <label>{{ $hg->name }}
                                                                    <span id="rangehg-{{ ++$I }}"
                                                                        class="badge badge-primary"
                                                                        style="font-size:15px;">
                                                                        {{ number_format($hg->value, 1) }}
                                                                    </span>
                                                                </label>
                                                            </p>
                                                            <!-- <div class="badge badge-primary">
                                                            <span id="demo"></span>
                                                        </div> -->
                                                        </div>
                                                        <div class="rating">
                                                            <input type="hidden" name="hg[{{ $hg->id }}]"
                                                                id="hg-{{ ++$i }}-value"
                                                                value="{{ $hg->value }}" />
                                                            <label>
                                                                @if ($hg->value >= 1)
                                                                    <input type="radio"
                                                                        name="hgstar-{{ $i }}"
                                                                        id="hg-{{ $i }}" value="1"
                                                                        checked onchange="rangehg(this)" />
                                                                @else
                                                                    <input type="radio"
                                                                        name="hgstar-{{ $i }}"
                                                                        id="hg-{{ $i }}" value="1"
                                                                        onchange="rangehg(this)" />
                                                                @endif
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>
                                                                @if ($hg->value >= 2)
                                                                    <input type="radio"
                                                                        name="hgstar-{{ $i }}"
                                                                        id="hg-{{ $i }}" value="2"
                                                                        checked onchange="rangehg(this)" />
                                                                @else
                                                                    <input type="radio"
                                                                        name="hgstar-{{ $i }}"
                                                                        id="hg-{{ $i }}" value="2"
                                                                        onchange="rangehg(this)" />
                                                                @endif
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>
                                                                @if ($hg->value >= 3)
                                                                    <input type="radio"
                                                                        name="hgstar-{{ $i }}"
                                                                        id="hg-{{ $i }}" value="3"
                                                                        checked onchange="rangehg(this)" />
                                                                @else
                                                                    <input type="radio"
                                                                        name="hgstar-{{ $i }}"
                                                                        id="hg-{{ $i }}" value="3"
                                                                        onchange="rangehg(this)" />
                                                                @endif
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>
                                                                @if ($hg->value >= 4)
                                                                    <input type="radio"
                                                                        name="hgstar-{{ $i }}"
                                                                        id="hg-{{ $i }}" value="4"
                                                                        checked onchange="rangehg(this)" />
                                                                @else
                                                                    <input type="radio"
                                                                        name="hgstar-{{ $i }}"
                                                                        id="hg-{{ $i }}" value="4"
                                                                        onchange="rangehg(this)" />
                                                                @endif
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>
                                                                @if ($hg->value >= 5)
                                                                    <input type="radio"
                                                                        name="hgstar-{{ $i }}"
                                                                        id="hg-{{ $i }}" value="5"
                                                                        checked onchange="rangehg(this)" />
                                                                @else
                                                                    <input type="radio"
                                                                        name="hgstar-{{ $i }}"
                                                                        id="hg-{{ $i }}" value="5"
                                                                        onchange="rangehg(this)" />
                                                                @endif
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                        </div>
                                                        @php $total += $hg->value; @endphp
                                                    @endforeach
                                                    <input type="hidden" name="health_groom" id="health_groom"
                                                        value="{{ $breed->health_groom }}" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <hr>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <center>
                                                    <h5>Trainability
                                                        <span id="rangeres4" class="badge badge-success"
                                                            style="font-size:15px;">
                                                            {{ number_format($breed->train, 1) }}
                                                        </span>
                                                    </h5>
                                                </center>
                                                <br>

                                                <?php $i = 0;
                                                $I = 0;
                                                $total = 0; ?>
                                                <div class="appartmentLivingDiv" style="text-align:center;">
                                                    @foreach ($train_bones as $trn)
                                                        <div>
                                                            <!-- <p style="margin: 0px;">Suited To Apartment Living </p> -->
                                                            <p style="margin: 0px;">
                                                                <label>{{ $trn->name }}
                                                                    <span id="rangetrain-{{ ++$I }}"
                                                                        class="badge badge-primary"
                                                                        style="font-size:15px;">
                                                                        {{ number_format($trn->value, 1) }}
                                                                    </span>
                                                                </label>
                                                            </p>
                                                            <!-- <div class="badge badge-primary">
                                                            <span id="demo"></span>
                                                        </div> -->
                                                        </div>
                                                        <div class="rating">
                                                            <input type="hidden" name="trn[{{ $trn->id }}]"
                                                                id="trn-{{ ++$i }}-value"
                                                                value="{{ $trn->value }}" />
                                                            <label>
                                                                @if ($trn->value >= 1)
                                                                    <input type="radio"
                                                                        name="trnstar-{{ $i }}"
                                                                        id="trn-{{ $i }}" value="1"
                                                                        checked onchange="rangetrain(this)" />
                                                                @else
                                                                    <input type="radio"
                                                                        name="trnstar-{{ $i }}"
                                                                        id="trn-{{ $i }}" value="1"
                                                                        onchange="rangetrain(this)" />
                                                                @endif
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>
                                                                @if ($trn->value >= 2)
                                                                    <input type="radio"
                                                                        name="trnstar-{{ $i }}"
                                                                        id="trn-{{ $i }}" value="2"
                                                                        checked onchange="rangetrain(this)" />
                                                                @else
                                                                    <input type="radio"
                                                                        name="trnstar-{{ $i }}"
                                                                        id="trn-{{ $i }}" value="2"
                                                                        onchange="rangetrain(this)" />
                                                                @endif
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>
                                                                @if ($trn->value >= 3)
                                                                    <input type="radio"
                                                                        name="trnstar-{{ $i }}"
                                                                        id="trn-{{ $i }}" value="3"
                                                                        checked onchange="rangetrain(this)" />
                                                                @else
                                                                    <input type="radio"
                                                                        name="trnstar-{{ $i }}"
                                                                        id="trn-{{ $i }}" value="3"
                                                                        onchange="rangetrain(this)" />
                                                                @endif
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>
                                                                @if ($trn->value >= 4)
                                                                    <input type="radio"
                                                                        name="trnstar-{{ $i }}"
                                                                        id="trn-{{ $i }}" value="4"
                                                                        checked onchange="rangetrain(this)" />
                                                                @else
                                                                    <input type="radio"
                                                                        name="trnstar-{{ $i }}"
                                                                        id="trn-{{ $i }}" value="4"
                                                                        onchange="rangetrain(this)" />
                                                                @endif
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>
                                                                @if ($trn->value >= 5)
                                                                    <input type="radio"
                                                                        name="trnstar-{{ $i }}"
                                                                        id="trn-{{ $i }}" value="5"
                                                                        checked onchange="rangetrain(this)" />
                                                                @else
                                                                    <input type="radio"
                                                                        name="trnstar-{{ $i }}"
                                                                        id="trn-{{ $i }}" value="5"
                                                                        onchange="rangetrain(this)" />
                                                                @endif
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                        </div>
                                                        @php $total += $trn->value; @endphp
                                                    @endforeach
                                                    <input type="hidden" name="train" id="train"
                                                        value="{{ $breed->train }}" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <center>
                                                    <h5>
                                                        Physical Needs
                                                        <span id="rangeres5" class="badge badge-success"
                                                            style="font-size:15px;">
                                                            {{ number_format($breed->physical, 1) }}
                                                        </span>
                                                    </h5>
                                                </center>
                                                <br>

                                                <?php $i = 0;
                                                $I = 0;
                                                $total = 0; ?>

                                                <div class="appartmentLivingDiv" style="text-align:center;">
                                                    @foreach ($physical_bones as $pb)
                                                        <div>
                                                            <!-- <p style="margin: 0px;">Suited To Apartment Living </p> -->
                                                            <p style="margin: 0px;">
                                                                <label>{{ $pb->name }}
                                                                    <span id="rangeph-{{ ++$I }}"
                                                                        class="badge badge-primary"
                                                                        style="font-size:15px;">
                                                                        {{ number_format($pb->value, 1) }}
                                                                    </span>
                                                                </label>
                                                            </p>
                                                        </div>
                                                        <div class="rating">
                                                            <input type="hidden" name="physicalb[{{ $pb->id }}]"
                                                                id="physical-{{ ++$i }}-value"
                                                                value="{{ $pb->value }}" />
                                                            <label>
                                                                @if ($pb->value >= 1)
                                                                    <input type="radio"
                                                                        name="pbstar-{{ $i }}"
                                                                        id="pb-{{ $i }}" value="1"
                                                                        checked onchange="rangeph(this)" />
                                                                @else
                                                                    <input type="radio"
                                                                        name="pbstar-{{ $i }}"
                                                                        id="pb-{{ $i }}" value="1"
                                                                        onchange="rangeph(this)" />
                                                                @endif
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>
                                                                @if ($pb->value >= 2)
                                                                    <input type="radio"
                                                                        name="pbstar-{{ $i }}"
                                                                        id="pb-{{ $i }}" value="2"
                                                                        checked onchange="rangeph(this)" />
                                                                @else
                                                                    <input type="radio"
                                                                        name="pbstar-{{ $i }}"
                                                                        id="pb-{{ $i }}" value="2"
                                                                        onchange="rangeph(this)" />
                                                                @endif
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>
                                                                @if ($pb->value >= 3)
                                                                    <input type="radio"
                                                                        name="pbstar-{{ $i }}"
                                                                        id="pb-{{ $i }}" value="3"
                                                                        checked onchange="rangeph(this)" />
                                                                @else
                                                                    <input type="radio"
                                                                        name="pbstar-{{ $i }}"
                                                                        id="pb-{{ $i }}" value="3"
                                                                        onchange="rangeph(this)" />
                                                                @endif
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>
                                                                @if ($pb->value >= 4)
                                                                    <input type="radio"
                                                                        name="pbstar-{{ $i }}"
                                                                        id="pb-{{ $i }}" value="4"
                                                                        checked onchange="rangeph(this)" />
                                                                @else
                                                                    <input type="radio"
                                                                        name="pbstar-{{ $i }}"
                                                                        id="pb-{{ $i }}" value="4"
                                                                        onchange="rangeph(this)" />
                                                                @endif
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>
                                                                @if ($pb->value >= 5)
                                                                    <input type="radio"
                                                                        name="pbstar-{{ $i }}"
                                                                        id="pb-{{ $i }}" value="5"
                                                                        checked onchange="rangeph(this)" />
                                                                @else
                                                                    <input type="radio"
                                                                        name="pbstar-{{ $i }}"
                                                                        id="pb-{{ $i }}" value="5"
                                                                        onchange="rangeph(this)" />
                                                                @endif
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                        </div>
                                                        @php $total += $pb->value; @endphp
                                                    @endforeach
                                                    <input type="hidden" name="physical" id="physical"
                                                        value="{{ $breed->physical }}" />
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-md-12">
                                            <span>
                                                <hr>
                                                <hr>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>About The Breed</label>
                                                <textarea class="summernote" name="about" id="ckeditor1">{{ htmlspecialchars_decode($breed->about) }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>History</label>
                                                <textarea class="summernote" name="history" id="ckeditor2">{{ htmlspecialchars_decode($breed->history) }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Personality</label>
                                                <textarea class="summernote" name="personality" id="ckeditor3">{{ htmlspecialchars_decode($breed->personality) }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Health</label>
                                                <textarea class="summernote" name="health" id="ckeditor4">{{ htmlspecialchars_decode($breed->health) }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Care</label>
                                                <textarea class="summernote" name="care" id="ckeditor5">{{ htmlspecialchars_decode($breed->care) }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Feeding</label>
                                                <textarea class="summernote" name="feeding" id="ckeditor6">{{ htmlspecialchars_decode($breed->feeding) }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Grooming</label>
                                                <textarea class="summernote" name="grooming" id="ckeditor7">{{ htmlspecialchars_decode($breed->grooming) }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Children & Pets</label>
                                                <textarea class="summernote" name="child_pets" id="ckeditor8">{{ htmlspecialchars_decode($breed->child_pets) }}</textarea>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="card-footer text-left">
                                    <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                    <a href="{{ route('breeds.index') }}">
                                        <button class="btn btn-danger" type="button">Cancel</button>
                                    </a>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
        

            </div>
        </div>


    

    <div class="modal fade" tabindex="-1" role="dialog" id="upload_videos">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload Videos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>
        </div>
    </div>


 <script src="{{asset('public/bower_components/ckeditor/ckeditor.js')}}"></script>


<script type="text/javascript">
if ($('#ckeditor1').length) {
CKEDITOR.replace('ckeditor1');
}
if ($('#ckeditor2').length) {
CKEDITOR.replace('ckeditor2');
}
if ($('#ckeditor3').length) {
CKEDITOR.replace('ckeditor3');
}
if ($('#ckeditor4').length) {
CKEDITOR.replace('ckeditor4');
}
if ($('#ckeditor5').length) {
CKEDITOR.replace('ckeditor5');
}
if ($('#ckeditor6').length) {
CKEDITOR.replace('ckeditor6');
}
if ($('#ckeditor7').length) {
CKEDITOR.replace('ckeditor7');
}
if ($('#ckeditor8').length) {
CKEDITOR.replace('ckeditor8');
}

        function changepic() {
            $('#upload_profile_picture').modal('show');
        }

        function rangeadp(v) {
            let split = v.id.split('-');
            $('#rangeadp-' + split[1]).html(v.value + '.0');

            $('#adp-' + split[1] + '-value').attr('value', parseFloat(v.value));

            let total = parseInt($("#adp-1:checked").val() != undefined ? $("#adp-1:checked").val() : 0) +
                parseInt($("#adp-2:checked").val() != undefined ? $("#adp-2:checked").val() : 0) +
                parseInt($("#adp-3:checked").val() != undefined ? $("#adp-3:checked").val() : 0) +
                parseInt($("#adp-4:checked").val() != undefined ? $("#adp-4:checked").val() : 0) +
                parseInt($("#adp-5:checked").val() != undefined ? $("#adp-5:checked").val() : 0) +
                parseInt($("#adp-6:checked").val() != undefined ? $("#adp-6:checked").val() : 0);

            $('#adapt').attr('value', parseFloat(total / 6).toFixed(1));

            $('#rangeres1').html(parseFloat(total / 6).toFixed(1));

            console.log(total / 6, "adp");
        }

        function rangefrn(f) {
            let split = f.id.split('-');

            $('#rangefrn-' + split[1]).html(f.value + '.0');

            $('#frn-' + split[1] + '-value').attr('value', parseFloat(f.value));

            let total = parseInt($("#frn-1:checked").val() != undefined ? $("#frn-1:checked").val() : 0) +
                parseInt($("#frn-2:checked").val() != undefined ? $("#frn-2:checked").val() : 0) +
                parseInt($("#frn-3:checked").val() != undefined ? $("#frn-3:checked").val() : 0) +
                parseInt($("#frn-4:checked").val() != undefined ? $("#frn-4:checked").val() : 0);

            $('#friendly').attr('value', parseFloat(total / 4).toFixed(1));

            $('#rangeres2').html(parseFloat(total / 4).toFixed(1));

            console.log(total / 4);
        }

        function rangehg(h) {
            let split = h.id.split('-');
            $('#rangehg-' + split[1]).html(h.value + '.0');

            $('#hg-' + split[1] + '-value').attr('value', parseFloat(h.value));

            let total = parseInt($("#hg-1:checked").val() != undefined ? $("#hg-1:checked").val() : 0) +
                parseInt($("#hg-2:checked").val() != undefined ? $("#hg-2:checked").val() : 0) +
                parseInt($("#hg-3:checked").val() != undefined ? $("#hg-3:checked").val() : 0) +
                parseInt($("#hg-4:checked").val() != undefined ? $("#hg-4:checked").val() : 0) +
                parseInt($("#hg-5:checked").val() != undefined ? $("#hg-5:checked").val() : 0) +
                parseInt($("#hg-6:checked").val() != undefined ? $("#hg-6:checked").val() : 0);

            $('#health_groom').attr('value', parseFloat(total / 6).toFixed(1));

            $('#rangeres3').html(parseFloat(total / 6).toFixed(1));

            console.log(total / 6);
        }

        function rangetrain(t) {
            let split = t.id.split('-');

            $('#rangetrain-' + split[1]).html(t.value + '.0');

            $('#trn-' + split[1] + '-value').attr('value', parseFloat(t.value));

            let total = parseInt($("#trn-1:checked").val() != undefined ? $("#trn-1:checked").val() : 0) +
                parseInt($("#trn-2:checked").val() != undefined ? $("#trn-2:checked").val() : 0) +
                parseInt($("#trn-3:checked").val() != undefined ? $("#trn-3:checked").val() : 0) +
                parseInt($("#trn-4:checked").val() != undefined ? $("#trn-4:checked").val() : 0) +
                parseInt($("#trn-5:checked").val() != undefined ? $("#trn-5:checked").val() : 0) +
                parseInt($("#trn-6:checked").val() != undefined ? $("#trn-6:checked").val() : 0);

            $('#train').attr('value', parseFloat(total / 6).toFixed(1));

            $('#rangeres4').html(parseFloat(total / 6).toFixed(1));

            console.log(total / 6);
        }

        function rangeph(p) {
            let split = p.id.split('-');

            $('#rangeph-' + split[1]).html(p.value + '.0');

            $('#physical-' + split[1] + '-value').attr('value', parseFloat(p.value));

            let total = parseInt($("#pb-1:checked").val() != undefined ? $("#pb-1:checked").val() : 0) +
                parseInt($("#pb-2:checked").val() != undefined ? $("#pb-2:checked").val() : 0) +
                parseInt($("#pb-3:checked").val() != undefined ? $("#pb-3:checked").val() : 0) +
                parseInt($("#pb-4:checked").val() != undefined ? $("#pb-4:checked").val() : 0);

            $('#physical').attr('value', parseFloat(total / 4).toFixed(1));

            $('#rangeres5').html(parseFloat(total / 4).toFixed(1));

            console.log(total / 4);
        }
    </script>

@endsection