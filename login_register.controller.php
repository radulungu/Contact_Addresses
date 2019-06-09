<?php

    if (isset($_POST['register_button'])) {

        $reg_resp = register($conn, $_POST['fname_register'], $_POST['lname_register'], $_POST['email_register'], $_POST['password_register'], $_POST['phone_register']);
    }

    if (isset($_POST['login_button'])) {

        $login_resp = login($conn, $_POST['email_login'], $_POST['password_login']);
    }

?>