<?php
	session_start();
?>
<html>
	<head>
		<title>DST - Project | Follow Up </title>
		<!-- Core JS -->
		<script src="js/dashboard.js?n=1"></script> 	
		
		<!-- Favicon -->
		<link rel="icon" href="img/favicon.png" sizes="16x16" type="image/png">
		<!-- Bootstrap Core CSS -->
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
		
	</head>

	<body onload="begin()">
			<div class="navigation">
					<ul>
						<li style="float:left;"><p>Follow Up</p></li>
						<li id="logMeOut"><a href="index.php">Logout</a></li>
					  	<li id="GetNewStudent"><a onclick='newStudent()'>Save and Next Student</a></li>
					  	<!--<li id="saveMe"><a onclick='validate()'>Save</a></li>-->
					</ul>
			</div>
			<div class="page">
				<img id="pesit-logo" src="img/pesit.png" ></img>
				<img id="pesimsr-logo" src="img/pesimsr.png" ></img>
				<h1 style="font-size:25px;"><center>Follow Up<center></h1>
				<hr>

				<div id="main">
					<!-- Student Details -->
					<div class="well well-sm" >
						<table id="static-table" class="table" rules="none" style="margin-bottom:0px">
							<tr>
								<td>Student Unique ID :  <b><span id="student_id"></span></b></td>
								<td>Follow up No. : <b><span id="count"></span></b> </td>
								<td>Date of Treatment : <input type='date' class='datePicker' id="treat_date"></td>	
							</tr>
							<tr>
								<td>Child Name :  <b><span id="cname"></span></b></td>
								<td>Gender :  <b><span id="cgender"></span></b></td>
								<td>Age :  <b><span id="cage"></span></b></td>			
							</tr>
							<tr>
								<td>Parent Name :  <b><span id="pname"></span></b></td>
								<td></td>
								<td>Contact No. :  <b><input id="pmobile" maxlength="10" type="number" contenteditable="true"/></b></td>
							</tr>
							<tr>
								<td>School Name :  <b><span id="sname"></span></b></td>
								<td></td>
								<td>Contact No. :  <b><span id="smobile"></span></b></td>
							</tr>
							<tr>
								<td>Height :  <b><span id="height"></span></b></td>
								<td>Weight :  <b><span id="weight"></span></b></td>
								<td>Date of Initial Examination : <b><span id="dateIE"></span></b></td>
							</tr>
						</table>
					</div>
				</div>
				<div class="panel panel-default" style="margins:0px">
					<div class="panel-heading" style="font-size: 23px;">Diagnosis</div>
					<div class="panel-body" >
						<div id="diagnosis"></div>
						<div id="buttons"></div>
					
					</div>
				</div>
				
				<!--<p style="font-size:15px;"><center>- - - - - - - - - Cut Here - - - - - - - -<center></p>-->
				
				<div id="treatment-div" class="panel panel-default" style="margins:0px">
					<div class="panel-heading" style="font-size: 23px;">Prescription <span style="float:right;"><b><span id="student_id_pre"></b></span></div>
					<div class="panel-body">
						<table class="table table-bordered" id="treat-table">
						<thead>
						  <tr id="treat-row-0">
							<th><center>Medicine</center></th>
							<th><center>Frequency</center></th>
							<th><center>Duration</center></th>
							<th><center>Check Box</center></th>
						  </tr>
						</thead>
					  </table>
					  <div style="float:right;">
						<button class="btn btn-danger btn-md" id="treat-add" style='padding-left:10px; width:100px;' onclick='deleteTreat()'>Delete</button>
						<button class="btn btn-success btn-md" id="treat-add" style='padding-left:10px; width:100px;' onclick='addTreat()'>Add</button>
					  </div>
					</div>
				</div>
			</div>
			<div id="data"></div>
		
	</body>
	
	<script>// Global data reciever
		var dataReceived;
		var diagnosis = document.getElementById('diagnosis');
		var buttons = document.getElementById('buttons');
		var sid = <?php echo $_SESSION['sid'] ?> ;
		//console.log("Stud_id: "+sid);
		//console.log(window.location.hostname);
		var ip_address = window.location.hostname;
	</script>
</html>