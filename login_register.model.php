<?php

    function register($conn, $first_name, $last_name, $email, $password, $phone_number) {

        $query = "SELECT * FROM user WHERE email = ? LIMIT 0, 1";

        $stmt = $conn -> prepare($query);

        $email = htmlspecialchars(strip_tags($email));

        $stmt -> bind_param("s", $email);

        $stmt -> execute();

        $row_count = $stmt -> num_rows();

        $stmt -> close();

        if ($row_count > 0) {

            $html_alert = "Email already exists!";
            return $html_alert;
        } else {

            $hashedPassword = md5($password);

            $registerStmt = $conn -> prepare('INSERT INTO user(first_name, last_name, email, password, phone_number) VALUES(?,?,?,?,?)');

            $registerStmt -> bind_param("ssssi", $first_name, $last_name, $email, $hashedPassword, $phone_number);

            $success = $registerStmt -> execute();

            $registerStmt -> close();

            return $success;
        }

    }

    function login($conn, $email, $password) {

        $hashedPassword = md5($password);

        $loginStmt = $conn -> prepare('SELECT * FROM user WHERE email = ? AND password = ?');

        $loginStmt -> bind_param('ss', $email, $hashedPassword);

        $loginStmt -> execute();

        $results = $loginStmt -> get_result();

        $loginStmt -> close();

        if ($results -> num_rows  === 1) {

            $firstRow = $results -> fetch_assoc();

            $_SESSION['user_id'] = $firstRow['user_id'];
        }

        if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
            
            echo "true";
            echo $_SESSION['user_id'];
        } else {

            echo "false";
        }

        header('Location: /index.php');

        return NULL;
    }

?>