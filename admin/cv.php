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

if(isset($_GET['user_id'])){
    $user_id = $_GET['user_id'];
    $cv_id = getUserCV($user_id, $db, $sql);

    //Get the personal details
    $personalD = $db->selectDB($sql, "SELECT * FROM recruitee WHERE id = '$user_id'");
    if($personalD->rowCount() > 0){
        $personalD = $personalD;
    }else{
        $no_result = TRUE;
    }

    //Get the work experience
    $work = $db->selectDB($sql, "SELECT * FROM work_experience WHERE cv_id ='$cv_id'");
    if($work->rowCount() > 0){
        $work = $work;
    }else{
        $no_result = TRUE;
    }

    //Get education background and qualification
    $school = $db->selectDB($sql, "SELECT * FROM edu_qualification WHERE cv_id ='$cv_id'");
    if($school->rowCount() > 0){
        $school = $school;
    }else{
        $no_result = TRUE;
    }

    //Get education background and qualification
    $referee = $db->selectDB($sql, "SELECT * FROM recruitee_referees WHERE cv_id ='$cv_id'");
    if($referee->rowCount() > 0){
        $referee = $referee;
    }else{
        $no_result = TRUE;
    }


}else{
    header("Location: $base_url/admin");
    exit();
}
?>

<style type="text/css">
    .cv{
        padding-top: 40px;
        padding-bottom: 40px;
        min-height: 500px;
        background-color: #fff;
        margin: 50px;
        width: 900px;
    }
    .cv-main-header{
        text-align: center;
        /*text-decoration: underline;*/
    }
    .title-header{
        text-transform: uppercase;
        font-weight: bolder;
        text-decoration: underline;

    }
    ul{
        list-style: none;
    }

    li >strong{
        width: 200px;
        margin-right: 60px;

    }

    .divider{
        border-bottom: solid black;
    }
    .but{
        padding-top: 30px;
    }   
    
</style>
<div class="row">
    <div class="col-md-12 cv">
        <div class="col-md-12 cv-main-header">
            <strong><h2>CURRICULUM VITAE</h2></strong>
        </div>
        <div class="cv-contents">
            <section class="divider col-md-12">
                <div class="title-header">
                    <h4>personal data</h4>
                </div>
                <div>
                    <ul>
                        <?php
                            while ($row = $personalD->fetch()) {
                        ?>
                        <li><strong>Name:</strong><?php echo $row->fullname; ?></li>
                        <li><strong>Email:</strong><?php echo $row->email; ?></li>
                        <li><strong>Phone:</strong><?php echo $row->phone; ?></li>
                        <li><strong>Gender:</strong><?php echo $row->gender; ?></li>
                        <li><strong>Address:</strong><?php echo $row->address; ?></li>
                        <li><strong>Marital Status:</strong><?php echo $row->marital_status; ?></li>
                        <li><strong>State:</strong><?php echo $row->state; ?></li>
                        <li><strong>Language:</strong><?php echo $row->language; ?></li>
                        <li><strong>Nationality:</strong><?php echo $row->nationality; ?></li>

                        <?php } ?>
                    </ul>
                </div>
            </section>

            <section class="divider col-md-12">
                <div class="title-header">
                    <h4>work experience</h4>
                </div>

                <?php while ($row = $work->fetch()) { ?>
                <div class="col-md-4">
                    <ul>
                        <div><strong><?php echo $row->workshop_name; ?></strong></div>
                        <div><em><?php echo $row->post_held; ?></em><div>
                        <strong><em><?php echo $row->workshop_address; ?></em></strong>
                        <p><?php echo date('M j, Y', strtotime($row->start_date)).' - '.date('M j, Y', strtotime($row->start_date)); ?></p>
                    </ul>
                    
                </div>
                <?php } ?>
            </section>

            <section class="divider col-md-12">
                <div class="title-header">
                    <h4>educational background & Qualification</h4>
                </div>

                <?php while ($row = $school->fetch()) { ?>
                 
                <div class="col-md-4">
                    <ul>
                        <div><strong><?php echo $row->school_name; ?></strong></div>
                        <div><em><?php echo $row->qualification_obtained; ?></em></div>
                        <strong><em><?php echo $row->course_studied; ?></em></strong>
                        <p><?php echo date('M j, Y', strtotime($row->start_date)).' - '.date('M j, Y', strtotime($row->start_date)); ?></p>
                    </ul>
                    
                </div>
                <?php } ?>
            </section>

            <section class="col-md-12">
                <div class="title-header">
                    <h4>referees</h4>
                </div>

                <?php while ($row = $referee->fetch()) { ?>
                <div class="col-md-4">
                    <ul>
                        <div><strong><?php echo $row->referee_name; ?></strong></div>
                        <div><em><?php echo $row->referee_phone; ?></em></div>
                        <strong><em><?php echo $row->referee_address; ?></em></strong>
                        <p><?php echo $row->referee_email; ?></p>
                    </ul>
                    
                </div>
                <?php } ?>
            </section>
            
        </div>

        <div class="pull-right but">
            <a href="<?php echo $base_url; ?>/admin/customers.php" class="btn btn-md btn-danger">Reject</a>
            <a href="<?php echo $base_url; ?>/admin/controller.php?cv_id=<?php echo $cv_id; ?>" class="btn btn-md btn-info">Confirm</a>
        </div>
    </div>
</div>
<?php
	include('footer.php')
?>	