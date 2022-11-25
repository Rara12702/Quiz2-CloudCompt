<?php
    require "includes/header.inc.php";
?>

    <style>
        <?php include 'css/search_contacts.css'; ?>
    </style>

    <?php
        require "./includes/dbh.inc.php" ;

        // Check if search parameter exists in url
        // Find out users with given pattern
        // in their id, name or surname and display them

        // Seach parameter does not exist
        if(!isset($_GET['search'])){
            $sql = "SELECT * FROM Contacts";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$sql)){
                header("Location: ./Contacts.php?error=sqlerror");
                exit();
            }
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
        }
        // Seach parameter exist
        else{
            $searchpattern="%{$_GET['search']}%";
            // Prepare query using placeholders (prevent sql injection)
            $sql = "SELECT * FROM Contacts WHERE ID LIKE ? OR NAME LIKE ? OR SURNAME LIKE ?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$sql)){
                header("Location: ./Contacts.php?error=sqlerror");
                exit();
            }
            mysqli_stmt_bind_param($stmt, "sss", $searchpattern, $searchpattern, $searchpattern);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
        }

    ?>
    <main>
        <div class="main-content">
        <div class="search-wrap">
            <br>
            <div class="search">
                    <form action="" method="GET" >
                        <input class="searchTerm" type="text" name="search" maxlength="255" placeholder="Cari berdsasarkan Nama" />
                        <button class="searchButton" type="submit" hidden="true" name="search-submit">Search</button>
                    </form>
                </div>
            </div>
            <br>
            <hr>
            <div class="card-header">
                <h2>Data Mahasiswa</h2>
            </div>
            <div class="card-body">
                <table id="contacts-table" class="table search-table">
                    <tr>
                        <th>Nama Lengkap</th>
                        <th>Nama Panggilan</th>
                        <th>Email</th>
                        <th>Telephone</th>
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
                    <?php    
                    } 
                    ?>
                </table>
            </div>
        </div>
    </main>

<?php
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    require "includes/footer.inc.php";
?>
