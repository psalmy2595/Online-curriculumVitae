<?php

/**
 * Database Connection class
 * 
 * This connects,inserts,selects,delete to/from the database.
 * 
 * @package october 2019
 * @author samuel johnson
 * @copyright AstraTech 2019
 * @version 1.0
 * @param $connstr| the connection string = host + dbname
 * @param $user | the database user name
 * @param $pass | the database user
 * @param array| the functions return values in an array
 */


//TO HIDE ERROR OFF THE SCREEN
//error_reporting (E_ALL ^E_NOTICE);
//error_reporting (E_STRICT);

class db{

	function connectDB($connStr,$user,$pass){
	    try{
	       $conn = new PDO($connStr,$user,$pass);
	       $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
	    } 
	    catch (Exception $ex) {
            $error = $ex->getMessage();
            return $error;
	    }
  }

  
  function insertDB($conn,$query){
    try{
        $conn->query($query);
        return TRUE;
    }
    catch (PDOException $e){
      $error = "ERROR INSERTING INTO db: ".$e->getMessage();
      return $error;
    }
  }
  
  function selectDB($conn,$query){
    try{
      $q = $conn->query($query);
      $q->setFetchMode(PDO::FETCH_OBJ);
    }
    catch (PDOException $e){
      $error = "ERROR SELECTING FROM DB: ".$e->getMessage();
      return $error;
    }

    return $q;
  }

    function updateDB($conn,$query){
        try{
       		$conn->query($query);
            return true;
        }
        catch (PDOException $e){
          $error = "ERROR INSERTING INTO db: ".$e->getMessage();
          return $error;
        }
    }

    function deleteDB($conn,$query){
        try{
            $conn->query($query);
            return true;
        }
        catch (PDOException $e) {
          $error = "ERROR DELETING db: ".$e->getMessage();
          return $error;
        }
    }
}
?>