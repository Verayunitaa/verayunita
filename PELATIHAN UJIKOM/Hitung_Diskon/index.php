<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $totalBelanja = isset($_POST['totalBelanja']) ? (float)$_POST['totalBelanja'] : 0;
    $diskon = 0;

    if ($totalBelanja >= 100000) {
        $diskon = 0.10 * $totalBelanja;
    } elseif ($totalBelanja >= 50000) {
        $diskon = 0.05 * $totalBelanja;
    }
    
    $totalBayar = $totalBelanja - $diskon;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hitung Diskon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <header class="bg-primary text-white text-center py-3">
        <h1>Hitung Diskon Belanja</h1>
    </header>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-dark text-white">Masukkan Total Belanja</div>
                    <div class="card-body">
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="totalBelanja" class="form-label">Total Belanja (Rp)</label>
                                <input type="number" class="form-control" id="totalBelanja" name="totalBelanja" placeholder="Masukkan total belanja" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Hitung Diskon</button>
                        </form>
                        <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
                        <div class="mt-4">
                            <p>Total Belanja: Rp. <?= number_format($totalBelanja, 0, ',', '.') ?></p>
                            <p>Diskon: Rp. <?= number_format($diskon, 0, ',', '.') ?></p>
                            <p>Total Bayar: Rp. <?= number_format($totalBayar, 0, ',', '.') ?></p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-4">
        <p>&copy; 2025 Website. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>