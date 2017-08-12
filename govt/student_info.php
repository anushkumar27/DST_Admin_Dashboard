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

  <title>Student Info | Dashboard</title>

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
                <li><a href="/DST_Admin_Dashboard/govt"><i class="fa fa-home"></i> Home</a>
                </li>
                <li><a href="student_info"><i class="fa fa-group"></i>Student ID Information</a>
                </li>
                <li><a href="gis_console"><i class="fa fa-desktop"></i>GIS Console</a>
                </li>
                <!-- <li><a><i class="fa fa-edit"></i> Forms <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="/report" target="_blank" >Report Generation</a></li>
                    <li><a href="/follow_up" target="_blank" 
                    >Follow-Up Updation</a></li>
                  </ul>
                </li> -->
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
<!-- top tiles
        <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-graduation-cap"></i> Total Schools</span>
              <div class="count green">2500</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Students</span>
              <div class="count green">123.50</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Males</span>
              <div class="count green">2,500</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Females</span>
              <div class="count green">4,567</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-hospital-o"></i> Total Referrals</span>
              <div class="count green">2,315</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-medkit"></i> Reports Generated</span>
              <div class="count green">7,325</div>
            </div>
          </div>
        -->
        
        <div class="row">
          <div class="col-md-6">
            <div class="x_panel">
              <div class="x_title">
                <h2> Student ID Generation</h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">

                <div class="col-md-5">
                  <!-- required for floating -->
                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs tabs-left">
                    <li class="active"><a href="#tab1" data-toggle="tab">Mandal</a>
                    </li>
                    <li><a href="#tab2" data-toggle="tab">Govt / Pvt</a>
                    </li>
                    <li><a href="#tab3" data-toggle="tab">School Type</a>
                    </li>
                    <li><a href="#tab4" data-toggle="tab">Management</a>
                    </li>
                  </ul>
                </div>

                <div class="col-md-7">
                  <!-- Tab panes -->
                  <div class="tab-content">
                    <div class="tab-pane active" id="tab1">
                      <p class="lead"></p>
                      <p></p>
                    </div>
                    <div class="tab-pane" id="tab2"></div>
                    <div class="tab-pane" id="tab3"></div>
                    <div class="tab-pane" id="tab4"></div>
                  </div>
                </div>

                <div class="clearfix"></div>

              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="x_panel">
              <div class="x_title">
                <h2>ID Description </h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">

                <div class="col-md-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="For e.g. 20102003001" id="std_id">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button" onclick="decrypt()">Describe</button>
                    </span>
                  </div>

                  <div class="col-md-12 col-sm-6 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Description </h2>
                        <div class="clearfix"></div>
                      </div>
                      <div class="x_content">
                        <ul class="list-unstyled timeline">
                          <li>
                            <div class="block">
                              <div class="tags">
                                <a class="tag">
                                  <span>Mandal</span>
                                </a>
                              </div>
                              <div class="block_content">
                                <h2 class="title">
                                  <a id="sch_mandal"></a>
                                </h2>
                                <div class="byline">
                                </div>
                                <p class="excerpt">
                                </p>
                                <br>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="block">
                              <div class="tags">
                                <a class="tag">
                                  <span>Panchayat</span>
                                </a>
                              </div>
                              <div class="block_content">
                                <h2 class="title">
                                  <a id="sch_panch"></a>
                                </h2>
                                <div class="byline">
                                </div>
                                <p class="excerpt">
                                </p>
                                <br>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="block">
                              <div class="tags">
                                <a class="tag">
                                  <span>Village</span>
                                </a>
                              </div>
                              <div class="block_content">
                                <h2 class="title">
                                  <a id="sch_vill"></a>
                                </h2>
                                <div class="byline">
                                </div>
                                <p class="excerpt">
                                </p>
                                <br>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="block">
                              <div class="tags">
                                <a class="tag">
                                  <span>School Name</span>
                                </a>
                              </div>
                              <div class="block_content">
                                <h2 class="title">
                                  <a id="sch_name"></a>
                                </h2>
                                <div class="byline">
                                </div>
                                <p class="excerpt">
                                </p>
                                <br>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="block">
                              <div class="tags">
                                <a class="tag">
                                  <span>Child Name</span>
                                </a>
                              </div>
                              <div class="block_content">
                                <h2 class="title">
                                  <a id="stud_name"></a>
                                </h2>
                                <div class="byline">
                                </div>
                                <p class="excerpt">
                                </p>
                                <br>
                              </div>
                            </div>
                          </li>
                        </ul>

                      </div>
                    </div>
                  </div>
                </div>                    

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
    var mandal=["kuppam","Gudupalli","Shanthipuram","Ramakuppam","Vkota"];
    var gov=["Govt","Pvt"];
    var sch=["Primary (1-5)","Upper Primary (1-7)","High School (Upto 10)"];
    var manage=["Mandal Parishath","Zilla Parishath","Aided","Govt","Pvt Unaided"];
    var mand_str="";
    var gov_str="";
    var sch_str="";
    var man_str="";
    for(i=0;i<mandal.length;i++) {
      dat=(i+1)+"-"+mandal[i]+"</br>";
      mand_str+=dat;
    }
    document.getElementById("tab1").innerHTML=mand_str;

    for(i=0;i<gov.length;i++) {
      dat=(i+1)+"-"+gov[i]+"</br>";
      gov_str+=dat;
    }
    document.getElementById("tab2").innerHTML=gov_str;

    for(i=0;i<sch.length;i++) {
      dat=(i+1)+"-"+sch[i]+"</br>";
      sch_str+=dat;
    }
    document.getElementById("tab3").innerHTML=sch_str;

    for(i=0;i<manage.length;i++) {
      dat=(i+1)+"-"+manage[i]+"</br>";
      man_str+=dat;
    }
    document.getElementById("tab4").innerHTML=man_str;
    
    function decrypt() {
      var std_id = document.getElementById("std_id").value;
      if(std_id.length == 11){
        console.log("Selected Student ID", std_id);
        getData(std_id);
        var data=JSON.parse(dataReceived);
        document.getElementById("sch_mandal").innerHTML=data["mandal"]; 
        document.getElementById("sch_panch").innerHTML=data["panch"];
        document.getElementById("sch_vill").innerHTML=data["vill"];
        document.getElementById("sch_name").innerHTML=data["stud"];
        document.getElementById("stud_name").innerHTML=data["sch"];
      }else{
        alert("Enter Valid Student ID");
        document.getElementById("sch_mandal").innerHTML=""; 
        document.getElementById("sch_panch").innerHTML="";
        document.getElementById("sch_vill").innerHTML="";
        document.getElementById("sch_name").innerHTML="";
        document.getElementById("stud_name").innerHTML="";
      }
    }

    function getData(std_id) {
      var xhttp=new XMLHttpRequest();   
      xhttp.onreadystatechange = function (){
          if(xhttp.readyState==4 && xhttp.status==200){
              dataReceived=xhttp.responseText;
          }
      };
      xhttp.open("POST","getStudentData",false);
      xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
      xhttp.send("s="+std_id);
    }
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
