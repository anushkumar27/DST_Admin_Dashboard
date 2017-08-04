var refferalChart = document.getElementById("refferalDoughnut");
var refferalChartDataConfig = {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [
					10,
					20,
					30,
					40,
					50                
                ],
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
                data: [
					10,
					20,
					30,
					40,
					50                
                ],
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
    }
  };

  xhttp.open("GET", "getAllData",false);
  xhttp.send();
}