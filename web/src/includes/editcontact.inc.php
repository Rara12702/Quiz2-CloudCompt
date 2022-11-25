<?php
    if (isset($_POST['edit-contact-submit'])){
        require "dbh.inc.php" ;

        $uid = $_POST['edit-contact-id'];
        $uname = $_POST['edit-contact-name'];
        $usname = $_POST['edit-contact-surname'];
        $uemail = $_POST['edit-contact-email'];
        $uphone = $_POST['edit-contact-phone'];


        // Check in backend if fields are acceptable
        if (empty($uid) || empty($uname) || empty($usname) || empty($uemail) || empty($uphone)){
            header("Location: ../EditContact.php?error=emptyfields");
            exit();
        }
        else if (!preg_match("/^[a-zA-Z0-9_]+$/", $uid)){
            header("Location: ../EditContact.php?error=notvalidid");
            exit();
        }
        else if (!preg_match("/^[A-Za-zñÑçÇáéíóúÁÉÍÓÚ ]+$/", $uname)){
            header("Location: ../EditContact.php?error=notvalidname");
            exit();
        }
        else if (!preg_match("/^[A-Za-zñÑçÇáéíóúÁÉÍÓÚ ]+$/", $usname)){
            header("Location: ../EditContact.php?error=notvalidsurname");
            exit();
        }
        else if (!preg_match("/^[^@]+@[a-zA-Z0-9]+\.[a-z]+$/", $uemail)){
            header("Location: ../AddContact.php?error=notvalidemail");
            exit();
        }
        else if (!preg_match("/^[0-9\-\(\) \+]+$/", $uphone)){
            header("Location: ../EditContact.php?error=notvalidusername");
            exit();
        }
    
        // Prepare query using placeholders (prevent sql injection)
        $sql = "UPDATE Contacts SET NAME = ?, SURNAME = ?, EMAIL = ?, PHONENUMBER = ? WHERE ID = ?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ../EditContact.php?error=sqlerror");
            exit();
        }
    
        // Pass parameters and execute statement 
        mysqli_stmt_bind_param($stmt, "sssss", $uname, $usname, $uemail, $uphone, $uid);
        mysqli_stmt_execute($stmt);
    
        if(mysqli_stmt_affected_rows($stmt)){
            header("Location: ../EditContact.php?edited=true");
            exit();
        }
        else{
            // echo mysqli_stmt_error($stmt);
            header("Location: ../EditContact.php?edited=false");
            exit();
        }
    
        // Close connections
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
    // Try to access register without submiting form
    else{
        header("Location: ../EditContact.php?POST=false");
        exit();
    }
    
