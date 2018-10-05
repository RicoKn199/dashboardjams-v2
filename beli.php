<?php
session_start();
//koneksi ke database
include 'koneksi.php';
// take id_produk
$id_produk = $_GET['id'];

// jika sudah di kranjang maka produk +1
if (isset($_SESSION['keranjang'][$id_produk]))
{
 $_SESSION['keranjang'][$id_produk]+=1;
}
// jika belom di keranjang, mka di anggap sudah membeli 1
else
{
    $_SESSION['keranjang'][$id_produk] = 1;
}

// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";

// move to halaman keranjang
echo "<script>alert('produk telah masuk ke keranjang');</script>";
echo "<script>location='keranjang.php';</script>";
?>
