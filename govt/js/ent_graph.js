// call for data
getData();

var entDoughnutStudents = document.getElementById("entDoughnutStudents");
var entDoughnutStudentsDataConfig = {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [dataReceived.nMale, dataReceived.nFemale],
                backgroundColor: [
                   '#c0392b',
                   '#16a085'
                ],
                label: 'Dataset'
            }],
            labels: [
                "Male",
                "Female",
            ]
        },
        options: {
            responsive: true,
            legend: {
                position: 'bottom',
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    };
var entDoughnutStudentsObj = new Chart(entDoughnutStudents, entDoughnutStudentsDataConfig);
console.log(dataReceived);
var entPieDisease = document.getElementById("entPieDisease");
var entPieDiseaseDataConfig = {
        type: 'pie',
        data: {
            datasets: [{
                data: [
                  dataReceived.OtitisExterna,
                  dataReceived.ASOM,
                  dataReceived.CSOM,
                  dataReceived.ImpactedWax,
                  dataReceived.ImpairedHearing,
                  dataReceived.Epistaxis,
                  dataReceived.Adenotonsilitis,
                  dataReceived.Pharyngitis,
                  dataReceived.AllergicRhinitis,
                  dataReceived.SpeechDefects,
                  dataReceived.URTI,
                  dataReceived.Cleft
                ],
                backgroundColor: [
                   '#2c3e50',
                   '#16a085',
                   '#f39c12',
                   '#7f8c8d',
                   '#9b59b6',
                   '#c0392b',
                   '#e67e22',
                   '#f1c40f',
                   '#27ae60',
                   '#2980b9',
                   '#1abc9c',
                   '#3498db'
                ],
                label: 'Dataset'
            }],
            labels: [
                "Otitis Externa",
                "ASOM",
                "CSOM",
                "Impacted Wax",
                "Impaired Hearing",
                "Epistaxis",
                "Adenotonsilitis",
                "Pharyngitis",
                "Allergic Rhinitis",
                "SpeechDefects",
                "URTI",
                "Cleft"
            ]
        },
        options: {
            responsive: true,
            legend: {
                position: 'bottom',
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    };
var entPieDiseaseObj = new Chart(entPieDisease, entPieDiseaseDataConfig);

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

  xhttp.open("GET", "getAllDataEnt",false);
  xhttp.send();
}

