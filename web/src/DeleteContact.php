<?php
    require "includes/header.inc.php";
?>

    <style>
        <?php include 'css/delete_contacts.css'; ?>
    </style>

    <?php
        require "./includes/dbh.inc.php" ;

        // Show users in Delete page
        // First of all get them and afterwards display 
        // them in a while loop
        
        $sql = "SELECT * FROM Contacts";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ./Contacts.php?error=sqlerror");
            exit();
        }
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    ?>
    <main>
        <div class="main-content">
            <div>
                <div class="card-header">
                    <h2>Data Mahasiswa</h2>
                </div>
                <div class="card-body">
                    <table id="contacts-table" class="table table-bordered">
                        <tr>
                            <th>Nama Lengkap</th>
                            <th>Nama Panggilan</th>
                            <th>Email</th>
                            <th>Telephone</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        while ($row = mysqli_fetch_array($result)){
                            $id = $row['ID'];
                            $name = $row['NAME'];
                            $surname = $row['SURNAME'];
                            $email = $row['EMAIL'];
                            $phone = $row['PHONENUMBER'];
                        ?>
                        <tr>
                            <td><?php echo $name;?> </td>
                            <td><?php echo $surname;?> </td>
                            <td><?php echo $email;?> </td>
                            <td><?php echo $phone;?> </td>

                            <form action="includes/deletecontact.inc.php" method="post" onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                <input type="hidden" name="delete-contact-id" id="delete-contact-id" value="<?= $id ?>">
                                <td><button name="delete-contact-submit" class="btn">Delete</button></td>
                            </form>
                        </tr>
                        <?php    
                        } 
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </main>

<?php
    require "includes/footer.inc.php";
?>
