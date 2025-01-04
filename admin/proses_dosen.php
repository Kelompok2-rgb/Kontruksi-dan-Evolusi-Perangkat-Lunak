<?php

if($_GET['proses']=='insert'){
    

    if (isset($_POST['submit'])) {
        include '../koneksi.php';
        
        $sql = mysqli_query($db, "INSERT INTO dosen (nip,nama_dosen,email,prodi_id,notelp,alamat)VALUES
            ('$_POST[nip]','$_POST[nama_dosen]','$_POST[email]','$_POST[prodi]','$_POST[notelp]','$_POST[alamat]')");
        if ($sql) {
            echo "<script> alert ('Alah ta input');window.location='index.php?p=dosen';</script>";
            //echo "<script>window.location"
        }

    }

    

}

if($_GET['proses']=='delete'){
    
    include '../koneksi.php';
    
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $hapus = mysqli_query($db, "DELETE FROM dosen WHERE id='$id'");
    
        if ($hapus) {
            echo "<script>alert('Data berhasil dihapus'); window.location='index.php?p=dosen';</script>";
        }
    }
    
    

}

if($_GET['proses']=='update'){
    if(isset($_POST['update'])){
    include'../koneksi.php';

   $sql= mysqli_query($db,"UPDATE dosen SET
   nip ='$_POST[nip]',
   nama_dosen ='$_POST[nama_dosen]',
   email ='$_POST[email]',
   prodi_id ='$_POST[prodi]',
   notelp ='$_POST[notelp]',
   alamat ='$_POST[alamat]' WHERE id='$_POST[id]'");
    
   if($sql){
    echo "<script>alert('Data berhasil Diedit');window.location='index.php?p=dosen'</script>";
        }
    else{
    die("Query error: " . mysqli_error($db));
        }
    }
}

