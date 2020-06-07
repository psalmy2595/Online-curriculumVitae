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

    <title>Admin Login</title>

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

      <form class="form-signin" action="<?php echo $base_url; ?>/admin/controller.php" method="POST" name="form-login" >
        <h2 class="form-signin-heading" style="font-size: 25px;"><br><br> ADMIN LOGIN SCREEN </h2>
        <!-- <h2 class="form-signin-heading" style="font-size: 30px"></h2> -->
        <div class="login-wrap">
            <div class="user-login-info">
                <input type="text" class="form-control" placeholder="Email" name="email" autofocus>
                <input type="password" class="form-control" placeholder="Password" name="password">
            </div>
            <!--  -->
            <input type="submit" name="alogin" class="btn-primary form-control">

            <div class="registration">
                Don't have an account yet?
                <a class="" href="<?php echo $base_url; ?>/admin/signup.php">
                    Create an account
                </a>
            </div>

        </div>

         


    </div>

    <!-- Placed js at the end of the document so the pages load faster -->

    <!--Core js-->
    <script src="<?php echo $base_url; ?>/admin/assets/js/jquery.js"></script>
    <script src="<?php echo $base_url; ?>/admin/assets/bs3/js/bootstrap.min.js"></script>

  </body>
</html>
<?php

    unset($_SESSION['notification']);