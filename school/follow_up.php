<?php
    session_start();
    if(!$_SESSION['userName']){
      header('Location: /DST_Admin_Dashboard');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>FollowUp | Dashboard</title>

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="./images/fav.png" />
  <!-- Bootstrap -->
  <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- iCheck -->
  <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="../build/css/custom.min.css" rel="stylesheet">

  <!-- Custom CSS for Table -->
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
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="#" class="site_title text-center"><img src="./images/logo.png" width="100px" /></a>
          </div>

          <div class="clearfix"></div>

          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_pic">
              <img src="images/user.png" id="profileImage1" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Welcome,</span>
              <h2><?php echo $_SESSION['userName']; ?></h2>
            </div>
          </div>
          <!-- /menu profile quick info -->
          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <h3>G-Sehat Dashboard</h3>
              <ul class="nav side-menu">
                <li><a href="/DST_Admin_Dashboard/school"><i class="fa fa-home"></i> Home</a>
                </li>
                <li><a href="student_info"><i class="fa fa-group"></i>Student ID Information</a>
                </li>
                <!-- <li><a href="gis_console"><i class="fa fa-desktop"></i>GIS Console</a>
                </li> -->
                <li><a><i class="fa fa-edit"></i> Forms <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="report/ConsolidatedReport/export.php" target="_blank" >Report Generation</a></li>
                    <li><a href="stud_follow_up" target="_blank" 
                    >Follow-Up Updation</a></li>
                  </ul>
                </li>
                <!-- <li><a href="quick_stats"><i class="fa fa-bar-chart-o"></i>Quick Stats</a>
                </li> -->
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
            <ul class="nav navbar-nav navbar-right">
              <li class="">
                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <img src="images/user.png" id="profileImage2" alt=""><?php echo $_SESSION['userName']; ?>
                  <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu pull-right">
                  <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                </ul>
              </li>
            </ul>
          </nav>
        </div>
      </div>
      <!-- /top navigation -->

      <!-- page content -->
      <div class="right_col" role="main">

        <div class="row">
          <div class="col-md-12">
            <div class="x_panel">
              <div class="x_title">
                <h2> FollowUp Report</h2>
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
    </div>
    <!-- /page content -->

  </div>

  <!-- jQuery -->
  <script src="../vendors/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- FastClick -->
  <script src="../vendors/fastclick/lib/fastclick.js"></script>
  <!-- Chart.js -->
  <script src="../vendors/Chart.js/dist/Chart.min.js"></script>
  <!-- Custom Theme Scripts -->
  <script src="../build/js/custom.min.js"></script>
  <!-- Custom Theme Scripts -->
  <script src="../build/js/custom.min.js"></script>

  <script type="text/javascript">
        var schID=<?php echo $_SESSION['userId']?>;
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
        xhttp.open("POST","school_fill",false);
        xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xhttp.send("s="+schID);

</script>

   <script type="text/javascript">
      var userId= '<?php echo $_SESSION['userId']; ?>';

      // set profile pic
      document.getElementById("profileImage1").src="images/"+userId+".png";
      document.getElementById("profileImage2").src="images/"+userId+".png";

      document.getElementById("profileImage1").onerror = function(e) {
           document.getElementById("profileImage1").src="images/user.png";
      };

       document.getElementById("profileImage2").onerror = function(e) {
          document.getElementById("profileImage1").src="images/user.png";
      };


    </script>
</body>
</html>
