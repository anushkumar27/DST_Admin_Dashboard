// call for data
getData();

// setting data of top tiles 
document.getElementById('nSchools').innerHTML = dataReceived.nSchools;
document.getElementById('nStudents').innerHTML = parseInt(dataReceived.nMale) + parseInt(dataReceived.nFemale);
document.getElementById('nMale').innerHTML = dataReceived.nMale;
document.getElementById('nFemale').innerHTML = dataReceived.nFemale;
document.getElementById('nReferel').innerHTML = dataReceived.nReferel;
document.getElementById('nReport').innerHTML = dataReceived.nReport;

var refferalChart = document.getElementById("refferalDoughnut");
var refferalChartDataConfig = {
        type: 'doughnut',
        data: {
            datasets: [{
                data: dataReceived.referralDoughnut,
                backgroundColor: [
                   '#c0392b',
                   '#e67e22',
                   '#f1c40f',
                   '#27ae60',
                   '#2980b9'
                ],
                label: 'Dataset 1'
            }],
            labels: [
                "Eye",
                "ENT",
                "Skin",
                "Oral",
                "General"
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
var refferalChartObj = new Chart(refferalChart, refferalChartDataConfig);

var mandalDoughnut = document.getElementById("mandalDoughnut");
var mandalDoughnutDataConfig = {
        type: 'doughnut',
        data: {
            datasets: [{
                data: dataReceived.mandalDoughnut,
                backgroundColor: [
                   '#2c3e50',
                   '#16a085',
                   '#f39c12',
                   '#7f8c8d',
                   '#d35400'
                ],
                label: 'Dataset 1'
            }],
            labels: [
                "Kuppam",
                "Gudupalli",
                "Shanthipuram",
                "Ramakuppam",
                "Vkota"
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
var mandalDoughnutObj = new Chart(mandalDoughnut, mandalDoughnutDataConfig);

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