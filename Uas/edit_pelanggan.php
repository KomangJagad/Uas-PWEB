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

// Edit pelanggan
if (isset($_POST['submit'])) {
    $idPelanggan = $_POST['id_pelanggan'];
    $namaPelanggan = $_POST['nama_pelanggan'];
    $jenisKelamin = $_POST['jenis_kelamin'];
    $alamatPelanggan = $_POST['alamat_pelanggan'];
    $telponPelanggan = $_POST['telpon_pelanggan'];

    // Cari indeks pelanggan yang akan diupdate
    $index = array_search($idPelanggan, array_column($pelangganData, 'id_pelanggan'));

    // Update data pelanggan
    if ($index !== false) {
        $pelangganData[$index]['nama_pelanggan'] = $namaPelanggan;
        $pelangganData[$index]['jenis_kelamin'] = $jenisKelamin;
        $pelangganData[$index]['alamat_pelanggan'] = $alamatPelanggan;
        $pelangganData[$index]['telpon_pelanggan'] = $telponPelanggan;

        // Simpan data ke file JSON
        saveDataToJSON($pelangganFile, $pelangganData);
    }

    // Redirect ke halaman utama setelah mengupdate data pelanggan
    header("Location: index.php");
    exit();
}

// Mendapatkan ID Pelanggan dari parameter URL
$idPelanggan = $_GET['id'];
// Cari data pelanggan berdasarkan ID
$editPelanggan = null;
foreach ($pelangganData as $pelanggan) {
    //var_dump ($pelanggan);
    if ($pelanggan['id_pelanggan'] === $idPelanggan) {
        $editPelanggan = $pelanggan;
        break;
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Pelanggan</title>
    <link rel="stylesheet" href="edit.css">
</head>
<body>
    <h1>Edit Pelanggan</h1>
    <?php if ($editPelanggan): ?>
        <form method="POST" action="">
            <label for="id_pelanggan">ID Pelanggan:</label>
            <input type="text" id="id_pelanggan" name="id_pelanggan" value="<?php echo $editPelanggan['id_pelanggan']; ?>" readonly><br>

            <label for="nama_pelanggan">Nama Pelanggan:</label>
            <input type="text" id="nama_pelanggan" name="nama_pelanggan" value="<?php echo $editPelanggan['nama_pelanggan']; ?>" required><br>

            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <input type="radio" id="jenis_kelamin" name="jenis_kelamin" value="Laki-laki" <?php if ($editPelanggan['jenis_kelamin'] === 'Laki-laki') echo 'checked'; ?> required> Laki-laki
            <input type="radio" id="jenis_kelamin" name="jenis_kelamin" value="Perempuan" <?php if ($editPelanggan['jenis_kelamin'] === 'Perempuan') echo 'checked'; ?> required> Perempuan<br>

            <label for="alamat_pelanggan">Alamat Pelanggan:</label>
            <input type="text" id="alamat_pelanggan" name="alamat_pelanggan" value="<?php echo $editPelanggan['alamat_pelanggan']; ?>" required><br>

            <label for="telpon_pelanggan">Telepon Pelanggan:</label>
            <input type="text" id="telpon_pelanggan" name="telpon_pelanggan" value="<?php echo $editPelanggan['telpon_pelanggan']; ?>" required><br>

            <input type="submit" name="submit" value="Update">
        </form>
    <?php else: ?>
        <p>Pelanggan tidak ditemukan.</p>
    <?php endif; ?>
</body>
</html>
