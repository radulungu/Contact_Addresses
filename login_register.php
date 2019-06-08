<?php

    session_start();

    require_once 'database_conn.php';

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
		echo $email;
		echo $hashedPassword;

        $loginStmt -> execute();

        $results = $loginStmt -> get_result();

        $loginStmt -> close();

        if ($results -> num_rows  === 1) {

            $firstRow = $results -> fetch_assoc();

            $_SESSION['user_id'] = $firstRow['user_id'];
			header('Location: index.php');
			
        } else {
			echo "please log in using correct credentials";
		}

    }

    if (isset($_POST['register_button'])) {

        $reg_resp = register($conn, $_POST['fname_register'], $_POST['lname_register'], $_POST['email_register'], $_POST['password_register'], $_POST['phone_register']);
    }

    if (isset($_POST['login_button'])) {

        $login_resp = login($conn, $_POST['email_login'], $_POST['password_login']);
		
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>OnCo-register (Online Contacts)</title>
</head>
<body>

    <header>
        
        <div class="navbar">

            <button onclick="home()">Home</button>
            <button class="push_item" onclick="login_js()">LogIn</button>
            <button onclick="register_js()">Register</button>
        
        </div>

    </header>

    <section>
        
        <div id="home_page">

            <h2>OnCo (Online Contacts)</h2>
            <p> Sa se dezvolte o aplicatie Web care sa reprezinte un manager de contacte personale. Utilizatorii vor avea acces la functionalitati pe baza unui cont. Fiecare persoana de contact va avea asociate informatii precum nume, prenume, adresa, data nasterii, minim o fotografie, numere de telefon, adrese de e-mail, adrese Web, descriere, interese etc.

            Aplicatia va permite gruparea contactelor, cautarea pe baza unor criterii complexe (de pilda, obtinerea persoanelor mai tinere de 20 de ani localizate in Iasi, actualmente la FII si care sunt interesate de tehnologii Web), precum si exportarea acestor informatii in diferite formate (cel putin vCard, CSV, Atom).</p>
            
        </div>

    </section>

    <section>
    
        <div id="login" class="form_style">
            
            <h2 class="form_title">Log In</h2>

            <form action="login_register.php" method="post">
                
                <div class="form_div">
                    
                    <label for="email_login">Email:</label>
                    <input type="email" id="email_login" name="email_login">
                
                </div>

                <div class="form_div">
                    
                    <label for="password_login">Password:</label>
                    <input type="text" id="password_login" name="password_login">
                
                </div>

                <div class="form_div">

                    <input type="submit" name="login_button" value="Log In">
                
                </div>

            </form>
        
        </div>

    </section>

    <section>
    
        <div id="register"  class="form_style">
            
            <h2 class="form_title">Register</h2>
            
            <form action="login_register.php" method="post">

                <div class="form_div">

                    <label for="fname_register">First name:</label>
                    <input type="text" id="fname_register" name="fname_register">

                </div>

                <div class="form_div">

                    <label for="lname_register">Last name:</label>
                    <input type="text" id="lname_register" name="lname_register">

                </div>

                <div class="form_div">

                    <label for="email_register">Email:</label>
                    <input type="email" id="email_register" name="email_register">

                </div>

                <div class="form_div">

                    <label for="phone_register">Phone number:</label>
                    <input type="tel" id="phone_register" name="phone_register">

                </div>

                <div class="form_div">

                    <label for="password_register">Password:</label>
                    <input type="text" id="password_register" name="password_register">

                </div>

                <div class="form_div">

                    <input type="submit" name="register_button" value="Register">

                </div>

            </form>

        </div>

    </section>

    <script src="js.js"></script>

</body>
</html>