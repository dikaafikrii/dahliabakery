<!DOCTYPE html>
<html>
<head>
    <title>Daftar Roti</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Daftar Roti</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Jenis Roti</th>
            <th>Harga Roti</th>
            <th>Stok Roti</th>
        </tr>
        <?php
        // Konfigurasi database
        $servername = "localhost";
        $username = "root";
        $password = "123";
        $dbname = "dahliabakery";

        // Membuat koneksi
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Memeriksa koneksi
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        // Query SQL untuk mengambil data
        $sql = "SELECT id, jenis_roti, harga_roti, stok_roti FROM daftar_roti";
        $result = $conn->query($sql);

        // Memeriksa apakah query berhasil dieksekusi
        if ($result->num_rows > 0) {
            // Menampilkan data dalam bentuk baris tabel HTML
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["id"]."</td>";
                echo "<td>".$row["jenis_roti"]."</td>";
                echo "<td>".$row["harga_roti"]."</td>";
                echo "<td>".$row["stok_roti"]."</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Tidak ada data yang ditemukan</td></tr>";
        }

        // Mendapatkan data dari form
        if(isset($_POST['id'])) {
            $id = $_POST['id'];
            $stok = $_POST['stok_roti'];
          
        // Query SQL untuk melakukan update stok roti
        $sql = "UPDATE daftar_roti SET stok_roti='$stok' WHERE id=$id";
        }
if ($conn->query($sql) == TRUE) {
    echo "Stok roti berhasil diperbarui";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


        ?>
    </table>
    <form action="tes.php" method="post">
        ID Roti: <input type="text" name="id"><br>
        Stok Baru: <input type="text" name="stok_roti"><br>
        <input type="submit" value="Update Stok Roti">
    </form>
</body>
</html>
