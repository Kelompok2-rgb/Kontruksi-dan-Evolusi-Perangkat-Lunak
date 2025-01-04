<?php

session_start();

$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["filetoupload"]["name"]);
$nama_file = $_FILES["filetoupload"]["name"];
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if ($_GET['proses'] == 'insert') {
    include '../koneksi.php';
   
    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["filetoupload"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["filetoupload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["filetoupload"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["filetoupload"]["name"])) . " has been uploaded.";
            $sql = mysqli_query($db, "INSERT INTO berita (user_id,kategori_id,judul_berita,file_upload,isi_berita)VALUES
        ('$_SESSION[user_id]','$_POST[kategori_id]','$_POST[judul_berita]','$nama_file','$_POST[isi_berita]')");
            if ($sql) {
                echo "<script> alert ('Data berhasil diinput');window.location='index.php?p=berita';</script>";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }

        }
    }

}



if ($_GET['proses'] == 'delete') {

    include '../koneksi.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $hapus = mysqli_query($db, "SELECT * FROM berita WHERE id='$id'");
        $hps_gambar = $hapus->fetch_assoc();
        $file_upload = $hps_gambar['file_upload'];
        if (file_exists("images/$file_upload")) {
            unlink("images/$file_upload");
        }

        $hapus = mysqli_query($db, "DELETE FROM berita WHERE id='$id'");

        if ($hapus) {
            echo "<script>alert('Data berhasil dihapus'); window.location='index.php?p=berita';</script>";
        }
    }



}

if ($_GET['proses'] == 'update') {
    if (isset($_POST['update'])) {
        include '../koneksi.php';

        $id = $_POST['id'];
        $judul_berita = $_POST['judul_berita'];
        $kategori_id = $_POST['kategori_id'];
        $isi_berita = $_POST['isi_berita'];
        $file_lama = $_POST['file_lama'];

        $file_name = $file_lama;


        if (!empty($_FILES['filetoupload']['name'])) {
            $file_name = basename($_FILES['filetoupload']['name']);
            $file_tmp = $_FILES['filetoupload']['tmp_name'];
            $file_destination = 'images/' . $file_name;

            if (file_exists("images/$file_lama")) {
                unlink("images/$file_lama");
            }

            if (!move_uploaded_file($file_tmp, $file_destination)) {
                die("<script>alert('Gagal mengunggah file baru.');window.location='index.php?p=berita';</script>");
            }
        }


        // Update data di database
        $ubah = mysqli_query($db, "UPDATE berita SET
            judul_berita = '$judul_berita',
            kategori_id = '$kategori_id',
            isi_berita = '$isi_berita',
            file_upload = '$file_name'
          WHERE id = '$id'");

        if ($ubah) {
            echo "<script>alert('Data berhasil diedit');window.location='index.php?p=berita'</script>";
        } else {
            die("Query error: " . mysqli_error($db));
        }
    }
}


