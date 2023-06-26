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
$barangFile = "data_barang.json";
$barangData = getDataFromJSON($barangFile);

// Tambah pelanggan baru
if (isset($_POST['submit'])) {
    $newBarang = array(
        'id_barang' => $_POST['id_barang'],
        'nama_barang' => $_POST['nama_barang'],
        'tipe_barang' => $_POST['tipe_barang'],
        'tanggal_terima' => $_POST['tanggal_terima'],
        'stock_barang' => $_POST['stock_barang'],
        'harga_barang' => $_POST['harga_barang'],
        'supplier' => $_POST['supplier']
    );
    
    // Tambahkan data pelanggan baru ke array
    $barangData[] = $newBarang;

    // Simpan data ke file JSON
    saveDataToJSON($barangFile, $barangData);
    
    // Redirect ke halaman utama setelah menambahkan pelanggan baru
    header("Location: tampil.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Barang Baru</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <div class="container">
        <h1>Data Toko</h1>

        <!-- Form tambah pelanggan (Create) -->
        <h2>Tambah Barang</h2>
        <form method="POST" action="">
            <label for="id_pelanggan">ID Barang:</label>
            <input type="text" id="id_barang" name="id_barang" required><br><br>

            <label for="nama_barang">Nama Barang:</label>
            <input type="text" id="nama_barang" name="nama_barang" required><br><br>

            <label for="tipe_barang">Tipe Barang:</label>
            <select id="tipe_barang" name="tipe_barang" required>
                <option value="phone">Phone</option>
                <option value="laptop">Laptop</option>
            </select><br><br>

            <label for="tanggal_terima">Tanggal Terima:</label>
            <input type="text" id="tanggal_terima" name="tanggal_terima" required><br><br>

            <label for="stock_barang">stock Barang:</label>
            <input type="text" id="stock_barang" name="stock_barang" required><br><br>

            <label for="harga_barang">Harga Barang:</label>
            <textarea id="harga_barang" name="harga_barang" required></textarea><br><br>

            <label for="supplier">Supplier:</label>
            <textarea id="supplier" name="supplier" required></textarea><br><br>

            <input type="submit" value="Tambah Data" name="submit" class="btn btn-primary">
        </form>
        <!-- Tabel data barang (Read) -->
        
        <h2>Data Barang</h2>
        <table>
            <tr>
                <th>ID Barang</th>
                <th>Nama Barang</th>
                <th>Tipe Barang</th>
                <th>Tanggal Terima</th>
                <th>Stock Barang</th>
                <th>Harga Barang</th>
                <th>Supplier</th>
                <th>Aksi</th>
            </tr>
            <?php foreach($barangData as $barang):?>
            <tr>
            <td><?php echo $barang['id_barang']; ?></td>
                <td><?php echo $barang['nama_barang']; ?></td>
                <td><?php echo $barang['tipe_barang']; ?></td>
                <td><?php echo $barang['tanggal_terima']; ?></td>
                <td><?php echo $barang['stock_barang']; ?></td>
                <td><?php echo $barang['harga_barang']; ?></td>
                <td><?php echo $barang['supplier']; ?></td>
                <td>
                    <a href="edit_barang.php?id=<?php echo $barang['id_barang']?>">Edit</a>
                    <a href="delete_barang.php?id=<?php echo $barang ['id_barang']?>">Hapus</a>
                </td>
            </tr>
            <?php endforeach;?>
        </table>
    </div>
</body>
</html>
