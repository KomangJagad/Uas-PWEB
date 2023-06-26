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

// Edit barang
if (isset($_POST['submit'])) {
    $idBarang = $_POST['id_barang'];
    $namaBarang = $_POST['nama_barang'];
    $tipeBarang = $_POST['tipe_barang'];
    $tanggalTerima = $_POST['tanggal_terima'];
    $stockBarang = $_POST['stock_barang'];
    $hargaBarang = $_POST['harga_barang'];
    $Supplier = $_POST['supplier'];

    // Cari indeks barang yang akan diupdate
    $index = array_search($idBarang, array_column($barangData, 'id_barang'));

    // Update data barang
    if ($index !== false) {
        $barangData[$index]['nama_barang'] = $namaBarang;
        $barangData[$index]['tipe_barang'] = $tipeBarang;
        $barangData[$index]['tanggal_terima'] = $tanggalTerima;
        $barangData[$index]['stock_barang'] = $stockBarang;
        $barangData[$index]['harga_barang'] = $hargaBarang;
        $barangData[$index]['supplier'] = $Supplier;

        // Simpan data ke file JSON
        saveDataToJSON($barangFile, $barangData);
    }

    // Redirect ke halaman utama setelah mengupdate data barang
    header("Location: tampil.php");
    exit();
}

// Mendapatkan ID barang dari parameter URL
$idBarang = $_GET['id'];
// Cari data barang berdasarkan ID
$editbarang = null;
foreach ($barangData as $barang) {
    //var_dump ($barang);
    if ($barang['id_barang'] === $idBarang) {
        $editBarang = $barang;
        break;
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Barang</title>
    <link rel="stylesheet" href="edit.css">
</head>
<body>
    <h1>Edit Barang</h1>
    <?php if ($editBarang): ?>
        <form method="POST" action="">
            <label for="id_barang">ID Barang:</label>
            <input type="text" id="id_barang" name="id_barang" value="<?php echo $editBarang['id_barang']; ?>" readonly><br>

            <label for="nama_barang">Nama Barang:</label>
            <input type="text" id="nama_barang" name="nama_barang" value="<?php echo $editBarang['nama_barang']; ?>" required><br>

            <label for="tipe_barang">Tipe Barang:</label>
            <input type="radio" id="tipe_barang" name="tipe_barang" value="Laki-laki" <?php if ($editBarang['tipe_barang'] === 'phone') echo 'checked'; ?> required> Phone
            <input type="radio" id="tipe_barang" name="tipe_barang" value="Perempuan" <?php if ($editBarang['tipe_barang'] === 'laptop') echo 'checked'; ?> required> Laptop<br>

            <label for="tanggal_terima">Tanggal Terima:</label>
            <input type="text" id="tanggal_terima" name="tanggal_terima" value="<?php echo $editBarang['tanggal_terima']; ?>" required><br>

            <label for="stock_barang">Stock barang:</label>
            <input type="text" id="stock_barang" name="stock_barang" value="<?php echo $editBarang['stock_barang']; ?>" required><br>

            <label for="harga_barang">Harga barang:</label>
            <input type="text" id="harga_barang" name="harga_barang" value="<?php echo $editBarang['harga_barang']; ?>" required><br>

            <label for="supplier">Supplier:</label>
            <input type="text" id="supplier" name="supplier" value="<?php echo $editBarang['supplier']; ?>" required><br>

           

            <input type="submit" name="submit" value="Update">
        </form>
    <?php else: ?>
        <p>Barang tidak ditemukan.</p>
    <?php endif; ?>
</body>
</html>
