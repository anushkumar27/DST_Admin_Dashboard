// call for data
getData();
console.log("Eye",dataReceived);
var eyeDoughnutStudents = document.getElementById("eyeDoughnutStudents");
var eyeDoughnutStudentsDataConfig = {
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
var eyeDoughnutStudentsObj = new Chart(eyeDoughnutStudents, eyeDoughnutStudentsDataConfig);

var eyePieDisease = document.getElementById("eyePieDisease");
var eyePieDiseaseDataConfig = {
        type: 'pie',
        data: {
            datasets: [{
                data: [
                  dataReceived.ColourVision,
                  dataReceived.BitotSpots,
                  dataReceived.AllergicConjunctivitis,
                  dataReceived.NightBlindness,
                  dataReceived.CongenitalPtosis,
                  dataReceived.CongenitalDevelopmentalCararact,
                  dataReceived.Amblyopia,
                  dataReceived.Nystagmus,
                  dataReceived.FundusExamination
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
                   '#27ae60'
                ],
                label: 'Dataset'
            }],
            labels: [
                "Colour Vision",
                "Bitot Spots",
                "Allergic Conjunctivitis",
                "Night Blindness",
                "Congenital Ptosis",
                "Congenital Developmental Cararact",
                "Amblyopia",
                "Nystagmus",
                "FundusExamination"
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
var eyePieDiseaseObj = new Chart(eyePieDisease, eyePieDiseaseDataConfig);

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

  xhttp.open("GET", "getAllDataEye",false);
  xhttp.send();
}

