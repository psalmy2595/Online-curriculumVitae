<?php
	$base_url = "http://127.0.0.1/pr-cv";

	function get_admin_id($email, $db, $sql) {
		$query = "SELECT * FROM admin WHERE email='$email'";
		$return = $db->selectDB($sql,$query);
		if ($return->rowCount() > 0) {
			while($r = $return->fetch()){
				return $r->id;
			}
		}
		else{
			return NULL;
		}	
	}

	function get_recruitee_id($email, $db, $sql) {
		$query = "SELECT * FROM recruitee WHERE email='$email'";
		$return = $db->selectDB($sql,$query);
		if ($return->rowCount() > 0) {
			while($r = $return->fetch()){
				return $r->id;
			}
		}
		else{
			return NULL;
		}	
	}

	function userHasCV($user_id, $db, $sql) {
		$query = "SELECT * FROM recruitee_cv WHERE recruitee_id='$user_id'";
		$return = $db->selectDB($sql,$query);
		if ($return->rowCount() > 0) {
			return true;
		}
		else{
			return false;
		}	
	}

	function getUserCV($user_id, $db, $sql) {
		$query = "SELECT * FROM recruitee_cv WHERE recruitee_id='$user_id'";
		$return = $db->selectDB($sql,$query);
		if ($return->rowCount() > 0) {
			while($r = $return->fetch()){
				return $r->id;
			}
		}
		else{
			return null;
		}	
	}

	function getUserName($user_id, $db, $sql) {
		$query = "SELECT * FROM recruitee WHERE id='$user_id'";
		$return = $db->selectDB($sql,$query);
		if ($return->rowCount() > 0) {
			while($r = $return->fetch()){
				return $r->fullname;
			}
		}
		else{
			return null;
		}	
	}

	function cvConfirmed($user_id, $db, $sql) {
		$query = "SELECT * FROM recruitee_cv WHERE recruitee_id='$user_id' AND status= 1";
		$return = $db->selectDB($sql,$query);
		if ($return->rowCount() > 0) {
			return true;
		}
		else{
			return false;
		}	
	}

	function getNumOfUsers($db, $sql) {
		$query = "SELECT * FROM recruitee";
		$result = $db->selectDB($sql,$query);
		return $result->rowCount();	
	}

	function getNumOfConfirmedCv($db, $sql) {
		$query = "SELECT * FROM recruitee_cv WHERE status = 1";
		$result = $db->selectDB($sql,$query);
		return $result->rowCount();	
	}

	function getPersonalDetail($user_id, $db, $sql) {
		$query = "SELECT * FROM recruitee WHERE id='$user_id'";
		$return = $db->selectDB($sql,$query);
		if ($return->rowCount() > 0) {
			$result = $return->fetch();
			/*while($r = $return->fetch()){
				return $r;
			}*/
			return $result;
		}
		else{
			return null;
		}	
	}

	function get_admin_name($id, $db, $sql) {
		$query = "SELECT * FROM admin WHERE id='$id'";
		$return = $db->selectDB($sql,$query);
		if ($return->rowCount() > 0) {
			while($r = $return->fetch()){
				return $r->name;
			}
		}
		else{
			return NULL;
		}	
	}

	function get_customer_name($id, $db, $sql) {
		$query = "SELECT * FROM customer WHERE id='$id'";
		$return = $db->selectDB($sql,$query);
		if ($return->rowCount() > 0) {
			while($r = $return->fetch()){
				return $r->fullname;
			}
		}
		else{
			return NULL;
		}	
	}

function get_num_of_ads($db, $sql) {
		$query = "SELECT * FROM advert";
		$result = $db->selectDB($sql,$query);
		return $result->rowCount();	
	}
	

	function get_category_name($id, $db, $sql){
		$query = "SELECT * FROM categories WHERE id='$id'";
		$return = $db->selectDB($sql,$query);
		if ($return->rowCount() > 0) {
			while($r = $return->fetch()){
				return $r->name;
			}
		}
		else{
			return NULL;
		}	
	}

	function get_sellers_name($id, $db, $sql){
		$query = "SELECT * FROM customer WHERE id='$id'";
		$return = $db->selectDB($sql,$query);
		if ($return->rowCount() > 0) {
			while($r = $return->fetch()){
				return $r->fullname;
			}
		}
		else{
			return NULL;
		}	
	}

	function get_sellers_phone($seller_id, $db, $sql){
		$query = "SELECT * FROM customer WHERE id='$seller_id'";
		$return = $db->selectDB($sql,$query);
		if ($return->rowCount() > 0) {
			while($r = $return->fetch()){
				return $r->phone;
			}
		}
		else{
			return NULL;
		}	
	}

	function get_sellers_address($seller_id, $db, $sql){
		$query = "SELECT * FROM customer WHERE id='$seller_id'";
		$return = $db->selectDB($sql,$query);
		if ($return->rowCount() > 0) {
			while($r = $return->fetch()){
				return $r->address;
			}
		}
		else{
			return NULL;
		}	
	}

	function get_sellers_details($id, $db, $sql){
		$query = "SELECT * FROM customer WHERE id='$id'";
		$return = $db->selectDB($sql,$query);
		if ($return->rowCount() > 0) {
			while($r = $return->fetch()){
				return array($r->name, $r->$address);
			}
		}
		else{
			return NULL;
		}	
	}

	function get_ad_avatar($id, $db, $sql){
		$query = "SELECT * FROM advert WHERE customer_id='$id'";
		$return = $db->selectDB($sql,$query);
		if ($return->rowCount() > 0) {
			while($r = $return->fetch()){
				return $r->cover;
			}
		}
		else{
			return NULL;
		}	
	}

	function delete_all_ads_avatar($db, $sql) {
		$query = "SELECT * FROM jokes";
		$return = $db->selectDB($sql,$query);
		if ($return->rowCount() > 0) {
			while($r = $return->fetch()){
				$file = "avatar/jokes/".$r->avatar;
	        	unlink($file);
			}
		}
	}	

	function get_ads_avatar($id, $db, $sql) {
		$query = "SELECT * FROM jokes WHERE id='$id'";
		$return = $db->selectDB($sql,$query);
		if ($return->rowCount() > 0) {
			while($r = $return->fetch()){
				return $r->avatar;
			}
		}
		else{
			return NULL;
		}	
	}

	function get_ad_status($id, $db, $sql){
		$return = $db->selectDB($sql, "SELECT * FROM advert WHERE status = 1 AND id= '$id'");
			if($return->rowCount() > 0){
				return TRUE;
			}else{
				return FALSE;
			}
		}
	
?>
