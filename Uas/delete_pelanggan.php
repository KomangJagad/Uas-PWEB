<?php

// Fungsi untuk mendapatkan data dari file JSON
function getDataFromJSON($filename) {
    $file = file_get_contents($filename);
    $data = json_decode($file, true);
    return $data;
}

// Fungsi untuk menyimpan data ke file JSON
function saveDataToJSON($filename, $data) {
    $jsondata = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents($filename, $jsondata);
}

// Mendapatkan data pelanggan dari file JSON
$pelangganFile = "data_pelanggan.json";
$pelangganData = getDataFromJSON($pelangganFile);

// Hapus pelanggan
if (isset($_GET['id'])) {
    $idPelanggan = $_GET['id'];

    // Cari indeks pelanggan yang akan dihapus
    $index = array_search($idPelanggan, array_column($pelangganData, 'id_pelanggan'));

    // Hapus data pelanggan
    if ($index !== false) {
        array_splice($pelangganData, $index, 1);

        // Simpan data ke file JSON
        saveDataToJSON($pelangganFile, $pelangganData);
    }

    // Redirect ke halaman utama setelah menghapus data pelanggan
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Hapus Pelanggan</title>
</head>
<body>
    <?php if (isset($_GET['id'])): ?>
        <?php $idPelanggan = $_GET['id']; ?>
        <h1>Hapus Pelanggan</h1>
        <p>Apakah Anda yakin ingin menghapus pelanggan dengan ID: <?php echo $idPelanggan; ?>?</p>
        <form method="POST" action="">
            <input type="hidden" name="id_pelanggan" value="<?php echo $idPelanggan; ?>">
            <input type="submit" name="submit" value="Hapus">
        </form>
    <?php endif; ?>
</body>
</html>
