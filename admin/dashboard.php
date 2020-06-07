<?php
	session_start();

	include 'header.php';
    if(isset($_SESSION['notification'])){
        $notification = $_SESSION['notification'];
    }
   

    //create database object
$db = new db();

//connect to database
if ($sql = $db->connectDB($connStr, $user, $pass)) {
    if (is_string($sql)) {
        echo $sql;
    }
}

if(!isset($_SESSION['cv_admin_logged'])){
	$_SESSION['notification'] = "<div class='notification'>
								<div class='alert alert-danger alert-dismissable'>
			          				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
			          					<p style='text-trasform: capitalize;'><strong>ERROR: </strong>Please Log in to view this page.</p>
			        			</div>
							</div>";
				header("Location: $base_url/admin");
				exit();
}

?>



<div class="row">
    <div class="col-md-3">
        <div class="mini-stat clearfix">
            <span class="mini-stat-icon orange"><i class="fa fa-users"></i></span>
            <div class="mini-stat-info">
                <span><?php echo getNumOfUsers($db, $sql); ?></span>
                Users
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="mini-stat clearfix">
            <span class="mini-stat-icon tar"><i class="fa fa-book"></i></span>
            <div class="mini-stat-info">
                <span><?php echo getNumOfConfirmedCv($db, $sql); ?></span>
                Confirmed CV(s)
            </div>
        </div>
    </div>
    
</div>
<?php
	include('footer.php')
?>	