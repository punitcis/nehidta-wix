@extends('NewEngland.layout.base')

<link rel="stylesheet" type="text/css" href="NewEnglandMap/css/NewEnglandMap.css">
<main>
    <section class="nehSec">
        <div class="containerMain">
            <div class="container" style="padding: 0%">



                <div class="projecttype-dropdown-container">
               {{-- <div class= ""> --}}
                   <!-- Select Coalitions Type -->
                   <div  class="projectType_wrapper">
                       <label for="project_type_filter">
                           Select Coalitions Type:
                       </label>
                       <div class="select-wrapper">
                       <select name="project_type_filter" id="project_type_filter" class="form-control"
                           style="">
                           <option value="all">All Prevention partners</option>
                           <option value="Drug Free Communities Coalitions">Drug Free Communities Coalitions</option>
                           <option value="CARA Coalitions">CARA Coalitions</option>
                           <option value="National Guard Counter Drug">National Guard Counter Drug</option>
                           <option value="States Initiatives">States Initiatives</option>
                           <option value="Local Initiatives">Local Initiatives</option>
                       </select>
                       </div>
                   </div>
           
                   <!-- Project Target -->
                   <div class="projectTarget_wrapper">
                       <label for="project_target_filter">
                           Project Target:
                       </label>
                       <select name="project_target_filter[]" id="project_target_filter" class="form-control" multiple
                           style="">
                           <option value="all">All Targets</option>
                           <option value="Alcohol">Alcohol</option>
                           <option value="Marijuana/Cannabis">Marijuana/Cannabis</option>
                           <option value="Prescription drugs">Prescription drugs</option>
                           <option value="Tobacco/nicotine">Tobacco/nicotine</option>
                           <option value="Heroin and fentanyl">Heroin and fentanyl</option>
                           <option value="Methamphetamine">Methamphetamine</option>
                       </select>
                   </div>
               {{-- </div> --}}
           </div>
           
             


                <div class="header">
                    <h1>Drug-Free Community Coalitions — Fiscal Year 2023</h1>
                </div>

                <div class="main-container">


                    <div id="map"></div>
                    <div class="sidebar">
                        <div class="containerone">
                            <h1 class="display" id="display">Select a state or territory</h1>
                            {{-- <button id="clearButton" style="margin-left: 10px;"><i class="fa-solid fa-xmark"></i></button> --}}
                            <button id="clearButton" style="margin-left: 10px; display: none;"><i class="fa-solid fa-xmark"></i></button>

                        </div>



                        <div id="scrollable-list">
                            <div id="state-list" class="scrollable-list">
                                <input type="text" id="search-bar" placeholder="Search state name"
                                    style="margin-bottom: 10px; padding: 5px; width: 100%; box-sizing: border-box;">
                                <!-- Dynamically populate state list -->
                                @foreach ($states as $state)
                                    <div class="list-item" data-value="{{ $state }}">{{ $state->state }}</div>
                                @endforeach
                            </div>
                            <div id="places-list" class="scrollable-list" style="display: none;">
                                <!-- Places will be dynamically added here -->
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

            <script>
                const stateGeoJson = @json(
                    $states->mapWithKeys(function ($state) {
                        return [$state->state => asset($state->file_path)];
                    }));



                const places = @json($placesByStateName);

                let map, markersLayer, placeMarkers = {};
                let currentGeoJsonLayer;
            </script>
        </div>
    </section>

    <script type="text/javascript" src="NewEnglandMap/js/NewEngland.js"></script>