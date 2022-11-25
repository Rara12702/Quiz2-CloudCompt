<?php
    require "includes/header.inc.php";
?>

    <style>
        <?php include 'css/edit_contacts.css'; ?>
    </style>
    
    <?php
        require "./includes/dbh.inc.php" ;

        // Check if some error exist and inform user
        if(isset($_GET['error'])){
            if($_GET['error'] == "sqlerror"){
                echo "<script>alert('Hay algo mal con la base de datos');</script>";
            }
            else{
                echo "<script>alert('Error inesperado');</script>";
            }
        }
        // Show user in Edit page
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
                            <th>NIM</th>
                            <th>Name</th>
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
                        <form name="edit-contact-form" class="edit-contact-form" action="/includes/editcontact.inc.php" method="post" onsubmit="return confirm('Apakah anda yakin ingin mengedit data ini?')"> 
                            <input type="hidden" name="edit-contact-id" value="<?php echo $id;?>">
                            <td><input class="std-ed-te" type="text" size="10" name="edit-contact-name" maxlength="255" placeholder="NIM*" value="<?php echo $name;?>" required pattern="[A-Za-zñÑçÇáéíóúÁÉÍÓÚ ]+"/></td>
                            <td><input class="std-ed-te" type="text" size="10" name="edit-contact-surname" maxlength="255" placeholder="Name*" value="<?php echo $surname;?>" required pattern="[A-Za-zñÑçÇáéíóúÁÉÍÓÚ ]+"/></td>
                            <td><input class="std-ed-te" type="email" size="10" name="edit-contact-email" maxlength="255" placeholder="Email*" value="<?php echo $email;?>" required pattern="[^@]+@[a-zA-Z0-9]+\.[a-z]+"/></td>
                            <td><input class="std-ed-te" type="text" size="10" name="edit-contact-phone" maxlength="255" placeholder="Telephone*" value="<?php echo $phone;?>" required pattern="[0-9\-\(\) \+]+"/></td>
                            <td><button  name="edit-contact-submit" lass="btn">Edit</button></td>
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
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    require "includes/footer.inc.php";
?>
