<?php

if ($_GET['proses'] == 'insert') {

    if (isset($_POST['submit'])) {
        include '../koneksi.php';

        $sql = mysqli_query($db, "INSERT INTO prodi (nama_prodi,jenjang_studi,keterangan)VALUES
        ('$_POST[nama_prodi]','$_POST[jenjang_studi]','$_POST[keterangan]')");
        if ($sql) {
            echo "<script> alert ('Alah ta input');window.location='index.php?p=prodi';</script>";
        }
    }
}

if ($_GET['proses'] == 'delete') {

    include '../koneksi.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $hapus = mysqli_query($db, "DELETE FROM prodi WHERE id='$id'");

        if ($hapus) {
            echo "<script>alert('Data berhasil dihapus'); window.location='index.php?p=prodi';</script>";
        }
    }
}


if ($_GET["proses"] == 'update') {

    include '../koneksi.php';

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $nama_prodi = $_POST['nama_prodi'];
        $jenjang_studi = $_POST['jenjang_studi'];
        $keterangan = $_POST['keterangan'];

        $sql = mysqli_query($db, "UPDATE prodi SET 
        nama_prodi='$nama_prodi', 
        jenjang_studi='$jenjang_studi', 
        keterangan='$keterangan'
        WHERE id='$id'");

        if ($sql) {
            echo "<script>alert('Data berhasil diupdate'); window.location='index.php?p=prodi';</script>";
        } else {
            echo "Error: " . mysqli_error($db);
        }
    }

}

