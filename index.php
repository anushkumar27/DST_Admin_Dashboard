<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login | Dashboard</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="./images/fav.png" />
    <!-- Bootstrap -->
    <link href="./vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="./vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="./vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="./vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="./build/css/custom.min.css" rel="stylesheet">

    <style type="text/css">
      body {
        overflow-x: hidden;
      }
    </style>
  </head>

  <body class="login">
      <div class="row">
        <br/>
        <br/>
        <div class="col-md-3 col-md-offset-1">
          <img class="text-center" src="./images/pes-logo.png" style="width: 200px"/>
        </div>
        <div class="col-md-3 col-md-offset-1">
          <img class="text-center" src="./images/dst-logo.png" style="width: 200px"/>
        </div>
        <div class="col-md-3 col-md-offset-1">
          <img class="text-center" src="./images/pesimsr-logo.png" style="width: 200px"/>
        </div>
      </div>
      <div class="row">
        <br/>
        <div class="col-md-3 col-md-offset-5">
          <img class="text-center" src="./images/logo.png" style="width: 200px"/>
        </div>
      </div>

      <div class="login_wrapper" style="margin: auto;">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="validate" method="post">
              <h1>Login</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" name="uname" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" name="pass" required="" />
              </div>
              
              <input type="submit" value="Login" class="btn btn-default submit text-center" style="width: 200px;clear:both;float: none;display:block;margin: auto;"/>
            </form>
          </section>
        </div>

      </div>
  </body>
</html>
