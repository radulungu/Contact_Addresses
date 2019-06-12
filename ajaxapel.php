<?php

	error_reporting(E_ERROR);

	require_once 'database_conn.php';
	
	session_start();
	//include_once 'index.controller.php';

	$q = $_GET['q'];

	function lolo() {
 		
 		global $conn;
 		
 		$q = $_GET['q'];

        $query = "SELECT * FROM contacts where phone_number = ? and user_id =?";

        $stmt = $conn -> prepare($query);

        $stmt -> bind_param("ii", $q, $_SESSION['user_id']);

        $stmt -> execute();
        
      	$rows = $stmt->get_result(); 
  
        return $rows->num_rows;
	}

	$x = lolo();

	if($x == 1) {
		
		$hint = ""; 
	 
		if ($q !== "") {
	  
	   		$hint = " this number already exists!";
	   		
	   		echo $hint;
		}

	} else {
	 
	 $hint = " no suggestion available!";
	 
	 echo $hint;
	}

?>

