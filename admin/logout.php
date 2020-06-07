<?php
	include '../inc/function.php';

	unset($_SESSION['advert_admin_logged']);
	header("Location: $b_url");
	exit();