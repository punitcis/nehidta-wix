function initMap() {
    map = L.map("map", {
        scrollWheelZoom: false ,
        doubleClickZoom: false,
        dragging: false,
        zoomControl: false,
        minZoom: 6, // Set minimum zoom level
        maxZoom: 12, // Set maximum zoom level
        keyboard: false, // Enable keyboard controls (arrow keys for panning, + and - for zoom)
        zoomAnimation: true, // Enable smooth zoom animations
        boxZoom: false, // Enable zooming to a box (shift+drag to zoom)
        inertia: true, // Smooth panning when dragging
        tap: false,// Enable tap for mobile devices
     
}).setView([44.2300, -70.5491], 6);

window.addEventListener('resize', () => {
    map.invalidateSize();
}); 

    jQuery("#project_target_filter").on('change', function(){
        handleFilterChange();
    });
 

    L.control.zoom({
        position: 'bottomright'  
    }).addTo(map);

    markersLayer = L.layerGroup().addTo(map);

    loadAllStates();
    loadAllPlaces();

    document.querySelectorAll(".list-item").forEach((item) => {
        item.addEventListener("click", function () {
            const state = this.textContent;
            loadToState(state);
            highlightState(state);
            updateDisplay(state);
        });
    });

    document .getElementById("clearButton").addEventListener("click", function () {
            if (currentGeoJsonLayer) {
                map.removeLayer(currentGeoJsonLayer);
                currentGeoJsonLayer = null;
            }

            document.getElementById("display").textContent =
                "Select a state or territory";
            const listItems = document.querySelectorAll(".list-item");
            listItems.forEach((item) => {
                item.classList.remove("highlight");
            });

            map.setView([44.2300, -70.5491], 6);
            markersLayer.clearLayers();
            loadAllPlaces();
            hideClearButton()

            document.getElementById("search-bar").value = "";
            filterLists("");

            document.getElementById("state-list").style.display = "block";
            document.getElementById("places-list").style.display = "none";
            
        });

       
        
     

        function handleFilterChange() {
      
            if (currentGeoJsonLayer) {
                map.removeLayer(currentGeoJsonLayer);
                currentGeoJsonLayer = null;
            }
       
            document.getElementById("display").textContent =
                "Select a state or territory";
            const listItems = document.querySelectorAll(".list-item");
            listItems.forEach((item) => {
                item.classList.remove("highlight");
            });
        
            map.setView([44.2300, -70.5491], 6);
            markersLayer.clearLayers();
            loadAllPlaces();
        
            document.getElementById("search-bar").value = "";
            filterLists("");
        
            document.getElementById("state-list").style.display = "block";
            document.getElementById("places-list").style.display = "none";
        }
        
        
           document.getElementById("project_type_filter").addEventListener("click", handleFilterChange);

           document .getElementById("search-bar").addEventListener("input", function () {
             const query = this.value.toLowerCase();
             filterLists(query);
           });
}

function hideClearButton() {
    const clearButton = document.getElementById("clearButton");
    if (clearButton) {
        clearButton.style.display = "none";  // Make the button visible
    }
}

function showClearButton() {
    const clearButton = document.getElementById("clearButton");
    if (clearButton) {
        clearButton.style.display = "block";  // Make the button visible
    }
}

function filterLists(query) {

    document.querySelectorAll("#state-list .list-item").forEach((item) => {
        const stateMatch = item.textContent.toLowerCase().includes(query);
        item.style.display = stateMatch ? "" : "none";
    });
}
const shadesOfBlue = [
    "#5A7B99", "#2772A9", "#3A5479", "#265186", "#83B0C8",
    "#0892D0", "#5A7B99",
   
];

function loadAllStates() {
    const layerGroup = L.layerGroup().addTo(map); 
    for (const [index, [stateName, geojsonUrl]] of Object.entries(Object.entries(stateGeoJson))) {
        fetch(geojsonUrl)
            .then((response) => {
                if (!response.ok) {
                    throw new Error(`Network response was not ok for ${geojsonUrl}`);
                }
                return response.json();
            })
            .then((geojson) => {
                const color = shadesOfBlue[index % shadesOfBlue.length]; 

                const geoJsonLayer = L.geoJSON(geojson, {
                    style: function (feature) {
                        return {
                            color: "#C6CED8", 
                            weight: 1,
                            opacity: 1,
                            fillColor: color, 
                            fillOpacity: 1,
                        };
                    },
                    onEachFeature: function (feature, layer) {
                        layer.on("mouseover", function (e) {
                            const layer = e.target;
                            layer.setStyle({
                                fillColor: "#C8A473",
                                fillOpacity: 0.9,
                            });
                        });

                        layer.on("mouseout", function (e) {
                            const layer = e.target;
                            layer.setStyle({
                                fillColor: color, 
                                fillOpacity: 1,
                            });
                        });

                        layer.on("click", function () {
                            highlightState(stateName);
                            loadToState(stateName);
                            updateDisplay(stateName);
                            
                        });
                    },
                });

                layerGroup.addLayer(geoJsonLayer); 
            })
            .catch((error) => {
                console.error("Error loading GeoJSON:", error);
            });
    }
}



function loadToState(state) {
    if (stateGeoJson[state]) {
        fetch(stateGeoJson[state])
            .then((response) => response.json())
            .then((geojson) => {
                if (currentGeoJsonLayer) {
                    map.removeLayer(currentGeoJsonLayer);
                }

                currentGeoJsonLayer = L.geoJSON(geojson, {
                    style: function (feature) {
                        return {
                            color: "#712177",
                            weight: 2,
                            opacity: 1,
                            fillColor: "#C8A473",
                            fillOpacity: 0.9,
                        };
                    },
                }).addTo(map);

                const bounds = currentGeoJsonLayer.getBounds();
                map.flyTo(bounds.getCenter(),6.7, { animate: true, duration: 0.5 });

                markersLayer.clearLayers();
                
                const placesList = document.getElementById("places-list");
                placesList.innerHTML = "";

                if (places[state]) {
                    const selectedType = document.getElementById("project_type_filter").value;
                    const selectedTargets = Array.from(document.getElementById("project_target_filter").selectedOptions).map(option => option.value);
                    let placesFound = false; 
                
                    places[state].forEach((place) => {
                        if (place.project_type) {
                            const typeMatches = selectedType === "all" || place.project_type.trim().toLowerCase() === selectedType.trim().toLowerCase();
                   
                            const normalizedPlaceTargets = place.project_target ? place.project_target.split(',').map(target => target.trim().toLowerCase()) : [];

                            const targetMatches = selectedTargets.length === 0 || selectedTargets.includes("all") || selectedTargets.some(target => normalizedPlaceTargets.includes(target.trim().toLowerCase()));

                            if (typeMatches && targetMatches) {
                                const placeItem = document.createElement("div");
                                placeItem.classList.add("list-item");

                                placeItem.innerHTML = `
                                    ${place.project_name ? `<span class="project_name">${place.project_name}</span>` : ""}
                                    ${place.year ? `<span style="font-size: 16px;">( Year ${place.year})</span>` : ""}
                                    <br>
                                    ${place.address ? `<span style="font-size: 14px;">${place.address}</span>` : ""}
                                `;
                                
                                placeItem.dataset.lat = place.lat;
                                placeItem.dataset.lng = place.lng;

                                placeItem.addEventListener("mouseover", function () {
                                    highlightPlace(place.lat, place.lng);
                                });

                                placeItem.addEventListener("mouseout", function () {
                                    clearHighlight();
                                });
                               
                                placeItem.style.cursor = 'pointer';

                                const circle = addPlaceDot(place.lat, place.lng, place.address, place.project_name, place.year, place.project_link, place.contact, place.facebook_link, place.youtube_link,place.project_target,place.description);
                            
                                placeItem.addEventListener("click", function () {
                                    circle.openPopup();  
                                });
                              
                                placesList.appendChild(placeItem);
                                placesFound = true; 
                                
                            }
                        }
                    });

                    if (!placesFound) {
                        const noPlaceItem = document.createElement("div");
                        noPlaceItem.classList.add("list-item");
                        noPlaceItem.textContent = "No place found";
                        noPlaceItem.style.color = "#ff0000";
                        noPlaceItem.style.fontSize = "18px";
                        noPlaceItem.style.fontWeight = "bold";
                        noPlaceItem.style.textAlign = "center";
                        placesList.appendChild(noPlaceItem);
                    }
                } else {
                    const noPlaceItem = document.createElement("div");
                    noPlaceItem.classList.add("list-item");
                    noPlaceItem.textContent = "No place found";
                    noPlaceItem.style.color = "#ff0000";
                    noPlaceItem.style.fontSize = "18px";
                    noPlaceItem.style.fontWeight = "bold";
                    noPlaceItem.style.textAlign = "center";
                    placesList.appendChild(noPlaceItem);
                }

                placesList.style.display = "block";
                document.getElementById("state-list").style.display = "none";
                showClearButton(); 
            });
    }
    
}


function loadAllPlaces() {
    const selectedType = document.getElementById("project_type_filter").value;
    const selectedTargets = Array.from(document.getElementById("project_target_filter").selectedOptions).map(option => option.value);

    if (markersLayer) {
        markersLayer.clearLayers();  
    }

    for (const state in places) {
        places[state].forEach((place) => {
   
            const placeType = place.project_type ? place.project_type.trim() : "";

            const placeTargets = place.project_target ? place.project_target.split(",").map(target => target.trim().toLowerCase()) : [];

            const typeMatches = selectedType === "all" || selectedType === "" || placeType.toLowerCase() === selectedType.toLowerCase();

            const targetMatches = selectedTargets.includes("all") || selectedTargets.length === 0 || selectedTargets.some(selectedTarget => placeTargets.includes(selectedTarget.toLowerCase()));

            if (typeMatches && targetMatches) {
                addPlaceDot(
                    place.lat,
                    place.lng,
                    place.address,
                    place.project_name,
                    place.year,
                    place.project_link,
                    place.contact,
                    place.facebook_link,
                    place.youtube_link,
                    place.project_target,
                    place.description
                );
            }
        });
    }
}

function addPlaceDot(lat, lng, address = "", project_name = "", year = "", project_link = "", contact = "",facebook_link = "",youtube_link="",project_target="",description="") {

    if (!map.getPane("circlePane")) {
        map.createPane("circlePane");
        map.getPane("circlePane").style.zIndex = 650;
    }

    const circle = L.circleMarker([lat, lng], {
        radius: 4,
        color: "#FF4B33",
        fillColor: "#FF4B33",
        fillOpacity: 2.1,
        pane: "circlePane",
    })
    .addTo(markersLayer)
    .bindPopup(`
        <h4 class="mapProjName">${project_name}</h4><br>

        <div class="icon-wrapper">
            <span class="icon"><i class="fas fa-map-marker-alt"></i></span>
            <span>${address}</span>
        </div>
        <div class="icon-wrapper">
            <span class="icon"><i class="fas fa-phone"></i></span>
            <span><a href="tel:${contact}">${contact}</a></span>
        </div>
        ${project_link ? 
        `<div class="icon-wrapper">
            <span class="icon"><a href="${project_link}"><i class="fas fa-link"></i></a></span>
            <span><a href="${project_link}" target="_blank">${project_link}</a></span>
        </div>` : ""}

        <div class="icon-wrapper">
            <span class="icon"><i class="fa-regular fa-calendar-check"></i></span>
            <span>${year}</span>
        </div>

        
        <div class="icon-wrapper">
        <span class="icon"><i class="fa-solid fa-bullseye"></i></span>
        <span>${project_target} </span></div>

        ${description ? 
            `<div class="icon-wrapper"><span class="icon"><i class="fa-regular fa-clipboard"></i></span>
        <span>${description}</span></div>` : ""}

        <div class="icon-wrapper">
           
            ${Boolean(facebook_link) || Boolean(youtube_link) ? 
            ` <span class="icon"><i class="fas fa-share-alt"></i></span>
              <div class="social-media">
            ${facebook_link ?`<span class="icon icon-facebook"><a href="${facebook_link}" target="_blank"><i class="fab fa-facebook"></i></a></span>`:""}
            ${youtube_link ? `<span class="icon icon-youtube"><a href="${youtube_link}" target="_blank"><i class="fab fa-youtube"></i></a></span>`:""}
            </div>` : ""}
        </div>
    `);

    placeMarkers[address] = circle;

    circle.on('click', function() {
        circle.openPopup();  
        showClearButton(); 
    });
    return circle;
}

function clearHighlight() {
    Object.keys(placeMarkers).forEach((address) => {
        const circle = placeMarkers[address];
        circle.setStyle({
            fillColor: "#FF4B33",
            color: "#FF4B33",
        });
        circle.setRadius(4);
    });
}

function highlightPlace(lat, lng) {
    Object.keys(placeMarkers).forEach((address) => {
        const circle = placeMarkers[address];
        if (
            circle.getLatLng().lat === parseFloat(lat) &&
            circle.getLatLng().lng === parseFloat(lng)
        ) {
            circle.setStyle({
                fillColor: "#eab104",
                color: "#eab104",
            });
            circle.setRadius(5);
        } else {
            circle.setStyle({
                fillColor: "#FF4B33",
                color: "#FF4B33",
            });
            circle.setRadius(4);
        }
    });
}


function highlightState(state) {
    document.querySelectorAll(".list-item").forEach((item) => {
        item.classList.remove("highlight");
    });
    const items = document.querySelectorAll(".list-item");
    items.forEach((item) => {
        if (item.textContent === state) {
            item.classList.add("highlight");
            item.scrollIntoView({
                behavior: "smooth",
                block: "center",
            });
        }
    });
}


function updateDisplay(state) {
    const display = document.getElementById("display");
    display.textContent = state;
}


window.onload = initMap;
