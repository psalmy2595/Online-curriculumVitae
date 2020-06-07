<?php
	include 'inc/function.php';

	unset($_SESSION['recruitee_logged']);
	header("Location: $b_url");
	exit();