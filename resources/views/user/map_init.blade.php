<script>
    const latlongs = {!! $cordinates !!};
    console.log(latlongs);

    function initMap() {
        // 1. Initialize the map
        const myLatlng = {
            lat: 33.0,
            lng: 78.0
        };
        const map = new google.maps.Map(document.getElementById('map'), {
            zoom: 4,
            center: myLatlng,
        });
        // 2. Set up autocomplete for address input
        const input = document.getElementById('address');
        const autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.setFields(['geometry', 'formatted_address', 'address_components']);
        autocomplete.addListener('place_changed', () => {
            const place = autocomplete.getPlace();
            if (!place.geometry) {
                return;
            }
            const address = place.formatted_address;
            const city = getAddressComponent(place, 'locality');
            const state = getAddressComponent(place, 'administrative_area_level_1');
            const country = getAddressComponent(place, 'country');
            const latitude = place.geometry.location.lat();
            const longitude = place.geometry.location.lng();
            // Update the input fields
            document.getElementById('address').value = address;
            document.getElementById('city').value = city;
            document.getElementById('state').value = state;
            document.getElementById('country').value = country;
            document.getElementById('latitude').value = latitude;
            document.getElementById('longitude').value = longitude;
            // Center the map on the selected location
            map.setCenter({
                lat: latitude,
                lng: longitude
            });
        });
        // 3. Add markers for users
        latlongs.forEach((location, index) => {
            const marker = new google.maps.Marker({
                position: location,
                map: map,
                icon: {
                    path: google.maps.SymbolPath.POINTER,
                    fillColor: 'red',
                    fillOpacity: 1,
                    strokeColor: 'red',
                    strokeWeight: 1,
                    scale: 5
                }
            });
            const infoWindowContent = `
                <div>
                    <strong>${location.name}</strong> <br>
                    <a href="${location.profile_link}" target="_blank">View Profile</a>
                </div>
            `;
            const infoWindow = new google.maps.InfoWindow({
                content: infoWindowContent
            });
            marker.addListener('click', () => {
                infoWindow.open(map, marker);
            });
            google.maps.event.addListener(infoWindow, 'domready', function() {
                const closeButton = this.getContent().querySelector('.close-info-window');
                closeButton.addEventListener('click', () => {
                    infoWindow.close();
                });
            });
        });
    }

    function getAddressComponent(place, type) {
        for (const component of place.address_components) {
            if (component.types.includes(type)) {
                return component.long_name;
            }
        }
        return '';
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBy2l4KGGTm4cTqoSl6h8UAOAob87sHBsA&libraries=places&callback=initMap" async defer></script>