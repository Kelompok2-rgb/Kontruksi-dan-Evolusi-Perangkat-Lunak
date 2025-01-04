
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1>User</h1>
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
                <a href="index.php?p=tambah_user&aksi=input" class="btn btn-success">Tambah User</a>
            </div>
            <table class="table table-bordered border border-black" id="example">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Level</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    // Query untuk mengambil data dari tabel user, berita, dan kategori
                    $result = mysqli_query($db, "SELECT * FROM user");

                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $no . "</td>";
                        echo "<td>" . $row['full_name'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['level'] . "</td>";
                        echo "<td>
                    <a href='index.php?p=tambah_user&aksi=edit&id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit</a>
                    <a href='proses_user.php?proses=delete&id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus?\")'>Delete</a>
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
                        <form action="proses_user.php?proses=insert" method="post">

                            <!-- Nama -->
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="full_name">
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control" name="email">
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>

                            <!-- Level -->
                            <div class="row mb-3">
                                <label for="level" class="col-sm-3 col-form-label">Level</label>
                                <div class="col-sm-8">
                                    <select class="form-select" id="level" name="level">
                                        <option value="" disabled selected>-Pilih Level</option>
                                        <option value="admin">Admin</option>
                                        <option value="developer">Developer</option>
                                        <option value="poweruser">Power User</option>
                                        <option value="enduser">End User</option>
                                        <option value="guest">Guest</option>
                                    </select>
                                </div>




                            </div>



                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-8">

                                    <input type="submit" name="submit" class="btn btn-primary">
                                    <button type="reset" name="reset" class="btn btn-warning">Reset</button>
                                    <a href="?p=tambah_user" class="btn btn-success">Lihat User</a>
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
        $query = mysqli_query($db, "SELECT * FROM user WHERE id=$id");
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
                        <form action="proses_user.php?proses=update" method="post">
                            <input type="hidden" name="id" value="<?= $data['id'] ?>">

                            <!-- Judul -->
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="full_name" value="<?= $data['full_name'] ?>"
                                        required>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control" name="email" value="<?= $data['email'] ?>"
                                        required>
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" name="password" value="<?= $data['password'] ?>"
                                        required>
                                </div>
                            </div>

                            <!-- Level -->
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Level</label>
                                <div class="col-sm-8">
                                    <select class="form-select" id="level" name="level">
                                        <option value="" disabled selected>-Pilih Level</option>

                                        <option value="admin" <?= $data['level'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                                        <option value="developer" <?= $data['level'] == 'developer' ? 'selected' : '' ?>>Developer
                                        </option>
                                        <option value="poweruser" <?= $data['level'] == 'poweruser' ? 'selected' : '' ?>>Power User
                                        </option>
                                        <option value="enduser" <?= $data['level'] == 'enduser' ? 'selected' : '' ?>>End User</option>
                                        <option value="guest" <?= $data['level'] == 'guest' ? 'selected' : '' ?>>Guest</option>
                                    </select>
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