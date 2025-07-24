@extends('frontend.layouts.master')

@section('content')
    <!-- breadcrumb-area -->
    <section class="breadcrumb-area breadcrumb-bg" data-background="{{ asset('frontend/img/bg/vet_place.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2 class="title">Animal Care Places in Sri Lanka</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home.authenticated') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Animal Care Places</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb-area-end -->

    <main>
        <section class="animal-care-section py-5">
            <div class="container">
                <!-- Instructional Note -->
                <div class="alert alert-info d-flex align-items-center mb-4" role="alert">
                    <img src="{{ asset('frontend/img/icon/w_pawprint.png') }}" alt="Pawprint" class="me-2" style="width: 24px;">
                    <div>
                        <strong>Welcome!</strong> This map shows a curated selection of animal care places (e.g., veterinary clinics, pet shops) in Sri Lanka sourced from OpenStreetMap. Not all locations may be displayed due to data availability. Use the filters below to explore.
                    </div>
                </div>

                <!-- Back to Home Button -->
                <div class="mb-4">
                    <a href="{{ route('home.authenticated') }}" class="btn btn-secondary" aria-label="Back to homepage">
                        <img src="{{ asset('frontend/img/icon/w_pawprint.png') }}" alt="Pawprint" style="width: 18px; margin-right: 6px;">
                        Back to Home
                    </a>
                </div>

                <div class="controls mb-4">
                    <label for="districtSelect" class="me-2"><strong>District:</strong></label>
                    <select id="districtSelect" class="form-select d-inline-block w-auto">
                        <option value="all">All Sri Lanka</option>
                        <option value="Ampara">Ampara</option>
                        <option value="Anuradhapura">Anuradhapura</option>
                        <option value="Badulla">Badulla</option>
                        <option value="Batticaloa">Batticaloa</option>
                        <option value="Colombo" selected>Colombo</option>
                        <option value="Galle">Galle</option>
                        <option value="Gampaha">Gampaha</option>
                        <option value="Hambantota">Hambantota</option>
                        <option value="Jaffna">Jaffna</option>
                        <option value="Kalutara">Kalutara</option>
                        <option value="Kandy">Kandy</option>
                        <option value="Kegalle">Kegalle</option>
                        <option value="Kilinochchi">Kilinochchi</option>
                        <option value="Kurunegala">Kurunegala</option>
                        <option value="Mannar">Mannar</option>
                        <option value="Matale">Matale</option>
                        <option value="Matara">Matara</option>
                        <option value="Monaragala">Monaragala</option>
                        <option value="Mullaitivu">Mullaitivu</option>
                        <option value="Nuwara Eliya">Nuwara Eliya</option>
                        <option value="Polonnaruwa">Polonnaruwa</option>
                        <option value="Puttalam">Puttalam</option>
                        <option value="Ratnapura">Ratnapura</option>
                        <option value="Trincomalee">Trincomalee</option>
                        <option value="Vavuniya">Vavuniya</option>
                    </select>

                    <label for="categorySelect" class="ms-3 me-2"><strong>Category:</strong></label>
                    <select id="categorySelect" class="form-select d-inline-block w-auto">
                        <option value="all">All Categories</option>
                        <option value="veterinary">Veterinary Clinic</option>
                        <option value="petshop">Pet Shop</option>
                        <option value="shelter">Animal Shelter</option>
                        <option value="rescue">Animal Rescue</option>
                        <option value="wildlife">Wildlife Center</option>
                    </select>

                    <button id="findButton" class="btn btn-primary btn-lg ms-3">Find</button>
                </div>

                <div id="map" class="position-relative mb-4">
                    <div id="map-loading" style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1000;">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">...</span>
                        </div>
                    </div>
                </div>

                <div class="results">
                    <h3 id="resultsHeader" class="mb-4">Animal Care Places: <span id="placeCount">0</span></h3>
                    <div id="placeList"></div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('styles')
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <!-- MarkerCluster CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.Default.css" />

    <style>
        #map {
            height: 500px;
            width: 100%;
            border-radius: 8px;
        }
        .controls {
            padding: 15px;
            text-align: center;
            background: #f8f8f8;
            border-bottom: 1px solid #ddd;
        }
        .results {
            padding: 20px 0;
            background: #f9f9f9;
        }
        .results h3 {
            margin: 0 0 15px;
            color: #333;
        }
        .place-card {
            background: white;
            border-radius: 8px;
            padding: 15px;
            margin: 10px 0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
        }
        .place-card h4 {
            margin: 0;
            color: #007bff;
        }
        .place-card p {
            margin: 5px 0;
            color: #555;
        }
        .legend {
            position: absolute;
            bottom: 20px;
            right: 10px;
            background: white;
            padding: 8px;
            border-radius: 5px;
            box-shadow: 0 0 12px rgba(0,0,0,0.15);
            font-size: 14px;
            line-height: 18px;
            z-index: 1000;
        }
        .legend-item {
            display: flex;
            align-items: center;
            margin-bottom: 6px;
        }
        .legend-icon {
            width: 16px;
            height: 16px;
            margin-right: 6px;
            border-radius: 50%;
        }
        .legend-red { background: red; }
        .legend-blue { background: blue; }
        .legend-green { background: green; }
        .legend-orange { background: orange; }
        .legend-purple { background: purple; }
        .legend-gray { background: gray; }

        /* Responsive Styles */
        @media (max-width: 768px) {
            #map {
                height: 400px;
            }
            .controls {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 10px;
            }
            .controls label {
                width: 100%;
                text-align: center;
            }
            .controls select, .controls button {
                width: 100%;
                max-width: 300px;
            }
            .place-card {
                flex-direction: column;
                align-items: flex-start;
            }
            .place-card button {
                margin-top: 10px;
                width: 100%;
            }
            .legend {
                bottom: 10px;
                right: 5px;
                padding: 6px;
                font-size: 12px;
                line-height: 16px;
            }
            .legend-item {
                margin-bottom: 4px;
            }
            .legend-icon {
                width: 12px;
                height: 12px;
                margin-right: 4px;
            }
        }
        @media (max-width: 576px) {
            #map {
                height: 300px;
            }
            .controls select, .controls button {
                font-size: 14px;
            }
            .results h3 {
                font-size: 1.5rem;
            }
            .place-card h4 {
                font-size: 1.25rem;
            }
            .legend {
                bottom: 5px;
                right: 5px;
                padding: 4px;
                font-size: 10px;
                line-height: 14px;
            }
            .legend-item {
                margin-bottom: 3px;
            }
            .legend-icon {
                width: 10px;
                height: 10px;
                margin-right: 3px;
            }
        }
    </style>
@endsection

@section('scripts')
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <!-- MarkerCluster JS -->
    <script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script>

    <script>
        const map = L.map('map').setView([6.9271, 79.8612], 12); // Default to Colombo

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // District bounding boxes
        const districts = {
            "Ampara": [6.90, 81.30, 7.50, 81.90],
            "Anuradhapura": [8.00, 80.00, 8.50, 80.80],
            "Badulla": [6.60, 80.80, 7.10, 81.30],
            "Batticaloa": [7.60, 81.30, 8.00, 81.80],
            "Colombo": [6.80, 79.80, 7.00, 80.00],
            "Galle": [5.90, 80.00, 6.20, 80.40],
            "Gampaha": [7.00, 79.80, 7.40, 80.10],
            "Hambantota": [6.00, 80.70, 6.50, 81.40],
            "Jaffna": [9.60, 79.90, 9.80, 80.20],
            "Kalutara": [6.30, 79.90, 6.70, 80.20],
            "Kandy": [7.10, 80.50, 7.40, 80.80],
            "Kegalle": [6.80, 80.20, 7.20, 80.50],
            "Kilinochchi": [9.30, 80.20, 9.60, 80.50],
            "Kurunegala": [7.30, 79.80, 7.70, 80.50],
            "Mannar": [8.70, 79.80, 9.10, 80.20],
            "Matale": [7.50, 80.50, 7.80, 80.80],
            "Matara": [5.90, 80.40, 6.20, 80.70],
            "Monaragala": [6.50, 80.90, 6.90, 81.40],
            "Mullaitivu": [9.00, 80.50, 9.30, 80.90],
            "Nuwara Eliya": [6.80, 80.60, 7.10, 80.90],
            "Polonnaruwa": [7.70, 80.80, 8.20, 81.30],
            "Puttalam": [7.60, 79.70, 8.00, 80.10],
            "Ratnapura": [6.40, 80.30, 6.80, 80.70],
            "Trincomalee": [8.30, 80.90, 8.70, 81.40],
            "Vavuniya": [8.50, 80.20, 8.90, 80.70]
        };

        // Create a marker cluster group
        let markerClusterGroup = L.markerClusterGroup();
        map.addLayer(markerClusterGroup);

        // Circle layer for district highlight
        let districtCircle = null;

        // Store places data
        let placesData = [];

        // Clear markers function
        function clearMarkers() {
            markerClusterGroup.clearLayers();
            if (districtCircle) {
                map.removeLayer(districtCircle);
                districtCircle = null;
            }
        }

        // Custom icons
        const icons = {
            veterinary: L.icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
                iconSize: [25, 41], iconAnchor: [12, 41], popupAnchor: [1, -34],
                shadowUrl: 'https://unpkg.com/leaflet@1.7.1/dist/images/marker-shadow.png',
                shadowSize: [41, 41]
            }),
            petshop: L.icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-blue.png',
                iconSize: [25, 41], iconAnchor: [12, 41], popupAnchor: [1, -34],
                shadowUrl: 'https://unpkg.com/leaflet@1.7.1/dist/images/marker-shadow.png',
                shadowSize: [41, 41]
            }),
            shelter: L.icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-green.png',
                iconSize: [25, 41], iconAnchor: [12, 41], popupAnchor: [1, -34],
                shadowUrl: 'https://unpkg.com/leaflet@1.7.1/dist/images/marker-shadow.png',
                shadowSize: [41, 41]
            }),
            rescue: L.icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-orange.png',
                iconSize: [25, 41], iconAnchor: [12, 41], popupAnchor: [1, -34],
                shadowUrl: 'https://unpkg.com/leaflet@1.7.1/dist/images/marker-shadow.png',
                shadowSize: [41, 41]
            }),
            wildlife: L.icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-violet.png',
                iconSize: [25, 41], iconAnchor: [12, 41], popupAnchor: [1, -34],
                shadowUrl: 'https://unpkg.com/leaflet@1.7.1/dist/images/marker-shadow.png',
                shadowSize: [41, 41]
            }),
            default: L.icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-grey.png',
                iconSize: [25, 41], iconAnchor: [12, 41], popupAnchor: [1, -34],
                shadowUrl: 'https://unpkg.com/leaflet@1.7.1/dist/images/marker-shadow.png',
                shadowSize: [41, 41]
            })
        };

        // Function to select icon based on tags
        function getIcon(tags) {
            if (tags["amenity"] === "veterinary") return icons.veterinary;
            if (tags["shop"] === "pet") return icons.petshop;
            if (tags["amenity"] === "animal_shelter") return icons.shelter;
            if (tags["social_facility"] === "animal_rescue") return icons.rescue;
            if (tags["wildlife"] !== undefined) return icons.wildlife;
            return icons.default;
        }

        // Build Overpass QL query (optimized)
        function buildOverpassQuery(bbox = null, category = "all") {
            let bboxFilter = bbox
                ? `(${bbox[0]},${bbox[1]},${bbox[2]},${bbox[3]})`
                : '(6.5,79.5,10.0,81.5)'; // Sri Lanka default bbox

            let queryParts = [];
            if (category === "all" || category === "veterinary") {
                queryParts.push(`node["amenity"="veterinary"]${bboxFilter}`);
            }
            if (category === "all" || category === "petshop") {
                queryParts.push(`node["shop"="pet"]${bboxFilter}`);
            }
            if (category === "all" || category === "shelter") {
                queryParts.push(`node["amenity"="animal_shelter"]${bboxFilter}`);
            }
            if (category === "all" || category === "rescue") {
                queryParts.push(`node["social_facility"="animal_rescue"]${bboxFilter}`);
            }
            if (category === "all" || category === "wildlife") {
                queryParts.push(`node["wildlife"]${bboxFilter}`);
            }

            if (queryParts.length === 0) return '';

            return `
                [out:json][timeout:25];
                (
                    ${queryParts.join(';')};
                );
                out center;
            `;
        }

        // Check if a point is within a bounding box
        function isWithinBounds(lat, lon, bbox) {
            if (!bbox) return true;
            return lat >= bbox[0] && lat <= bbox[2] && lon >= bbox[1] && lon <= bbox[3];
        }

        // Cache management
        function getCachedData(key) {
            const cached = localStorage.getItem(key);
            if (cached) {
                const { data, timestamp } = JSON.parse(cached);
                const age = Date.now() - timestamp;
                if (age < 24 * 60 * 60 * 1000) { // Cache valid for 24 hours
                    return data;
                } else {
                    localStorage.removeItem(key);
                }
            }
            return null;
        }

        function setCachedData(key, data) {
            localStorage.setItem(key, JSON.stringify({ data, timestamp: Date.now() }));
        }

        // Add markers with clustering and filter results by district
        function addMarkers(data, district, category) {
            clearMarkers();
            placesData = [];

            if (!data || !data.elements || data.elements.length === 0) {
                document.getElementById('placeCount').textContent = '0';
                document.getElementById('placeList').innerHTML = '<p>No places found for the selected criteria.</p>';
                alert("No data found for selected area or category.");
                return;
            }

            let filteredData = data.elements;
            if (category !== "all") {
                filteredData = data.elements.filter(element => {
                    const tags = element.tags || {};
                    return (
                        (category === "veterinary" && tags.amenity === "veterinary") ||
                        (category === "petshop" && tags.shop === "pet") ||
                        (category === "shelter" && tags.amenity === "animal_shelter") ||
                        (category === "rescue" && tags.social_facility === "animal_rescue") ||
                        (category === "wildlife" && tags.wildlife !== undefined)
                    );
                });
            }

            // Add circle for district
            let bounds = null;
            if (district !== "all" && districts[district]) {
                const bbox = districts[district];
                const centerLat = (bbox[0] + bbox[2]) / 2;
                const centerLon = (bbox[1] + bbox[3]) / 2;
                const latDiff = (bbox[2] - bbox[0]) * 111000; // Approx meters
                const lonDiff = (bbox[3] - bbox[1]) * 111000 * Math.cos(centerLat * Math.PI / 180);
                const radius = Math.max(latDiff, lonDiff) / 2;

                districtCircle = L.circle([centerLat, centerLon], {
                    radius: radius,
                    color: '#007bff',
                    fillColor: '#007bff',
                    fillOpacity: 0.1,
                    weight: 2
                }).addTo(map);

                bounds = L.latLngBounds(
                    [bbox[0], bbox[1]],
                    [bbox[2], bbox[3]]
                );
            }

            filteredData.forEach(element => {
                const lat = element.lat || (element.center && element.center.lat);
                const lon = element.lon || (element.center && element.center.lon);
                if (!lat || !lon) return;

                // Only process markers within the district bounds if a district is selected
                if (district !== "all" && !isWithinBounds(lat, lon, districts[district])) return;

                const tags = element.tags || {};
                const name = tags.name || "Unknown Animal Care Place";
                const icon = getIcon(tags);

                let popupContent = `<b>${name}</b><br>Type: `;
                let type = "Animal Care";
                if (tags.amenity === "veterinary") type = "Veterinary Clinic";
                else if (tags.shop === "pet") type = "Pet Shop";
                else if (tags.amenity === "animal_shelter") type = "Animal Shelter";
                else if (tags.social_facility === "animal_rescue") type = "Animal Rescue";
                else if (tags.wildlife !== undefined) type = "Wildlife Center";
                popupContent += type;

                if (tags.phone) popupContent += `<br>Phone: ${tags.phone}`;
                if (tags.website) popupContent += `<br><a href="${tags.website}" target="_blank">Website</a>`;
                if (tags.opening_hours) popupContent += `<br>Hours: ${tags.opening_hours}`;

                let addressParts = [];
                if (tags['addr:housenumber']) addressParts.push(tags['addr:housenumber']);
                if (tags['addr:street']) addressParts.push(tags['addr:street']);
                if (tags['addr:city']) addressParts.push(tags['addr:city']);
                if (tags['addr:postcode']) addressParts.push(tags['addr:postcode']);
                const address = addressParts.length > 0 ? addressParts.join(', ') : "Address not available";

                popupContent += `<br>Address: ${address}`;

                const marker = L.marker([lat, lon], { icon: icon, title: name });
                marker.bindPopup(popupContent);
                markerClusterGroup.addLayer(marker);

                placesData.push({ name, type, address, lat, lon, phone: tags.phone || "N/A", website: tags.website || "", hours: tags.opening_hours || "N/A" });
            });

            // Sort places by name
            placesData.sort((a, b) => a.name.localeCompare(b.name));

            // Update results with all places
            document.getElementById('placeCount').textContent = placesData.length;
            const placeList = document.getElementById('placeList');
            placeList.innerHTML = '';
            if (placesData.length === 0) {
                placeList.innerHTML = '<p>No places found for the selected criteria.</p>';
            } else {
                placesData.forEach(place => {
                    const card = document.createElement('div');
                    card.className = 'place-card';
                    card.innerHTML = `
                        <div>
                            <h4>${place.name}</h4>
                            <p><strong>Type:</strong> ${place.type}</p>
                            <p><strong>Address:</strong> ${place.address}</p>
                            <p><strong>Phone:</strong> ${place.phone}</p>
                            <p><strong>Hours:</strong> ${place.hours}</p>
                            ${place.website ? `<p><a href="${place.website}" target="_blank">Visit Website</a></p>` : ''}
                        </div>
                        <button class="btn btn-primary btn-sm" onclick="openGoogleMaps(${place.lat}, ${place.lon}, '${place.name.replace(/'/g, "\\'")}')">Get Directions</button>
                    `;
                    placeList.appendChild(card);
                });
            }
        }

        // Fetch from Overpass and update map
        async function fetchPlaces(bbox = null, category = "all") {
            const cacheKey = `animalcare_${bbox ? bbox.join('_') : 'all'}_${category}`;
            const cachedData = getCachedData(cacheKey);

            if (cachedData) {
                addMarkers(cachedData, document.getElementById('districtSelect').value, category);
                return;
            }

            const query = buildOverpassQuery(bbox, category);
            if (!query) {
                alert("No valid category selected.");
                return;
            }

            const url = 'https://overpass-api.de/api/interpreter';
            document.getElementById('map').style.cursor = 'wait';
            document.getElementById('map-loading').style.display = 'block';

            try {
                const response = await fetch(url, { method: 'POST', body: query });
                if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                const data = await response.json();
                setCachedData(cacheKey, data);
                addMarkers(data, document.getElementById('districtSelect').value, category);
            } catch (e) {
                alert("Failed to load animal care places from OpenStreetMap. Please try again.");
                console.error(e);
            } finally {
                document.getElementById('map').style.cursor = 'grab';
                document.getElementById('map-loading').style.display = 'none';
            }
        }

        // Open Google Maps for directions
        function openGoogleMaps(lat, lon, name) {
            const url = `https://www.google.com/maps/dir/?api=1&destination=${lat},${lon}&destination_place_id=${encodeURIComponent(name)}`;
            window.open(url, '_blank');
        }

        // Debounce function to prevent rapid clicks
        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        // Load Colombo data initially from cache or API
        fetchPlaces(districts["Colombo"], "all");

        // Find button event with debounce
        document.getElementById('findButton').addEventListener('click', debounce(function () {
            const district = document.getElementById('districtSelect').value;
            const category = document.getElementById('categorySelect').value;

            if (district === "all") {
                map.setView([7.8731, 80.7718], 7);
                fetchPlaces(null, category);
            } else if (districts[district]) {
                const bbox = districts[district];
                const centerLat = (bbox[0] + bbox[2]) / 2;
                const centerLon = (bbox[1] + bbox[3]) / 2;
                map.setView([centerLat, centerLon], 12);
                fetchPlaces(bbox, category);
            }
        }, 500));

        // Add a legend with note
        const legend = L.control({ position: 'bottomright' });
        legend.onAdd = function (map) {
            const div = L.DomUtil.create('div', 'legend');
            div.innerHTML = `
                <div class="legend-item mb-2"><small>Sample animal care types:</small></div>
                <div class="legend-item"><span class="legend-icon legend-red"></span>Veterinary Clinic</div>
                <div class="legend-item"><span class="legend-icon legend-blue"></span>Pet Shop</div>
                <div class="legend-item"><span class="legend-icon legend-green"></span>Animal Shelter</div>
                <div class="legend-item"><span class="legend-icon legend-orange"></span>Animal Rescue</div>
                <div class="legend-item"><span class="legend-icon legend-purple"></span>Wildlife Center</div>
                <div class="legend-item"><span class="legend-icon legend-gray"></span>Other Animal Care</div>
            `;
            return div;
        };
        legend.addTo(map);
    </script>
@endsection