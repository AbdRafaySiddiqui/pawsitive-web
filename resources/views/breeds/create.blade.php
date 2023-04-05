@extends('layouts.master')

@section('content')
    <div class="content-w full_h"  style="width:100%">

        <div class="content-i">
            <div class="content-box">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="element-wrapper">
                            <h6 class="element-header">
                                Breeds - Create
                            </h6>
                            @if (session()->has('message'))
                                        <div class="alert alert-success">
                                            {{ session()->get('message') }}
                                        </div>
                                    @endif
                            <div class="element-box">
                                <form action="{{ route('breeds.store') }}" method="post">
                                    @csrf
                                    <h5 class="form-header">
                                        Create a new Breed
                                    </h5>
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label" for="">Breed Name</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" name="name" placeholder="Enter Breed Name"
                                                type="text" required>
                                        </div>
                                    </div>



                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Variations (Seperate by ';')</label>
                                                <input type="text" class="form-control" name="variations" id="variations"
                                                    placeholder="For e.g. Black Brown;White;Black">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Clubs</label>
                                                <select class="form-control select2" tabindex="-1" aria-hidden="true"
                                                    name="club_id[]" id="club_id" multiple>
                                                    <option value="0">{{ 'Select Club(s)' }}</option>
                                                    @foreach ($clubs as $club)
                                                        <option value="{{ $club->id }}">{{ $club->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>AKC Group</label>
                                                <select class="form-control select2" tabindex="-1" aria-hidden="true"
                                                    name="akc_group" id="akc_group">
                                                    <option value="0">{{ 'Select AKC Group' }}</option>
                                                    @foreach ($AKC as $akc)
                                                        <option value="{{ $akc->id }}">{{ $akc->name }}</option>
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
                                                        <input type="radio" name="cfa_group" value="Yes" class="custom-switch-input">
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description">Yes</span>
                                                    </label>
                                                    <label class="custom-switch">
                                                        <input type="radio" name="cfa_group" checked value="No" class="custom-switch-input">
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description">No</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

    
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>FCI Group</label>
                                                <select class="form-control select2" tabindex="-1" aria-hidden="true"
                                                    name="fci_group" id="fci_group">
                                                    <option value="0">{{ 'Select FCI Group' }}</option>
                                                    @foreach ($FCI as $fci)
                                                        <option value="{{ $fci->id }}">{{ $fci->name }}</option>
                                                    @endforeach
                                                 </select>
                                            </div>
                                        </div>

                                    </div> 

                                   

                                    <div class="row">
                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Height</label>
                                                <br>
                                                <input type="number" class="form-control col-md-2 float-left"
                                                    name="height_male1" id="height_male1">
                                                <span class="float-left" style="padding:10px;"><strong>To</strong></span>
                                                <input type="number" class="form-control col-md-2 float-left"
                                                    name="height_male2" id="height_male2">
                                                <span class="float-left" style="padding:10px;"><strong>CM
                                                        (MALE)</strong></span>
                                                <br>
                                                <br>
                                                <br>
                                                <input type="number" class="form-control col-md-2 float-left"
                                                    name="height_female1" id="height_female1">
                                                <span class="float-left" style="padding:10px;"><strong>To</strong></span>
                                                <input type="number" class="form-control col-md-2 float-left"
                                                    name="height_female2" id="height_female2">
                                                <span class="float-left" style="padding:10px;"><strong>CM
                                                        (FEMALE)</strong></span>
                                            </div>
                                        </div>

  <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Weight</label>
                                                <br>
                                                <input type="number" class="form-control col-md-2 float-left"
                                                    name="weight_male1" id="weight_male1">
                                                <span class="float-left" style="padding:10px;"><strong>To</strong></span>
                                                <input type="number" class="form-control col-md-2 float-left"
                                                    name="weight_male2" id="weight_male2">
                                                <span class="float-left" style="padding:10px;"><strong>KG
                                                        (MALE)</strong></span>
                                                <br>
                                                <br>
                                                <br>
                                                <input type="number" class="form-control col-md-2 float-left"
                                                    name="weight_female1" id="weight_female1">
                                                <span class="float-left" style="padding:10px;"><strong>To</strong></span>
                                                <input type="number" class="form-control col-md-2 float-left"
                                                    name="weight_female2" id="weight_female2">
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
                                                    name="life_span1" id="life_span1">
                                                <span class="float-left" style="padding:10px;"><strong>To</strong></span>
                                                <input type="number" class="form-control col-md-2 float-left"
                                                    name="life_span2" id="life_span2">
                                                <span class="float-left"
                                                    style="padding:10px;"><strong>YEARS</strong></span>
                                            </div>
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

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <center>
                                                    <h5>Adaptability
                                                        <span id="rangeres1" class="badge badge-success"
                                                            style="font-size:15px;">
                                                            {{ number_format(0, 1) }}
                                                        </span>
                                                    </h5>
                                                </center>
                                                <br>

                                                <?php $i = 0;
                                                $I = 0;
                                                $total = 0; ?>

                                                <div class="appartmentLivingDiv" style="text-align:center;">
                                                    <!-- <div style="display: flex; gap:10px"> -->
                                                    @foreach ($adapt_bones as $ab)
                                                        <div>
                                                            <!-- <p style="margin: 0px;">Suited To Apartment Living </p> -->
                                                            <p style="margin: 0px;">
                                                                <label>{{ $ab }}
                                                                    <span id="rangeadp-{{ ++$I }}"
                                                                        class="badge badge-primary"
                                                                        style="font-size:15px;">
                                                                        {{ number_format(0, 1) }}
                                                                    </span>
                                                                </label>
                                                            </p>
                                                            <!-- <div class="badge badge-primary">
                                                                <span id="demo"></span>
                                                            </div> -->
                                                        </div>
                                                        <div class="rating">
                                                            <input type="hidden" name="adp[]"
                                                                id="adp-{{ ++$i }}-value" value="0" />
                                                            <label>
                                                                <input type="radio" name="adpstar-{{ $i }}"
                                                                    id="adp-{{ $i }}" value="1"
                                                                    onchange="rangeadp(this)" />
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="adpstar-{{ $i }}"
                                                                    id="adp-{{ $i }}" value="2"
                                                                    onchange="rangeadp(this)" />
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="adpstar-{{ $i }}"
                                                                    id="adp-{{ $i }}" value="3"
                                                                    onchange="rangeadp(this)" />
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="adpstar-{{ $i }}"
                                                                    id="adp-{{ $i }}" value="4"
                                                                    onchange="rangeadp(this)" />
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="adpstar-{{ $i }}"
                                                                    id="adp-{{ $i }}" value="5"
                                                                    onchange="rangeadp(this)" />
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                    <input type="hidden" name="adapt" id="adapt"
                                                        value="0" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <center>
                                                    <h5>Overall Friendliness
                                                        <span id="rangeres2" class="badge badge-success"
                                                            style="font-size:15px;">
                                                            {{ number_format(0, 1) }}
                                                        </span>
                                                    </h5>
                                                </center>
                                                <br>

                                                <?php $i = 0;
                                                $I = 0;
                                                $total = 0; ?>

                                                <div class="appartmentLivingDiv" style="text-align:center;">
                                                    <!-- <div style="display: flex; gap:10px"> -->
                                                    @foreach ($friendly_bones as $frn)
                                                        <div>
                                                            <!-- <p style="margin: 0px;">Suited To Apartment Living </p> -->
                                                            <p style="margin: 0px;">
                                                                <label>{{ $frn }}
                                                                    <span id="rangefrn-{{ ++$I }}"
                                                                        class="badge badge-primary"
                                                                        style="font-size:15px;">
                                                                        {{ number_format(0, 1) }}
                                                                    </span>
                                                                </label>
                                                            </p>
                                                            <!-- <div class="badge badge-primary">
                                                                <span id="demo"></span>
                                                            </div> -->
                                                        </div>
                                                        <div class="rating">
                                                            <input type="hidden" name="frn[]"
                                                                id="frn-{{ ++$i }}-value" value="0" />
                                                            <label>
                                                                <input type="radio" name="frnstar-{{ $i }}"
                                                                    id="frn-{{ $i }}" value="1"
                                                                    onchange="rangefrn(this)" />
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="frnstar-{{ $i }}"
                                                                    id="frn-{{ $i }}" value="2"
                                                                    onchange="rangefrn(this)" />
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="frnstar-{{ $i }}"
                                                                    id="frn-{{ $i }}" value="3"
                                                                    onchange="rangefrn(this)" />
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="frnstar-{{ $i }}"
                                                                    id="frn-{{ $i }}" value="4"
                                                                    onchange="rangefrn(this)" />
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="frnstar-{{ $i }}"
                                                                    id="frn-{{ $i }}" value="5"
                                                                    onchange="rangefrn(this)" />
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                    <input type="hidden" name="friendly" id="friendly"
                                                        value="0" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <center>
                                                    <h5>Health And Grooming Needs
                                                        <span id="rangeres3" class="badge badge-success"
                                                            style="font-size:15px;">
                                                            {{ number_format(0, 1) }}
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
                                                                <label>{{ $hg }}
                                                                    <span id="rangehg-{{ ++$I }}"
                                                                        class="badge badge-primary"
                                                                        style="font-size:15px;">
                                                                        {{ number_format(0, 1) }}
                                                                    </span>
                                                                </label>
                                                            </p>
                                                            <!-- <div class="badge badge-primary">
                                                                <span id="demo"></span>
                                                            </div> -->
                                                        </div>
                                                        <div class="rating">
                                                            <input type="hidden" name="hg[]"
                                                                id="hg-{{ ++$i }}-value" value="0" />
                                                            <label>
                                                                <input type="radio" name="hgstar-{{ $i }}"
                                                                    id="hg-{{ $i }}" value="1"
                                                                    onchange="rangehg(this)" />
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="hgstar-{{ $i }}"
                                                                    id="hg-{{ $i }}" value="2"
                                                                    onchange="rangehg(this)" />
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="hgstar-{{ $i }}"
                                                                    id="hg-{{ $i }}" value="3"
                                                                    onchange="rangehg(this)" />
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="hgstar-{{ $i }}"
                                                                    id="hg-{{ $i }}" value="4"
                                                                    onchange="rangehg(this)" />
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="hgstar-{{ $i }}"
                                                                    id="hg-{{ $i }}" value="5"
                                                                    onchange="rangehg(this)" />
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                    <input type="hidden" name="health_groom" id="health_groom"
                                                        value="0" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <center>
                                                    <h5>Trainability
                                                        <span id="rangeres4" class="badge badge-success"
                                                            style="font-size:15px;">
                                                            {{ number_format(0, 1) }}
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
                                                                <label>{{ $trn }}
                                                                    <span id="rangetrain-{{ ++$I }}"
                                                                        class="badge badge-primary"
                                                                        style="font-size:15px;">
                                                                        {{ number_format(0, 1) }}
                                                                    </span>
                                                                </label>
                                                            </p>
                                                            <!-- <div class="badge badge-primary">
                                                                <span id="demo"></span>
                                                            </div> -->
                                                        </div>
                                                        <div class="rating">
                                                            <input type="hidden" name="trainb[]"
                                                                id="trn-{{ ++$i }}-value" value="0" />
                                                            <label>

                                                                <input type="radio" name="trnstar-{{ $i }}"
                                                                    id="trn-{{ $i }}" value="1"
                                                                    onchange="rangetrain(this)" />

                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>

                                                                <input type="radio" name="trnstar-{{ $i }}"
                                                                    id="trn-{{ $i }}" value="2"
                                                                    onchange="rangetrain(this)" />

                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="trnstar-{{ $i }}"
                                                                    id="trn-{{ $i }}" value="3"
                                                                    onchange="rangetrain(this)" />

                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>

                                                                <input type="radio" name="trnstar-{{ $i }}"
                                                                    id="trn-{{ $i }}" value="4"
                                                                    onchange="rangetrain(this)" />
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>

                                                                <input type="radio" name="trnstar-{{ $i }}"
                                                                    id="trn-{{ $i }}" value="5"
                                                                    onchange="rangetrain(this)" />
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                    <input type="hidden" name="train" id="train"
                                                        value="0" />
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
                                                            {{ number_format(0, 1) }}
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
                                                                <label>{{ $pb }}
                                                                    <span id="rangeph-{{ ++$I }}"
                                                                        class="badge badge-primary"
                                                                        style="font-size:15px;">
                                                                        {{ number_format(0, 1) }}
                                                                    </span>
                                                                </label>
                                                            </p>
                                                        </div>
                                                        <div class="rating">
                                                            <input type="hidden" name="physicalb[]"
                                                                id="physical-{{ ++$i }}-value" value="0" />
                                                            <label>
                                                                <input type="radio" name="pbstar-{{ $i }}"
                                                                    id="pb-{{ $i }}" value="1"
                                                                    onchange="rangeph(this)" />
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="pbstar-{{ $i }}"
                                                                    id="pb-{{ $i }}" value="2"
                                                                    onchange="rangeph(this)" />
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="pbstar-{{ $i }}"
                                                                    id="pb-{{ $i }}" value="3"
                                                                    onchange="rangeph(this)" />
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="pbstar-{{ $i }}"
                                                                    id="pb-{{ $i }}" value="4"
                                                                    onchange="rangeph(this)" />
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="pbstar-{{ $i }}"
                                                                    id="pb-{{ $i }}" value="5"
                                                                    onchange="rangeph(this)" />
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                    <input type="hidden" name="physical" id="physical"
                                                        value="0" />
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
                                                <textarea class="about" name="about" id="ckeditor1"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>History</label>
                                                <textarea class="history" name="history" id="ckeditor2"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Personality</label>
                                                <textarea class="ckeditor1" name="personality" id="ckeditor3"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Health</label>
                                                <textarea class="summernote" name="health" id="ckeditor4"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Care</label>
                                                <textarea class="summernote" name="care" id="ckeditor5"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Feeding</label>
                                                <textarea class="summernote" name="feeding" id="ckeditor6"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Grooming</label>
                                                <textarea class="summernote" name="grooming" id="ckeditor7"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Children & Pets</label>
                                                <textarea class="summernote" name="child_pets" id="ckeditor8"></textarea>
                                            </div>
                                        </div>
                                    </div>                         



                                    <div class="form-buttons-w mb-4">
                                        <button class="btn btn-primary" type="submit"> Submit</button>
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
    </div>
    </div>
    <div class="display-type"></div>
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
