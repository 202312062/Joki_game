<?php
$koneksi = new mysqli("localhost", "root", "", "joki_game");

// Proses form jika disubmit 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama        = $_POST["nama"];
    $email       = $_POST["email"];
    $game        = $_POST["game"];
    $Rank_awal  = $_POST["Rank_awal"];
    $Rank_target= $_POST["Rank_target"];
    $catatan     = $_POST["catatan"];

    $stmt = $koneksi->prepare("INSERT INTO pesanan (nama, email, game, Rank_awal, Rank_target, catatan, status) VALUES (?, ?, ?, ?, ?, ?, 'pending')");
    $stmt->bind_param("ssssss", $nama, $email, $game, $Rank_awal, $Rank_target, $catatan);
    $stmt->execute();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pemesanan Joki Game</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="form-container">
    <h2>Form Pemesanan Joki Game</h2>
    <form method="POST" action="">
        <label>Nama Lengkap:</label>
        <input type="text" name="nama" required>

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Nama Game:</label>
        <input type="text" name="game" required>

        <label>Rank Awal:</label>
        <input type="text" name="Rank_awal" required>

        <label>Rank Target:</label>
        <input type="text" name="Rank_target" required>

        <label>Catatan Tambahan:</label>
        <textarea name="catatan" rows="4"></textarea>

        <button type="submit">Kirim Pesanan</button>
    </form>
</div>

<!-- Menampilkan daftar pesanan -->
<div class="form-container">
    <h2>Daftar Pesanan Anda</h2>

    <?php
    $result = $koneksi->query("SELECT * FROM pesanan ORDER BY id DESC");
    while ($row = $result->fetch_assoc()):
    ?>
        <div class="order-item">
            <h4><?= htmlspecialchars($row['nama']) ?> (<?= htmlspecialchars($row['game']) ?>)</h4>
            <p>Email: <?= htmlspecialchars($row['email']) ?></p>
            <p>Rank: <?= htmlspecialchars($row['Rank_awal']) ?> → <?= htmlspecialchars($row['Rank_target']) ?></p>
            <p>Status: <strong><?= htmlspecialchars($row['status']) ?></strong></p>
        </div>
    <?php endwhile; ?>
</div>

<!-- Link ke halaman admin -->
<div style="text-align:center; margin-top: 40px;">
    <a href="admin.php" style="color:#00d4ff; font-weight:bold;">🔐 Login Admin</a>
</div>

</body>
</html>
