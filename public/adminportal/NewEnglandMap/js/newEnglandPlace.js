
// function confirmDelete() {
//     return confirm("Are you sure you want to delete this place?");
// }
// Select all delete buttons with the class 'deleteButton'
document.querySelectorAll('#deleteButton').forEach(function(button) {
    button.addEventListener('click', function(e) {
        e.preventDefault();
        
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: "btn btn-success",
              cancelButton: "btn btn-danger"
            },
            buttonsStyling: false
        });
        
        swalWithBootstrapButtons.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                swalWithBootstrapButtons.fire({
                    title: "Deleted!",
                    text: "Your data has been deleted.",
                    icon: "success"
                }).then(() => {
                    // Find and submit the form related to the clicked button
                    this.closest('form').submit();
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire({
                    title: "Cancelled",
                    text: "Your data is safe :)",
                    icon: "error"
                });
            }
        });
    });
});


$(document).ready(function() {

    $('#project_target').select2({
    theme: 'bootstrap4', 
    placeholder: 'Select Project Target',
    allowClear: true,  
    width: '100%' 
});

    var englandstates = $('#new_england_state_id').val();
    var address = $('#address').val();
    
    if (englandstates != '' && address != '') {

        processLocation();

    }
   
    function handleUpdate() {
        resetBoundingBox(); 
        processLocation(); 
    }

   
    $('#updateButton').on('click', function() {
        handleUpdate();
    });


    let errorTimer;

    function resetBoundingBox() {
        $('#lat').val('');
        $('#lng').val('');
        $('#saveButton').prop('disabled', true).removeClass('btn-success').addClass('btn-primary');
        console.log('Bounding box values reset.');
    }

    function hideErrorMessage() {
        $('#error-message').hide();
    }

    function showErrorMessage(message) {
        $('#error-message').text(message).show();
    }

    function getStateBoundingBox(stateName, callback) {
        var stateBoundingBoxUrl =
            `https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(stateName)}&format=json&limit=1`;

        $.ajax({
            url: stateBoundingBoxUrl,
            method: 'GET',
            success: function(stateData) {
                if (stateData && stateData.length > 0 && stateData[0].boundingbox) {
                    var stateBoundingBox = stateData[0].boundingbox;
                    var minLat = parseFloat(stateBoundingBox[0]);
                    var maxLat = parseFloat(stateBoundingBox[1]);
                    var minLon = parseFloat(stateBoundingBox[2]);
                    var maxLon = parseFloat(stateBoundingBox[3]);

                    callback(minLat, maxLat, minLon, maxLon);
                } else {
                    resetBoundingBox();
                    showErrorMessage(
                        'State bounding box not found or API returned no results.');
                }
            },
            error: function() {
                resetBoundingBox();
                showErrorMessage('An error occurred during the state geocoding process.');
            }
        });
    }


    function processLocation() {

        var placeName = $('#address').val();
        var stateName = $('#new_england_state_id option:selected').text().trim();

      

        if (!placeName || placeName.length <= 2) {
            // showErrorMessage('Please enter a valid place name.');
            
            return;
        }


        if (!stateName || stateName === "Select a state") {
            showErrorMessage('Please select a valid state.');
            // return;
        }
        getStateBoundingBox(stateName, function(minLat, maxLat, minLon, maxLon) {
            var placeGeocodeUrl =
                `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(placeName)}&addressdetails=1`;

            $.ajax({
                url: placeGeocodeUrl,
                method: 'GET',
                success: function(placeData) {
                    if (placeData && placeData.length > 0) {
                        var lat = parseFloat(placeData[0].lat);
                        var lon = parseFloat(placeData[0].lon);
                        var address = placeData[0].address;

                        $('#lat').val(lat);
                        $('#lng').val(lon);

                        var placeState = address.state;

                        if (placeState === stateName && lat >= minLat && lat <=
                            maxLat && lon >= minLon && lon <= maxLon) {
                            console.log('Location is within the selected state.');
                            hideErrorMessage();
                            $('#saveButton').prop('disabled', false).removeClass(
                                'btn-primary').addClass('btn-success');
                                console.log("the processLocation is working");
                            if (errorTimer) {
                                clearTimeout(errorTimer);
                                errorTimer = null;
                            }
                        } else {
                        
                            console.log(
                                'Location does not match the selected state or is outside the bounding box.'
                            );
                            resetBoundingBox();
                            showErrorMessage(
                                `The place "${placeName}" does not match the selected state "${stateName}". Please ensure the place is valid .`
                            );
                        }
                    } else {
                        resetBoundingBox();
                        showErrorMessage('Unable to find the specified place.');
                    }
                },
                error: function() {
                    resetBoundingBox();
                    showErrorMessage(
                        'An error occurred during the place geocoding process.');
                }
            });



        });


    }





    $('#address, #new_england_state_id').on('change', function() {
        processLocation();



    });




    // error message customization----------------------------------------------------------------------------------------------->>>

    $('input, select').on('input change', function() {
        $('#error-block').fadeOut('slow');
    });


    $('#year').on('input change', function() {
        $('#err-year').hide(1000);
    });

    $('#project_link').on('input change', function() {
        $('#err-project_link').hide(1000);
    });

    $('#project_name').on('input change', function() {
        $('#err-project_name').hide(1000);
    });

    $('#project_type').on('input change', function() {
        $('#err-project_type').hide(1000);
    });
    $('#project_target').on('input change', function() {
        $('#err-project_target').hide(1000);
    });

    $('#city').on('input change', function() {
        $('#err-city').hide(1000);
    });

    $('#contact').on('input change',function(){
        $('#err-contact').hide(1000);

    });
  




});


$(document).ready(function(){
    let overlay = document.createElement("div");
    overlay.id = "sidebar-overlay";
    $("body").append(overlay);
    $("#sidebar-overlay").click(function(){
        $('[data-widget="pushmenu"]').click();
    });
});

