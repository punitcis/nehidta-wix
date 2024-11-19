<!DOCTYPE html>
<html lang="en">

<head>
    <title>Locations | New England HIDTA</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Meta -->
    <meta name="keywords" content="" />
    <meta name="author" content="">
    <meta name="robots" content="" />
    <meta name="description" content="" />

    <!-- this styles only adds some repairs on idevices  -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon.ico">

    <!-- Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- font-family: "Rozha One", system-ui; -->
    <link href="https://fonts.googleapis.com/css2?family=Rozha+One&display=swap" rel="stylesheet">
    <!-- font-family: "Manrope", sans-serif; -->
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    <!-- font-family: "Open Sans" -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


   
    {{-- datatable --}}
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

   <link href="https://cdn.datatables.net/2.1.7/css/dataTables.bootstrap5.css" rel="stylesheet"> --}}

   {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.css"> --}}

 {{-- adminlte select2 --}}
   <link rel="stylesheet" href="{{asset('adminportal/plugins/select2/css/select2.min.css')}}">
   <link rel="stylesheet" href="{{asset('adminportal/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">


    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="assets/css/nehidta1.css">
    <link rel="stylesheet" type="text/css" href="NewEnglandMap/css/NewEnglandMap.css">


    {{-- favicon --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    
    
</head>

<body>
    @yield('content')

    <script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="assets/js/custom.js"></script>
    <script type="text/javascript" src="NewEnglandMap/js/NewEngland.js"></script>


    <script  src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

 {{-- datatable --}}
    {{-- <script src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.bootstrap5.js" type="text/javascript"></script> --}}

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script> --}}



    <!-- Bootstrap4 Duallistbox -->
<script src="{{asset('adminportal/plugins/select2/js/select2.full.min.js')}}"></script>
{{-- <script src="{{asset('adminportal/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script> --}}

{{-- 
      <script>
       
        	
      new DataTable('#Table-DFCC');
      new DataTable('#Table-CC');
      new DataTable('#Table-NGCD');
      new DataTable('#Table-SI');
      new DataTable('#Table-NI');
     
      
        </script>  --}}

    {{-- <script>
        
    

        document.getElementById('investigativeLink').addEventListener('click', function() {
            window.open('https://www.nehidta.org/enforcement-initiatives', '_self');
        });--}}

        <script>
            $(document).ready(function() {
                $('#project_target_filter').select2({
                    placeholder: 'Select Project Target',  // Placeholder text for the dropdown
                    allowClear: true,                      // Adds a clear button to remove selected values
                    // width: '260px', 
                                       // Set the width of the select box
                });
            });
        </script>
        
    </script> 
</body>

</html>