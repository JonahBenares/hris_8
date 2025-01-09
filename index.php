<?php 
//session_start();
$url= "http://" . $_SERVER['SERVER_NAME']; 
?>
<!DOCTYPE html>
<html lang="en">


<style type="text/css">
    .back{
        height: 400px;
        background: #0002;
        background-image: url("<?php echo $url; ?>/HRIS/humanresource/assets/img/IMG_09391.png");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat; 
    }
    .card{
        border-radius: 20px!important
    }
</style>
<!--Designed By ALpha-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Vendor styles -->
    <link rel="stylesheet" href="<?php echo $url; ?>/humanresource/assets/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="<?php echo $url; ?>/humanresource/assets/vendors/bower_components/animate.css/animate.min.css">

    <!-- App styles -->
    <link rel="stylesheet" href="<?php echo $url; ?>/humanresource/assets/css/app.min.css">
    <link rel="stylesheet" href="<?php echo $url; ?>/humanresource/assets/css/style.css">
</head>

<body data-sa-theme="1">
    <div class="login">

        <div class="container">
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <div class="card" style="box-shadow: 0px 0px 8px 3px #00000063">
                        <div class="card-body" style="padding: 0px 15px">
                            <div class="row">
                            <div class="col-lg-6 back" style="border-radius:20px 0px 0px 20px!important"></div>
                            <div class="col-lg-6">
                                <div class="m-t-70"></div>
                                <center>
                                <h1>CENPRI - HRIS</h1>
                                <br>
                                </center>
                                <form role="form" method='POST' action="login.php">
                                    <div class="login__block__body">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                                        </div>

                                        <div class="form-group">
                                            <input type="password" class="form-control" placeholder="Password"  id="password" name="password">
                                        </div>
                                        <input type='submit' name='login_time' value='Login'  class="btn btn-secondary btn-block">
                                    </div>
                                </form>
                            </div>
                        </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-2"></div>
            </div>
        </div>
    </div>

    <script src="<?php echo $url; ?>/HRIS/humanresource/assets/vendors/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo $url; ?>/HRIS/humanresource/assets/vendors/bower_components/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?php echo $url; ?>/HRIS/humanresource/assets/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- App functions and actions -->
    <script src="<?php echo $url; ?>/HRIS/humanresource/js/app.min.js"></script>
</body>

<!--Designed By ALpha-->
</html>