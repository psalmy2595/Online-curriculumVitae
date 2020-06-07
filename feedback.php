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
}else{
    $user_id = $_SESSION['recruitee_logged']['user_id'];
}

/*$return = $db->selectDB($sql, "SELECT * FROM customer");
    if($return->rowCount() > 0){
        $list = $return;
    }else{
        $no_result = TRUE;
    }
*/
?>

<?php
    if (cvConfirmed($user_id, $db, $sql)) {
        $username = getUserName($user_id, $db, $sql);
?>

<div class="col-md-6">
    <div class="alert alert-success">
        <span class="alert-icon"><i class="fa fa-envelope-o"></i></span>
        <div class="notification-info">
            <ul class="clearfix notification-meta">
                <li class="pull-left notification-sender"><span><a href="#"><?php echo $username; ?>.</a></span> your CV has been confirmed, come for your interview </li>
                <!-- <li class="pull-right notification-time">7 Hours Ago</li> -->
            </ul>
            <p>
                .
            </p>
        </div>
    </div>
    
</div>

<?php } else{?>

<div class="col-md-6">
    <div class="alert alert-danger">
        <span class="alert-icon"><i class="fa fa-envelope-o"></i></span>
        <div class="notification-info">
            <ul class="clearfix notification-meta">
                <li class="pull-left notification-sender"><span><a href="#"></a></span>Your CV has not been confirmed. </li>
                <!-- <li class="pull-right notification-time">7 Hours Ago</li> -->
            </ul>
            <p>
                .
            </p>
        </div>
    </div>
    
</div>

<?php } ?>


<?php
	include('footer.php')
?>	