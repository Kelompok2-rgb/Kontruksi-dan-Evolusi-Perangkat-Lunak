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
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quos tempore animi maxime alias minima eaque impedit inventore consectetur, soluta, molestiae, possimus ipsam mollitia corrupti veniam beatae minus non fugiat excepturi modi cumque. Consectetur ullam eveniet ipsum magnam voluptas libero earum aperiam nobis doloremque labore facere aliquam praesentium ea nihil ratione, ex cupiditate, deserunt autem reprehenderit quam nam tenetur dignissimos? Voluptatibus, distinctio atque. Suscipit quas doloribus quaerat fuga iste est officia officiis ut voluptatibus aliquid voluptate perspiciatis iure, dicta id, nemo fugit saepe eos mollitia impedit facilis quod repellendus a! Vitae, earum ipsum atque in qui at magnam aut eaque! Quia.</p>
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