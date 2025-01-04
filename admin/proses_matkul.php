<?php

if ($_GET['proses'] == 'insert') {

    if (isset($_POST['submit'])) {
        include '../koneksi.php';

        $sql = mysqli_query($db, "INSERT INTO matkul (kode_mk,nama_mk,sks,prodi_id,semester)VALUES
            ('$_POST[kode_mk]','$_POST[nama_mk]','$_POST[sks]','$_POST[prodi]','$_POST[semester]')");
        if ($sql) {
            echo "<script> alert ('Data Sudah Di Input');window.location='index.php?p=matkul';</script>";
            //echo "<script>window.location"
        }
    }
}


if ($_GET['proses'] == 'delete') {

    include '../koneksi.php';

    if (isset($_GET['kode_mk'])) {
        $kode_mk = $_GET['kode_mk'];
        $hapus = mysqli_query($db, "DELETE FROM matkul WHERE kode_mk='$kode_mk'");

        if ($hapus) {
            echo "<script>alert('Data berhasil dihapus'); window.location='index.php?p=matkul';</script>";
        }
    }
}

if ($_GET['proses'] == 'update') {
    if (isset($_POST['update'])) {
        include '../koneksi.php';

        $sql = mysqli_query($db, "UPDATE matkul SET
   nama_mk ='$_POST[nama_mk]',
    sks ='$_POST[sks]',
   prodi_id ='$_POST[prodi]',
   semester ='$_POST[semester]' WHERE kode_mk='$_POST[kode_mk]'");

        if ($sql) {
            echo "<script>alert('Data berhasil Diedit');window.location='index.php?p=matkul'</script>";
        } else {
            die("Query error: " . mysqli_error($db));
        }
    }
}