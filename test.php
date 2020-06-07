<?php
include 'header.php';
    // if(isset($_SESSION['notification'])){
    //     $notification = $_SESSION['notification'];
    // }
   

    //create database object
$db = new db();

//connect to database
if ($sql = $db->connectDB($connStr, $user, $pass)) {
    if (is_string($sql)) {
        echo $sql;
    }
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
	.comapny_name{

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
						<li><strong>Name:</strong>samuel Johnson</li>
						<li><strong>Email:</strong>samuel Johnsonn</li>
						<li><strong>Phone:</strong>samuel Johnson</li>
						<li><strong>Address:</strong>samuel Johnsonn</li>
						<li><strong>Marital Status:</strong>samuel Johnson</li>
						<li><strong>State:</strong>samuel Johnson</li>
						<li><strong>Language:</strong>samuel Johnson</li>
					</ul>
				</div>
			</section>

			<section class="divider col-md-12">
				<div class="title-header">
					<h4>work experience</h4>
				</div>
				<div class="col-md-4">
					<ul>
						<div><strong>Company Name</strong></div>
						<em>Manager</em>
						<p>start date - end date</p>
					</ul>
					
				</div>

				<div class="col-md-4">
					<ul>
						<div><strong>Company Name</strong></div>
						<em>Manager</em>
						<p>start date - end date</p>
					</ul>
					
				</div>
			</section>

			<section class="divider col-md-12">
				<div class="title-header">
					<h4>educational background & Qualification</h4>
				</div>
				<div class="col-md-4">
					<ul>
						<div><strong>School Name</strong></div>
						<em>Qualification obtained</em>
						<strong><em>Course studied</em></strong>
						<p>start date - end date</p>
					</ul>
					
				</div>

				<div class="col-md-4">
					<ul>
						<div><strong>School Name</strong></div>
						<em>Qualificaiton obtained</em>
						<strong><em>Course studied</em></strong>
						<p>start date - end date</p>
					</ul>
					
				</div>
			</section>

			<section class="col-md-12">
				<div class="title-header">
					<h4>referees</h4>
				</div>
				<div class="col-md-4">
					<ul>
						<div><strong>Referee Name</strong></div>
						<em>referee phone</em>
						<strong><em>referee address</em></strong>
						<p>referee email</p>
					</ul>
					
				</div>

				<div class="col-md-4">
					<ul>
						<div><strong>Referee Name</strong></div>
						<em>referee phone</em>
						<strong><em>referee address</em></strong>
						<p>referee email</p>
					</ul>
					
				</div>
			</section>
			
		</div>
	</div>
</div>