<?php
    if (isset($_POST['delete-contact-submit'])){
        require "dbh.inc.php" ;

        $uid = $_POST['delete-contact-id'];

        // Prepare query using placeholders (prevent sql injection)
        $sql = "DELETE FROM Contacts WHERE ID = ?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ../DeleteContact.php?error=sqlerror");
            exit();
        }

        // Pass parameters and execute statement 
        mysqli_stmt_bind_param($stmt, "s", $uid);
        mysqli_stmt_execute($stmt);

        if(mysqli_stmt_affected_rows($stmt)){
            header("Location: ../DeleteContact.php?deleted=true");
            exit();
        }
        else{
            // echo mysqli_error($conn);
            header("Location: ../DeleteContact.php?deleted=false");
            exit();
        }

        // Close connections
        mysqli_stmt_close($stmt);
        mysqli_close($conn);

    }
    // Try to access register without submiting form
    else{
        header("Location: ../DeleteContact.php?POST=false");
        exit();
    }