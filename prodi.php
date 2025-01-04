<?php
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'view';

switch ($aksi) {
    case 'view':
        ?>
        <?php
        include 'koneksi.php';
        ?>

        <body>
            <div class="container-fluid py-3">
                <h3 class="text-center">Data Prodi</h3>
                <table id="example" class="table table-bordered border border-black">
                    <thead class="table-dark">
                        <tr>
                    <th>No</th>
                    <th>Nama Prodi</th>
                    <th>Jenjang Studi</th>
                    <th>Keterangan</th>
                    </tr>
                    </thead>

                    <tbody>
                        <?php
                        $result = mysqli_query($db, "SELECT  * FROM prodi");
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $no . "</td>";
                            echo "<td>" . $row['nama_prodi'] . "</td>";
                            echo "<td>" . $row['jenjang_studi'] . "</td>";
                            echo "<td>" . $row['keterangan'] . "</td>";
                            echo "</tr>";
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>



            </div>



        </body>

        <?php
        break;
    default:
}
?>