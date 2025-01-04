<?php

if($_GET['proses']=='insert'){
    

    if (isset($_POST['submit'])) {
        include '../koneksi.php';
        $tgl = $_POST['thn'] . '-' . $_POST['bln'] . '-' . $_POST['tgl'];
        $hobies = implode(',', $_POST['hobi']);

        $sql = mysqli_query($db, "INSERT INTO mahasiswa (nim,nama,tgl_lahir,jekel,prodi_id,hobi,email,alamat)VALUES
            ('$_POST[nim]','$_POST[nama]','$tgl','$_POST[jk]','$_POST[prodi]','$hobies','$_POST[email]','$_POST[alamat]')");
        if ($sql) {
            echo "<script> alert ('Alah ta input');window.location='index.php?p=mhs';</script>";
            //echo "<script>window.location"
        }

    }

    

}

if($_GET['proses']=='delete'){
    
    include '../koneksi.php';
    
    if (isset($_GET['nim'])) {
        $nim = $_GET['nim'];
        $hapus = mysqli_query($db, "DELETE FROM mahasiswa WHERE nim='$nim'");
    
        if ($hapus) {
            echo "<script>alert('Data berhasil dihapus'); window.location='index.php?p=mhs';</script>";
        }
    }
    
    

}

if($_GET['proses']=='update'){
    if(isset($_POST['update'])){
    include'../koneksi.php';
   $tgl=$_POST['thn']. '-'. $_POST['bln']. '-'. $_POST['tgl'];
   $hobies=implode(',', $_POST['hobi']);

   $sql= mysqli_query($db,"UPDATE mahasiswa SET
   nama ='$_POST[nama]',
   tgl_lahir ='$tgl',
   jekel ='$_POST[jk]',
   prodi_id ='$_POST[prodi]',
   hobi ='$hobies',
   email ='$_POST[email]',
   alamat ='$_POST[alamat]' WHERE nim='$_POST[nim]'");
    
   if($sql){
    echo "<script>alert('Data berhasil Diedit');window.location='index.php?p=mhs'</script>";
        }
    else{
    die("Query error: " . mysqli_error($db));
        }
    }
}

