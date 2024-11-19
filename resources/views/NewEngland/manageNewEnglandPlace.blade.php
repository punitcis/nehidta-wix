
@extends('admin.layout.base')

@section('content')

    @include('admin.layout.header')
    @include('admin.layout.sidebar')

    <div class="container mt-2">

        <!-- Success Message -->
        {{-- @if ($message = Session::get('success'))
     <div class="alert alert-success" id="success-alert">
        {{ $message }}
     </div>
        @endif --}}

        @if ($message = Session::get('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ $message }}',
                timer: 4000,
                showConfirmButton: false,
                toast: true,
                position: 'top',
        
             
            });
        });
    </script>
@endif


        <!-- Error Messages -->
        <div id="error-message" class="alert alert-danger" style="display: none;"></div>

{{-- 

        @if ($errors->any())
            <div id="error-block" class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}

        @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'ERRor!',
                    text: 'some thing went wrong ',
                    timer: 9000,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top',
            
                 
                });
            });
        </script>
    @endif
    
<div class=adminMain >

<form action="{{ isset($place) ? route('NewEnglandplace.update', $place->id) : route('NewEnglandplace.store') }}" method="POST" enctype="multipart/form-data" data-parsley-validate>
    @csrf
    @if(isset($place))
        @method('PUT')
    @endif
    <div class="card-body">
        <h1 id="contain" style="text-align:center">{{ isset($place) ? 'Edit Places of New England' : 'Add Places of New England' }}</h1>

        <div class="form-group">
            <label for="new_england_state_id">State: <span style="color: red;">*</span></label>
            @error('new_england_state_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <select name="new_england_state_id" class="form-control" id="new_england_state_id" data-parsley-required="true">
                <option value="">Select a state</option>
                @foreach ($states as $state)
                    <option value="{{ $state->id }}" {{ (isset($place) && $place->new_england_state_id == $state->id) || old('new_england_state_id') == $state->id ? 'selected' : '' }}>{{ $state->state }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="address">ADDRESS: <span style="color: red;">*</span></label>
            @error('address')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <input type="text" class="form-control" name="address" id="address" value="{{ old('address', isset($place) ? $place->address : '') }}" data-parsley-required="true">
        </div>

        <div class="form-group">
            <label for="city">CITY/TOWN: <span style="color: red;">*</span></label>
            @error('city')
                <div class="text-danger" id='err-city'>{{ $message }}</div>
            @enderror
            <input type="text" class="form-control" name="city" id="city" value="{{ old('city', isset($place) ? $place->city : '') }}" data-parsley-required="true">
        </div>

        <div class="form-group">
            <label for="project_name">Project Name: <span style="color: red;">*</span></label>
            @error('project_name')
                <div class="text-danger" id="err-projectname">{{ $message }}</div>
            @enderror
            <input type="text" class="form-control" name="project_name" id="project_name" value="{{ old('project_name', isset($place) ? $place->project_name : '') }}" data-parsley-required="true">
        </div>

        <div class="form-group">
            <label for="project_type">Select Coalitions Type: <span style="color: red;">*</span></label>
            @error('project_type')
                <div class="text-danger" id='err-project_type'>{{ $message }}</div>
            @enderror
            <select name="project_type" class="form-control" id="project_type" data-parsley-required="true">
                <option value="">Select project type</option>
                <option value="Drug Free Communities Coalitions" {{ (isset($place) && $place->project_type == 'Drug Free Communities Coalitions') || old('project_type') == 'Drug Free Communities Coalitions' ? 'selected' : '' }}>Drug Free Communities Coalitions</option>
                <option value="CARA Coalitions" {{ (isset($place) && $place->project_type == 'CARA Coalitions') || old('project_type') == 'CARA Coalitions' ? 'selected' : '' }}>CARA Coalitions</option>
                <option value="National Guard Counter Drug" {{ (isset($place) && $place->project_type == 'National Guard Counter Drug') || old('project_type') == 'National Guard Counter Drug' ? 'selected' : '' }}>National Guard Counter Drug</option>
                <option value="States Initiatives" {{ (isset($place) && $place->project_type == 'States Initiatives') || old('project_type') == 'States Initiatives' ? 'selected' : '' }}>States Initiatives</option>
                <option value="Local Initiatives" {{ (isset($place) && $place->project_type == 'Local Initiatives') || old('project_type') == 'Local Initiatives' ? 'selected' : '' }}>Local Initiatives</option>
            </select>
        </div>

        <div class="form-group">
            <label for="project_target">Project Target: <span style="color: red;">*</span></label>
            @error('project_target')
                <div class="text-danger" id='err-project_target'>{{ $message }}</div>
            @enderror
            <select name="project_target[]" id="project_target" class="form-control select2" multiple="multiple" data-parsley-required="true" style="width: 100%;">
                <option value="">Select project Target</option>
                @php
                    // If the place's project_target is a comma-separated string, convert it to an array
                    $selectedTargets = isset($place) && !empty($place->project_target) 
                        ? array_map('trim', explode(',', $place->project_target)) 
                        : [];
                @endphp
                <option value="Alcohol" {{ in_array('Alcohol', old('project_target', $selectedTargets)) ? 'selected' : '' }}>Alcohol</option>
                <option value="Marijuana/Cannabis" {{ in_array('Marijuana/Cannabis', old('project_target', $selectedTargets)) ? 'selected' : '' }}>Marijuana/Cannabis</option>
                <option value="Tobacco/nicotine" {{ in_array('Tobacco/nicotine', old('project_target', $selectedTargets)) ? 'selected' : '' }}>Tobacco/nicotine</option>
                <option value="Heroin and fentanyl" {{ in_array('Heroin and fentanyl', old('project_target', $selectedTargets)) ? 'selected' : '' }}>Heroin and fentanyl</option>
                <option value="Methamphetamine" {{ in_array('Methamphetamine', old('project_target', $selectedTargets)) ? 'selected' : '' }}>Methamphetamine</option>
            </select>
        </div>
        

        <div class="form-group">
            <label for="contact">Contact: <span style="color: red;">*</span></label>
            @error('contact')
                <div class="text-danger" id='err-contact'>{{ $message }}</div>
            @enderror
            <input type="text" class="form-control" name="contact" id="contact" value="{{ old('contact', isset($place) ? $place->contact : '') }}" data-parsley-required="true">
        </div>

        <div class="form-group">
            @error('year')
                <div class="text-danger" id='err-year'>{{ $message }}</div>
            @enderror
            <label for="year">Year: <span style="color: red;">*</span></label>
            <input type="number" class="form-control" name="year" id="year" value="{{ old('year', isset($place) ? $place->year : '') }}" data-parsley-required="true">
        </div>

        <div class="form-group">
            <label for="receipient_name">Receipient Name:</label>
            @error('receipient_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <input type="text" class="form-control" name="receipient_name" id="receipient_name" value="{{ old('receipient_name', isset($place) ? $place->receipient_name : '') }}">
        </div>

        <div class="form-group">
            <label for="project_link">Project Link: </label>
            @error('project_link')
                <div class="text-danger" id='err-project_link'>{{ $message }}</div>
            @enderror
            <input type="url" class="form-control" name="project_link" id="project_link" value="{{ old('project_link', isset($place) ? $place->project_link : '') }}" placeholder="https://example.com" data-parsley-required="true">
        </div>

        <div class="form-group">
            <label for="facebook_link">Facebook Link:</label>
            @error('facebook_link')
                <div class="text-danger" id='err-facebook_link'>{{ $message }}</div>
            @enderror
            <input type="url" class="form-control" name="facebook_link" id="facebook_link" value="{{ old('facebook_link', isset($place) ? $place->facebook_link : '') }}" placeholder="https://example.com">
        </div>

        <div class="form-group">
            <label for="youtube_link">Youtube Link:</label>
            @error('youtube_link')
                <div class="text-danger" id='err-youtube_link'>{{ $message }}</div>
            @enderror
            <input type="url" class="form-control" name="youtube_link" id="youtube_link" value="{{ old('youtube_link', isset($place) ? $place->youtube_link : '') }}" placeholder="https://example.com">
        </div>

        

        <div class="form-group">
            @error('description')
                <div class="text-danger" id='err-description'>{{ $message }}</div>
            @enderror
            <label for="year">Add Note</label>
            <input type="text" class="form-control" name="description" id="description" value="{{ old('description', isset($place) ? $place->description : '') }}" placeholder="Enter a detailed description here..." data-parsley-required="true">
        </div>


        <input type="hidden" name="lat" id="lat" value="{{ old('lat', isset($place) ? $place->lat : '') }}">
        <input type="hidden" name="lng" id="lng" value="{{ old('lng', isset($place) ? $place->lng : '') }}">
    </div>

  
        <button type="submit" class="btn btn-primary" id="saveButton" disabled>{{ isset($place) ? 'Update Place' : 'Add Place' }}</button>
  
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
                <td class="actions">
                    <div style="display: flex; gap: 10px;"> <!-- Using flexbox with gap -->
                        <form id="deleteForm" class="deleteForm" action="{{ route('NewEnglandplace.delete', $place->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger" id="deleteButton">Delete</button>
                        </form>
                   
                        
                        <a href="{{ route('NewEnglandplace.edit', $place->id) }}" class="btn btn-success">Edit</a>
                    </div>
                </td>
                
                    
                   
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Pagination -->
<div class="pagination-container" style="margin-bottom: 50px">
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

</div>

        <!-- Leaflet and jQuery Scripts -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Location Validation Script -->
    <script src="{{asset('NewEnglandMap/js/newEnglandPlace.js')}}"></script>
   
@endsection