var dataReceived;
function updateMap(){
  var mandals = $("#mandals input:radio:checked").map(function(){
    return $(this).val();
  }).get();
  var students = $("#students input:radio:checked").map(function(){
    return $(this).val();
  }).get();

  var d1 = $("#d1 input:checkbox:checked").map(function(){
    return $(this).val();
  }).get();
  var d2 = $("#d2 input:checkbox:checked").map(function(){
    return $(this).val();
  }).get();

  res = {};
  table = {};

  table['health1'] = [];
  table['health2'] = [];
  table['eye'] = [];
  table['ent'] = [];
  table['skin'] = [];

  temp = {};
  res['mandals'] = mandals;
  res['student'] = students;
  temp['d'] = d1.concat(d2);
  
  for(i = 0; i < temp['d'].length; i++){
    mytempSplit = temp['d'][i].split('%');
    table[mytempSplit[0]].push(mytempSplit[1]);
  }

  res['d'] = table;
  //console.log(JSON.stringify(res));
  getData(JSON.stringify(res));

}

function initMap() {
   map1 = new google.maps.Map(document.getElementById('map-div-1'), {
          zoom: 10,
          mapTypeId: 'hybrid',
          center: {lat: 12.774546, lng: 78.433523},
          //center: {lat: 37.782, lng: -122.447},
          zoomControl: true,
          scaleControl: true,
          fullscreenControl: true
  });
   map2 = new google.maps.Map(document.getElementById('map-div-2'), {
          zoom: 10,
          mapTypeId: 'hybrid',
          center: {lat: 12.774546, lng: 78.433523},
          //center: {lat: 37.782, lng: -122.447},
          zoomControl: true,
          scaleControl: true,
          fullscreenControl: true
  });
   map3 = new google.maps.Map(document.getElementById('map-div-3'), {
          zoom: 10,
          mapTypeId: 'hybrid',
          center: {lat: 12.774546, lng: 78.433523},
          //center: {lat: 37.782, lng: -122.447},
          zoomControl: true,
          scaleControl: true,
          fullscreenControl: true
  });
   map4 = new google.maps.Map(document.getElementById('map-div-4'), {
          zoom: 10,
          mapTypeId: 'hybrid',
          center: {lat: 12.774546, lng: 78.433523},
          //center: {lat: 37.782, lng: -122.447},
          zoomControl: true,
          scaleControl: true,
          fullscreenControl: true
  });
}

function setMapPoints(){
  document.getElementById("c1").innerHTML = dataReceived[0].length;
  document.getElementById("c2").innerHTML = dataReceived[1].length;
  document.getElementById("c3").innerHTML = dataReceived[2].length;
  document.getElementById("c4").innerHTML = dataReceived[3].length;
  initMap();
  var h1 = [];
  var h2 = [];
  var h3 = [];
  var h4 = [];

  for(var i = 0; i < dataReceived[0].length; i++){
    h1.push(new google.maps.LatLng(parseFloat(dataReceived[0][i].lat), parseFloat(dataReceived[0][i].lon)));
  }

  for(var i = 0; i < dataReceived[1].length; i++){
    h2.push(new google.maps.LatLng(parseFloat(dataReceived[0][i].lat), parseFloat(dataReceived[0][i].lon)));
  }

  for(var i = 0; i < dataReceived[2].length; i++){
    h3.push(new google.maps.LatLng(parseFloat(dataReceived[0][i].lat), parseFloat(dataReceived[0][i].lon)));
  }

  for(var i = 0; i < dataReceived[3].length; i++){
    h4.push(new google.maps.LatLng(parseFloat(dataReceived[0][i].lat), parseFloat(dataReceived[0][i].lon)));
  }

  var heatmap1 = new google.maps.visualization.HeatmapLayer({
    data: h1
  });
  var heatmap2 = new google.maps.visualization.HeatmapLayer({
    data: h2
  });
  var heatmap3 = new google.maps.visualization.HeatmapLayer({
    data: h3
  });
  var heatmap4 = new google.maps.visualization.HeatmapLayer({
    data: h4
  });

  heatmap1.setMap(map1);
  heatmap2.setMap(map2);
  heatmap3.setMap(map3);
  heatmap4.setMap(map4);
}

function getData(ip) {
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
      setMapPoints();
      //console.log(dataReceived);
    }
  };
  xhttp.open("POST", "getGISPoints",false);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("ip="+ip);
}