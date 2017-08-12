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

  <title>Dashboard</title>

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

  <style type="text/css">
    #map-div {
      width: 100%;
      height: 300px;
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
                <li><a href="/DST_Admin_Dashboard/admin"><i class="fa fa-home"></i> Home</a>
                </li>
                <li><a href="student_info"><i class="fa fa-group"></i>Student ID Information</a>
                </li>
                <li><a href="gis_console"><i class="fa fa-desktop"></i>GIS Console</a>
                </li>
                <li><a><i class="fa fa-edit"></i> Forms <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="./report" target="_blank" >Report Generation</a></li>
                    <li><a href="./follow_up" target="_blank" >Follow-Up Updation</a></li>
                  </ul>
                </li>
                <li><a href="quick_stats"><i class="fa fa-bar-chart-o"></i>Quick Stats</a>
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
        <!-- top tiles -->
        <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-graduation-cap"></i> Total Schools</span>
              <div class="count green" id="nSchools"></div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Students</span>
              <div class="count green" id="nStudents"></div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Males</span>
              <div class="count green" id="nMale"></div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Females</span>
              <div class="count green" id="nFemale"></div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-hospital-o"></i> Total Referrals</span>
              <div class="count green" id="nReferel"></div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-medkit"></i> Reports Generated</span>
              <div class="count green" id="nReport"></div>
            </div>
          </div>
        <!-- /top tiles -->
        <div class="row">
          <div class="col-md-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Heath Centers Distribution</h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content" >
                <div id="map-div"></div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">

          <div class="col-md-6">
            <div class="x_panel">
              <div class="x_title">
                <p>Referral Distribution</p>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <p>The graph below visulises the frequency distribution of affected children in their affected disease domain in the region of study</p>
                <canvas id="refferalDoughnut" height="200px"></canvas>
              </div>
            </div>
          </div>

<!--       the weather widget, uncomment if required
          <div class="col-md-3">
            <div class="x_panel">
              <div class="x_title">
                <p>Weather Report</p>
                <div class="clearfix"></div>
              </div>
              <div class="x_content" >
                  <a href="http://www.accuweather.com/en/in/kuppam/191872/weather-forecast/191872" class="aw-widget-legal"></a>
                  <div id="awcc1481390194015" class="aw-widget-current"  data-locationkey="191872" data-unit="c" data-language="en-us" data-useip="false" data-uid="awcc1481390194015"></div>
                  <script type="text/javascript" src="http://oap.accuweather.com/launch.js"></script>
              </div>
            </div>
          </div>
 -->
          <div class="col-md-6">
            <div class="x_panel">
              <div class="x_title">
                <p>Mandal Referral Distribution</p>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <p>The graph below visulises the frequency distribution of affected children in differenct region of study</p>
                <canvas id="mandalDoughnut" height="200px"></canvas>
              </div>
            </div>
          </div>


        </div>
      </div>
    </div>
    <!-- /page content -->

  </div>
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
    <!-- Graphs -->
    <script src="./js/graph.js"></script>
    <!-- Gmaps -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCUZp3Pe7FtxqOHAbJ3NzwyrK1EJVAT1Bk&libraries=visualization&callback=initMap"></script>
    <!-- Gmaps Custom-->
    <script src="./js/map.js"></script>

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
