<?php

    if (isset($_POST['submit_filter'])) {
        
        $allFilteredContacts=filterContacts($conn);
    }

?>