<div>
    <div id="map"></div>
</div>

@section('jsmap')
    <script>
        var map = L.map('map').setView([10.4961, -66.8983], 8);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        const markerIcon = L.icon({
            iconSize: [25, 41],
            iconAnchor: [10, 41],
            popupAnchor: [2, -40],
            // specify the path here
            iconUrl: "{{ asset('images/leaflet/marker-icon.png') }}",
            shadowUrl: "{{ asset('images/leaflet/marker-shadow.png') }}"
        });

        let coord = '{!! json_encode($coords) !!}'
        coord = JSON.parse(coord)
        coord.forEach((c, index) => {
            let marker = L.marker([c.latitude, c.longitude], {
                    icon: markerIcon
                }).addTo(map).bindPopup(`
            <iframe src='https://www.${c.iframe}'></iframe>
            <p>${c.name}</p>
            `)
                .openPopup()

            marker.on('click', function(e) {
                map.flyTo(e.latlng, 14);
            })
        })
    </script>
@endsection
