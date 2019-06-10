<?php

    if (isset($_POST['create_group_button'])) {

        $create_group_response = createNewGroup($conn, $_SESSION['user_id'], $_POST['create_group']);
    }   
   
    if (isset($_GET['del'])) {
        
        $id = $_GET['del'];

        $query = "DELETE FROM contacts WHERE id = ".$id;
        
        $Stmt = $conn->prepare($query);
        
        $success = $Stmt -> execute();
        
        $Stmt -> close();
    }
            
    if (isset($_POST['button_addcontact'])) {
        
        $avatarPath = "";
        
        $target_dir = "uploads/";
        
        $target_file = $target_dir . basename($_FILES["avatar"]["name"]);
        
        $uploadOk = 1;
        
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
         
        $check = getimagesize($_FILES["avatar"]["tmp_name"]);
        
        if($check !== false) {
            
            if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
                
                $avatarPath = "/uploads/" . $_FILES["avatar"]["name"];

            } else {
                
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            
            echo "Sorry, your file was not uploaded.";
        }
        
        $add_contact_response = addContact($conn, $_SESSION['user_id'],  $_POST['first_name'], $_POST['last_name'], $_POST['phone_number'], $_POST['user_email'], $_POST['user_city'], $_POST['user_age'], $_POST['user_faculty'], $_POST['user_web'], $_POST['user_interests'], $avatarPath);
    }

    if (isset($_POST['logout_button'])) {

        $logout_resp = logout();
    }

?>