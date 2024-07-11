<?php

require ('config/Database.php');
require ('helpers/PreventInjectionSQL.php');

session_start();

if(!isset($_SESSION['username'])) {
  header('Location:index.php');
}

$connect = openConnection();

$id = preventInjection($_POST['idData']);
// bulan penjualan
$bulan = preventInjection($_POST['bulan']);
// nama idol
$idol = preventInjection($_POST['idol']);
// nama album
$album = preventInjection($_POST['album']);
// versi album
$versi = preventInjection($_POST['versi']);
// jumlah penjualan
$jumlah = preventInjection($_POST['jumlah']);

if(mysqli_query($connect, "UPDATE album SET bulan_penjualan = '$bulan', nama_idol = '$idol', nama_album = '$album', versi_album = '$versi', jumlah_penjualan = '$jumlah' WHERE id ='$id'")) {
  header("Location:create-album.php");
} else {
  header("Location:create-album.php?notify=error");
}

// mysqli_query($connect, "UPDATE pmb INNER JOIN pmb_fakultas ON pmb.tahun_penerimaan = pmb_fakultas.tahun_penerimaan
// SET pmb.jumlah_pendaftar = (pmb.jumlah_pendaftar - pmb_fakultas.jumlah_pendaftar) WHERE pmb_fakultas.id ='$id'");


// $check = mysqli_query($connect,"SELECT * FROM pmb_fakultas WHERE tahun_penerimaan ='$tahun' and fakultas ='$fakultas'");
// $check2 = mysqli_query($connect,"SELECT * FROM pmb_fakultas WHERE id ='$id'");

// while($obj = mysqli_fetch_object($check2)){

//   if($fakultas == $obj->fakultas) {
//     mysqli_query($connect, "UPDATE pmb_fakultas SET tahun_penerimaan ='$tahun', fakultas = '$fakultas', jumlah_pendaftar = '$jumlah' WHERE id = '$id'");  
//     mysqli_query($connect, "UPDATE pmb INNER JOIN pmb_fakultas ON pmb.tahun_penerimaan = pmb_fakultas.tahun_penerimaan SET pmb.jumlah_pendaftar = (pmb.jumlah_pendaftar + pmb_fakultas.jumlah_pendaftar) WHERE pmb_fakultas.id ='$id'");

//     header("Location:create-pmb.php");
//   } else {
//     if(mysqli_num_rows($check) > 0){ 
//       while($obj1 = mysqli_fetch_object($check)){
//         if($fakultas == $obj1->fakultas) {
//           header("Location:create-pmb.php?notify=error");
//         } else {
//           mysqli_query($connect, "UPDATE pmb_fakultas SET tahun_penerimaan ='$tahun', fakultas = '$fakultas', jumlah_pendaftar = '$jumlah' WHERE id = '$id'");  
//           mysqli_query($connect, "UPDATE pmb INNER JOIN pmb_fakultas ON pmb.tahun_penerimaan = pmb_fakultas.tahun_penerimaan SET pmb.jumlah_pendaftar = (pmb.jumlah_pendaftar + pmb_fakultas.jumlah_pendaftar) WHERE pmb_fakultas.id ='$id'");

//           header("Location:create-pmb.php");
//         }
//       }
//     } else {
//       mysqli_query($connect, "UPDATE pmb_fakultas SET tahun_penerimaan ='$tahun', fakultas = '$fakultas', jumlah_pendaftar = '$jumlah' WHERE id = '$id'");  
//       mysqli_query($connect, "UPDATE pmb INNER JOIN pmb_fakultas ON pmb.tahun_penerimaan = pmb_fakultas.tahun_penerimaan SET pmb.jumlah_pendaftar = (pmb.jumlah_pendaftar + pmb_fakultas.jumlah_pendaftar) WHERE pmb_fakultas.id ='$id'");
//       header("Location:create-pmb.php");
//     }
//   }
// }

?>