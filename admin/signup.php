<?php
    session_start();
    if(isset($_SESSION['notification'])){
        $notification = $_SESSION['notification'];
    }
    include '../inc/conn.php';
    include '../inc/function.php';
    include '../inc/db.php';

    //create database object
$db = new db();

//connect to database
if ($sql = $db->connectDB($connStr, $user, $pass)) {
    if (is_string($sql)) {
        echo $sql;
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="images/favicon.png">

    <title>Registration</title>

    <!--Core CSS -->
    <link href="<?php echo $base_url; ?>/admin/assets/bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>/admin/assets/css/bootstrap-reset.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>/admin/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="<?php echo $base_url; ?>/admin/assets/css/style.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>/admin/assets/css/style-responsive.css" rel="stylesheet" />

    
   
</head>

  <body class="login-body">

    <div class="container">

      <div>
          <?php
            if(isset($notification)){
                echo $notification;
            }
        ?>
      </div>
      <form class="form-signin" action="<?php echo $base_url; ?>/admin/controller.php" method="POST">
        <?php
            if(isset($notification)){
                echo $notification;
            }
        ?>
        <h2 class="form-signin-heading"><img src="<?php echo $base_url; ?>/assets/img/logo.png" width="300px;"></h2>
        <div class="login-wrap">
            <p>Enter your personal details below</p>
            <div class="form-group">
                <label>Fullname</label>
                <input type="text" name="fullname" class="form-control">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password   " name="password" class="form-control">
            </div>

            <div class="form-group">
                <label>Re-Password</label>
                <input type="password   " name="rpassword" class="form-control">
            </div>

            <div class="form-group">
                <input type="submit" name="admin_signup" class="form-control btn-primary">
            </div>
            <div class="registration">
                Already Registered.
                <a class="" href="<?php echo $base_url; ?>/admin">
                    Login
                </a>
            </div>

        </div>

      </form>

    </div>


    <!-- Placed js at the end of the document so the pages load faster -->

   <!--Core js-->
    <script src="<?php echo $base_url; ?>/admin/assets/js/jquery.js"></script>
    <script src="<?php echo $base_url; ?>/admin/assets/bs3/js/bootstrap.min.js"></script>

  </body>
</html>
<?php

    unset($_SESSION['notification']);