<?php

if ($_GET['proses'] == 'insert') {

    if (isset($_POST['submit'])) {
        include '../koneksi.php';
        
        $pass=md5($_POST['password']);
        $sql = mysqli_query($db, "INSERT INTO user (full_name,email,password,level)VALUES
        ('$_POST[full_name]','$_POST[email]','$pass','$_POST[level]')");
        if ($sql) {
            echo "<script> alert ('Alah ta input');window.location='index.php?p=tambah_user';</script>";
        }
    }
}

if ($_GET['proses'] == 'delete') {

    include '../koneksi.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $hapus = mysqli_query($db, "DELETE FROM user WHERE id='$id'");

        if ($hapus) {
            echo "<script>alert('Data berhasil dihapus'); window.location='index.php?p=tambah_user';</script>";
        }
    }
}


if ($_GET["proses"] == 'update') {

    include '../koneksi.php';

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $email = $_POST['email'];
        $pass=md5($_POST['password']);
        $level = $_POST['level'];

        $sql = mysqli_query($db, "UPDATE user SET 
        full_name='$full_name', 
        email='$email', 
        password='$pass',
        level='$level'
        WHERE id='$id'");

        if ($sql) {
            echo "<script>alert('Data berhasil diupdate'); window.location='index.php?p=tambah_user';</script>";
        } else {
            echo "Error: " . mysqli_error($db);
        }
    }

}

