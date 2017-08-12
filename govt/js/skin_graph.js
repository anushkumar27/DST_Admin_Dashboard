// call for data
getData();

var doughnutStudents = document.getElementById("doughnutStudents");
var doughnutStudentsDataConfig = {
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
var doughnutStudentsObj = new Chart(doughnutStudents, doughnutStudentsDataConfig);

var pieDisease = document.getElementById("pieDisease");
var pieDiseaseDataConfig = {
        type: 'pie',
        data: {
            datasets: [{
                data: [
                  dataReceived.Scabies,
                  dataReceived.PityriasisAlba,
                  dataReceived.Phrynoderma,
                  dataReceived.Pediculosis,
                  dataReceived.Impetigo,
                  dataReceived.Papularurticaria,
                  dataReceived.TineaCrusis,
                  dataReceived.Miliaria,
                  dataReceived.ViralWarts,
                  dataReceived.Xerosis
                ],
                backgroundColor: [
                   '#2c3e50',
                   '#16a085',
                   '#f39c12',
                   '#7f8c8d',
                   '#d35400',
                   '#c0392b',
                   '#e67e22',
                   '#f1c40f',
                   '#27ae60',
                   '#2980b9'
                ],
                label: 'Dataset'
            }],
            labels: [
                "Scabies",
                "Pityriasis Alba",
                "Phrynoderma",
                "Pediculosis",
                "Impetigo",
                "Papularurticaria",
                "Tinea Crusis",
                "Miliaria",
                "Viral Warts",
                "Xerosis"
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
var pieDiseaseObj = new Chart(pieDisease, pieDiseaseDataConfig);

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

  xhttp.open("GET", "getAllDataSkin",false);
  xhttp.send();
}

