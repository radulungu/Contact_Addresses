<?php
    
    session_start();
    
    require_once('database_conn.php');
    
    require_once('filtered_contacts.model.php');
    
    require_once('filtered_contacts.controller.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>OnCo (Online Contacts) - Filtered Contacts</title>
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

            <div class="align_items">
            
                <?php foreach($allFilteredContacts as $contact): ?>
                
                <div class="container">
                    <form id="editContact" action="index.php" enctype="multipart/form-data" method="POST">
                    

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
                            <li class="center_buttons"><button id="save" type="submit" form="editContact" class="contact_button"><a style="text-decoration:none;color:black;" href="edit_contact.php" >Edit</a></button>
                                                    <button id="delete" type="submit" form="editContact" class="contact_button"><a style="text-decoration:none;color:black;" href="index.php?del=<?php echo $contact['id']; ?>" >Delete</a></button> 
                        </li>
                        </ul>
                    </form>
                    </div>

                <?php endforeach; ?>

               </div>

      
 </section>

</body>
</html>