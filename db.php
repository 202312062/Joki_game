<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "joki_game";

$conn = new mysqli($host, $user, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
