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

// Tambah pelanggan baru
if (isset($_POST['submit'])) {
    $newPelanggan = array(
        'id_pelanggan' => $_POST['id_pelanggan'],
        'nama_pelanggan' => $_POST['nama_pelanggan'],
        'jenis_kelamin' => $_POST['jenis_kelamin'],
        'alamat_pelanggan' => $_POST['alamat_pelanggan'],
        'telpon_pelanggan' => $_POST['telpon_pelanggan']
    );

    // Tambahkan data pelanggan baru ke array
    $pelangganData[] = $newPelanggan;

    // Simpan data ke file JSON
    saveDataToJSON($pelangganFile, $pelangganData);
    
    // Redirect ke halaman utama setelah menambahkan pelanggan baru
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Pelanggan Baru</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <div class="container">
        <h1>Data Toko</h1>

        <!-- Form tambah pelanggan (Create) -->
        <h2>Tambah Pelanggan</h2>
        <form method="POST" action="">
            <label for="id_pelanggan">ID Pelanggan:</label>
            <input type="text" id="id_pelanggan" name="id_pelanggan" required><br><br>

            <label for="nama_pelanggan">Nama Pelanggan:</label>
            <input type="text" id="nama_pelanggan" name="nama_pelanggan" required><br><br>

            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <select id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select><br><br>

            <label for="alamat_pelanggan">Alamat Pelanggan:</label>
            <textarea id="alamat_pelanggan" name="alamat_pelanggan" required></textarea><br><br>

            <label for="telpon_pelanggan">Telpon Pelanggan:</label>
            <input type="text" id="telpon_pelanggan" name="telpon_pelanggan" required><br><br>

            <input type="submit" value="Tambah Data" name="submit" class="btn btn-primary">
        </form>
        <!-- Tabel data pelanggan (Read) -->
        
        <h2>Data Pelanggan</h2>
        <table>
            <tr>
                <th>ID Pelanggan</th>
                <th>Nama Pelanggan</th>
                <th>Jenis Kelamin</th>
                <th>Alamat Pelanggan</th>
                <th>Telpon Pelanggan</th>
                <th>Aksi</th>
            </tr>
            <?php foreach($pelangganData as $pelanggan):?>
            <tr>
            <td><?php echo $pelanggan['id_pelanggan']; ?></td>
                <td><?php echo $pelanggan['nama_pelanggan']; ?></td>
                <td><?php echo $pelanggan['jenis_kelamin']; ?></td>
                <td><?php echo $pelanggan['alamat_pelanggan']; ?></td>
                <td><?php echo $pelanggan['telpon_pelanggan']; ?></td>
                <td>
                    <a href="edit_pelanggan.php?id=<?php echo $pelanggan['id_pelanggan']?>">Edit</a>
                    <a href="delete_pelanggan.php?id=<?php echo $pelanggan ['id_pelanggan']?>">Hapus</a>
                </td>
            </tr>
            <?php endforeach;?>
        </table>
    </div>
</body>
</html>
