<?php  
	session_start();

	include_once("inc/db.php");
	include_once("inc/conn.php");
	include_once("inc/function.php");

	//create database object
	$db = new db();

	//connect to database
	$sql = $db->connectDB($connStr,$user,$pass);
	
	if(isset($_SESSION['recruitee_logged'])){

		$user_id = $_SESSION['recruitee_logged']['user_id'];
	}

	if(isset($_POST['test'])){
		$companies = $_POST['company'];
		// var_dump($data);

		foreach ($companies as $company_data => $company) {
			echo $company['name'].'<br><br>';
			echo $company['post'].'<br><br>';
			echo $company['start_date'].'<br><br>';
			echo $company['end_date'].'<br><br>';
		}
	}

// login
	if (isset($_POST['login'])) {

		//check for empty fields
		foreach($_POST as $key => $val) {
		 	if(empty($val)){
			 	$_SESSION['notification'] = "<div class='notification'>
								<div class='alert alert-danger alert-dismissable'>
			          				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
			          					<p style='text-trasform: capitalize;'><strong>ERROR: </strong>Fill the empty Fields.</p>
			        			</div>
							</div>";
				header("Location: $base_url");
				exit();
			}
	    }

		    $email = strtolower($_POST['email']);
		    $password = $_POST['password'];

			//check if user is valid
			$query = "SELECT * FROM recruitee WHERE email='$email' AND password='$password'";
			$r = $db->selectDB($sql,$query);
			if($r->rowCount() > 0){
				$_SESSION['recruitee_logged']['email'] = $email;
				$_SESSION['recruitee_logged']['user_id'] = get_recruitee_id($email, $db, $sql);


				header("Location: $base_url/add_cv.php");
				exit();
			}
			else{
				$_SESSION['notification'] = "<div class='notification'>
								<div class='alert alert-danger alert-dismissable'>
			          				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
			          					<p style='text-trasform: capitalize;'><strong>ERROR: </strong>Invalid Login Details.</p>
			        			</div>
							</div>";
				header("Location: $base_url");
				exit();

			}		
	}

	// Admin logout
	if (isset($_POST['logout'])) {
		unset($_SESSION['recruitee_logged']);
		header("Location: $bases_url");
		exit();
	}
       
        // for ajax request
	if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

		// delete movie
		if (isset($_POST['action']) AND $_POST['action'] == "delete_movie"){
			$id = $_POST['id'];

			$return = $db->deleteDB($sql, "DELETE FROM movies WHERE id='$id'");
			if ($return === TRUE) {
				echo '1';
			}
			else{
				echo '0';
			}
		}
                // delete order
		if (isset($_POST['action']) AND $_POST['action'] == "delete_order"){
			$id = $_POST['id'];

			$return = $db->deleteDB($sql, "DELETE FROM bookings WHERE id='$id'");
			if ($return === TRUE) {
				echo '1';
			}
			else{
				echo '0';
			}
		}
  }

  /*AJAX REQUEST ENDS HERE*/
  
	
// admin reg
if (isset($_POST['signup'])) {

    // check for empty fields
    foreach ($_POST as $key => $val) {
        if (empty($val)) {
            $_SESSION['notification'] = "<div class='notification'>
								<div class='alert alert-danger alert-dismissable'>
			          				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
			          					<p style='text-transform: capitalize;'><strong>ERROR: </strong>Fill the empty Fields.</p>
			        			</div>
							</div>";
            header("Location: $base_url/signup.php");
            exit();
        }
    }

    $name = strtolower($_POST['username']);
    $email = strtolower($_POST['email']);
    $password = strtolower($_POST['password']);

    if($password != $_POST['rpassword']){
    	 $_SESSION['notification'] = "<div class='notification'>
								<div class='alert alert-danger alert-dismissable'>
			          				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
			          					<p style='text-transform: capitalize;'><strong>ERROR: </strong>Retype same password.</p>
			        			</div>
							</div>";
            header("Location: $base_url/signup.php");
            exit();
    }

    //check if email exist
    $query = "SELECT * FROM recruitee WHERE email='$email'";
    $r = $db->selectDB($sql, $query);
    if ($r->rowCount() > 0) {
        $_SESSION['notification'] = "<div class='notification'>
							<div class='alert alert-danger alert-dismissable'>
		          				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
		          					<p style='text-transform: capitalize;'><strong>ERROR: </strong>$email already Exist.</p>
		        			</div>
						</div>";
        header("Location: $base_url/signup.php");
        exit();
    } else {
        // insert user
        $ee = $db->insertDB($sql, "INSERT INTO recruitee(username, email, password) VALUES('$name', '$email', '$password')");

        if ($ee === TRUE) {

        	$_SESSION['recruitee_logged']['email'] = $email;
			$_SESSION['recruitee_logged']['user_id'] = get_recruitee_id($email, $db, $sql);

			//Open a new Document for user
			$user_id = $_SESSION['recruitee_logged']['user_id'];
			if(userHasCV($user_id, $db, $sql)){
				//Do nothing
			}else{
				$ee = $db->insertDB($sql, "INSERT INTO recruitee_cv(recruitee_id, status, submitted) VALUES('$user_id', 0, 0)");
			}

            $_SESSION['notification'] = "<div class='notification'>
							<div class='alert alert-success alert-dismissable'>
		          				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
		          					<p style='text-transform: capitalize;'><strong>Welcome $name , please fill out your CV then submit</strong></p>
		        			</div>
						</div>";
            header("Location: $base_url/add_cv.php");
            exit();
        } else {
            $_SESSION['notification'] = "<div class='notification'>
							<div class='alert alert-danger alert-dismissable'>
		          				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
		          					<p style='text-transform: capitalize;'><strong>ERROR: </strong>$ee</p>
		        			</div>
						</div>";
            header("Location: $base_url/signup.php");
            exit();
        }
    }
}


/*FILL OUT CV*/
if(isset($_POST['finish'])){
	$user_id = $_SESSION['recruitee_logged']['user_id'];
	$cv_id = getUserCV($user_id, $db, $sql);

	//Get all from personal details and update recruitee table where id == user_id
	$fullname = $_POST['fullname'];
	$phone = $_POST['phone'];
	$religion = $_POST['religion'];
	$marital_status = $_POST['marital_status'];
	$language = $_POST['language'];
	$gender = $_POST['gender'];
	$state = $_POST['state'];
	$nationality = $_POST['nationality'];
	$address = $_POST['address'];

	$db->updateDB($sql, "UPDATE recruitee SET fullname = '$fullname', phone = '$phone', religion = '$religion', marital_status = '$marital_status', language = '$language', gender = '$gender', state = '$state', nationality = '$nationality', address = '$address' WHERE id = '$user_id'");


	//Get all from work experience and insert into work_experience table.
	$companies = $_POST['company'];

	//save data into database
	foreach ($companies as $company_data => $company) {
	  /*if(empty($record[1]) || empty($record[2]) || empty($record[3]) || empty($record[4])){
	    continue;
	  }else{
*/
	  	 $company_name = $company['name'];
		 $post = $company['post'];
		 $start_date = $company['start_date'];
		 $end_date = $company['end_date'];
		 $address = $company['address'];

	  		$ee = $db->insertDB($sql, "INSERT INTO work_experience(cv_id, workshop_name, start_date, end_date, post_held, workshop_address) VALUES('$cv_id', '$company_name', '$start_date', '$end_date', '$post', '$address')");
	  /*}*/
	    
	}

	//Get all from education qualification and insert into edu_qualification table.
	$schools = $_POST['school'];

	foreach ($schools as $school_data => $school) {
	  /*if(empty($record[1]) || empty($record[2]) || empty($record[3]) || empty($record[4])){
	    continue;
	  }else{*/

	  	 $school_name = $school['name'];
		 $qualification = $school['qualification'];
		 $course = $school['course'];
		 $start_date = $school['start_date'];
		 $end_date = $school['end_date'];

	  		$ee = $db->insertDB($sql, "INSERT INTO edu_qualification(cv_id, school_name, qualification_obtained, start_date, end_date, course_studied) VALUES('$cv_id', '$school_name', '$qualification', '$start_date', '$end_date', '$course')");
	  /*}*/
	    
	}

	/*Get all from referees and insert into referees table*/
	$referees = $_POST['referee'];

	foreach ($referees as $referee_data => $referee) {
	  /*if(empty($record[1]) || empty($record[2]) || empty($record[3]) || empty($record[4])){
	    continue;
	  }else{*/

	  	 $referee_name = $referee['name'];
		 $phone = $referee['phone'];
		 $address = $referee['address'];
		 $email = $referee['email'];

	  		$ee = $db->insertDB($sql, "INSERT INTO recruitee_referees(cv_id, referee_name, referee_phone, referee_address, referee_email) VALUES('$cv_id', '$referee_name', '$phone', '$address', '$email')");
	  /*}*/   
	}

	/*If all the entries are successful then update the submitted column in table recruitee_cv to 1*/
	$ee = $db->updateDB($sql, "UPDATE recruitee_cv SET submitted = 1 WHERE id = '$cv_id'");

	if($ee === TRUE){
		$_SESSION['notification'] = "<div class='notification'>
							<div class='alert alert-success alert-dismissable'>
		          				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
		          					<p style='text-transform: capitalize;'><strong>CV successfully submitted, Check the feedback later to see if your CV has been confirmed</strong></p>
		        			</div>
						</div>";
            header("Location: $base_url/add_cv.php");
            exit();
	}


}