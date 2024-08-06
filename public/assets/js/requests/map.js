let map;
function loadMap(){

  map = L.map('map').setView([8.76, -67.25], 6);

  L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
  }).addTo(map);

  map.on('click', onMapClick);

}

var marker;

function onMapClick(e) {

  if(marker) marker.remove();
  marker = L.marker([e.latlng.lat, e.latlng.lng]).addTo(map);

  document.getElementById('latitude').value = e.latlng.lat;
  document.getElementById('longitude').value = e.latlng.lng;

}
