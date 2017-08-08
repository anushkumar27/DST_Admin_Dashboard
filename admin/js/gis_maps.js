var dataReceived;

function initMap() {
  var map1 = new google.maps.Map(document.getElementById('map-div-1'), {
          zoom: 10,
          mapTypeId: 'hybrid',
          //center: {lat: 12.774546, lng: 78.433523},
          center: {lat: 37.782, lng: -122.447},
          zoomControl: true,
          scaleControl: true,
          fullscreenControl: true
  });
  var map2 = new google.maps.Map(document.getElementById('map-div-2'), {
          zoom: 10,
          mapTypeId: 'hybrid',
          //center: {lat: 12.774546, lng: 78.433523},
          center: {lat: 37.782, lng: -122.447},
          zoomControl: true,
          scaleControl: true,
          fullscreenControl: true
  });
  var map3 = new google.maps.Map(document.getElementById('map-div-3'), {
          zoom: 10,
          mapTypeId: 'hybrid',
          //center: {lat: 12.774546, lng: 78.433523},
          center: {lat: 37.782, lng: -122.447},
          zoomControl: true,
          scaleControl: true,
          fullscreenControl: true
  });
  var map4 = new google.maps.Map(document.getElementById('map-div-4'), {
          zoom: 10,
          mapTypeId: 'hybrid',
          //center: {lat: 12.774546, lng: 78.433523},
          center: {lat: 37.782, lng: -122.447},
          zoomControl: true,
          scaleControl: true,
          fullscreenControl: true
  });

  /* Data points defined as an array of LatLng objects */
  var heatmapData = [
    new google.maps.LatLng(37.782, -122.447),
    new google.maps.LatLng(37.782, -122.445),
    new google.maps.LatLng(37.782, -122.443),
    new google.maps.LatLng(37.782, -122.441),
    new google.maps.LatLng(37.782, -122.439),
    new google.maps.LatLng(37.782, -122.437),
    new google.maps.LatLng(37.782, -122.435),
    new google.maps.LatLng(37.785, -122.447),
    new google.maps.LatLng(37.785, -122.445),
    new google.maps.LatLng(37.785, -122.443),
    new google.maps.LatLng(37.785, -122.441),
    new google.maps.LatLng(37.785, -122.439),
    new google.maps.LatLng(37.785, -122.437),
    new google.maps.LatLng(37.785, -122.435)
  ];


  var heatmap1 = new google.maps.visualization.HeatmapLayer({
    data: heatmapData
  });
  var heatmap2 = new google.maps.visualization.HeatmapLayer({
    data: heatmapData
  });
  var heatmap3 = new google.maps.visualization.HeatmapLayer({
    data: heatmapData
  });
  var heatmap4 = new google.maps.visualization.HeatmapLayer({
    data: heatmapData
  });


  heatmap1.setMap(map1);
  heatmap2.setMap(map2);
  heatmap3.setMap(map3);
  heatmap4.setMap(map4);
}
function getData() {
  var xhttp;
  if(window.XMLHttpRequest){
    xhttp = new XMLHttpRequest();
  } else{
    xhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }

  xhttp.onreadystatechange = function (){
    if(xhttp.readyState == 4 && xhttp.status == 200) {
      dataReceived = xhttp.responseText;
      dataReceived = JSON.parse(dataReceived);
    }
  };

  xhttp.open("GET", "getPoints",false);
  xhttp.send();
}