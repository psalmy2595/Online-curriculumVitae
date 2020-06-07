<?php  
	session_start();

	include_once("../inc/db.php");
	include_once("../inc/conn.php");
	include_once("../inc/function.php");

	//create database object
	$db = new db();

	//connect to database
	$sql = $db->connectDB($connStr,$user,$pass);
	
	if(isset($_SESSION['cv_admin_logged'])){

		$admin_id = $_SESSION['cv_admin_logged']['admin_id'];
	}

// login
	if (isset($_POST['alogin'])) {

		//check for empty fields
		foreach($_POST as $key => $val) {
		 	if(empty($val)){
			 	$_SESSION['notification'] = "<div class='notification'>
								<div class='alert alert-danger alert-dismissable'>
			          				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
			          					<p style='text-trasform: capitalize;'><strong>ERROR: </strong>Fill the empty Fields.</p>
			        			</div>
							</div>";
				header("Location: $base_url/admin");
				exit();
			}
	    }

		    $email = strtolower($_POST['email']);
		    $password = $_POST['password'];

			//check if user is valid
			$query = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
			$r = $db->selectDB($sql,$query);
			if($r->rowCount() > 0){
				$_SESSION['cv_admin_logged']['email'] = $email;
				$_SESSION['cv_admin_logged']['admin_id'] = get_admin_id($email, $db, $sql);

				header("Location: $base_url/admin/dashboard.php");
				exit();
			}
			else{
				$_SESSION['notification'] = "<div class='notification'>
								<div class='alert alert-danger alert-dismissable'>
			          				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
			          					<p style='text-trasform: capitalize;'><strong>ERROR: </strong>Invalid Admin Login Details.</p>
			        			</div>
							</div>";
				header("Location: $base_url/admin");
				exit();

			}		
	}

	// Admin logout
	if (isset($_POST['admin_logout'])) {
		unset($_SESSION['cv_admin_logged']);
		header("Location: $base_url");
		exit();
	}
        
   
	
// admin reg
if (isset($_POST['admin_signup'])) {

    // check for empty fields
    foreach ($_POST as $key => $val) {
        if (empty($val)) {
            $_SESSION['notification'] = "<div class='notification'>
								<div class='alert alert-danger alert-dismissable'>
			          				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
			          					<p style='text-transform: capitalize;'><strong>ERROR: </strong>Fill the empty Fields.</p>
			        			</div>
							</div>";
            header("Location: $base_url/admin/signup.php");
            exit();
        }
    }

    $name = strtolower($_POST['fullname']);
    $email = strtolower($_POST['email']);
    $password = strtolower($_POST['password']);

    if($password != $_POST['rpassword']){
    	 $_SESSION['notification'] = "<div class='notification'>
								<div class='alert alert-danger alert-dismissable'>
			          				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
			          					<p style='text-transform: capitalize;'><strong>ERROR: </strong>Retype same password.</p>
			        			</div>
							</div>";
            header("Location: $base_url/admin/signup.php");
            exit();
    }

    //check if category is valid
    $query = "SELECT * FROM admin WHERE email='$email'";
    $r = $db->selectDB($sql, $query);
    if ($r->rowCount() > 0) {
        $_SESSION['notification'] = "<div class='notification'>
							<div class='alert alert-danger alert-dismissable'>
		          				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
		          					<p style='text-transform: capitalize;'><strong>ERROR: </strong>$email already Exist.</p>
		        			</div>
						</div>";
        header("Location: $base_url/admin/signup.php");
        exit();
    } else {
        // insert category
        $ee = $db->insertDB($sql, "INSERT INTO admin(name, email, password) VALUES('$name', '$email', '$password')");

        if ($ee === TRUE) {

        	$_SESSION['cv_admin_logged']['email'] = $email;
			$_SESSION['cv_admin_logged']['admin_id'] = get_admin_id($email, $db, $sql);

            $_SESSION['notification'] = "<div class='notification'>
							<div class='alert alert-success alert-dismissable'>
		          				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
		          					<p style='text-transform: capitalize;'><strong>SUCCESS: </strong>Admin $name created</p>
		        			</div>
						</div>";
            header("Location: $base_url/admin/dashboard.php");
            exit();
        } else {
            $_SESSION['notification'] = "<div class='notification'>
							<div class='alert alert-danger alert-dismissable'>
		          				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
		          					<p style='text-transform: capitalize;'><strong>ERROR: </strong>$ee</p>
		        			</div>
						</div>";
            header("Location: $base_url/admin/signup.php");
            exit();
        }
    }
}

if(isset($_GET['cv_id'])){
	$cv_id = $_GET['cv_id'];

	$ee = $db->updateDB($sql, "UPDATE recruitee_cv SET status = 1 WHERE id = '$cv_id'");

	if($ee === TRUE){
		header("Location: $base_url/admin/customers.php");
            exit();
	}
}

if(isset($_POST['del_cus'])){
	$c_id = $_POST['customer_id'];

	$ee = $db->deleteDB($sql, "DELETE FROM 	recruitee WHERE id = '$c_id'");

	if($ee === TRUE){
		header("Location: $base_url/admin/customers.php");
            exit();
	}
}