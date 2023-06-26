<!DOCTYPE html>
<html>
<head>
    <title>Data Toko</title>
</head>
<body>
    <h1>Data Toko</h1>

    <?php
    // Fungsi untuk mendapatkan data dari file JSON
    function getDataFromJSON($file) {
        $data = file_get_contents($file);
        return json_decode($data, true);
    }

    // Fungsi untuk menampilkan data pelanggan
    function displayPelanggan($pelanggan) {
        echo "<h2>Data Pelanggan</h2>";
        echo "<table>";
        echo "<tr><th>ID Pelanggan</th><th>Nama Pelanggan</th><th>Jenis Kelamin</th><th>Alamat</th><th>Telpon</th></tr>";
        foreach ($pelanggan as $p) {
            echo "<tr><td>{$p['id_pelanggan']}</td><td>{$p['nama_pelanggan']}</td><td>{$p['jenis_kelamin']}</td><td>{$p['alamat_pelanggan']}</td><td>{$p['telpon_pelanggan']}</td></tr>";
        }
        echo "</table>";
    }

    // Fungsi untuk menampilkan data barang
    function displayBarang($barang) {
        echo "<h2>Data Barang</h2>";
        echo "<table>";
        echo "<tr><th>ID Barang</th><th>Nama Barang</th><th>Tipe Barang</th><th>Tanggal Terima</th><th>Stock Barang</th><th>Harga Barang</th><th>Supplier</th></tr>";
        foreach ($barang as $b) {
            echo "<tr><td>{$b['id_barang']}</td><td>{$b['nama_barang']}</td><td>{$b['tipe_barang']}</td><td>{$b['tanggal_terima']}</td><td>{$b['stock_barang']}</td><td>{$b['harga_barang']}</td><td>{$b['supplier']}</td></tr>";
        }
        echo "</table>";
    }

    // Fungsi untuk menampilkan data supplier
    function displaySupplier($supplier) {
        echo "<h2>Data Supplier</h2>";
        echo "<table>";
        echo "<tr><th>ID Supplier</th><th>Nama Supplier</th><th>Alamat Supplier</th></tr>";
        foreach ($supplier as $s) {
            echo "<tr><td>{$s['id_supplier']}</td><td>{$s['nama_supplier']}</td><td>{$s['alamat_supplier']}</td></tr>";
        }
        echo "</table>";
    }

    // Fungsi untuk menampilkan data pembelian
    function displayPembelian($pembelian) {
        echo "<h2>Data Pembelian</h2>";
        echo "<table>";
        echo "<tr><th>ID Pembelian</th><th>ID Pelanggan</th><th>ID Barang</th><th>Tanggal Pembelian</th><th>Jumlah Pembelian</th></tr>";
        foreach ($pembelian as $p) {
            echo "<tr><td>{$p['id_pembelian']}</td><td>{$p['id_pelanggan']}</td><td>{$p['id_barang']}</td><td>{$p['tanggal_pembelian']}</td><td>{$p['jumlah_pembelian']}</td></tr>";
        }
        echo "</table>";
    }

    // Mendapatkan data dari file JSON
    $pelanggan = getDataFromJSON("data_pelanggan.json");
    $barang = getDataFromJSON("data_barang.json");
    $supplier = getDataFromJSON("data_supplier.json");
    $pembelian = getDataFromJSON("data_pembelian.json");

    // Menampilkan data
    displayPelanggan($pelanggan);
    displayBarang($barang);
    displaySupplier($supplier);
    displayPembelian($pembelian);
    ?>

</body>
</html>
