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

  <title>GIS Console | Dashboard</title>

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
    .map-div {
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
            <a href="index.html" class="site_title text-center"><img src="./images/logo.png" width="100px" /></a>
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
                    <li><a href="/report" target="_blank">Report Generation</a></li>
                    <li><a href="/follow_up" target="_blank" >Follow-Up Updation</a></li>
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
        <!-- top tiles -->
        <div class="row tile_count">
            <div class="col-md-3 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Initial Stage</span>
              <div class="count green" id="c1"> - </div>
            </div>
            <div class="col-md-3 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Follow-up I</span>
              <div class="count green" id="c2"> - </div>
            </div>
            <div class="col-md-3 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Follow-up II</span>
              <div class="count green" id="c3"> - </div>
            </div>
            <div class="col-md-3 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Follow-up III</span>
              <div class="count green" id="c4"> - </div>
            </div>
          </div>
        <!-- /top tiles -->
        
        <div class="row">
          <div class="col-md-12">
            <div class="x_panel">
              <h2>Console Filter</h2>
              <div class="x_content" >
                <!-- Filter Options -->

                <div class="col-md-2">
                  <div class="x_title">
                    <h2>Madal Filter</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="btn-group-vertical" data-toggle="buttons" id="mandals">
                      <label class="btn btn-default active">
                          <input type="radio" name="mandalsName" value="0" checked/> All Mandals
                      </label> 
                      <label class="btn btn-default">
                          <input type="radio" name="mandalsName" value="1" /> Kuppam
                      </label> 
                      <label class="btn btn-default">
                          <input type="radio" name="mandalsName" value="2" /> V. Kota
                      </label> 
                      <label class="btn btn-default">
                          <input type="radio" name="mandalsName" value="3" /> Ramakuppam
                      </label> 
                      <label class="btn btn-default">
                          <input type="radio" name="mandalsName" value="4" /> Ramakuppam
                      </label> 
                      <label class="btn btn-default">
                          <input type="radio" name="mandalsName" value="5" /> Ramakuppam
                      </label> 
                    </div>
                </div>

                <div class="col-md-3">
                  <div class="x_title">
                    <h2>Student Filter</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="btn-group" data-toggle="buttons" id="students">
                      <label class="btn btn-default active">
                          <input type="radio" name="studentsName" value="0" checked/> All Students
                      </label> 
                      <label class="btn btn-default">
                          <input type="radio" name="studentsName" value="1" /> Male
                      </label> 
                      <label class="btn btn-default">
                          <input type="radio" name="studentsName" value="2" /> Female
                      </label> 
                  </div>

                  <br/>
                  <br/>

                  

                </div>
                     
                <div class="col-md-3">
                  <div class="x_title">
                    <h2>Diseases Filter</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="btn-group-vertical" data-toggle="buttons" id="d1">
                      <label class="btn btn-default">
                          <input type="checkbox" name="d" value="health1%oe_dc" /> Dental Caries
                      </label> 
                      <label class="btn btn-default">
                          <input type="checkbox" name="d" value="eye%bs_r#bs_l" /> Bitots spots
                      </label> 
                      <label class="btn btn-default">
                          <input type="checkbox" name="d" value="eye%ac_r#ac_l" /> Allergic Conjunctivitis
                      </label> 
                      <label class="btn btn-default">
                          <input type="checkbox" name="d" value="health2%vt_b" /> Vitamin B Complex Deficiency
                      </label> 
                      <label class="btn btn-default">
                          <input type="checkbox" name="d" value="ent%iw_r#iw_l" /> Wax
                      </label> 
                      <label class="btn btn-default">
                          <input type="checkbox" name="d" value="ent%as_r#as_l" /> ASOM
                      </label> 
                      <label class="btn btn-default">
                          <input type="checkbox" name="d" value="ent%cs_r#cs_l" /> CSOM
                      </label>  
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="x_title">
                    <h2>(MultiSelect)</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="btn-group-vertical" data-toggle="buttons" id="d2">

                      <label class="btn btn-default">
                          <input type="checkbox" name="d" value="ent%oe_r#oe_l" /> Otitis Externa
                      </label> 
                       <label class="btn btn-default">
                          <input type="checkbox" name="d" value="ent%ad" /> Adenotonsilitis
                      </label> 
                      <label class="btn btn-default">
                          <input type="checkbox" name="d" value="skin%pi" /> Pityriasis Alba
                      </label> 
                      <label class="btn btn-default">
                          <input type="checkbox" name="d" value="skin%pe" /> Pediculosis
                      </label> 
                      <label class="btn btn-default">
                          <input type="checkbox" name="d" value="skin%sc" /> Scabies
                      </label> 
                      <label class="btn btn-default">
                          <input type="checkbox" name="d" value="skin%pap" /> Papular Urticaria
                      </label> 
                      <label class="btn btn-default">
                          <input type="checkbox" name="d" value="skin%xerosis" /> Xerosis
                      </label>
                  </div>
                </div>

                <div class="col-md-1">
                  <input type="button" class="btn btn-info" onclick="updateMap()" value="GO" style="padding: 10px; margin: 10px;margin-top: 100px; font-weight: bold; height: 100px;width: 50px;"/> 
                </div>
          </div>
        </div>


        <div class="row">
          <div class="col-md-6">
            <div class="x_panel" style="padding: 5px 5px;">
              <div class="x_content" >
                <p> Initial Stage</p>
                <div class="map-div" id="map-div-1"></div>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="x_panel" style="padding: 5px 5px;">
              <div class="x_content" >
                <p> Follow-up I</p>
                <div class="map-div" id="map-div-2"></div>
              </div>
            </div>
          </div>

        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="x_panel" style="padding: 5px 5px;">
              <div class="x_content" >
                <p> Follow-up II</p>
                <div class="map-div" id="map-div-3"></div>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="x_panel" style="padding: 5px 5px;">
              <div class="x_content" >
                <p> Follow-up III</p>
                <div class="map-div" id="map-div-4"></div>
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
    <!-- Gmaps Custom-->
    <script src="./js/gis_maps.js"></script>
    <!-- Gmaps -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCUZp3Pe7FtxqOHAbJ3NzwyrK1EJVAT1Bk&libraries=visualization&callback=initMap"></script>
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
