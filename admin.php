<?php
$koneksi = new mysqli("localhost", "root", "", "joki_game");
$result = $koneksi->query("SELECT * FROM pesanan ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin - Daftar Pesanan</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Menu navigasi */
        .navbar {
            background-color: #333;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }

        .navbar h1 {
            font-size: 20px;
            margin: 0;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            margin-left: 15px;
            font-weight: bold;
        }

        .nav-links a:hover {
            text-decoration: underline;
        }

        /* Konten utama */
        .form-container {
            max-width: 800px;
            margin: 40px auto;
            background-color: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }

        .order-item {
            border-left: 5px solidrgb(255, 0, 0);
            margin-bottom: 20px;
            padding: 15px;
            background-color:rgb(25, 0, 255);
            border-radius: 8px;
        }

        .order-item h4 {
            margin: 0 0 8px;
        }

        .btn-selesai {
            display: inline-block;
            padding: 6px 10px;
            background-color: #28a745;
            color: white;
            border-radius: 4px;
            text-decoration: none;
        }

        .btn-selesai.disabled {
            background-color: #6c757d;
            pointer-events: none;
        }
    </style>
</head>
<body>

<!-- Menu Navigasi -->
<div class="navbar">
    <h1>📋 Admin Joki Game</h1>
    <div class="nav-links">
        <a href="index.php">Beranda</a>
        <a href="admin.php">Pesanan</a>
        <a href="#">Logout</a> <!-- Ganti dengan login sistem kalau dibutuhkan -->
    </div>
</div>

<!-- Konten Daftar Pesanan -->
<div class="form-container">
    <h2>Daftar Pesanan Masuk</h2>

    <?php while($row = $result->fetch_assoc()): ?>
        <div class="order-item">
            <h4><?= htmlspecialchars($row['nama']) ?> (<?= htmlspecialchars($row['game']) ?>)</h4>
            <p>Email: <?= htmlspecialchars($row['email']) ?></p>
            <p>Rank: <?= htmlspecialchars($row['Rank_awal']) ?> → <?= htmlspecialchars($row['Rank_target']) ?></p>
            <p>Status: <strong><?= $row['status'] ?></strong></p>

            <?php if ($row['status'] != 'selesai'): ?>
                <a class="btn-selesai" href="update_status.php?id=<?= $row['id'] ?>">Tandai Selesai</a>
            <?php else: ?>
                <span class="btn-selesai disabled">✅ Selesai</span>
            <?php endif; ?>
        </div>
    <?php endwhile; ?>
</div>

</body>
</html>
