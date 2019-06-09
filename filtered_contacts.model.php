<?php

    function filterContacts($conn) {

      $user_id = $_SESSION['user_id'];
      
      $first_name = $_POST['user_fname'];
      
      $last_name =  $_POST['user_lname'];
      
      $phone_number = $_POST['phone_nr'];
      
      $email = $_POST['mail'];
      
      $city = $_POST['user_cityaddress'];
      
      $min_age = $_POST['user_min_age'];
      
      $max_age = $_POST['user_max_age'];
      
      $faculty = $_POST['what_faculty'];
      
      $interests = $_POST['interests'];

      $query = "SELECT * FROM contacts";
      
      $conditions = array();

      $conditions[] = "user_id='$user_id'";
   
      if(!empty($first_name)) {
        
        $conditions[] = "first_name='$first_name'";
      }

      if(!empty($last_name)) {
      
        $conditions[] = "last_name='$last_name'";
      }

      if(!empty($phone_number)) {
      
        $conditions[] = "phone_number='$phone_number'";
      }

      if(!empty($email)) {
      
        $conditions[] = "email='$email'";
      }

      if(!empty($city)) {
        
        $conditions[] = "city='$city'";
      }

      if(!empty($min_age)) {
      
        $conditions[] = "age>='$min_age'";
      }

      if(!empty($max_age)) {
      
        $conditions[] = "age<='$max_age'";
      }

      if(!empty($faculty)) {
      
        $conditions[] = "faculty='$faculty'";
      }
     
      if(!empty($interests)) {
        
        $conditions[] = "interests='$interests'";
      }

      $sql = $query;
      
      if (count($conditions) > 0) {
      
        $sql .= " WHERE " . implode(' AND ', $conditions);
      }
    
      $result = $conn->query($sql);
    
      return $result;
    }

?>