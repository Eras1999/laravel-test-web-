// Initialize AOS (Animate On Scroll)
AOS.init({
    duration: 800,
    easing: 'ease-out-cubic',
    once: true
});

document.getElementById('upload-post-btn').addEventListener('click', function() {
    const form = document.getElementById('upload-post-form');
    form.style.display = 'block';
    this.style.display = 'none';
    setTimeout(() => initMap(), 100);
});

document.getElementById('cancel-upload-btn').addEventListener('click', function() {
    document.getElementById('upload-post-form').style.display = 'none';
    document.getElementById('upload-post-btn').style.display = 'block';
});

// Toggle filter visibility
document.getElementById('toggle-filter').addEventListener('click', function() {
    const filterContent = document.getElementById('filter-content');
    filterContent.classList.toggle('hidden');
    const icon = this.querySelector('i');
    icon.classList.toggle('fa-chevron-down');
    icon.classList.toggle('fa-chevron-up');
});

// Clear filters functionality
document.getElementById('clear-filters').addEventListener('click', function() {
    const form = document.getElementById('filter-form');
    document.getElementById('animal_type_filter').value = '';
    document.getElementById('district_filter').value = '';
    document.getElementById('healthy_status_filter').value = '';
    form.submit();
});

function initMap() {
    const districtSelect = document.getElementById('district');
    const placeInput = document.getElementById('place');
    const placeNameSpan = document.getElementById('place-name');
    const latitudeInput = document.getElementById('latitude');
    const longitudeInput = document.getElementById('longitude');

    const districtCoords = {
        'Colombo': [6.9271, 79.8612], 'Gampaha': [7.0887, 79.9998], 'Kalutara': [6.5833, 79.9608],
        'Kandy': [7.2906, 80.6337], 'Matale': [7.4680, 80.6227], 'Nuwara Eliya': [6.9705, 80.7820],
        'Galle': [6.0437, 80.2168], 'Matara': [5.9485, 80.5353], 'Hambantota': [6.1237, 81.1185],
        'Jaffna': [9.6615, 80.0255], 'Kilinochchi': [9.3962, 80.4027], 'Mannar': [8.9779, 79.9167],
        'Vavuniya': [8.7617, 80.4985], 'Mullaitivu': [9.2674, 80.8136], 'Batticaloa': [7.7105, 81.7007],
        'Ampara': [7.2969, 81.6750], 'Trincomalee': [8.5778, 81.2083], 'Kurunegala': [7.4833, 80.3667],
        'Puttalam': [8.0362, 79.8310], 'Anuradhapura': [8.3149, 80.4027], 'Polonnaruwa': [7.9385, 81.0050],
        'Badulla': [6.9932, 81.0548], 'Moneragala': [6.8728, 81.3497], 'Ratnapura': [6.6847, 80.3864],
        'Kegalle': [7.2528, 80.3468]
    };

    let map = L.map('map').setView([7.8731, 80.7718], 8);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
    }).addTo(map);

    let districtCircle;

    districtSelect.addEventListener('change', function() {
        const district = this.value;
        if (district && districtCoords[district]) {
            const coords = districtCoords[district];
            map.setView(coords, 10);

            if (districtCircle) map.removeLayer(districtCircle);

            districtCircle = L.circle(coords, {
                radius: 15000,
                color: '#667eea',
                fillColor: '#764ba2',
                fillOpacity: 0.3
            }).addTo(map);
        } else {
            map.setView([7.8731, 80.7718], 8);
            if (districtCircle) map.removeLayer(districtCircle);
        }
    });

    map.on('click', function(e) {
        const lat = e.latlng.lat;
        const lon = e.latlng.lng;

        fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lon}&format=json&addressdetails=1`)
            .then(response => response.json())
            .then(data => {
                const fullPlace = data.display_name || 'Unknown location';
                placeInput.value = fullPlace;
                placeNameSpan.textContent = fullPlace;
                latitudeInput.value = lat;
                longitudeInput.value = lon;

                L.popup()
                    .setLatLng([lat, lon])
                    .setContent(`<b>📍 Place:</b><br>${fullPlace}`)
                    .openOn(map);
            })
            .catch(error => {
                console.error('Error:', error);
                placeNameSpan.textContent = 'Failed to get location';
                placeInput.value = '';
                latitudeInput.value = '';
                longitudeInput.value = '';
            });
    });


    
}

