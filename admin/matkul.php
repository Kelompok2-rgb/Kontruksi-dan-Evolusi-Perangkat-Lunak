<?php
if ($_SESSION["user_level"] !== 'admin') {
    echo "<script>alert('Anda tidak memiliki akses ke halaman ini!');window.location='index.php';</script>";
    exit;
}
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Mata Kuliah</h1>
</div>

<?php
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'view';
switch ($aksi) {
    case 'view':
        ?>
        <?php
        include '../koneksi.php';
        ?>


        <div class="container">
            <div class="py-2">
                <a href="index.php?p=matkul&aksi=input" class="btn btn-success">Input Data Baru</a>
            </div>
            <table id="example" class="table table-bordered border border-black">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Matkul</th>
                        <th>Nama Matkul</th>
                        <th>SKS</th>
                        <th>Prodi</th>
                        <th>Semester</th>
                        <th>Aksi</th>
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
                        echo "<td>
                        <a href='index.php?p=matkul&aksi=edit&kode_mk=" . $row['kode_mk'] . "' class='btn btn-warning btn-sm'>Edit</a>
                        <a href='proses_matkul.php?proses=delete&kode_mk=" . $row['kode_mk'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus?\")'>Delete</a>
                    </td>";
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

    case 'input':
        ?>

        <body>
            <div class="container">

                <div class="row">
                    <div class="col-8">
                        <form action="proses_matkul.php?proses=insert" method="post">
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Kode Matkul</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="kode_mk" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Nama Matkul</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="nama_mk" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">SKS</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" name="sks" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Prodi</label>
                                <div class="col-sm-8">
                                    <select name="prodi" class="form-select">
                                        <option value="">--Pilih Prodi--</option>
                                        <?php
                                        include '../koneksi.php';
                                        $ambil_prodi = mysqli_query($db, "SELECT * FROM prodi");
                                        while ($data_prodi = mysqli_fetch_assoc($ambil_prodi)) {
                                            echo "<option value='" . $data_prodi['id'] . "'>" . $data_prodi['nama_prodi'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Semester</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" name="semester" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-8">
                                    <input type="submit" name="submit" class="btn btn-primary">
                                    <button type="reset" name="reset" class="btn btn-warning">Reset</button>
                                    <a href="?p=matkul" class="btn btn-success">Lihat Mata Kuliah</a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>




            </div>

        </body>


        <?php
        break;

    case 'edit':
        ?>
        <?php
        include '../koneksi.php';

        // Mendapatkan data dosen berdasarkan NIP
        if (isset($_GET['kode_mk'])) {
            $kode_mk = $_GET['kode_mk'];
            $query = mysqli_query($db, "SELECT * FROM matkul WHERE kode_mk='$kode_mk'");
            $data = mysqli_fetch_assoc($query);
        }

        if (isset($_POST['update'])) {
            // Mengambil data dari form
            $nama_mk = $_POST['nama_mk'];
            $sks = $_POST['sks'];
            $prodi_id = $_POST['prodi'];
            $semester = $_POST['semester'];
        }
        ?>

        <body>

            <div class="container">
                <form action="proses_matkul.php?proses=update" method="post">
                    <input type="hidden" name="kode_mk" value="<?= $data['kode_mk'] ?>">



                    <!-- Nama -->
                    <div class="mb-3">
                        <label for="" class="form-label">Nama Matkul</label>
                        <input type="text" name="nama_mk" class="form-control" value="<?= $data['nama_mk'] ?>" required>
                    </div>

                    <!-- SKS -->
                    <div class="mb-3">
                        <label class="form-label">SKS</label>
                        <input type="number" name="sks" class="form-control" value="<?= $data['sks'] ?>" required>
                    </div>

                    <!-- Prodi -->
                    <div class="mb-3">
                        <label class="form-label">Prodi</label>
                        <select name="prodi" class="form-select">
                            <option value="">--Pilih Prodi--</option>
                            <?php
                            include '../koneksi.php';
                            $ambil_prodi = mysqli_query($db, "SELECT * FROM prodi");
                            while ($data_prodi = mysqli_fetch_assoc($ambil_prodi)) {
                                $selected = ($data['prodi_id'] == $data_prodi['id']) ? 'selected' : '';
                                echo "<option value='" . $data_prodi['id'] . "' $selected>" . $data_prodi['nama_prodi'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Semester -->
                    <div class="mb-3">
                        <label class="form-label">Semester</label>
                        <input type="number" name="semester" class="form-control" value="<?= $data['semester'] ?>" required>
                    </div>


                    <button type="submit" name="update" class="btn btn-primary">Update</button>
                </form>
            </div>

        </body>
        <?php
        break;
}

?>