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

// Mendapatkan data barang dari file JSON
$barangFile = "data_barang.json";
$barangData = getDataFromJSON($barangFile);

// Hapus barang
if (isset($_GET['id'])) {
    $idBarang = $_GET['id'];

    // Cari indeks barang yang akan dihapus
    $index = array_search($idBarang, array_column($barangData, 'id_barang'));

    // Hapus data barang
    if ($index !== false) {
        array_splice($barangData, $index, 1);

        // Simpan data ke file JSON
        saveDataToJSON($barangFile, $barangData);
    }

    // Redirect ke halaman utama setelah menghapus data barang
    header("Location: tampil.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Hapus barang</title>
</head>
<body>
    <?php if (isset($_GET['id'])): ?>
        <?php $idBarang = $_GET['id']; ?>
        <h1>Hapus barang</h1>
        <p>Apakah Anda yakin ingin menghapus barang dengan ID: <?php echo $idBarang; ?>?</p>
        <form method="POST" action="">
            <input type="hidden" name="id_barang" value="<?php echo $idBarang; ?>">
            <input type="submit" name="submit" value="Hapus">
        </form>
    <?php endif; ?>
</body>
</html>
