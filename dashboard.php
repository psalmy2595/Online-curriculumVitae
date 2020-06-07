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

if(!isset($_SESSION['recruitee_logged'])){
	$_SESSION['notification'] = "<div class='notification'>
								<div class='alert alert-danger alert-dismissable'>
			          				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
			          					<p style='text-trasform: capitalize;'><strong>ERROR: </strong>Please Log in to view this page.</p>
			        			</div>
							</div>";
				header("Location: $base_url");
				exit();
}

?>



<div class="row">
    <div class="col-md-3">
        <div class="mini-stat clearfix">
            <span class="mini-stat-icon orange"><i class="fa fa-users"></i></span>
            <div class="mini-stat-info">
                <span><?php echo get_num_of_customer($db, $sql); ?></span>
                Customers
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="mini-stat clearfix">
            <span class="mini-stat-icon tar"><i class="fa fa-tag"></i></span>
            <div class="mini-stat-info">
                <span><?php echo get_num_of_ads($db, $sql); ?></span>
                Ads Placed
            </div>
        </div>
    </div>
    
</div>
<?php
	include('footer.php')
?>	