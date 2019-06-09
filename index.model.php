<?php

    $html_alert = '';

    function retrieveGroupName($conn) {

        $query = "SELECT name FROM groups WHERE user_id = ?";

        $stmt = $conn -> prepare($query);

        $stmt -> bind_param("i", $_SESSION['user_id']);

        $stmt -> execute();
        
        $rows = $stmt->get_result(); 
  
        return $rows->fetch_assoc();    
    }

    function retrieveGroupId($conn) {

        $query = "SELECT * FROM groups WHERE user_id = ?";

        $stmt = $conn -> prepare($query);

        $stmt -> bind_param("i", $_SESSION['user_id']);

        $stmt -> execute();

        $rows = $stmt->get_result(); 
  
        return $rows;   
    }

    function addContact($conn, $group_id, $first_name, $last_name, $phone_number, $email, $city, $age, $faculty, $web_address, $interests, $avatarPath) {
        
        $query = "SELECT * FROM contacts WHERE phone_number = ? LIMIT 0,1";

        $stmt = $conn -> prepare($query);

        $stmt -> bind_param("i", $phone_number);

        $stmt -> execute();

        $row_count = $stmt -> num_rows();

        $stmt -> close();

        if ($row_count > 0) {

            $html_alert = "Contact already exists!";

            return $html_alert;
            
        } else {
                
            if ($registerStmt = $conn -> prepare('INSERT INTO contacts(user_id, group_id, first_name, last_name, phone_number, email, city, age, faculty, web_address, interests, avatar) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)')) {    
              
                $registerStmt -> bind_param("iissississss", $_SESSION['user_id'],$_POST['group'], $first_name, $last_name, $phone_number, $email, $city, $age, $faculty, $web_address, $interests, $avatarPath);

                $success = $registerStmt -> execute();

                $registerStmt -> close();
            
                return $success;
                
            } else {

                echo "false";
            }
        }
    }
    
    function createNewGroup($conn, $user_id, $group_name) {

        GLOBAL $html_alert;

        if (!$group_name) {

            $html_alert = "Please complete the group name!";

        } else {

            $query = "SELECT * FROM groups WHERE name = ? and user_id = ?";

            $stmt = $conn -> prepare($query);

            $stmt -> bind_param("si", $group_name, $_SESSION['user_id']);

            $stmt -> execute();

            if ($stmt->get_result()->fetch_assoc()['name'] === $group_name) {

                $html_alert = "A group with this name already exists!";
        
                $stmt->close();

            } else {

                $stmt->close();
        
                if ($createGroupStmt = $conn -> prepare('INSERT INTO groups(user_id, name) VALUES(?,?)')) {

                    $createGroupStmt -> bind_param("is", $_SESSION['user_id'], $group_name);

                    $success = $createGroupStmt -> execute();

                    $createGroupStmt -> close();

                    $html_alert = "Group added successfully";
        
                } else {

                    $html_alert = "Insert group db_error";
                }
            }
        }
    }

    function retreiveAllContacts($conn) {
        
        $query = "SELECT * FROM contacts WHERE user_id = ? ORDER BY group_id";
        
        $stmt = $conn -> prepare($query);

        $stmt -> bind_param("i", $_SESSION['user_id']);

        $stmt -> execute();
        
        $rows = $stmt->get_result(); 
  
        return $rows;   
    }

     function logout() {

        session_unset();

        session_destroy();

        header('Location: /login_register.php');
    }

    $group_names = retrieveGroupName($conn);
    
    $allContacts = retreiveAllContacts($conn);
    
    $allGroups = retrieveGroupId($conn);

?>