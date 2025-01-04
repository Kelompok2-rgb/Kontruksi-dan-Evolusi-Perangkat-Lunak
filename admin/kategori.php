<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Kategori</h1>
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
                    <a href="index.php?p=kategori&aksi=input" class="btn btn-success btn-sm py-3">Input Data Baru</a>
                </div>

                <table class="table table-bordered border border-black" id="example">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $result = mysqli_query($db, "SELECT  * FROM kategori");
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $no . "</td>";
                            echo "<td>" . $row['nama_kategori'] . "</td>";
                            echo "<td>
                        <a href='index.php?p=kategori&aksi=edit&id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit</a>
                        <a href='proses_kategori.php?proses=delete&id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus?\")'>Delete</a>
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
                <form action="proses_kategori.php?proses=insert" method="post">

                    <div class="mb-3">
                        <label for="" class="form-label">
                            <h4 style="font-size: 18px">Nama Kategori</h4>
                        </label>
                        <input type="text" class="form-control" name="nama_kategori" autofocus required
                            style="max-width: 700px;">
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" name="reset" class="btn btn-warning">Reset</button>
                    <a href="?p=kategori" class="btn btn-success">Lihat Kategori</a>

                </form>
            </div>

        </body>
        <?php
        break;

    case 'edit':
        ?>
        <?php
        include '../koneksi.php';

        // Mendapatkan data Kategori berdasarkan ID
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $query = mysqli_query($db, "SELECT * FROM kategori WHERE id='$id'");
            $data = mysqli_fetch_assoc($query);
        }

        if (isset($_POST['update'])) {
            // Mengambil data dari form
            $id = $_POST['id'];
            $nama_kategori = $_POST['nama_kategori'];
        }
        ?>

        <body>
            <div class="container">
                <form action="proses_kategori.php?proses=update" method="post">
                    <input type="hidden" name="id" value="<?= $data['id'] ?>">
                    <div class="mb-3">
                        <label for="" class="form-label">
                            <h4 style="font-size: 18px">Nama Kategori</h4>
                        </label>
                        <input type="text" class="form-control" name="nama_kategori" value="<?= $data['nama_kategori'] ?>"
                            autofocus required style="max-width: 700px;">
                    </div>

                    <button type="submit" name="update" class="btn btn-primary">Update</button>
                </form>
            </div>
        </body>
        <?php
        break;
}
?>