// call for data
getData();

// setting data of top tiles 
document.getElementById('nSchools').innerHTML = dataReceived.nSchools;
document.getElementById('nStudents').innerHTML = parseInt(dataReceived.nMale) + parseInt(dataReceived.nFemale);
document.getElementById('nMale').innerHTML = dataReceived.nMale;
document.getElementById('nFemale').innerHTML = dataReceived.nFemale;
document.getElementById('nReferel').innerHTML = dataReceived.nReferel;
document.getElementById('nReport').innerHTML = dataReceived.nReport;

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
      //console.log(dataReceived);
    }
  };

  xhttp.open("GET", "getAllData",false);
  xhttp.send();
}