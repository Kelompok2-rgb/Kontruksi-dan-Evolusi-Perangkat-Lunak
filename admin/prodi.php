<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Prodi</h1>
</div>

<?php
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'view';

switch ($aksi) {
    case 'view':
        ?>
        <?php
        include '../koneksi.php';
        ?>

        <body>
            <div class="container py-2">
                <div class="py-2">
                    <a href="index.php?p=prodi&aksi=input" class="btn btn-success btn-sm py-3">Input Data Baru</a>
                </div>

                <table class="table table-bordered border border-black" id="example" >
                    <thead>
                        <tr>
                    <th>No</th>
                    <th>Nama Prodi</th>
                    <th>Jenjang Studi</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
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
                            echo "<td>
                        <a href='index.php?p=prodi&aksi=edit&id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit</a>
                        <a href='proses_prodi.php?proses=delete&id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus?\")'>Delete</a>
                    </td>";
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

    case 'input':
        ?>

        <body>
            <div class="container">
                <form action="proses_prodi.php?proses=insert" method="post">

                    <div class="mb-3">
                        <label for="" class="form-label">
                            <h4 style="font-size: 18px">Nama Prodi</h4>
                        </label>
                        <input type="text" class="form-control" name="nama_prodi" autofocus required style="max-width: 700px;">
                    </div>

                    <div class="mb-3" style="max-width: 700px;">
                        <label for="jenjang_studi" class="form-label">
                            <h4 style="font-size: 18px">Jenjang Studi</h4>
                        </label>
                        <select class="form-select" id="jenjang_studi" name="jenjang_studi">
                            <option value="" disabled selected>-Pilih Jenjang</option>

                            <option value="D3">D-III</option>
                            <option value="D4">D-IV</option>
                            <option value="S2">S2</option>
                            <option value="S3">S3</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">
                            <h4 style="font-size: 18px">Keterangan</h4>
                        </label>
                        <div class="mb-3">
                            <textarea class="teks" name="keterangan" cols="92" rows="5"></textarea>
                        </div>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" name="reset" class="btn btn-warning">Reset</button>
                    <a href="?p=prodi" class="btn btn-success">Lihat Prodi</a>




                </form>
            </div>



        </body>
        <?php
        break;

    case 'edit':
        ?>
        <?php
        include '../koneksi.php';

        // Mendapatkan data mahasiswa berdasarkan ID
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $query = mysqli_query($db, "SELECT * FROM prodi WHERE id='$id'");
            $data = mysqli_fetch_assoc($query);
        }

        if (isset($_POST['update'])) {
            // Mengambil data dari form
            $id = $_POST['id'];
            $nama_prodi = $_POST['nama_prodi'];
            $jenjang_studi = $_POST['jenjang_studi'];
            $keterangan = $_POST['keterangan'];

        }
        ?>

        <body>
            <div class="container">
                <form action="proses_prodi.php?proses=update" method="post">
                    <input type="hidden" name="id" value="<?= $data['id'] ?>">
                    <div class="mb-3">
                        <label for="" class="form-label">
                            <h4 style="font-size: 18px">Nama Prodi</h4>
                        </label>
                        <input type="text" class="form-control" name="nama_prodi" value="<?= $data['nama_prodi'] ?>" autofocus
                            required style="max-width: 700px;">
                    </div>

                    <div class="mb-3" style="max-width: 700px;">
                        <label for="jenjang_studi" class="form-label">
                            <h4 style="font-size: 18px">Jenjang Studi</h4>
                        </label>
                        <select class="form-select" id="jenjang_studi" name="jenjang_studi">
                            <option value="" disabled selected>-Pilih Jenjang</option>

                            <option value="D3" <?= $data['jenjang_studi'] == 'D3' ? 'selected' : '' ?>>D-III</option>
                            <option value="D4" <?= $data['jenjang_studi'] == 'D4' ? 'selected' : '' ?>>D-IV</option>
                            <option value="S2" <?= $data['jenjang_studi'] == 'S2' ? 'selected' : '' ?>>S2</option>
                            <option value="S3" <?= $data['jenjang_studi'] == 'S3' ? 'selected' : '' ?>>S3</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">
                            <h4 style="font-size: 18px">Keterangan</h4>
                        </label>
                        <div class="mb-3">
                            <textarea class="teks" name="keterangan" cols="92" rows="5"><?= $data['keterangan'] ?></textarea>
                        </div>
                    </div>

                    <button type="submit" name="update" class="btn btn-primary">Update</button>
                </form>
            </div>
        </body>
        <?php
        break;
}
?>