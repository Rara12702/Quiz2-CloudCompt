<?php
    require "includes/header.inc.php";
?>

    <style>
        <?php include 'css/add_contacts.css'; ?>
    </style>
    <main>
            <?php
                // Check if some error exist and inform user
                if(isset($_GET['error'])){
                    if($_GET['error'] == "sqlerror"){
                        echo "<script>alert('Ada kesalahan pada database!');</script>";
                    }
                    else if($_GET['error'] == "userexists"){
                        echo "<script>alert('ID atau Telephone sudah ada!');</script>";
                    }
                    else{
                        echo "<script>alert('Terjadi kesalahan!');</script>";
                    }
                }
                // Inform user when a new user added successfully to the system
                else if (isset($_GET['add-contact'])){
                    if($_GET['add-contact'] == "true"){
                        echo "<script>alert('Berhasil membuat data!');</script>";
                    }
                }
            ?>
            <div class="add-contact-page">
                <div class="form">
                <div class='add-contact-form-text'><h2>ADD MAHASISWA</h2></div>
                <form name="add-contact-form" class="add-contact-form" action="includes/addcontact.inc.php"  method="post">
                <input type="text" name="add-contact-name" maxlength="255" placeholder="Nama Lengkap*" required pattern="[A-Za-zñÑçÇáéíóúÁÉÍÓÚ ]+"/>
                <input type="text" name="add-contact-surname" maxlength="255" placeholder="Nama Panggilan*" required pattern="[A-Za-zñÑçÇáéíóúÁÉÍÓÚ ]+"/>
                <input type="email" name="add-contact-email" maxlength="255" placeholder="Email*" required pattern="[^@]+@[a-zA-Z0-9]+\.[a-z]+"/>
                <input type="text" name="add-contact-phone" placeholder="Telephone*" required pattern="[0-9\-\(\) \+]+"/>
                <button type="submit" name="add-contact-submit">ADD</button>
                </form>
            </div>
            </div>
    </main>

<?php
    require "includes/footer.inc.php";
?>
