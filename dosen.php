
<?php
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'view';
switch ($aksi) {
    case 'view':
        ?>
        <?php
        include 'koneksi.php';
        ?>


        <div class="container-fluid py-3">
            <h3 class="text-center">Data Dosen</h3>
            
            <table id="example"class="table table-bordered border border-black">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>NIP</th>
                        <th>Nama Dosen</th>
                        <th>Email</th>
                        <th>Prodi</th>
                        <th>NoTelp</th>
                        <th>Alamat</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = mysqli_query($db, "SELECT * FROM dosen 
                    INNER JOIN prodi ON prodi.id = dosen.prodi_id");

                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $no . "</td>";
                        echo "<td>" . $row['nip'] . "</td>";
                        echo "<td>" . $row['nama_dosen'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['nama_prodi'] . "</td>";
                        echo "<td>" . $row['notelp'] . "</td>";
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