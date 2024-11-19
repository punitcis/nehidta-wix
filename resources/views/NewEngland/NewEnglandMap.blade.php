@extends('NewEngland.layout.base')
@include('NewEngland.layout.header')

<main>
    <section class="nehSec">
        <div class="containerMain">
            <div class="container">



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
                            <button id="clearButton" style="margin-left: 10px; display: none;"><i class="fa-solid fa-xmark"></i></button>
                            {{-- <button id="clearButton" style="margin-left: 10px;"><i class="fa-solid fa-xmark"></i></button> --}}
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
    {{-- <div class="Drug-Free-Communities-Coalitions-table"
        style="  padding-top:40px; padding-button:40px;margin-left: 80px;margin-right: 80px;margin-bottom: 50px;">

        <h1>Drug Free Communities Coalitions</h1>

        <table id="Table-DFCC" class="table table-striped" style="width:100%">

            <thead>

                <tr>
                    <th>Coalitions state</th>
                    <th>city/town</th>
                    <th>Receipient Name</th>
                    <th>Coalition Name</th>

                </tr>
            </thead>
            <thead>
                <tr>
                    <th>
                        <input type="text" id="filter-state-DFCC" placeholder="Filter by State" class="form-control">
                    </th>
                    <th>
                        <input type="text" id="filter-city-DFCC" placeholder="Filter by City" class="form-control">
                    </th>
                    <th>
                        <input type="text" id="filter-receipient-DFCC" placeholder="Filter by Recipient"
                            class="form-control">
                    </th>
                    <th>
                        <input type="text" id="filter-coalition-DFCC" placeholder="Filter by Coalition"
                            class="form-control">
                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($Dfcc as $place)
                    <tr>
                        <td>{{ $place->NewEnglandStates->state }}</td>
                        <td>{{ $place->city }}</td>
                        <td>{{ $place->receipient_name }}</td>
                        <td>{{ $place->projectname }}</td>

                    </tr>
                @endforeach



            </tbody>

        </table>
    </div>





    <div class="CARA Coalitions"
        style="  padding-top:40px; padding-button:40px;margin-left: 80px;margin-right: 80px;margin-bottom: 50px;">

        <h1>CARA Coalitions</h1>

        <table id="Table-CC" class="table table-striped" style="width:100%">

            <thead>
                <tr>
                    <th>Coalitions state</th>
                    <th>city/town</th>
                    <th>Receipient Name</th>
                    <th>Coalition Name</th>

                </tr>
            </thead>
            <thead>
                <tr>
                    <th>
                        <input type="text" id="filter-state-CC" placeholder="Filter by State" class="form-control">
                    </th>
                    <th>
                        <input type="text" id="filter-city-CC" placeholder="Filter by City" class="form-control">
                    </th>
                    <th>
                        <input type="text" id="filter-receipient-CC" placeholder="Filter by Recipient"
                            class="form-control">
                    </th>
                    <th>
                        <input type="text" id="filter-coalition-CC" placeholder="Filter by Coalition"
                            class="form-control">
                    </th>
                </tr>
            </thead>


            <tbody>
                @foreach ($CARACoalitions as $place)
                    <tr>
                        <td>{{ $place->NewEnglandStates->state }}</td>
                        <td>{{ $place->city }}</td>
                        <td>{{ $place->receipient_name }}</td>
                        <td>{{ $place->projectname }}</td>

                    </tr>
                @endforeach


            </tbody>

        </table>
    </div>



    <div class="National Guard Counter Drug"
        style="  padding-top:40px; padding-button:40px;margin-left: 80px;margin-right: 80px;margin-bottom: 50px;">

        <h1>National Guard Counter Drug</h1>

        <table id="Table-NGCD" class="table table-striped" style="width:100%">

            <thead>
                <tr>
                    <th>Coalitions state</th>
                    <th>city/town</th>
                    <th>Receipient Name</th>
                    <th>Coalition Name</th>

                </tr>
            </thead>
            <thead>

                <tr>
                    <th>
                        <input type="text" id="filter-state-NGCD" placeholder="Filter by State"
                            class="form-control">
                    </th>
                    <th>
                        <input type="text" id="filter-city-NGCD" placeholder="Filter by City"
                            class="form-control">
                    </th>
                    <th>
                        <input type="text" id="filter-receipient-NGCD" placeholder="Filter by Recipient"
                            class="form-control">
                    </th>
                    <th>
                        <input type="text" id="filter-coalition-NGCD" placeholder="Filter by Coalition"
                            class="form-control">
                    </th>
                </tr>
            </thead>


            <tbody>
                @foreach ($NGCD as $place)
                    <tr>
                        <td>{{ $place->NewEnglandStates->state }}</td>
                        <td>{{ $place->city }}</td>
                        <td>{{ $place->receipient_name }}</td>
                        <td>{{ $place->projectname }}</td>

                    </tr>
                @endforeach



            </tbody>

        </table>
    </div>




    <div class="States Initiatives"
        style="  padding-top:40px; padding-button:40px;margin-left: 80px;margin-right: 80px;margin-bottom: 50px;">

        <h1>States Initiatives</h1>

        <table id="Table-SI" class="table table-striped" style="width:100%">

            <thead>
                <tr>
                    <th>Coalitions state</th>
                    <th>city/town</th>
                    <th>Receipient Name</th>
                    <th>Coalition Name</th>

                </tr>
            </thead>
            <thead>
                <tr>
                    <th>
                        <input type="text" id="filter-state-SI" placeholder="Filter by State"
                            class="form-control">
                    </th>
                    <th>
                        <input type="text" id="filter-city-SI" placeholder="Filter by City" class="form-control">
                    </th>
                    <th>
                        <input type="text" id="filter-receipient-SI" placeholder="Filter by Recipient"
                            class="form-control">
                    </th>
                    <th>
                        <input type="text" id="filter-coalition-SI" placeholder="Filter by Coalition"
                            class="form-control">
                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($StatesInitiatives as $place)
                    <tr>
                        <td>{{ $place->NewEnglandStates->state }}</td>
                        <td>{{ $place->city }}</td>
                        <td>{{ $place->receipient_name }}</td>
                        <td>{{ $place->projectname }}</td>

                    </tr>
                @endforeach


            </tbody>

        </table>
    </div>


    <div class="Local Initiatives"
        style="  padding-top:40px; padding-button:40px;margin-left: 80px;margin-right: 80px;margin-bottom: 50px;">

        <h1>Local Initiatives</h1>

        <table id="Table-NI" class="table table-striped" style="width:100%">

            <thead>
                <tr>
                    <th>Coalitions state</th>
                    <th>city/town</th>
                    <th>Receipient Name</th>
                    <th>Coalition Name</th>

                </tr>
            </thead>
            <thead>
                <tr>
                    <th>
                        <input type="text" id="filter-state-NI" placeholder="Filter by State"
                            class="form-control">
                    </th>
                    <th>
                        <input type="text" id="filter-city-NI" placeholder="Filter by City" class="form-control">
                    </th>
                    <th>
                        <input type="text" id="filter-receipient-NI" placeholder="Filter by Recipient"
                            class="form-control">
                    </th>
                    <th>
                        <input type="text" id="filter-coalition-NI" placeholder="Filter by Coalition"
                            class="form-control">
                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($LocalInitiatives as $place)
                    <tr>
                        <td>{{ $place->NewEnglandStates->state }}</td>
                        <td>{{ $place->city }}</td>
                        <td>{{ $place->receipient_name }}</td>
                        <td>{{ $place->projectname }}</td>

                    </tr>
                @endforeach


            </tbody>

        </table>--}}
    {{-- </div>  --}}
</main>

{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {

        function filterTable(inputId, columnNumber, tableId) {
            const input = document.getElementById(inputId);
            const filter = input.value.toLowerCase();
            const table = document.getElementById(tableId);
            const tr = table.getElementsByTagName('tr');

            for (let i = 1; i < tr.length; i++) {
                const td = tr[i].getElementsByTagName('td')[columnNumber];
                if (td) {
                    const textValue = td.textContent || td.innerText;
                    tr[i].style.display = textValue.toLowerCase().indexOf(filter) > -1 ? '' : 'none';
                }

            }
        }

        // Event listeners for Table 1 (Drug-Free Communities Coalitions)------------------------------------------------------->
        document.getElementById('filter-state-DFCC').addEventListener('keyup', function() {
            filterTable('filter-state-DFCC', 0, 'Table-DFCC');
        });

        document.getElementById('filter-city-DFCC').addEventListener('keyup', function() {
            filterTable('filter-city-DFCC', 1, 'Table-DFCC');
        });

        document.getElementById('filter-receipient-DFCC').addEventListener('keyup', function() {
            filterTable('filter-receipient-DFCC', 2, 'Table-DFCC');
        });

        document.getElementById('filter-coalition-DFCC').addEventListener('keyup', function() {
            filterTable('filter-coalition-DFCC', 3, 'Table-DFCC');
        });

        // Event listeners for Table 2 (CARA Coalitions)---------------------------------------------------------------------------->
        document.getElementById('filter-state-CC').addEventListener('keyup', function() {
            filterTable('filter-state-CC', 0, 'Table-CC');

        });

        document.getElementById('filter-city-CC').addEventListener('keyup', function() {
            filterTable('filter-city-CC', 1, 'Table-CC');

        });

        document.getElementById('filter-receipient-CC').addEventListener('keyup', function() {
            filterTable('filter-receipient-CC', 2, 'Table-CC');

        });

        document.getElementById('filter-coalition-CC').addEventListener('keyup', function() {
            filterTable('filter-coalition-CC', 3, 'Table-CC');

        });

        // Event listeners for Table 3 (National Guard Counter Drug)----------------------------------------------------------------->
        document.getElementById('filter-state-NGCD').addEventListener('keyup', function() {
            filterTable('filter-state-NGCD', 0, 'Table-NGCD');
        });

        document.getElementById('filter-city-NGCD').addEventListener('keyup', function() {
            filterTable('filter-city-NGCD', 1, 'Table-NGCD');
        });

        document.getElementById('filter-receipient-NGCD').addEventListener('keyup', function() {
            filterTable('filter-receipient-NGCD', 2, 'Table-NGCD');
        });

        document.getElementById('filter-coalition-NGCD').addEventListener('keyup', function() {
            filterTable('filter-coalition-NGCD', 3, 'Table-NGCD');
        });
        // Event listeners for Table 4 (States Initiatives)----------------------------------------------------------------->

        document.getElementById('filter-state-SI').addEventListener('keyup', function() {
            filterTable('filter-state-SI', 0, 'Table-SI');
        });

        document.getElementById('filter-city-SI').addEventListener('keyup', function() {
            filterTable('filter-city-SI', 1, 'Table-SI');
        });

        document.getElementById('filter-receipient-SI').addEventListener('keyup', function() {
            filterTable('filter-receipient-SI', 2, 'Table-SI');
        });

        document.getElementById('filter-coalition-SI').addEventListener('keyup', function() {
            filterTable('filter-coalition-SI', 3, 'Table-SI');
        });

        //Event listeners for Table 5 (local Initiatives)--------------------------------------------------------------------->
        document.getElementById('filter-state-NI').addEventListener('keyup', function() {
            filterTable('filter-state-NI', 0, 'Table-NI');
        });

        document.getElementById('filter-city-NI').addEventListener('keyup', function() {
            filterTable('filter-city-NI', 1, 'Table-NI');
        });

        document.getElementById('filter-receipient-NI').addEventListener('keyup', function() {
            filterTable('filter-receipient-NI', 2, 'Table-NI');
        });

        document.getElementById('filter-coalition-NI').addEventListener('keyup', function() {
            filterTable('filter-coalition-NI', 3, 'Table-NI');
        });

    });
</script> --}}



@include('NewEngland.layout.footer')
