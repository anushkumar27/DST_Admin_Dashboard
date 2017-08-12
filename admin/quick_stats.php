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

  <title>Quick Stats | Dashboard</title>

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
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="/DST_Admin_Dashboard/admin" class="site_title text-center"><img src="./images/logo.png" width="100px" /></a>
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
                    <li><a href="#">Report Generation</a></li>
                    <li><a href="#">Follow-Up Updation</a></li>
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
                  <li><a href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                </ul>
              </li>
            </ul>
          </nav>
        </div>
      </div>
      <!-- /top navigation -->

      <!-- page content -->
      <div class="right_col" role="main">
        <!-- Skin -->
        <div class="row">

          <div class="col-md-6">
            <div class="x_panel">
              <div class="x_title">
                <p>Skin Disease Distribution (Male Vs Female)</p>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <p>The graph below visulises the distributionion of male and female children affected with skin diseases (referral)</p>
                <canvas id="doughnutStudents" height="190px"></canvas>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="x_panel">
              <div class="x_title">
                <p>Skin Disease Distribution (Disease)</p>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
              <p>The graph below visulises the distributionion of skin diseases in the region of study</p>
                <canvas id="pieDisease" height="200px"></canvas>
              </div>
            </div>
          </div>

        </div>
        <!-- Skin -->

        <!-- Eye -->
        <div class="row">

          <div class="col-md-6">
            <div class="x_panel">
              <div class="x_title">
                <p>Eye Disease Distribution (Male Vs Female)</p>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <p>The graph below visulises the distributionion of male and female children affected with Eye diseases (referral)</p>
                <canvas id="eyeDoughnutStudents" height="190px"></canvas>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="x_panel">
              <div class="x_title">
                <p>Eye Disease Distribution (Disease)</p>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
              <p>The graph below visulises the distributionion of Eye diseases in the region of study</p>
                <canvas id="eyePieDisease" height="200px"></canvas>
              </div>
            </div>
          </div>

        </div>
        <!-- Eye -->

        <!-- ENT -->
        <div class="row">

          <div class="col-md-6">
            <div class="x_panel">
              <div class="x_title">
                <p>ENT Disease Distribution (Male Vs Female)</p>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <p>The graph below visulises the distributionion of male and female children affected with ENT diseases (referral)</p>
                <canvas id="entDoughnutStudents" height="190px"></canvas>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="x_panel">
              <div class="x_title">
                <p>ENT Disease Distribution (Disease)</p>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
              <p>The graph below visulises the distributionion of ENT diseases in the region of study</p>
                <canvas id="entPieDisease" height="200px"></canvas>
              </div>
            </div>
          </div>

        </div>
        <!-- ENT -->

        <!-- Coming Soon -->
        <div class="row">
          <div class="col-md-12">
            
                <h5 class="text-center">More Stats</h5>
                <img src="images/coming_soon.gif" align="middle" style="display: block;margin-right: auto;margin-left: auto;"/>
          </div>
        </div>
        <!-- Coming Soon -->

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
    <script src="./js/skin_graph.js"></script>
    <script src="./js/ent_graph.js"></script>
    <script src="./js/eye_graph.js"></script>

    <script type="text/javascript">
      var userId= '<?php echo $_SESSION['userId']; ?>';

      // set profile pic
      document.getElementById("profileImage1").src="images/"+userId+".png";
      document.getElementById("profileImage2").src="images/"+userId+".png";

    </script>

  </body>
</html>
