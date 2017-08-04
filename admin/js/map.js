var dataReceived;
function initMap() {
  var map = new google.maps.Map(document.getElementById('map-div'), {
          zoom: 10,
          center: {lat: 12.774546, lng: 78.433523},
          zoomControl: true,
          scaleControl: true,
          fullscreenControl: true
    });
  setMarkers(map);
}

function setMarkers(map) {
	//get data 
	getData();

    // Adds markers to the map.

    // Marker sizes are expressed as a Size of X,Y where the origin of the image
    // (0,0) is located in the top left of the image.
    var centerImage = {
      url: 'images/center.png',
      size: new google.maps.Size(30, 30),
      // The origin for this image is (0, 0).
      origin: new google.maps.Point(0, 0),
      // The anchor for this image 
      anchor: new google.maps.Point(0, 0)
    };

    var phcImage = {
      url: 'images/phc.png',
      size: new google.maps.Size(100, 100),
      // The origin for this image is (0, 0).
      origin: new google.maps.Point(0, 0),
      // The anchor for this image 
      anchor: new google.maps.Point(0, 0)
    };


    for (var i = 0; i < dataReceived.length; i++) {
      var markerPoint = dataReceived[i];
      if(markerPoint[0] == 'center'){
      	var marker = new google.maps.Marker({
	        position: {lat: parseFloat(markerPoint[2]), lng: parseFloat(markerPoint[3])},
	        map: map,
	        icon: centerImage,
	        title: markerPoint[1],
	        zIndex: i
      	});
      }else{
      	var marker = new google.maps.Marker({
	        position: {lat: parseFloat(markerPoint[2]), lng: parseFloat(markerPoint[3])},
	        map: map,
	        icon: phcImage,
	        title: markerPoint[1],
	        zIndex: i
      	});
      }
      
    }
}