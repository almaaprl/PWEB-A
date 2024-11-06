<?php

require_once 'koneksi.php';
require_once 'navbar.php';
echo "<link rel='stylesheet' href='atyleadd.css'>";

?>
<div class="container">
    <?php

    if (isset($_POST['addnew'])) {

        if (empty($_POST['nama']) || empty($_POST['email']) || empty($_POST['jabatan']) || empty($_POST['alamat']) || empty($_POST['kontak']) || empty($_FILES['foto']['name'])) {
            echo "<script>alert('Please fill out all required fields');</script>";
        } else {
            $nama       = $_POST['nama'];
            $email      = $_POST['email'];
            $jabatan    = $_POST['jabatan'];
            $alamat     = $_POST['alamat'];
            $kontak     = $_POST['kontak'];
            $foto       = $_FILES['foto']['name'];

            $dir = "img/";
            $tmpFile = $_FILES['foto']['tmp_name'];

            if (!is_dir($dir)) {
                mkdir($dir, 0777, true);
            }

            move_uploaded_file($tmpFile, $dir . $foto);

            $sql = "INSERT INTO tb_staff(nama, email, jabatan, alamat, kontak, foto) 
                    VALUES('$nama', '$email', '$jabatan', '$alamat', '$kontak', '$foto')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Successfully added new user');</script>";
            } else {
                echo "<script>alert('Error: There was an error while adding new user');</script>";
            }
        }
    }
    ?>
    <div class="form-container">
        <div class="box">
            <h3>Add New Data</h3>
            <form action="" method="POST" enctype="multipart/form-data">
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" class="form-input"><br>
                
                <label for="email">Email</label>
                <input type="text" id="email" name="email" class="form-input"><br>
                
                <label for="jabatan">Jabatan</label>
                <input type="text" id="jabatan" name="jabatan" class="form-input"><br>
                
                <label for="alamat">Alamat</label>
                <textarea rows="4" name="alamat" class="form-input"></textarea><br>

                <label for="kontak">Kontak</label>
                <input type="text" id="kontak" name="kontak" class="form-input"><br>
                
                <label for="foto">Foto</label>
                <input type="file" id="foto" name="foto" class="form-input"><br>

                <input type="submit" name="addnew" class="btn" value="Add New">
            </form>
        </div>
    </div>
</div>
