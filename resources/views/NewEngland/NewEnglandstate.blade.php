@extends('admin.layout.base')

@section('content')
{{-- 
    @include('admin.layout.header')
    @include('admin.layout.sidebar') --}}

    <div class="container mt-2 " style="height:800px">

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                {{ $message }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{route('NewEnglandstate.store')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="card-body">
                <h1 style="text-align:center;">ADD state</h1>

                <div class="form-group">
                    <label for="name">State Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter state name" id="name" required>
                </div>

                <div class="form-group">
                    <label for="geojson">GeoJSON File:</label>
                    <input type="file" class="form-control" name="geojson" placeholder="Add your JSON file" id="geojson" accept=".json" required>
                </div>

                <div class="card-footer" style="margin-top: 25px;">
                    <button type="submit" class="btn btn-primary">Add state</button>
                </div>

            </div>

        </form>

    </div>

@endsection
