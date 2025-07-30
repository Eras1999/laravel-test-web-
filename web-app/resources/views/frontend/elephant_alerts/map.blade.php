@extends('frontend.layouts.master')

@section('content')
<section class="breadcrumb-area breadcrumb-bg" data-background="{{ asset('frontend/img/bg/elephant_map.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-content">
                    <h2 class="title">Elephant Sightings Map</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home.authenticated') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('elephant-alerts.index') }}">Elephant Alert</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Map</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

<main class="elephant-alerts-page">
    <section class="elephant-alerts-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="map-section">
                        <h3>Today's Elephant Sightings ({{ \Carbon\Carbon::today()->setTimezone('Asia/Colombo')->format('Y-m-d') }})</h3>
                        <p><strong>Total Reports Today: {{ $alerts->count() }}</strong></p>
                        <div id="map" style="height: 600px; position: relative; z-index: 1;">
                            {{-- START: Map Legend --}}
                            <div class="map-legend">
                                <h4>Marker Key</h4>
                                <div><i class="fas fa-map-marker-alt" style="color: #28a745;"></i> Healthy</div>
                                <div><i class="fas fa-map-marker-alt" style="color: #ffc107;"></i> Normal</div>
                                <div><i class="fas fa-map-marker-alt" style="color: #dc3545;"></i> Injured</div>
                            </div>
                            {{-- END: Map Legend --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-5">
                <div class="col-lg-12">
                    <div class="history-section">
                        <h3>Last 7 Days' Elephant Sightings</h3>
                        <div class="date-buttons" id="dateButtons">
                            <button class="btn btn-primary m-1 date-btn active" data-date="{{ \Carbon\Carbon::today()->setTimezone('Asia/Colombo')->format('Y-m-d') }}">Today</button>
                            @php
                                $endDate = \Carbon\Carbon::today()->setTimezone('Asia/Colombo')->subDay();
                                $startDate = \Carbon\Carbon::today()->setTimezone('Asia/Colombo')->subDays(7); // Show last 7 days including today
                                $dateCounts = [];
                                foreach ($allAlerts as $alert) {
                                    $date = \Carbon\Carbon::parse($alert->created_at)->setTimezone('Asia/Colombo')->format('Y-m-d');
                                    $dateCounts[$date] = ($dateCounts[$date] ?? 0) + 1;
                                }
                                // Loop from 7 days ago up to yesterday
                                $currentLoopDate = clone \Carbon\Carbon::today()->setTimezone('Asia/Colombo')->subDays(7);
                                while ($currentLoopDate->lt(\Carbon\Carbon::today()->setTimezone('Asia/Colombo'))) { // Loop until day before today
                                    $dateStr = $currentLoopDate->format('Y-m-d');
                                    $count = $dateCounts[$dateStr] ?? 0;
                                    echo '<button class="btn btn-secondary m-1 date-btn" data-date="' . $dateStr . '">' . $currentLoopDate->format('Y-m-d') . ' - ' . $count . ' alerts</button>';
                                    $currentLoopDate->addDay();
                                }
                            @endphp
                        </div>
                        <div class="accordion" id="historyAccordion">
                            <div class="accordion-item" id="dynamicAccordionItem">
                                <h2 class="accordion-header" id="headingDynamic">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDynamic" aria-expanded="true" aria-controls="collapseDynamic">
                                        Selected Date Reports (0 Reports)
                                    </button>
                                </h2>
                                <div id="collapseDynamic" class="accordion-collapse collapse show" aria-labelledby="headingDynamic" data-bs-parent="#historyAccordion">
                                    <div class="accordion-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover" id="alertsTable">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Mobile Number</th>
                                                        <th>District</th>
                                                        <th>Elephants</th>
                                                        <th>Health Status</th>
                                                        <th>Description</th>
                                                        <th>Image</th>
                                                        <th>Time</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="alertsTableBody">
                                                    <!-- Dynamic content will be inserted here -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('frontend/css/elephant_alerts.css') }}">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    #map {
        width: 100%;
        height: 600px; /* Increased height for better visibility */
        position: relative;
        z-index: 1; /* Ensures map stays below fixed headers/navs */
    }
    .history-section { margin-top: 40px; }
    .accordion-button { background-color: #f8f9fa; }
    .accordion-button:not(.collapsed) { background-color: #e9ecef; }
    .table th, .table td { vertical-align: middle; }
    .health-status.healthy { color: #28a745; font-weight: bold; }
    .health-status.normal { color: #ffc107; font-weight: bold; }
    .health-status.injured { color: #dc3545; font-weight: bold; }
    .date-buttons { margin-bottom: 15px; }
    .date-btn.active { background-color: #28a745; color: white; }
    .blink {
        animation: blink 1s infinite;
    }
    @keyframes blink {
        50% { opacity: 0.3; }
    }
    .custom-icon {
        text-align: center;
        line-height: 24px;
    }
    .leaflet-marker-icon {
        border-radius: 50%;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        width: 24px !important;
        height: 24px !important;
        background: transparent;
    }
    .leaflet-marker-icon i {
        margin: 0;
    }
    .leaflet-popup-pane {
        z-index: 11000; /* Ensure popups stay above other map elements if any */
    }
    .popup-image {
        max-width: 100%;
        height: auto;
        display: block;
        margin-top: 5px;
        border-radius: 4px;
    }

    /* New styles for the map legend */
    .map-legend {
        position: absolute;
        bottom: 10px; /* Adjust as needed */
        left: 10px; /* Adjust as needed */
        background: rgba(255, 255, 255, 0.9); /* Slightly transparent white background */
        padding: 8px 12px;
        border-radius: 5px;
        box-shadow: 0 1px 5px rgba(0,0,0,0.4);
        font-family: Arial, sans-serif;
        font-size: 14px; /* Default font size */
        z-index: 1000; /* Ensure legend is above map tiles but below popups */
    }
    .map-legend h4 {
        margin-top: 0;
        margin-bottom: 8px;
        font-size: 15px;
        color: #333;
    }
    .map-legend div {
        display: flex; /* Aligns icon and text horizontally */
        align-items: center; /* Vertically centers icon and text */
        margin-bottom: 5px;
    }
    .map-legend i {
        font-size: 20px; /* Adjust icon size to match markers */
        margin-right: 8px; /* Space between icon and text */
        line-height: 1; /* Ensures icon is centered */
    }

    /* Responsive adjustments for legend */
    @media (max-width: 768px) {
        .map-legend {
            font-size: 12px; /* Smaller font on smaller screens */
            padding: 6px 10px;
            bottom: 5px;
            left: 5px;
        }
        .map-legend h4 {
            font-size: 14px;
            margin-bottom: 5px;
        }
        .map-legend i {
            font-size: 18px; /* Smaller icons */
            margin-right: 6px;
        }
    }
</style>
@endsection

@section('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const map = L.map('map', {
            zoomControl: true,
            scrollWheelZoom: false
        }).setView([7.8731, 80.7718], 8); // Default to Sri Lanka center

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors',
            maxZoom: 18,
            minZoom: 8
        }).addTo(map);

        const healthStatusIcons = {
            healthy: L.divIcon({
                className: 'custom-icon blink',
                html: '<i class="fas fa-map-marker-alt" style="color: #28a745; font-size: 24px;"></i>',
                iconSize: [24, 24],
                iconAnchor: [12, 24],
                popupAnchor: [0, -24]
            }),
            normal: L.divIcon({
                className: 'custom-icon blink',
                html: '<i class="fas fa-map-marker-alt" style="color: #ffc107; font-size: 24px;"></i>',
                iconSize: [24, 24],
                iconAnchor: [12, 24],
                popupAnchor: [0, -24]
            }),
            injured: L.divIcon({
                className: 'custom-icon blink',
                html: '<i class="fas fa-map-marker-alt" style="color: #dc3545; font-size: 24px;"></i>',
                iconSize: [24, 24],
                iconAnchor: [12, 24],
                popupAnchor: [0, -24]
            })
        };

        let markers = [];
        const allAlerts = @json($allAlerts);
        const todayDate = "{{ \Carbon\Carbon::today()->setTimezone('Asia/Colombo')->format('Y-m-d') }}";

        function ucfirst(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }

        function updateMapAndTable(date = todayDate) {
            // Clear existing markers
            markers.forEach(marker => map.removeLayer(marker));
            markers = [];

            // Filter alerts for the selected date
            const filteredAlerts = allAlerts.filter(alert => {
                const alertDate = new Date(alert.created_at).toLocaleDateString('en-CA', { timeZone: 'Asia/Colombo' });
                return alertDate === date;
            });

            // Update map with filtered alerts
            if (filteredAlerts.length === 0) {
                map.setView([7.8731, 80.7718], 8); // Reset to Sri Lanka center if no alerts
            } else {
                filteredAlerts.forEach(alert => {
                    try {
                        const marker = L.marker([alert.latitude, alert.longitude], {
                            icon: healthStatusIcons[alert.health_status]
                        }).addTo(map);

                        let popupContent = `
                            <b>Name:</b> ${alert.name || 'N/A'}<br>
                            <b>Mobile Number:</b> ${alert.mobile_number || 'N/A'}<br>
                            <b>District:</b> ${alert.district || 'N/A'}<br>
                            <b>Elephants:</b> ${alert.elephant_count || 'N/A'}<br>
                            <b>Health Status:</b> ${ucfirst(alert.health_status) || 'N/A'}<br>
                            <b>Description:</b> ${alert.description || 'N/A'}<br>
                            <b>Date:</b> ${new Date(alert.created_at).toLocaleDateString('en-CA', { timeZone: 'Asia/Colombo' }) || 'N/A'}<br>
                            <b>Time:</b> ${new Date(alert.created_at).toLocaleTimeString('en-US', { hour12: false, timeZone: 'Asia/Colombo' }) || 'N/A'}
                        `;

                        if (alert.image) {
                            const imageUrl = `{{ asset('storage') }}/${alert.image}`;
                            popupContent += `<br><img src="${imageUrl}" class="popup-image" alt="Elephant Image">`;
                        }

                        fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${alert.latitude}&lon=${alert.longitude}&zoom=18&addressdetails=1`)
                            .then(response => response.json())
                            .then(data => {
                                const placeName = data.display_name || 'Unknown location';
                                marker.bindPopup(`<b>Location:</b> ${placeName}<br>${popupContent}`);
                            })
                            .catch(error => {
                                console.error('Reverse geocoding error for alert', alert.id, ':', error);
                                marker.bindPopup(`<b>Location:</b> Unknown<br>${popupContent}`);
                            });

                        markers.push(marker);
                    } catch (e) {
                        console.error('Error creating marker for alert', alert.id, ':', e);
                    }
                });
                const group = L.featureGroup(markers);
                map.fitBounds(group.getBounds().pad(0.2));
            }

            // Update table with filtered alerts
            const tableBody = document.getElementById('alertsTableBody');
            tableBody.innerHTML = ''; // Clear existing rows
            const accordionButton = document.querySelector('#headingDynamic .accordion-button');
            accordionButton.textContent = `Selected Date Reports (${filteredAlerts.length} Reports)`;

            filteredAlerts.forEach(alert => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${alert.name || 'N/A'}</td>
                    <td>${alert.mobile_number || 'N/A'}</td>
                    <td>${alert.district || 'N/A'}</td>
                    <td>${alert.elephant_count || 'N/A'}</td>
                    <td><span class="health-status ${alert.health_status}">${ucfirst(alert.health_status) || 'N/A'}</span></td>
                    <td>${alert.description || 'N/A'}</td>
                    <td>
                        ${alert.image ? `<a href="{{ asset('storage') }}/${alert.image}" target="_blank"><img src="{{ asset('storage') }}/${alert.image}" alt="Elephant" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;"></a>` : 'N/A'}
                    </td>
                    <td>${new Date(alert.created_at).toLocaleTimeString('en-US', { hour12: false, timeZone: 'Asia/Colombo' }) || 'N/A'}</td>
                `;
                tableBody.appendChild(row);
            });
        }

        updateMapAndTable(todayDate);

        document.querySelectorAll('.date-btn').forEach(button => {
            button.addEventListener('click', function() {
                document.querySelectorAll('.date-btn').forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                const selectedDate = this.getAttribute('data-date');
                updateMapAndTable(selectedDate);
            });
        });

        setTimeout(() => map.invalidateSize(), 100);
    });
</script>
@endsection