<?php

// Fungsi untuk mendapatkan data dari file JSON
function getDataFromJSON($filename) {
    $file = file_get_contents($filename);
    $data = json_decode($file, true);
    return $data;
}

// Mendapatkan data pelanggan dari file JSON
$pelangganFile = "data_pelanggan.json";
$pelangganData = getDataFromJSON($pelangganFile);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Pelanggan</title>
</head>
<body>
    <h1>Data Pelanggan</h1>
    <link rel="stylesheet" href="tampil.css">
    <table>
        <tr>
            <th>ID Pelanggan</th>
            <th>Nama Pelanggan</th>
            <th>Jenis Kelamin</th>
            <th>Alamat Pelanggan</th>
            <th>Telepon Pelanggan</th>
        </tr>
        <?php foreach ($pelangganData as $pelanggan): ?>
            <tr>
                <td><?php echo $pelanggan['id_pelanggan']; ?></td>
                <td><?php echo $pelanggan['nama_pelanggan']; ?></td>
                <td><?php echo $pelanggan['jenis_kelamin']; ?></td>
                <td><?php echo $pelanggan['alamat_pelanggan']; ?></td>
                <td><?php echo $pelanggan['telpon_pelanggan']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
