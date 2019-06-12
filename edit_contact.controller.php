<?php

    require_once 'database_conn.php';    

    if(isset($_GET['edit'])) {
     
     $id = $_GET['edit']; 

    $registerStmt = $conn -> prepare('SELECT * FROM contacts WHERE id = ?');

    $registerStmt -> bind_param("i", $_GET['edit']);

    $registerStmt -> execute();
        
    $rows = $registerStmt->get_result()->fetch_assoc(); 
  
    } elseif (isset($_POST['id_edit'])) {

        $rows['id']=$_POST['id_edit'];
        
        $rows['first_name']=$_POST['fname_edit'];
        
        $rows['last_name']=$_POST['lname_edit'];
        
        $rows['phone_number']=$_POST['phone_edit'];
        
        $rows['email']=$_POST['email_edit'];
        
        $rows['city']=$_POST['city_edit'];
        
        $rows['age']=$_POST['age_edit'];
        
        $rows['faculty']=$_POST['faculty_edit'];
        
        $rows['web_address']=$_POST['web_address_edit'];
        
        $rows['interests']=$_POST['interests_edit'];
        
        $registerStmt = $conn -> prepare('UPDATE contacts SET first_name=?, last_name=?, phone_number=?, email=?,city=?,age=?,faculty=?,web_address=?, interests=? WHERE id = ?');

        $registerStmt -> bind_param("ssississsi", $rows['first_name'],$rows['last_name'],$rows['phone_number'], $rows['email'],$rows['city'],  $rows['age'], $rows['faculty'],$rows['web_address'], $rows['interests'],$rows['id']);
 
        $success = $registerStmt -> execute();

        $registerStmt -> close();
        
        header('Location:index.php');
    }

?>