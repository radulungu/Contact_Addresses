<?php

	require_once 'database_conn.php';

	require_once 'filtered_contacts.model.php';

	require_once 'test_input.php';

    $first_name_error_filter = $last_name_error_filter = $phone_number_error_filter = $email_error_filter = $min_age_error_filter = $max_age_error_filter = $city_error_filter = $faculty_error_filter = $interests_error_filter = '';

    $first_name_filter = $last_name_filter = $phone_number_filter = $email_filter = $min_age_filter = $max_age_filter = $city_filter = $faculty_filter = $interests_filter = '';

    if (isset($_POST['submit_filter'])) {
        

        if (empty($_POST["user_fname"])) {
            
            $first_name_filter = "";

        } else {
        
            $first_name_filter = test_input($_POST["user_fname"]);
            
            if (!preg_match("/^[a-zA-Z ]*$/",$first_name_filter)) {
                
                $first_name_error_filter = "Only letters and white space allowed!"; 
            }
        }


        if (empty($_POST["user_lname"])) {
            
            $last_name_filter = "";

        } else {
        
            $last_name_filter = test_input($_POST["user_lname"]);
            
            if (!preg_match("/^[a-zA-Z ]*$/",$last_name_filter)) {
                
                $last_name_error_filter = "Only letters and white space allowed!";
            }
        }


        if (empty($_POST["phone_nr"])) {
            
            $phone_number_filter = "";

        } else {
        
            $phone_number_filter = test_input($_POST["phone_nr"]);
            
            if (!preg_match("/^[0-9]{10}+$/",$phone_number_filter)) {

                $phone_number_error_filter = "The format of your phone number is not valid!";
            }
        }


        if (empty($_POST["mail"])) {
            
            $email_filter = "";

        } else {
        
            $email_filter = test_input($_POST["mail"]);
            
            if (!filter_var($email_filter, FILTER_VALIDATE_EMAIL)) {
                
                $email_error_filter = "Invalid email format!";
            }
        }


        if (empty($_POST["user_min_age"])) {
            
            $min_age_filter = "";

        } else {
        
            $min_age_filter = test_input($_POST["user_min_age"]);
            
            if (!preg_match("/^[0-9]+$/",$min_age_filter)) {
                
                $min_age_error_filter = "Only digits allowed!";
            }
        }


        if (empty($_POST["user_max_age"])) {
            
            $max_age_filter = "";

        } else {
        
            $max_age_filter = test_input($_POST["user_max_age"]);
            
            if (!preg_match("/^[0-9]+$/",$max_age_filter)) {
                
                $max_age_error_filter = "Only digits allowed!";
            }
        }


        if (empty($_POST["user_cityaddress"])) {
            
            $city_filter = "";

        } else {
        
            $city_filter = test_input($_POST["user_cityaddress"]);
            
            if (!preg_match("/^[a-zA-Z ]*$/",$city_filter)) {
                
                $city_error_filter = "Only letters and white space allowed!"; 
            }
        }


        if (empty($_POST["what_faculty"])) {
            
            $faculty_filter = "";

        } else {

            $faculty_filter = test_input($_POST["what_faculty"]);
        
            if (!preg_match("/^[a-zA-Z ]*$/",$faculty_filter)) {
          
                $faculty_error_filter = "Only letters and white space allowed!";
            }    
        }


        if (empty($_POST["interests"])) {
            
            $interests_filter = "";

        } else {

            $interests_filter = test_input($_POST["interests"]);
        
            if (!preg_match("/^[a-zA-Z ,]*$/",$interests_filter)) {
          
                $interests_error_filter = "Only letters, white spaces and commas allowed!"; 
            }    
        }

        if ($first_name_error_filter === '' && $last_name_error_filter === '' && $phone_number_error_filter === '' && $email_error_filter === '' && $min_age_error_filter === '' && $max_age_error_filter === '' && $city_error_filter === '' && $faculty_error_filter === '' && $interests_error_filter === '') {

        	$allFilteredContacts = filterContacts($conn);
        } else {

        	header('Location: /index.php?action=filterContacts');
        }

    }

?>