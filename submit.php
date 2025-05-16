<?php
include 'db.php';

header('Content-Type: application/json');

$nama = $_POST['nama'];
$email = $_POST['email'];
$game = $_POST['game'];
$Rank_awal = $_POST['Rank_awal'];
$Rank_target = $_POST['Rank_target'];
$catatan = $_POST['catatan'];

$sql = "INSERT INTO pesanan (nama, email, game, Rank_awal, Rank_target, catatan)
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssdds", $nama, $email, $game, $Rank_awal, $Rank_target, $catatan);

if ($stmt->execute()) {
    echo json_encode([
        'success' => true,
        'pesanan' => [
            'nama' => $nama,
            'email' => $email,
            'game' => $game,
            'Rank_awal' => $Rank_awal,
            'Rank_target' => $Rank_target,
            'catatan' => $catatan
        ]
    ]);
} else {
    echo json_encode(['success' => false]);
}

$stmt->close();
$conn->close();
