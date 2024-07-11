<?php

require ('config/Database.php');
require ('helpers/PreventInjectionSQL.php');

session_start();

if(!isset($_SESSION['username'])) {
  header('Location:index.php');
}

$connect = openConnection();

// bulan penjualan
$bulan = preventInjection($_POST['bulan']);
// nama idol
$name = preventInjection($_POST['nama']);
// nama album
$name = preventInjection($_POST['nama']);
// versi album
$versi = preventInjection($_POST['versi']);
// jumlah penjualan
$jumlah = preventInjection($_POST['jumlah']);

if(mysqli_query($connect, "UPDATE album SET bulan_penjualan = '$bulan', nama_idol = '$nama', nama_album = '$nama', versi_album = '$versi', jumlah_penjualan = '$jumlah' WHERE id ='$id'")) {
  header("Location:create-album.php");
} else {
  header("Location:create-album.php?notify=error");
}

