<?php

    session_start();

    require_once 'database_conn.php';
    
    require_once 'login_register.model.php';
    
    require_once 'login_register.controller.php';

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
                    
                    <label for="email_login">Email*</label>
                    <input type="email" id="email_login" name="email_login" placeholder="<?php echo $email_login_error; ?>" required>
                
                </div>

                <div class="form_div">
                    
                    <label for="password_login">Password*</label>
                    <input type="password" id="password_login" name="password_login" placeholder= "<?php echo $password_login_error ?>" required>
                
                </div>

                <div class="form_div">

                    <input type="submit" name="login_button" value="Log In">
                
                </div>

            </form>
        
        </div>

    </section>

    <section>
    
        <div id="register" class="form_style">
            
            <h2 class="form_title">Register</h2>
            
            <form action="login_register.php" method="post">

                <div class="form_div">

                    <label for="fname_register">First name*</label>
                    <input type="text" id="fname_register" name="fname_register" placeholder="<?php echo $fname_register_error;?>" required>

                </div>

                <div class="form_div">

                    <label for="lname_register">Last name*</label>
                    <input type="text" id="lname_register" name="lname_register" placeholder="<?php echo $lname_register_error;?>" required>

                </div>

                <div class="form_div">

                    <label for="email_register">Email*</label>
                    <input type="email" id="email_register" name="email_register" placeholder="<?php echo $email_register_error;?>" required>

                </div>

                <div class="form_div">

                    <label for="phone_register">Phone number*</label>
                    <input type="tel" id="phone_register" name="phone_register" placeholder="<?php echo $phone_register_error;?>" required>

                </div>

                <div class="form_div">

                    <label for="password_register">Password*</label>
                    <input type="password" id="password_register" name="password_register" placeholder="<?php echo $password_register_error;?>" required>

                </div>

                <div class="form_div">

                    <input type="submit" name="register_button" value="Register">

                </div>

            </form>

        </div>

    </section>

    <script src="js.js"></script>

    <script>
        
        <?php

            if (isset($_GET['action'])) {

                if ($_GET['action'] == 'login') {
                    
                    echo "login_js();";
                }
            }

            if (isset($_POST['fname_register'])) {
                
                if (isset($reg_resp) && $reg_resp == 1) {
                    
                    echo "login_js();";
                
                } else {

                    echo "register_js();";
                }
            }
            
        ?>

    </script>

</body>
</html>