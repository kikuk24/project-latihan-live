<?php
session_start();
include '../../config/koneksi.php';

$userId = $_SESSION['user_id'] ?? 1;

// Ambil data keranjang langsung

$query = "SELECT c.id as cart_id, c.user_id, c.product_id, c.quantity, p.name, p.price, p.image_url FROM carts c JOIN products p ON c.product_id = p.id WHERE c.user_id = $userId";
$result = $conn->query($query);

$items = [];
$total = 0;

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
        $total += $row['price'] * $row['quantity'];
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5">
        <h2 class="mb-4">Checkout</h2>

        <?php if (count($items) == 0): ?>
            <div class="alert alert-warning">Keranjang kamu kosong.</div>
        <?php else: ?>
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Produk</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $item): ?>
                        <tr>
                            <td>
                                <img src="./uploads/<?= $item['image_url'] ?>" width="60" class="me-2">
                                <?= $item['name'] ?>
                            </td>
                            <td><?= $item['quantity'] ?></td>
                            <td>Rp <?= number_format($item['price'], 0, ',', '.') ?></td>
                            <td>Rp <?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-end fw-bold">Total</td>
                        <td class="fw-bold">Rp <?= number_format($total, 0, ',', '.') ?></td>
                    </tr>
                </tfoot>
            </table>

            <div class="mt-4 text-end">
                <a href="../../index.php" class="btn btn-secondary">← Kembali</a>
                <button class="btn btn-success" onclick="alert('Pesanan berhasil! (Simulasi)')">Bayar Sekarang</button>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>