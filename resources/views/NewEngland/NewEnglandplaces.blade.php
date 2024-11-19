@extends('admin.layout.base')

@section('content')

    @include('admin.layout.header')
    @include('admin.layout.sidebar')

    <div class="container mt-2">

        <!-- Success Message -->
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                {{ $message }}
            </div>
        @endif

        <!-- Error Messages -->
        <div id="error-message" class="alert alert-danger" style="display: none;"></div>



        @if ($errors->any())
            <div id="error-block" class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form action="{{ route('NewEnglandplace.store') }}" method="POST" enctype="multipart/form-data" data-parsley-validate>
            @csrf
            <div class="card-body">
                <h1 id= "contain" style="text-align:center">ADD Places of NEW ENGLAND</h1>




                <div class="form-group">
                    <label for="new_england_state_id">States: *</label>
                    @error('new_england_state_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <select name="new_england_state_id" class="form-control" id="new_england_state_id"
                        data-parsley-required="true">
                        <option value="">Select a state </option>
                        @foreach ($states as $state)
                            <option value="{{ $state->id }}"
                                {{ old('new_england_state_id') == $state->id ? 'selected' : '' }}>{{ $state->state }}
                            </option>
                        @endforeach
                    </select>
                </div>

     

                <div class="form-group">

                    <label for="address">ADDRESS: *</label>
                    @error('address')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <input type="text" class="form-control" name="address" id="address" value="{{ old('address') }}"
                        data-parsley-required="true">
                </div>
                <div class="form-group">

                    <label for="city">CITY/TOWN: *</label>
                    @error('city')
                        <div class="text-danger" id='err-city'>{{ $message }}</div>
                    @enderror
                    <input type="text" class="form-control" name="city" id="city" value="{{ old('city') }}"
                        data-parsley-required="true">
                </div>




                <div class="form-group">

                    <label for="project_name">Project Name: *</label>
                    @error('project_name')
                        <div class="text-danger" id="err-projectname">{{ $message }}</div>
                    @enderror
                    <input type="text" class="form-control" name="project_name" id="project_name"
                        value="{{ old('project_name') }}" data-parsley-required="true">
                </div>
                <div class="form-group">

                    <label for="project_type">Select Coalitions Type: *</label>
                    @error('project_type')
                        <div class="text-danger" id='err-project_type'>{{ $message }}</div>
                    @enderror
                    <select name="project_type" class="form-control" id="project_type" data-parsley-required="true">
                        <option value="">Select project type</option>
                        <option value="Drug Free Communities Coalitions"
                            {{ old('project_type') == 'Drug Free Communities Coalitions' ? 'selected' : '' }}>Drug Free
                            Communities Coalitions</option>
                        <option value="CARA Coalitions" {{ old('project_type') == 'CARA Coalitions' ? 'selected' : '' }}>
                            CARA Coalitions</option>
                        <option value="National Guard Counter Drug"
                            {{ old('project_type') == 'National Guard Counter Drug' ? 'selected' : '' }}>National Guard
                            Counter Drug</option>
                        <option value="States Initiatives"
                            {{ old('project_type') == 'States Initiatives' ? 'selected' : '' }}>States Initiatives</option>
                        <option value="Local Initiatives"
                            {{ old('project_type') == 'Local Initiatives' ? 'selected' : '' }}>Local Initiatives</option>
                    </select>
                </div>
                

                <div class="form-group">
                    <label for="project_target">Project Target: *</label>
                    @error('project_target')
                        <div class="text-danger" id='err-project_target'>{{ $message }}</div>
                    @enderror
                    <select name="project_target[]" id="project_target" class="form-control select2" multiple="multiple" data-parsley-required="true" style="width: 100%;">
                        <option value="">Select project Target</option>
                        <option value="Alcohol" {{ in_array('Alcohol', old('project_target', [])) ? 'selected' : '' }}>Alcohol</option>
                        <option value="Marijuana/Cannabis" {{ in_array('Marijuana/Cannabis', old('project_target', [])) ? 'selected' : '' }}>Marijuana/Cannabis</option>
                        <option value="Tobacco/nicotine" {{ in_array('Tobacco/nicotine', old('project_target', [])) ? 'selected' : '' }}>Tobacco/nicotine</option>
                        <option value="Heroin and fentanyl" {{ in_array('Heroin and fentanyl', old('project_target', [])) ? 'selected' : '' }}>Heroin and fentanyl</option>
                        <option value="Methamphetamine" {{ in_array('Methamphetamine', old('project_target', [])) ? 'selected' : '' }}>Methamphetamine</option>
                    </select>
                </div>


                <div class="form-group">
                    <label for="contact">Contact: *</label>
                    @error('contact')
                        <div class="text-danger" id='err-contact'>{{ $message }}</div>
                    @enderror
                    <input type="text" class="form-control" name="contact" id="contact" value="{{ old('contact') }}"
                        data-parsley-required="true">
                </div>

                <div class="form-group">
                    <label for="receipient_name">Receipient Name:</label>
                    @error('receipient_name"')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <input type="text" class="form-control" name="receipient_name" id="receipient_name"
                        value="{{ old('receipient_name') }}" data-parsley-required="true">
                </div>

                <div class="form-group">
                    <label for="project_link">Project Link: *</label>
                    @error('project_link')
                        <div class="text-danger" id='err-project_link'>{{ $message }}</div>
                    @enderror
                    <input type="url" class="form-control" name="project_link" id="project_link"
                        value="{{ old('project_link') }}" placeholder="https://example.com" data-parsley-required="true">
                </div>


                <div class="form-group">
                    <label for="facebook_link">Facebook Link: </label>
                    @error('facebook_link')
                        <div class="text-danger" id='err-facebook_link'>{{ $message }}</div>
                    @enderror
                    <input type="url" class="form-control" name="facebook_link" id="facebook_link"
                        value="{{ old('facebook_link') }}" placeholder="https://example.com" data-parsley-required="true">
                </div>


                <div class="form-group">
                    <label for="youtube_link">Youtube Link: </label>
                    @error('youtube_link')
                        <div class="text-danger" id='err-youtube_link'>{{ $message }}</div>
                    @enderror
                    <input type="url" class="form-control" name="youtube_link" id="youtube_link"
                        value="{{ old('youtube_link') }}" placeholder="https://example.com" data-parsley-required="true">
                </div>


                <div class="form-group">
                    @error('year')
                        <div class="text-danger" id='err-year'>{{ $message }}</div>
                    @enderror
                    <label for="year">Year: *</label>
                    <input type="number" class="form-control" name="year" id="year" value="{{ old('year') }}"
                        data-parsley-required="true">
                </div>

                <div class="form-group">
                    @error('description')
                        <div class="text-danger" id='err-year'>{{ $message }}</div>
                    @enderror
                    <label for="description">Add Note: </label>
                    <input type="text" class="form-control" name="description" id="description" value="{{ old('description') }}"
                        data-parsley-required="true">
                </div>


                <input type="hidden" name="lat" id="lat" value="{{ old('lat') }}" required>
                <input type="hidden" name="lng" id="lng" value="{{ old('lng') }}" required>

                <div class="form-group" style="margin-top: 25px;">
                    <button type="submit" class="btn btn-primary" id="saveButton" disabled>Add Place</button>
                </div>
            </div>
        </form>

        <!-- Places Table -->
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Place Name</th>
                    <th>State</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $serial = ($places->currentPage() - 1) * $places->perPage() + 1;
                @endphp
                @foreach ($places as $place)
            
                    <tr>
                    
                        <td>{{ $serial++ }}</td>
                        <td>{{ $place->address }}</td>
                        <td>{{ $place->NewEnglandStates->state }}</td>



                        <td>{{ $place->lat }}</td>
                        <td>{{ $place->lng }}</td>
                        <td>
                            <form action="{{ route('NewEnglandplace.delete', $place->id) }}" method="POST"
                                onsubmit="return confirmDelete()">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            <button class="btn btn-success" id= "updateButton">
                                <a href="{{ route('NewEnglandplace.edit', $place->id) }}" style="color: white; text-decoration: none;">
                                    Update
                                </a>
                            </button>
                            
                           
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="pagination-container">
            @if ($places->onFirstPage())
                <span>Previous</span>
            @else
                <a href="{{ $places->previousPageUrl() }}" class="btn btn-secondary">Previous</a>
            @endif

            @if ($places->hasMorePages())
                <a href="{{ $places->nextPageUrl() }}" class="btn btn-secondary">Next</a>
            @else
                <span>Next</span>
            @endif
        </div>
       
    </div>

    <!-- Leaflet and jQuery Scripts -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
       <!-- Location Validation Script -->
    <script src="{{asset('NewEnglandMap/js/newEnglandPlace.js')}}"></script>
 
   

@endsection
