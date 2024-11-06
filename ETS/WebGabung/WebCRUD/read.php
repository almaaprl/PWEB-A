<?php
require_once 'koneksi.php';
require_once 'navbar.php';

echo "<link rel='stylesheet' href='styleread.css'>";
echo "<div class='container'>";

if (isset($_POST['delete'])) {
    $idStaff = $_POST['idstaff'];
    $sql = "DELETE FROM tb_staff WHERE id_staff=" . $idStaff;
    
    if ($conn->query($sql) === TRUE) {
    } else {
        echo "<script>alert('Error deleting user');</script>";
    }
}

$sql = "SELECT * FROM tb_staff";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>List Data Pegawai</h2>";
    echo "<table>";
    echo "<tr>
        <th>Nama</th>
        <th>Email</th>
        <th>Jabatan</th>
        <th>Alamat</th>
        <th>Kontak</th>
        <th>Foto</th>
        <th width='70px'>Delete</th>
        <th width='70px'>Edit</th>
    </tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<form action='' method='POST' onsubmit=\"return confirm('Are you sure you want to delete this user?');\">";
        echo "<input type='hidden' value='" . $row['id_staff'] . "' name='idstaff' />";
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
        echo "<td>" . htmlspecialchars($row['jabatan']) . "</td>";
        echo "<td>" . htmlspecialchars($row['alamat']) . "</td>";
        echo "<td>" . htmlspecialchars($row['kontak']) . "</td>";
        
        // Tampilkan tombol download jika foto tersedia
        $fotoPath = "img/" . $row['foto'];
        if (!empty($row['foto']) && file_exists($fotoPath)) {
            echo "<td><a href='$fotoPath' download class='btn btn-download'>Download Foto</a></td>";
        } else {
            echo "<td>No Photo</td>";
        }
        
        echo "<td><input type='submit' name='delete' value='Delete' class='btn btn-danger' /></td>";
        echo "<td><a href='update.php?id=" . $row['id_staff'] . "' class='btn btn-info'>Edit</a></td>";
        echo "</tr>";
        echo "</form>";
    }
    echo "</table>";
} else {
    echo "<br><br>No Record Found";
}
?>
</div>
