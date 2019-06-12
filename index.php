<?php

    session_start();
    
    require_once 'database_conn.php';

    require_once 'index.model.php';

    require_once 'index.controller.php';

    require_once 'filtered_contacts.controller.php'
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="js.js"></script>
    <script src="AJAXcheckNumber.js"></script>
    <title>OnCo (Online Contacts)</title>
</head>
<body>

    <header>
        
        <div class="navbar">
            
            <button onclick="functionContacts()">All Contacts</button>
            <button onclick="functionFilterContacts()">Filter Contacts</button>
            <button onclick="functionAdd()">Add Contact</button>
            <form class="push_item" action="/" method="POST">

                <button name="logout_button" onclick="functionLogout()">LogOut</button>
            
            </form>
        
        </div>

    </header>

    <section>
        
        <div id="home" >

            <h2>Want to create a new group?</h2>

                <form action="index.php" method="post">

                        <?php

                            if ($html_alert === "Group created successfully!") {

                                echo '<p class="good_alert">' . $html_alert . '</p>';

                            } else {

                                echo '<p class="bad_alert">' . $html_alert . '</p>';
                            }

                        ?>

                        <label for="create_group">Create new group:</label>
                        <input type="text" id="create_group" name="create_group">

                        <input class="contact_create" type="submit" name="create_group_button" value="Create">

                </form>
    
            <div class="align_items">
                
                <?php foreach($allGroups as $groupp): ?>  
                <?php foreach($allContacts as $contact): ?>
                
                <?php if($contact['group_id'] === $groupp['group_id']): ?>
                    <div class="container">
                    <form id="editContact" action="index.php" enctype="multipart/form-data" method="POST">
                    
                        <h3><?=$groupp['name']?></h3>
                        <img src=<?=$contact['avatar']?> alt="Profile picture">
                        <ul>
                            <li>First name:<input id="efname" name="efname" value="<?=$contact['first_name']?>"></input></li>
                            <li>Last name: <input id="elname" name="elname" value="<?=$contact['last_name']?>"></input></li>
                            <li>Phone number: <input  id="ephnumber" name="ephnumber" value="<?=$contact['phone_number']?>" id="phone_number"  ></input></li>
                            <li>Email: <input id="eemail" name="eemail"  value="<?=$contact['email']?>" ></input></li>
                            <li>City: <input id="ecity" name="ecity"  value="<?=$contact['city']?>"  ></input></li>
                            <li>Age: <input id="eage" name="eage" value="<?=$contact['age']?>"  ></input></li>
                            <li>Faculty: <input id="efaculty" name="efaculty" value="<?=$contact['faculty']?>"></input></li>
                            <li>Web address: <input id="eweb" name="eweb" value="<?=$contact['web_address']?>"  ></input></li>
                            <li>Interests: <input id="einterests" name="einterests" value="<?=$contact['interests']?>"  ></input></li>
                            <li class="center_buttons"><button id="save" type="submit" form="editContact" class="contact_button" name="edit"><a style="text-decoration:none;color:black;"  href="edit_contact.php?edit=<?php echo $contact['id']; ?>" >Edit</a></button>
                                                    <button id="delete" type="submit" form="editContact" class="contact_button"><a style="text-decoration:none;color:black;" href="index.php?del=<?php echo $contact['id']; ?>" >Delete</a></button> 
                        </li>
                        </ul>
                    </form>
                    </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endforeach; ?>  

            </div>
                
            </div>

        </div>

    </section>

    <section>
    
        <div id="sidebar">

            <h2>Filters</h2>
            <p>Filter your contacts any way you want.</p>
            
            <div class="all_sidebar">

                <div class="sidebar_container">

                    <form action="filtered_contacts.php" method="post">

                        <div class="form_div">
                                
                            <label for="fname">First name:</label>
                            <input type="text" id="user_fname" name="user_fname" placeholder="<?php echo $first_name_error_filter; ?>">
                            
                        </div>

                        <div class="form_div">

                            <label for="lname">Last name:</label>
                            <input type="text" id="user_lname" name="user_lname" placeholder="<?php echo $last_name_error_filter; ?>">

                        </div>

                        <div class="form_div">

                            <label for="phone_nr">Phone number:</label>
                            <input type="tel" id="phone_nr" name="phone_nr" placeholder="<?php echo $phone_number_error_filter; ?>">
                            
                        </div>

                        <div class="form_div">

                            <label for="mail">Email:</label>
                            <input type="email" id="mail" name="mail" placeholder="<?php echo $email_error_filter; ?>">

                        </div>

                        <div class="form_div">

                            <label for="min_age">Minimum age:</label>
                            <input type="number" id="user_min_age" name="user_min_age" min="1" max="120" placeholder="<?php echo $min_age_error_filter; ?>">

                        </div>

                        <div class="form_div">

                            <label for="max_age">Maximum age:</label>
                            <input type="number" id="user_max_age" name="user_max_age" min="1" max="120" placeholder="<?php echo $max_age_error_filter; ?>">

                        </div>

                        <div class="form_div">

                            <label for="city_address">City:</label>
                            <input type="text" id="user_cityaddress" name="user_cityaddress" placeholder="<?php echo $city_error_filter; ?>">

                        </div>

                        <div class="form_div">

                            <label for="what_faculty">Faculty:</label>
                            <input type="text" id="what_faculty" name="what_faculty" placeholder="<?php echo $faculty_error_filter; ?>">

                        </div>

                        <div class="form_div">

                            <label for="user_interests">Interests:</label>
                            <input type="text" id="interests" name="interests" placeholder="<?php echo $interests_error_filter; ?>">

                        </div>

                        <div class="form_div">

                            <input type="submit" name="submit_filter" value="Filter">

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </section>

    <section>
    
        <div id="addContact" class="form_style">
            
            <h2 class="form_title">Add your new contact</h2>
            
            <form action="index.php" method="post" enctype="multipart/form-data">

                <div class="form_div">

                    <label for="firstname">First name:</label>
                    <input type="text" id="firstname" name="first_name" placeholder="<?php echo $first_name_error; ?>" required>

                </div>

                <div class="form_div">

                    <label for="lastname">Last name:</label>
                    <input type="text" id="lastname" name="last_name" placeholder="<?php echo $last_name_error; ?>" required>

                </div>

                <div class="form_div">

                    <label for="phone">Phone number:</label>
                    <input type="tel" id="phone" name="phone_number" onkeyup="showHint(this.value)" placeholder="<?php echo $phone_number_error; ?>" required>
                    <div>Suggestion:<span id="txtHint"></span></div>

                </div>

                <div class="form_div">

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="user_email" placeholder="<?php echo $email_error; ?>" required>
                       
                </div>

                <div class="form_div">

                    <label for="city">City:</label>
                    <input type="text" id="city" name="user_city" placeholder="<?php echo $city_error; ?>" required>

                </div>

                <div class="form_div">

                    <label for="age">Age:</label>
                    <input type="number" id="age" name="user_age" placeholder="<?php echo $age_error; ?>" required>

                </div>

                <div class="form_div">

                    <label for="faculty">Faculty:</label>
                    <input type="text" id="faculty" name="user_faculty" placeholder="<?php echo $faculty_error; ?>">

                </div>

                <div class="form_div">

                    <label for="web">Web address:</label>
                    <input type="text" id="web" name="user_web" placeholder="<?php echo $web_address_error; ?>">

                </div>

                <div class="form_div">

                    <label for="interests">Interests:</label>
                    <input type="text" id="interests" name="user_interests" placeholder="<?php echo $interests_error; ?>">

                </div>

                <div class="form_div">

                    <label for="avatar">Profile picture:</label>
                    <input type="file" id="avatar" name="avatar" accept="image/png, image/jpeg" required>

                </div>

                <div class="form_div">

                    <label for="group">Group:</label>
                    <select id="group" name="group" required>
                        <?php foreach ($allGroups as $value) : ?>
                            <?= '<option value="' . $value['group_id'] . '">' . $value['name'] . '</option>' ?>
                        <?php endforeach; ?>
                    </select>

                </div>

                <div class="form_div">

                    <input type="submit" name="button_addcontact" value="Add contact">
            
                </div>

            </form>

        </div>

    </section>

    <script>
        
        <?php

            if (isset($_GET['action'])) {

                if ($_GET['action'] == 'filterContacts') {
                    
                    echo "functionFilterContacts();";
                }
            }
            
        ?>

    </script>

</body>
</html>