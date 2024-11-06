<?php
require_once 'koneksi.php';
require_once 'navbar.php';

echo "<link rel='stylesheet' href='styleupdate.css'>";
echo "<div class='container'>";

if (isset($_POST['update'])) {
    if (empty($_POST['nama']) || empty($_POST['email']) || empty($_POST['jabatan']) || empty($_POST['alamat']) || empty($_POST['kontak'])) {
        echo "<script>alert('Please fill out all required fields');</script>";
    } else {
        $nama    = $_POST['nama'];
        $email   = $_POST['email'];
        $jabatan = $_POST['jabatan'];
        $alamat  = $_POST['alamat'];
        $kontak  = $_POST['kontak'];
        $idStaff = $_POST['idstaff'];

        if (!empty($_FILES['foto']['name'])) {
            $foto = $_FILES['foto']['name'];
            $dir = "img/";
            $tmpFile = $_FILES['foto']['tmp_name'];
            
            if (move_uploaded_file($tmpFile, $dir . $foto)) {
                $sql = "UPDATE tb_staff SET nama='$nama', email='$email', jabatan='$jabatan', alamat='$alamat', kontak='$kontak', foto='$foto' WHERE id_staff=$idStaff";
            } else {
                echo "<script>alert('Error uploading new photo.');</script>";
            }
        } else {
            $sql = "UPDATE tb_staff SET nama='$nama', email='$email', jabatan='$jabatan', alamat='$alamat', kontak='$kontak' WHERE id_staff=$idStaff";
        }

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Successfully updated user');</script>";
            echo "<script>window.location.href='read.php';</script>"; 
        } else {
            echo "<script>alert('Error: There was an error while updating user info');</script>";
        }
    }
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$sql = "SELECT * FROM tb_staff WHERE id_staff=$id";
$result = $conn->query($sql);

if ($result->num_rows < 1) {
    header('Location: read.php');
    exit();
}

$row = $result->fetch_assoc();
?>

<div class="row">
    <div class="col">
        <h3>Update Data Pegawai</h3>
        <form action="update.php?id=<?php echo $row['id_staff']; ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo $row['id_staff']; ?>" name="idstaff">
            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($row['nama']); ?>" required><br>
            <label for="email">Email</label>
            <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required><br>
            <label for="jabatan">Jabatan</label>
            <input type="text" id="jabatan" name="jabatan" value="<?php echo htmlspecialchars($row['jabatan']); ?>" required><br>
            <label for="alamat">Alamat</label>
            <textarea rows="4" name="alamat" required><?php echo htmlspecialchars($row['alamat']); ?></textarea><br>
            <label for="kontak">Kontak</label>
            <input type="text" id="kontak" name="kontak" value="<?php echo htmlspecialchars($row['kontak']); ?>" required><br>
            <label for="foto">Foto</label>
            <input type="file" id="foto" name="foto"><br>
            <br>
            <input type="submit" name="update" class="btn" value="Update">
        </form>
    </div>
</div>

</div>
