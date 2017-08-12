<?php 
session_start() ;
?>

<!DOCTYPE html>

<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>My Dashboard | DST Project</title>
    <script src="../js/student_id.js"></script>    

	<!-- Favicon -->
    <link rel="icon" href="images/favicon.png" sizes="16x16" type="image/png">
	
    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <style>
  table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
  }

  td, th {
      border: 1px solid #dddddd;
      text-align: center;
      padding: 8px;
  }

  </style>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a class="site_title"><span class="glyphicon glyphicon-dashboard"></span><span> Dashboard | Follow Up</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                <img id="profileImage1" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $_SESSION['userName'];?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>&nbsp</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-edit"></i> Forms <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="../../report">Report Generation</a></li>
                      <li><a href="../../follow_up">Follow-Up Updation</a></li>
                    </ul>
                  </li>
				  <li><a href="student_id.php"><i class="fa fa-users"></i> Student ID Info</a>
                  </li>
                  <li><a><i class="fa fa-bar-chart-o"></i> Data Presentation <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="circos_1.php">Circos Chat 1</a></li>
                      <li><a href="circos_2.php">Circos Chart 2</a></li>
                      <li><a href="circos_3.php">Circos Chart 3</a></li>
                      <li><a href="circos_4.php">Circos Chart 4</a></li>
                    </ul>
                  </li>
				    <li><a target="_blank" href="geo_map.php"><i class="fa fa-map-marker"></i>Geospatial Map</a>
                  </li>
                </ul>
              </div>
             
            </div>
            <!-- /sidebar menu -->
          </div>
        </div>
        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a href="dashboard.php"><i class="fa fa-arrow-circle-left"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img id="profileImage1" alt=""><?php echo $_SESSION['userName'];?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="../index.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <script>          
            var userId= "<?php echo $_SESSION['uname'];?>";
            //console.log("username="+userId);
            document.getElementById("profileImage1").src="images/"+userId+".png";
            document.getElementById("profileImage2").src="images/"+userId+".png";
        </script>

        <div class="right_col" role="main">
          <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2> Follow up </h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <table id="follow_up_table">
                    <tr>
                      <th>STUDENT ID</th>
                      <th>STUDENT NAME</th>
                      <th>REFERAL</th>
                      <th>NEXT FOLOW UP DATE</th>
                    </tr>
                  </table>
                  </div>
                </div>
              </div>
              </div>
              </div>
              </div><!-- footer content -->
        <footer>
          <div class="pull-right">
           PES Institute of Technology and PES Institute of Medical Science of Research     </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->

                  <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="../vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="../vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="../vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="../vendors/Flot/jquery.flot.js"></script>
    <script src="../vendors/Flot/jquery.flot.pie.js"></script>
    <script src="../vendors/Flot/jquery.flot.time.js"></script>
    <script src="../vendors/Flot/jquery.flot.stack.js"></script>
    <script src="../vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="../vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="../vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="../vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

<script type="text/javascript">
        var schID=<?php echo $_SESSION['schID']?>;
        var xhttp=new XMLHttpRequest();
        var table=document.getElementById("follow_up_table");         
        xhttp.onreadystatechange = function (){
            if(xhttp.readyState==4 && xhttp.status==200){
                dataReceived=JSON.parse(xhttp.responseText);
                console.log(dataReceived);
              if(dataReceived!=0){
                for(var i=0;i<dataReceived.length;i++)
                {
                  var row=table.insertRow(i+1);
                  var cell0=row.insertCell(0);
                  var cell1=row.insertCell(1);
                  var cell2=row.insertCell(2);
                  var cell3=row.insertCell(3);
                  cell0.innerHTML=dataReceived[i][0];
                  cell1.innerHTML=dataReceived[i][1];
                  cell2.innerHTML=dataReceived[i][2];
                  cell3.innerHTML=dataReceived[i][3];

                }
          }
          else
            document.getElementById("follow_up_table").innerHTML="No students for follow up";
          }

        };
        xhttp.open("POST","http://"+ip_address+"/Web_Portal/production/school_fu_fill.php",false);
        xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xhttp.send("s="+schID);

</script>

    </body>
    </html>

