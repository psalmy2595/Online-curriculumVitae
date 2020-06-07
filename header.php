<?php
    include('inc/function.php');
    include('inc/db.php');
    include('inc/conn.php');

    if(isset($_SESSION['notification'])){
        $notification = $_SESSION['notification'];
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

        <title>Curriculum VS</title>

        <!--Core CSS -->
        <link href="<?php echo $base_url; ?>/admin/assets/bs3/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo $base_url; ?>/admin/assets/css/bootstrap-reset.css" rel="stylesheet">
        <link href="<?php echo $base_url; ?>/admin/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

        <link rel="stylesheet" href="<?php echo $base_url; ?>/admin/assets/js/data-tables/DT_bootstrap.css" />
        <link href="<?php echo $base_url; ?>/admin/assets/css/jquery.steps.css?1" rel="stylesheet" />

        <!-- Custom styles for this template -->
        <link href="<?php echo $base_url; ?>/admin/assets/css/style.css" rel="stylesheet">
        <link href="<?php echo $base_url; ?>/admin/assets/css/style-responsive.css" rel="stylesheet" />

    </head>

    <body>
        <section id="container" >
            <!--header start-->
            <header class="header fixed-top clearfix">
                <!--logo start-->
                <div class="brand">

                    </a>
                    <div class="sidebar-toggle-box">
                        <div class="fa fa-bars"></div>
                    </div>
                </div>
                <!--logo end-->
                <div class="top-nav clearfix">
                    <!--search & user info start-->
                    <ul class="nav pull-right top-menu">
                        <!-- user login dropdown start-->
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <img alt="" src="<?php echo $base_url; ?>/admin/assets/images/avatar1_small.jpg">
                                <span class="username">
                                    <?php
                                    // echo $this->myname;
                                    ?>
                                </span>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu extended logout">
                                <!-- <li><a href="<?php echo $base_url; ?>/admin/assets/dashboard/profile"><i class=" fa fa-suitcase"></i>Profile</a></li> -->
                                <li><a href="<?php echo $base_url; ?>/logout.php"><i class="fa fa-key"></i> Log Out</a></li>
                            </ul>
                        </li>
                        <!-- user login dropdown end -->
                    </ul>
                    <!--search & user info end-->
                </div>
            </header>
            <!--header end-->
            <aside>
                <div id="sidebar" class="nav-collapse">
                    <!-- sidebar menu start-->            
                    <div class="leftside-navigation">
                        <ul class="sidebar-menu" id="nav-accordion">
                            <!-- <li>
                                <a href="<?php echo $base_url; ?>/dashboard.php">
                                    <i class="fa fa-dashboard"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li> -->

                            <li>
                                <a href="<?php echo $base_url; ?>/add_cv.php">
                                    <i class="fa fa-users"></i>
                                    <span>Add CV</span>
                                </a>
                            </li>
                            
                            <li>
                                <a href="<?php echo $base_url; ?>/feedback.php">
                                    <i class="fa fa-stack-overflow"></i>
                                    <span>Feedback</span>
                                </a>
                            </li>

                            <li>
                                <a href="<?php echo $base_url; ?>">
                                    <i class="fa fa-sign-out"></i>
                                    <span>Log Out</span>
                                </a>
                            </li>

                            <!-- <li>
                                <a href="<?php echo $base_url; ?>/admin/ads.php">
                                    <i class="fa fa-adn"></i>
                                    <span>Ads</span>
                                </a>
                            </li> -->
                        </ul>
                    </div>
                </div>
            </aside>

            <section id="main-content">
                <section class="wrapper">