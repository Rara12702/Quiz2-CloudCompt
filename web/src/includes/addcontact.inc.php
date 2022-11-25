<?php
    if (isset($_POST['add-contact-submit'])){
        require "dbh.inc.php" ;

        $uname = $_POST['add-contact-name'];
        $usname = $_POST['add-contact-surname'];
        $uemail = $_POST['add-contact-email'];
        $uphone = $_POST['add-contact-phone'];

        // Check in backend if fields are acceptable
        if (empty($uname) || empty($usname) || empty($uemail) || empty($uphone)){
            header("Location: ../AddContact.php?error=emptyfields");
            exit();
        }
        else if (!preg_match("/^[A-Za-zñÑçÇáéíóúÁÉÍÓÚ ]+$/", $uname)){
            header("Location: ../AddContact.php?error=notvalidname");
            exit();
        }
        else if (!preg_match("/^[A-Za-zñÑçÇáéíóúÁÉÍÓÚ ]+$/", $usname)){
            header("Location: ../AddContact.php?error=notvalidsurname");
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
        $sql = "SELECT * FROM Contacts WHERE ID=? OR PHONENUMBER=?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ../AddContact.php?error=sqlerror");
            exit();
        }

        // Pass parameters and execute statement 
        mysqli_stmt_bind_param($stmt, "ss", $uid, $uphone);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);

        // Someone already exists with this id or email
        if ($resultCheck > 0){
            header("Location: ../AddContact.php?error=userexists");
            exit();
        }

        // -----------------------------------
        // Finaly if nothing is wrong add user
        // -----------------------------------
        // Prepare query using placeholders (prevent sql injection)
        $sql = "INSERT INTO Contacts (NAME, SURNAME, EMAIL, PHONENUMBER) VALUES (?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ../AddContact.php?error=sqlerror");
            exit();
        }

        // Pass parameters and execute statement
        mysqli_stmt_bind_param($stmt, "ssss", $uname, $usname, $uemail, $uphone);
        mysqli_stmt_execute($stmt);

        header("Location: ../AddContact.php?add-contact=true");
        exit();

        // Close connections
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
    // Try to access register without submiting form
    else{
        header("Location: ../AddContact.php");
        exit();
    }
