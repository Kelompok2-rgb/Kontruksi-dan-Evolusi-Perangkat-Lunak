<?php
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'view';
switch ($aksi) {
    case 'view':
        ?>
        <?php
        include 'koneksi.php';
        ?>


        <div class="container-fluid py-3">
            <h3 class="text-center">Mata Kuliah</h3>

            <table id="example" class="table table-bordered border border-black">
                <thead class="table-dark">
                    <tr>

                        <th>No</th>
                        <th>Kode Matkul</th>
                        <th>Nama Matkul</th>
                        <th>SKS</th>
                        <th>Prodi</th>
                        <th>Semester</th>


                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = mysqli_query($db, "SELECT * FROM matkul 
                    INNER JOIN prodi ON prodi.id = matkul.prodi_id");

                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $no . "</td>";
                        echo "<td>" . $row['kode_mk'] . "</td>";
                        echo "<td>" . $row['nama_mk'] . "</td>";
                        echo "<td>" . $row['sks'] . "</td>";
                        echo "<td>" . $row['nama_prodi'] . "</td>";
                        echo "<td>" . $row['semester'] . "</td>";
                        
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