<?php

require_once 'database_conn.php';

function filterContacts($conn)
{

    $user_id = $_SESSION['user_id'];

    $first_name = $_POST['user_fname'];

    $last_name = $_POST['user_lname'];

    $phone_number = $_POST['phone_nr'];

    $email = $_POST['mail'];

    $city = $_POST['user_cityaddress'];

    $min_age = $_POST['user_min_age'];

    $max_age = $_POST['user_max_age'];

    $faculty = $_POST['what_faculty'];

    $interests = $_POST['interests'];

    $query = "SELECT * FROM contacts";

    $conditions = array();
    $type = '';

    $query = $query . " WHERE user_id=?";
    $type = 'i';
    array_push($conditions, $user_id);

    if (!empty($first_name)) {
        $query = $query . " AND first_name=?";
        $type = $type . 's';
        array_push($conditions, $first_name);
    }

    if (!empty($last_name)) {
        $query = $query . " AND last_name=?";
        $type = $type . 's';
        array_push($conditions, $last_name);
    }

    if (!empty($phone_number)) {
        $query = $query . " AND phone_number=?";
        $type = $type . 'i'; 
        array_push($conditions, $phone_number);
    }

    if (!empty($email)) {
        $query = $query . " AND email=?";
        $type = $type . 's';
        array_push($conditions, $email);
    }

    if (!empty($city)) {
        $query = $query . " AND city=?";
        $type = $type . 's';
        array_push($conditions, $city);
    }

    if (!empty($min_age)) {
        $query = $query . " AND age>=?";
        $type = $type . 'i';
        array_push($conditions, $min_age);
    }

    if (!empty($max_age)) {
        $query = $query . " AND age<=?";
        $type = $type . 'i';
        array_push($conditions, $max_age);
    }

    if (!empty($faculty)) {
        $query = $query . " AND faculty LIKE CONCAT('%',?,'%')";
        $type = $type . 's';
        array_push($conditions, $faculty);
    }

    if (!empty($interests)) {
        $query = $query . " AND interests LIKE CONCAT('%',?,'%') ";
        $type = $type . 's';
        array_push($conditions, $interests);
    }

    $sql = $query;

    if (count($conditions) > 0) {

        $sql .= " WHERE " . implode(' AND ', $conditions);
    }
    $stmt = mysqli_prepare($conn, $query);
    $stmt->bind_param($type, ...$conditions);


  $stmt -> execute();

    $rows = $stmt->get_result(); 
  
        return $rows; 
  
}

?>