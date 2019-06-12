<?php

    require_once 'database_conn.php';

    include_once 'index.model.php';

    include_once 'index.php';

    require_once 'test_input.php';

    $first_name_error = $last_name_error = $phone_number_error = $email_error = $city_error = $age_error = $faculty_error = $web_address_error = $interests_error = '';

    $first_name = $last_name = $phone_number = $email = $city = $age = $faculty = $web_address = $interests = '';


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
    


        if (empty($_POST["first_name"])) {
            
            $first_name_error = "First name is required!";

        } else {
        
            $first_name = test_input($_POST["first_name"]);
            
            if (!preg_match("/^[a-zA-Z ]*$/",$first_name)) {
                
                $first_name_error = "Only letters and white space allowed!"; 
            }
        }


        if (empty($_POST["last_name"])) {
            
            $last_name_error = "Last name is required!";

        } else {
        
            $last_name = test_input($_POST["last_name"]);
            
            if (!preg_match("/^[a-zA-Z ]*$/",$last_name)) {
                
                $last_name_error = "Only letters and white space allowed!";
            }
        }


        if (empty($_POST["phone_number"])) {
            
            $phone_number_error = "Phone number is required!";

        } else {
        
            $phone_number = test_input($_POST["phone_number"]);
            
            if (!preg_match("/^[0-9]{10}+$/",$phone_number)) {

                $phone_number_error = "The format of your phone number is not valid!";
            }
        }


        if (empty($_POST["user_email"])) {
            
            $email_error = "Email is required!";

        } else {
        
            $email = test_input($_POST["user_email"]);
            
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                
                $email_error = "Invalid email format!";
            }
        }


        if (empty($_POST["user_city"])) {
            
            $city_error = "City is required!";

        } else {
        
            $city = test_input($_POST["user_city"]);
            
            if (!preg_match("/^[a-zA-Z ]*$/",$city)) {
                
                $city_error = "Only letters and white space allowed!"; 
            }
        }


        if (empty($_POST["user_age"])) {
            
            $age_error = "Age is required!";

        } else {
        
            $age = test_input($_POST["user_age"]);
            
            if (!preg_match("/^[0-9]+$/",$age)) {
                
                $age_error = "Only digits allowed!";
            }
        }

        
        if (empty($_POST["user_faculty"])) {
            
            $faculty = "";

        } else {

            $faculty = test_input($_POST["user_faculty"]);
        
            if (!preg_match("/^[a-zA-Z ]*$/",$faculty)) {
          
                $faculty_error = "Only letters and white space allowed!";
            }    
        }


        if (empty($_POST["user_web"])) {
            
            $web_address = "";

        } else {

            $web_address = test_input($_POST["user_web"]);
        
            if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$web_address)) {
          
                $web_address_error = "Invalid URL!"; 
            }    
        }


        if (empty($_POST["user_interests"])) {
            
            $interests = "";

        } else {

            $interests = test_input($_POST["user_interests"]);
        
            if (!preg_match("/^[a-zA-Z ,]*$/",$interests)) {
          
                $interests_error = "Only letters, white spaces and commas allowed!"; 
            }    
        }

        if ($first_name_error === '' && $last_name_error === '' && $phone_number_error === '' && $email_error === '' && $city_error === '' && $age_error === '' && $faculty_error === '' && $web_address_error === '' && $interests_error === '') {

            $add_contact_response = addContact($conn, $_SESSION['user_id'],  $_POST['first_name'], $_POST['last_name'], $_POST['phone_number'], $_POST['user_email'], $_POST['user_city'], $_POST['user_age'], $_POST['user_faculty'], $_POST['user_web'], $_POST['user_interests'], $avatarPath);
        }
    }

    if (isset($_POST['logout_button'])) {

        $logout_resp = logout();
    }

?>