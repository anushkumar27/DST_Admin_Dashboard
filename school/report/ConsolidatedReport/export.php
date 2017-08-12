<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Consolidated Report</title>
		<link rel="icon" href="img/favicon.png" sizes="16x16" type="image/png">
		<link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
		<!-- jQuery -->
		<script src="bower_components/jquery/dist/jquery.min.js"></script>
		<!-- Bootstrap Core JavaScript -->
		<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="css/report.css">

		<!-- Vex Alert -->
		<script src="vex-master/js/vex.combined.min.js"></script>
		<script>vex.defaultOptions.className = 'vex-theme-plain';</script>
		<link rel="stylesheet" href="vex-master/css/vex.css" />
		<link rel="stylesheet" href="vex-master/css/vex-theme-plain.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

		<style>
			h1{
				font-family: "Times New Roman", Georgia, Serif;
			}

			#pesit-logo{
				float: right;
				position: static;
				top: 3px;
				right: 2px;
			}
			#pesimsr-logo{
				float: left;
				position: static;
				margin-top:5px;
				top: 2px;
				left: 15px;
				height: 0.5%;
			}
		</style>

</head>
<body onload="getData()">

			<div class="navigation">
					<ul>
					  <li><a href=""></a></li>
					</ul>
			</div><br><br>
			<div>
				<img id="pesit-logo" src="img/pesit-LOGO.jpg" ></img>
				<img id="pesimsr-logo" src="img/pesimsr.png" ></img>
				<h1 style="font-size:25px;"><center>Consolidated Health Report<center></h1>
				<br>
<div id="sch_table">
<p><h2><center>Fetching Data.... Please Wait</center></h2></p>
</div>

</body>

<script type="text/javascript">
 	var ip_address = window.location.hostname;
	var sch_id=<?php echo $_SESSION['userId'] ?>;
	console.log(sch_id);
	var stud_id=[];
	var noEntry={"noTable":'',"partial":""};
	var missing=[];
	var partial=[];
					data=[];
		function getData() {
		var xhttp,data,empty;
		if (window.XMLHttpRequest){
			xhttp = new XMLHttpRequest();
		}
		else{
			xhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xhttp.onreadystatechange = function ()
		{
			if(xhttp.readyState==4 && xhttp.status==200)
			{
				data = xhttp.responseText;
				if(data==1)
				{
					document.getElementById("sch_table").innerHTML="<center><h3>No Student Health Data Available for "+sch_id+"</h3></center><br><br>";
					document.getElementById("sch_table").innerHTML+="<form action='../select.php'><center><button class=\"btn btn-success btn-md\">Back</button></form>";
				}
				else{
					//console.log(xhttp.responseText);
					data = JSON.parse(xhttp.responseText);
					
					for(var i=0;i<data['NoData'].length;i++)
					{
						stud_id.push(data['NoData'][i]['id']);
					}
					for(var i=0;i<stud_id.length;i++)
					{	
						if(data['NoData'][i][stud_id[i]].length==5)	
						missing.push(stud_id[i]);
						else
						{
							partial[stud_id[i]]=data['NoData'][i][stud_id[i]];
						}
					}
					document.getElementById("sch_table").innerHTML ="<form action=\"excel.php\" method=\"post\"><input class=\"btn btn-success btn-md\" id=\"download\" type=\"submit\" name=\"export_excel\" value=\"Download Report\"/></form><center><div><b>Referal Required</b>:"+data['follow'].length+ "&nbsp; <b>NoData</b>:"+missing.length+" &nbsp; <b>Partial Data</b>:"+(stud_id.length-missing.length)+"</center>";
					noEntry['noTable']=missing;
					noEntry['partial']=partial;
					/*for(var i=0;i<data['table'].length;i++)
					{
						if(data['table'][i]==String.fromCharCode(052))
						{
							tableData[i]="0";
							console.log(data['table'][i])
						}
					}*/
					document.getElementById("sch_table").innerHTML +=data['table'];
					
				}
			}
		};
		xhttp.open("POST","./school.php",false);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("s="+sch_id);
	}

</script>

</html>