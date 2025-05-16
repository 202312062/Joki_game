<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Joki Game</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function submitForm(event) {
            event.preventDefault();
            const form = document.getElementById('jokiForm');
            const formData = new FormData(form);

            fetch('submit.php', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    addOrderToList(data.pesanan);
                    form.reset();
                    alert("Pesanan berhasil dikirim!");
                } else {
                    alert("Gagal menyimpan data.");
                }
            })
            .catch(err => {
                console.error(err);
                alert("Terjadi kesalahan.");
            });
        }

        function addOrderToList(pesanan) {
            const list = document.getElementById('orderList');
            const item = document.createElement('div');
            item.className = 'order-item';
            item.innerHTML = `
                <h4>${pesanan.nama} (${pesanan.game})</h4>
                <p>Email: ${pesanan.email}</p>
                <p>Level: ${pesanan.Rank_awal} → ${pesanan.Rank_target}</p>
                <p>Catatan: ${pesanan.catatan}</p>
                <hr>
            `;
            list.prepend(item);
        }
    </script>
</head>
<body>
    <div class="form-container">
        <h2>Form Pemesanan Joki Game</h2>
        <form id="jokiForm" onsubmit="submitForm(event)">
            <label>Nama Lengkap:</label>
            <input type="text" name="nama" required> 

            <label>Email:</label>
            <input type="email" name="email" required> 

            <label>Nama Game:</label>
            <input type="text" name="game" required> 

            <label>Rank Awal:</label>
            <input type="number" name="Rank_awal" required>

            <label>Rank Target:</label>
            <input type="number" name="Rank_target" required>

            <label>Catatan Tambahan:</label>
            <textarea name="catatan" rows="4"></textarea> <br>

            <button type="submit">Kirim Pesanan</button>
        </form>
    </div>

    <div class="form-container" style="margin-top: 40px;">
        <h2>Daftar Pesanan</h2>
        <div id="orderList">
            <!-- Pesanan baru akan muncul di sini -->
        </div>
    </div>
</body>
</html>
