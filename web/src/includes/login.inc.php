<?php
    if (isset($_POST['login-submit'])){
        require "dbh.inc.php" ;

        $umail = $_POST['login-email'];
        $upass = $_POST['login-pwd'];

        // Check input fields
        if (empty($umail) || empty($upass)){
            header("Location: ../index.php?error=emptyfields");
            exit();
        }

        // Prepare query using placeholders (prevent sql injection)
        $sql = "SELECT * FROM Admins WHERE USERNAME=? OR EMAIL=?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../index.php?error=sqlerror");
            exit();
        }

        // Pass parameters and execute statement 
        mysqli_stmt_bind_param($stmt, "ss", $umail, $umail);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        // User has successfully authenticated
        if ($row = mysqli_fetch_assoc($result)){
            # TODO: Fix verify problem
            $pwdCheck = password_verify($upass, $row['PASSWORD']);
            if ($pwdCkeck == true || $upass == $row['PASSWORD']){   // Form created with hash, or dummy accounts for testing
                session_start();
                $_SESSION['Username'] = $row['USERNAME'];
                $_SESSION['ID'] = $row['ID'];
                header("Location: ../Admins.php?username=".$row['USERNAME']);
                exit();
            }
            else{
                header("Location: ../index.php?error=wrongcrentetials2");
                exit();
            }
        }
        else{
            header("Location: ../index.php?error=wrongcrentetials1");
            exit();
        }
        
        // Close connections
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
    // Try to access login without submiting form
    else{
        header("Location: ../index.php");
        exit();
    }



