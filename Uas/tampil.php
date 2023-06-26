<?php

// Fungsi untuk mendapatkan data dari file JSON
function getDataFromJSON($filename) {
    $file = file_get_contents($filename);
    $data = json_decode($file, true);
    return $data;
}

// Mendapatkan data barang dari file JSON
$barangFile = "data_barang.json";
$barangData = getDataFromJSON($barangFile);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Barang</title>
</head>
<body>
    <h1>Data Barang</h1>
    <link rel="stylesheet" href="tampil.css">
    <table>
        <tr>
            <th>ID Barang</th>
            <th>Nama Barang</th>
            <th>Tipe Barang</th>
            <th>Tanggal Terima</th>
            <th>Stock Barang</th>
            <th>Harga Barang</th>
            <th>Supplier</th>
        </tr>
        <?php foreach ($barangData as $barang): ?>
            <tr>
                <td><?php echo $barang['id_barang']; ?></td>
                <td><?php echo $barang['nama_barang']; ?></td>
                <td><?php echo $barang['tipe_barang']; ?></td>
                <td><?php echo $barang['tanggal_terima']; ?></td>
                <td><?php echo $barang['stock_barang']; ?></td>
                <td><?php echo $barang['harga_barang']; ?></td>
                <td><?php echo $barang['supplier']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
