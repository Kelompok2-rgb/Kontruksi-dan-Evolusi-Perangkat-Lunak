<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Mahasiswa</h1>
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
        <a href="index.php?p=mhs&aksi=input" class="btn btn-success">Input Data Baru</a>
        </div> 
            <table class="table table-bordered border border-black" id="example">
                <thead>
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
                        <th>Aksi</th>
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
                        echo "<td>
                        <a href='index.php?p=mhs&aksi=edit&nim=" . $row['nim'] . "' class='btn btn-warning btn-sm'>Edit</a>
                        <a href='proses_mahasiswa.php?proses=delete&nim=" . $row['nim'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus?\")'>Delete</a>
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
                        <form action="proses_mahasiswa.php?proses=insert" method="post">
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Nim</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" name="nim">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="nama">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-2">
                                    <select name="tgl" class="form-control">
                                        <option value="">--DD--</option>
                                        <?php
                                        for ($i = 1; $i <= 31; $i++) {
                                            echo "<option value=" . $i . ">" . $i . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <select name="bln" class="form-control">
                                        <option value="">--MM--</option>
                                        <?php
                                        $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                        foreach ($bulan as $key => $namaBulan) {
                                            echo "<option value=" . $key . ">" . $namaBulan . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <select name="thn" class="form-control">
                                        <option value="">--YY--</option>
                                        <?php
                                        for ($i = date('Y'); $i >= 1980; $i--) {
                                            echo "<option value=" . $i . ">" . $i . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-8">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jk" value="L" checked>
                                        <label class="form-check-label">
                                            Laki-laki
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jk" value="P">
                                        <label class="form-check-label">
                                            Perempuan
                                        </label>
                                    </div>
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

                                <label class="col-sm-3 col-form-label">Hobi</label>
                                <div class="col-sm-8">

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="hobi[]" value="Membaca">
                                        <label class="form-check-label">
                                            Membaca
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="hobi[]" value="Olahraga">
                                        <label class="form-check-label">
                                            Olahraga
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="hobi[]" value="Menulis">
                                        <label class="form-check-label">
                                            Menulis
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control" name="email">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Alamat</label>
                                <div class="col-sm-8">
                                    <textarea name="alamat" class="form-control" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-8">

                                    <input type="submit" name="submit" class="btn btn-primary">
                                    <button type="reset" name="reset" class="btn btn-warning">Reset</button>
                                    <a href="?p=mhs" class="btn btn-success">Lihat Data Mahasiswa</a>
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

        // Mendapatkan data mahasiswa berdasarkan NIM
        if (isset($_GET['nim'])) {
            $nim = $_GET['nim'];
            $query = mysqli_query($db, "SELECT * FROM mahasiswa WHERE nim='$nim'");
            $data = mysqli_fetch_assoc($query);
        }

        if (isset($_POST['update'])) {
            // Mengambil data dari form
            $nim = $_POST['nim'];
            $nama = $_POST['nama'];
            $tgl_lahir = $_POST['thn'] . '-' . $_POST['bln'] . '-' . $_POST['tgl'];
            $jk = $_POST['jk'];
            $prodi_id = $_POST['prodi'];
            $hobi = isset($_POST['hobi']) ? implode(',', $_POST['hobi']) : '';
            $email = $_POST['email'];
            $alamat = $_POST['alamat'];

        }
        ?>


        <body>
            <div class="container">
           
                <form action="proses_mahasiswa.php?proses=update" method="post">
                    <input type="hidden" name="nim" value="<?= $data['nim'] ?>">

                    <!-- Nama -->
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" value="<?= $data['nama'] ?>" required>
                    </div>

                    <!-- Tanggal Lahir -->
                    <div class="mb-3">
                        <label class="form-label">Tanggal Lahir</label>
                        <div class="row">
                            <div class="col-4">
                                <select name="tgl" class="form-control" required>
                                    <option value="">--DD--</option>
                                    <?php for ($i = 1; $i <= 31; $i++): ?>
                                        <option value="<?= $i ?>" <?= $i == date('d', strtotime($data['tgl_lahir'])) ? 'selected' : '' ?>><?= $i ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="col-4">
                                <select name="bln" class="form-control" required>
                                    <option value="">--MM--</option>
                                    <?php
                                    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                    foreach ($bulan as $key => $namaBulan):
                                        ?>
                                        <option value="<?= $key ?>" <?= $key == date('m', strtotime($data['tgl_lahir'])) ? 'selected' : '' ?>><?= $namaBulan ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-4">
                                <select name="thn" class="form-control" required>
                                    <option value="">--YY--</option>
                                    <?php for ($i = date('Y'); $i >= 1980; $i--): ?>
                                        <option value="<?= $i ?>" <?= $i == date('Y', strtotime($data['tgl_lahir'])) ? 'selected' : '' ?>><?= $i ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <div>
                            <input type="radio" name="jk" value="L" <?= $data['jekel'] == 'L' ? 'checked' : '' ?>> Laki-laki
                            <input type="radio" name="jk" value="P" <?= $data['jekel'] == 'P' ? 'checked' : '' ?>> Perempuan
                        </div>
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


                    <!-- Hobi -->
                    <div class="mb-3">
                        <label class="form-label">Hobi</label>
                        <div>
                            <?php $hobiArr = explode(',', $data['hobi']); ?>
                            <input type="checkbox" name="hobi[]" value="Membaca" <?= in_array('Membaca', $hobiArr) ? 'checked' : '' ?>> Membaca
                            <input type="checkbox" name="hobi[]" value="Olahraga" <?= in_array('Olahraga', $hobiArr) ? 'checked' : '' ?>> Olahraga
                            <input type="checkbox" name="hobi[]" value="Menulis" <?= in_array('Menulis', $hobiArr) ? 'checked' : '' ?>> Menulis
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?= $data['email'] ?>" required>
                    </div>

                    <!-- Alamat -->
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control" rows="5" required><?= $data['alamat'] ?></textarea>
                    </div>

                    <button type="submit" name="update" class="btn btn-primary">Update</button>
                </form>
            </div>

        </body>


        <?php
        break;
}

?>