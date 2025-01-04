<?php

if($_GET['proses']=='insert'){
    

    if (isset($_POST['submit'])) {
        include '../koneksi.php';
        
        $sql = mysqli_query($db, "INSERT INTO kategori (nama_kategori)VALUES
            ('$_POST[nama_kategori]')");
        if ($sql) {
            echo "<script> alert ('Alah ta input');window.location='index.php?p=kategori';</script>";
            //echo "<script>window.location"
        }

    }

    

}

if($_GET['proses']=='delete'){
    
    include '../koneksi.php';
    
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $hapus = mysqli_query($db, "DELETE FROM kategori WHERE id='$id'");
    
        if ($hapus) {
            echo "<script>alert('Data berhasil dihapus'); window.location='index.php?p=kategori';</script>";
        }
    }
    
    

}

if($_GET['proses']=='update'){
    if(isset($_POST['update'])){
    include'../koneksi.php';

   $sql= mysqli_query($db,"UPDATE kategori SET
   nama_kategori ='$_POST[nama_kategori]'");
    
   if($sql){
    echo "<script>alert('Data berhasil Diedit');window.location='index.php?p=kategori'</script>";
        }
    else{
    die("Query error: " . mysqli_error($db));
        }
    }
}

