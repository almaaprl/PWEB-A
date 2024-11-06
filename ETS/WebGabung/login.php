<?php
session_start();
require 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil input email dan password
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query untuk memeriksa email dan password di database
    $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['user'] = $email;
        header("Location: WebCRUD/index.php");
        exit();
    } else {
        echo "<script>alert('Email atau password salah.');</script>";
        echo "<script>window.location.href = 'index.html';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
