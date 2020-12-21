// This example requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBIwzALxUPNbatRBj3Xi1Uhp0fFzwWNBkE&libraries=places">
let map;
let service;
let infowindow;

function initMap() {

//   const sydney = new google.maps.LatLng(-33.867, 151.195);
//   infowindow = new google.maps.InfoWindow();
//   map = new google.maps.Map(document.getElementById("map"), {
//     center: sydney,
//     zoom: 15,
//   });
//   const request = {
//     query: "Museum of Contemporary Art Australia",
//     fields: ["name", "geometry"],
//   };
//   service = new google.maps.places.PlacesService(map);
//   service.findPlaceFromQuery(request, (results, status) => {
//     if (status === google.maps.places.PlacesServiceStatus.OK) {
//       for (let i = 0; i < results.length; i++) {
//         createMarker(results[i]);
//       }
//       map.setCenter(results[0].geometry.location);
//     }
//   });

var token = "9748d0fd112d02";
$.get("https://ipinfo.io?token=9748d0fd112d02", function(response) {
  console.log(response);
}, "jsonp")

let map;


  map = new google.maps.Map(document.getElementById("sldsucceed"), {
    center: { lat: -34.397, lng: 150.644 },
    zoom: 8,
  });

}
// initMap();

// function createMarker(place) {
//   const marker = new google.maps.Marker({
//     map,
//     position: place.geometry.location,
//   });
//   google.maps.event.addListener(marker, "click", () => {
//     infowindow.setContent(place.name);
//     infowindow.open(map);
//   });
// }