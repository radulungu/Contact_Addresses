<?php
	error_reporting(E_ERROR);
	require_once 'database_conn.php';
	include_once 'index.controller.php';
	


	$q = $_GET['q'];
	 function lolo($conn){
 		$q = $_GET['q'];

        $query = "SELECT * FROM contacts where phone_number = ? and user_id =?";

        $stmt = $conn -> prepare($query);

        $stmt -> bind_param("ii", $q, $_SESSION['user_id']);

        $stmt -> execute();
        
      $rows = $stmt->get_result(); 
  
        return $rows->fetch_assoc();   

      
}

	if(array_values(lolo($conn))){
	  $hint = ""; 
	 
	 if ($q !== "") {
	  
	   	$hint = "this number already exists";
	   	echo $hint;
	   
	}} else{
	 $hint = "no suggestion";
	 echo $hint;
	}

?>

