<?php

	require_once 'database_conn.php';

	require_once 'login_register.model.php';

	$fname_register_error = $lname_register_error = $email_register_error = $phone_register_error = $password_register_error = '';

	$first_name = $last_name = $email = $phone = $password = '';

	$email_login_error = $password_login_error = '';

	$email_login = $password_login = '';

	function test_input($data) {
	
		$data = trim($data);

		$data = stripslashes($data);
		
		$data = htmlspecialchars($data);
		
		return $data;
	}

    if (isset($_POST['register_button'])) {


    	if (empty($_POST["fname_register"])) {
            
            $fname_register_error = "First name is required!";

        } else {
        
            $first_name = test_input($_POST["fname_register"]);
            
            if (!preg_match("/^[a-zA-Z ]*$/",$first_name)) {
                
                $fname_register_error = "Only letters and white space allowed!"; 
            }
        }


    	if (empty($_POST["lname_register"])) {
            
            $lname_register_error = "Last name is required!";

        } else {
        
            $last_name = test_input($_POST["lname_register"]);
            
            if (!preg_match("/^[a-zA-Z ]*$/",$last_name)) {
                
                $lname_register_error = "Only letters and white space allowed!";
            }
        }


    	if (empty($_POST["email_register"])) {
            
            $email_register_error = "Email is required!";

        } else {
        
            $email = test_input($_POST["email_register"]);
            
    		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				
				$email_register_error = "Invalid email format!";
			}
        }


    	if (empty($_POST["phone_register"])) {
            
            $phone_register_error = "Phone number is required!";
        } else {
        
            $phone = test_input($_POST["phone_register"]);
            
            if (!preg_match("/^[0-9]{10}+$/",$phone)) {
                $phone_register_error = "The format of your phone number is not valid!";
            }
        }


    	if (empty($_POST["password_register"])) {
            
            $password_register_error = "Password is required!";

        } else {
        
            $password = test_input($_POST["password_register"]);
            
            if (!preg_match("/^[a-zA-Z0-9]*$/",$password)) {
                
                $password_register_error = "Only letters and digits allowed!";
            }
        }

        if ($fname_register_error === '' && $lname_register_error === '' && $email_register_error === '' && $phone_register_error === '' && $password_register_error === '') {
        	        $reg_resp = register($conn, $_POST['fname_register'], $_POST['lname_register'], $_POST['email_register'], $_POST['password_register'], $_POST['phone_register']);
        }
    }

    if (isset($_POST['login_button'])) {


    	if (empty($_POST["email_login"])) {
            
            $email_login_error = "Email is required!";

        } else {
        
            $email_login = test_input($_POST["email_login"]);
            
    		if (!filter_var($email_login, FILTER_VALIDATE_EMAIL)) {
				
				$email_login_error = "Invalid email format!";
			}
        }


    	if (empty($_POST["password_login"])) {
            
            $password_login_error = "Password is required!";

        } else {
        
            $password_login = test_input($_POST["password_login"]);
            
            if (!preg_match("/^[a-zA-Z0-9]*$/",$password_login)) {
                
                $password_login_error = "Only letters and digits allowed!";
            }
        }

        if ($email_login_error === '' && $password_login_error === '' ) {
        	$login_resp = login($conn, $_POST['email_login'], $_POST['password_login']);	
        }
        
        
    }

?>