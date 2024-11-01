<script>
    const latlongs = {!! $cordinates !!};
    console.log(latlongs);

    const center = latlongs.reduce((acc, curr) => {
        acc.lat += curr.lat;
        acc.lng += curr.lng;
        return acc;
    }, { lat: 0, lng: 0 });

    center.lat /= latlongs.length;
    center.lng /= latlongs.length;
    console.log("Center of the map:", center);


    function initMap() {
        const map = new google.maps.Map(document.getElementById('map'), {
            zoom: 2,
            center: center,
        });
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
            document.getElementById('address').value = address;
            document.getElementById('city').value = city;
            document.getElementById('state').value = state;
            document.getElementById('country').value = country;
            document.getElementById('latitude').value = latitude;
            document.getElementById('longitude').value = longitude;
            map.setCenter({
                lat: latitude,
                lng: longitude
            });
        });
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