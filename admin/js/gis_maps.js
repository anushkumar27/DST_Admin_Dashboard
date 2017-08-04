var dataReceived;
function initMap() {
  var map1 = new google.maps.Map(document.getElementById('map-div-1'), {
          zoom: 10,
          center: {lat: 12.774546, lng: 78.433523},
          zoomControl: true,
          scaleControl: true,
          fullscreenControl: true
  });
  var map2 = new google.maps.Map(document.getElementById('map-div-2'), {
          zoom: 10,
          center: {lat: 12.774546, lng: 78.433523},
          zoomControl: true,
          scaleControl: true,
          fullscreenControl: true
  });
  var map3 = new google.maps.Map(document.getElementById('map-div-3'), {
          zoom: 10,
          center: {lat: 12.774546, lng: 78.433523},
          zoomControl: true,
          scaleControl: true,
          fullscreenControl: true
  });
  var map4 = new google.maps.Map(document.getElementById('map-div-4'), {
          zoom: 10,
          center: {lat: 12.774546, lng: 78.433523},
          zoomControl: true,
          scaleControl: true,
          fullscreenControl: true
  });
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