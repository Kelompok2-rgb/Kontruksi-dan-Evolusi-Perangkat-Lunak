<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1>Berita</h1>
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
                <a href="index.php?p=berita&aksi=input" class="btn btn-success">Input Data Baru</a>
            </div>
            <table
                class="table table-bordered border border-black table-responsive  text-start align-middle table-bordered table-hover mb-0 py-2" id="example">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Level</th>
                        <th>Create_at</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $user_name = isset($_SESSION["user"]) ? $_SESSION["user"] : 'Unknown';
                    $user_email = isset($_SESSION["user_email"]) ? $_SESSION["user_email"] : 'No email';
                    $user_level = isset($_SESSION["user_level"]) ? $_SESSION["user_level"] : '';

                    // Query untuk mengambil data dari tabel user, berita, dan kategori
                    $result = mysqli_query($db, "SELECT berita.*, kategori.nama_kategori FROM user 
                                     INNER JOIN berita ON user.id = berita.user_id
                                     INNER JOIN kategori ON kategori.id = berita.kategori_id");

                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $no . "</td>";
                        echo "<td>" . $row['judul_berita'] . "</td>";
                        echo "<td>" . $row['nama_kategori'] . "</td>";
                        echo "<td>" . $user_name . "</td>";
                        echo "<td>" . $user_email . "</td>";
                        echo "<td>" . $user_level . "</td>";
                        echo "<td>" . $row['date_created'] . "</td>";
                        echo "<td>
                    <a href='index.php?p=berita&aksi=edit&id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit</a>
                    <a href='proses_berita.php?proses=delete&id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus?\")'>Delete</a>
                 </td>";
                        echo "</tr>";
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
                        <form action="proses_berita.php?proses=insert" method="post" enctype="multipart/form-data">

                            <!-- Judul -->
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Judul</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="judul_berita">
                                </div>
                            </div>

                            <!-- Kategori -->
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Kategori</label>
                                <div class="col-sm-8">
                                    <select name="kategori_id" class="form-select">
                                        <option value="">--Pilih Kategori--</option>
                                        <?php
                                        include '../koneksi.php';
                                        $ambil_kategori = mysqli_query($db, "SELECT * FROM kategori");
                                        while ($data_kategori = mysqli_fetch_assoc($ambil_kategori)) {
                                            echo "<option value='" . $data_kategori['id'] . "'>" . $data_kategori['nama_kategori'] . "</option>";
                                        }
                                        ?>

                                    </select>

                                </div>
                            </div>

                            <!-- File Upload -->
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">File Upload</label>
                                <div class="col-sm-8">
                                    <input type="file" class="form-control" name="filetoupload" id="file-upload">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-8">
                                    <img src="#" alt="Preview Uploaded Image" id="file-preview" width="200px">
                                </div>
                            </div>


                            <!-- Berita -->
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Berita</label>
                                <div class="col-sm-8">
                                    <textarea name="isi_berita" class="form-control" rows="5"></textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-8">

                                    <input type="submit" name="submit" class="btn btn-primary">
                                    <button type="reset" name="reset" class="btn btn-warning">Reset</button>
                                    <a href="?p=berita" class="btn btn-success">Lihat Berita</a>
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

        if (!isset($_GET['id']) || empty($_GET['id'])) {
            echo "ID tidak valid!";
            exit;
        }

        $id = $_GET['id'];
        $query = mysqli_query($db, "SELECT berita.*, kategori.nama_kategori 
                            FROM berita 
                            INNER JOIN kategori ON kategori.id = berita.kategori_id 
                            WHERE berita.id = '$id'");
        $data = mysqli_fetch_assoc($query);

        if (!$data) {
            echo "Data tidak ditemukan!";
            exit;
        }
        ?>

        <body>
            <div class="container">
                <div class="row">
                    <div class="col-8">
                        <form action="proses_berita.php?proses=update" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $data['id'] ?>">

                            <!-- Judul -->
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Judul</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="judul_berita"
                                        value="<?= $data['judul_berita'] ?>" required>
                                </div>
                            </div>


                            <!-- Kategori -->

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Kategori</label>
                                <div class="col-sm-8">
                                    <select name="kategori_id" class="form-select">
                                        <option value="">--Pilih Kategori--</option>
                                        <?php
                                        $ambil_kategori = mysqli_query($db, "SELECT * FROM kategori");
                                        while ($data_kategori = mysqli_fetch_assoc($ambil_kategori)) {
                                            $selected = ($data_kategori['id'] == $data['kategori_id']) ? 'selected' : '';
                                            echo "<option value='" . $data_kategori['id'] . "' $selected>" . $data_kategori['nama_kategori'] . "</option>";
                                        }
                                        ?>

                                    </select>

                                </div>
                            </div>



                            <!-- File Upload -->
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">File Upload</label>
                                <div class="col-sm-4">
                                    <!-- Tampilkan gambar jika file lama adalah gambar -->
                                    <?php if (!empty($data['file_upload'])): ?>
                                        <?php
                                        // Tentukan path file
                                        $filePath = 'images/' . $data['file_upload'];
                                        // Cek apakah file adalah gambar
                                        $isImage = preg_match('/\.(jpg|jpeg|png|gif)$/i', $data['file_upload']);
                                        ?>
                                        <?php if ($isImage): ?>
                                            <!-- Tampilkan gambar -->
                                            <p>File lama:</p>
                                            <img src="<?= $filePath ?>" alt="File Upload" style="max-width: 100%; max-height: 200px;">
                                        <?php else: ?>
                                            <!-- Tampilkan nama file jika bukan gambar -->
                                            <p>File yang diunggah: <a href="<?= $filePath ?>"
                                                    target="_blank"><?= $data['file_upload'] ?></a></p>
                                        <?php endif; ?>
                                        
                                        </div>
                                        <div class="col-sm-4">
                                            <p>file baru:</p>
                                        <img src="#" alt="Preview Uploaded Image" id="file-preview" width="200px">
                                        </div>
                                    <?php endif; ?>
                            </div>
                            <div class="row mb-3">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-8"><input type="file" class="form-control" name="filetoupload" id="file-upload">
                                        <!-- Input hidden untuk menyimpan nama file lama -->
                                        <input type="hidden" name="file_lama" value="<?= $data['file_upload'] ?>"></div>
                            </div>


                            <!-- Berita -->

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Berita</label>
                                <div class="col-sm-8">
                                    <textarea name="isi_berita" class="form-control"
                                        rows="5"><?= $data['isi_berita'] ?></textarea>
                                </div>
                            </div>


                            <button type="submit" name="update" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </body>



        <?php
        break;
}

?>

<script>
    const input = document.getElementById('file-upload');
    const previewPhoto = () => {
        const file = input.files;
        if (file) {
            const fileReader = new FileReader();
            const preview = document.getElementById('file-preview');
            fileReader.onload = function (event) {
                preview.setAttribute('src', event.target.result);
            }
            fileReader.readAsDataURL(file[0]);
        }
    }
    input.addEventListener("change", previewPhoto);
</script>