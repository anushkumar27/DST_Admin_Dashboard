<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>DST - PROJECT</title>
    <!-- Favicon -->
    <link rel="icon" href="img/favicon.png" sizes="16x16" type="image/png">

    <!-- Bootstrap Core CSS -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<style>
ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-color: #5CB85C;
        position: fixed;
        width: 100%;
        top: 0;
    }

    li {
        float: right;
    }

    li a {
        display: block;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }
        li#logMeOut a:hover {
        background-color: #c0392b;
        color: white;
    }
</style>
</head>

<body>
    <br><br>
    <div class="container"> 
        <div class="row">
			<center><h3>Select The Type Of Report</h3></center>
            <table colspan="3">
            <td>
            <div style="width:400px">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><center>Student Report</center></h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="studentCheck.php" method="POST">
                            <fieldset>
								<div class="form-group">
                                    <input class="form-control" placeholder="StudentID - Start" name="sid" type="text" value="" required>
                                </div>
                                <button class="btn btn-lg btn-success btn-block">Generate</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            </td><td style="width:500px"><h3><center>Or...</center></h3></td>
            <td>
            <div style="width:400px">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><center>Consolidated Report</center></h3>
                    </div>
                    <div class="panel-body" id="show">
                        <form role="form" action="schoolCheck.php" method="POST">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Enter SchoolID" name="schID" type="text" value="">
                                </div>
                                <div>
                                <p><center>Or..</center></p>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" list='sch' placeholder="Enter School Name" id="auto" name="schNm" onkeyup="getData()"> 
                                </div>
                                <button class="btn btn-lg btn-success btn-block">Generate</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            </td>
        </div>
    </div>

    <!-- jQuery -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

</body>

<script type="text/javascript">
    
    function getData() {
    var ip_address = window.location.hostname;
    var xhttp;
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
        data=JSON.parse(xhttp.responseText);
        document.getElementById('auto').innerHTML="<datalist id=\"sch\"></datalist>";
        var dataList = document.getElementById('sch');
        dataList.innerHTML="";
        var input = document.getElementById('auto');

        data.forEach(function(item) {
        // Create a new <option> element.
        var option = document.createElement('option');
        // Set the value using the item in the JSON array.
        option.value = item;
        // Add the <option> element to the <datalist>.
        dataList.appendChild(option);
      });
      }
    };
    xhttp.open("POST","http://"+ip_address+"/report/ConsolidatedReport/autofill.php",false);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("s");
  }

</script>

</html>