
<?php
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'view';
switch ($aksi) {
    case 'view':
        ?>
        <?php
        include 'koneksi.php';
        ?>


        <div class="container-fluid py-3">
            <h3 class="text-center">Daftar Mahasiswa</h3>
            
            <table id="example"class="table table-bordered border border-black">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Prodi</th>
                        <th>Hobi</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = mysqli_query($db, "SELECT * FROM mahasiswa 
                    INNER JOIN prodi ON prodi.id = mahasiswa.prodi_id");

                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $no . "</td>";
                        echo "<td>" . $row['nim'] . "</td>";
                        echo "<td>" . $row['nama'] . "</td>";
                        echo "<td>" . $row['tgl_lahir'] . "</td>";
                        echo "<td>" . $row['jekel'] . "</td>";
                        echo "<td>" . $row['nama_prodi'] . "</td>";
                        echo "<td>" . $row['hobi'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['alamat'] . "</td>";
                        echo "</tr>";
                        ?>
                        <?php
                        $no++;
                    }
                    ?>
                </tbody>
            </table> 
        </div>
        <?php
        break;
        default:

}
?>