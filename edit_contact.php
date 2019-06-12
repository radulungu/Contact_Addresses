<?php
    
    session_start();
    
    require_once 'database_conn.php';
    
    require_once 'edit_contact.controller.php';

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
            
            
            <form  action="index.php" method="POST">

                <button name="back">Back</button>
            
            </form>
        
        </div>

    </header>

    <section>
    
        <div id="edit_contact_form" class="form_style">
            
            <h2 class="form_title">Edit</h2>
            
            <form action="edit_contact.php" method="post" id="form1">
            
             <div class="form_div">

                    
                    <input type="hidden" id="id_edit" form="form1"  name="id_edit"  value="<?=$rows['id']?>">

                </div>

                <div class="form_div">

                    <label for="fname_edit">First name:</label>
                    <input type="text" id="fname_edit" form="form1"  name="fname_edit"  value="<?=$rows['first_name']?>">

                </div>

                <div class="form_div">

                    <label for="lname_edit">Last name:</label>
                    <input type="text" id="lname_edit" form="form1" name="lname_edit" value="<?=$rows['last_name']?>">

                </div>

                <div class="form_div">

                    <label for="phone_edit">Phone number:</label>
                    <input type="tel" id="phone_edit" form="form1" name="phone_edit" value="<?=$rows['phone_number']?>">

                </div>

                <div class="form_div">

                    <label for="email_edit">Email:</label>
                    <input type="email" id="email_edit" form="form1" name="email_edit" value="<?=$rows['email']?>">

                </div>

                <div class="form_div">

                    <label for="city_edit">City:</label>
                    <input type="tel" id="city_edit" form="form1" name="city_edit" value="<?=$rows['city']?>">

                </div>

                <div class="form_div">

                    <label for="age_edit">Age:</label>
                    <input type="tel" id="age_edit" form="form1" name="age_edit" value="<?=$rows['age']?>"> 

                </div>

                 <div class="form_div">

                    <label for="faculty_edit">Faculty:</label>
                    <input type="tel" id="faculty_edit" form="form1" name="faculty_edit" value="<?=$rows['faculty']?>">

                </div>

                <div class="form_div">

                    <label for="web_address_edit">Web address:</label>
                    <input type="tel" id="web_address_edit" form="form1" name="web_address_edit" value="<?=$rows['web_address']?>">

                </div>                

                <div class="form_div">

                    <label for="interests_edit">Interests:</label>
                    <input type="text" id="interests_edit" form="form1" name="interests_edit" value="<?=$rows['interests']?>">

                </div>

                <div class="form_div">
                    <input type="submit"  name="edit_contact" value ="edit" />

                </div>

            </form>

        </div>

    </section>

    <script src="js.js"></script>

</body>
</html>