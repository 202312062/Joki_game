<?php
if (isset($_GET['id'])) {
    $koneksi = new mysqli("localhost", "root", "", "joki_game");
    $id = intval($_GET['id']);
    $koneksi->query("UPDATE pesanan SET status='selesai' WHERE id=$id");
}
header("Location: admin.php");
exit();