<?php
session_start();
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <title>Konfirmasi Pembayaran</title>
  </head>
  <body>

    <?php include 'menu.php'; ?>
    <section class="konten">
      <div class="container">
        <h2>Detail Pembelian</h2>

        <?php
        $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan
                        ON pembelian.id_pelanggan=pelanggan.id_pelanggan
                        WHERE pembelian.id_pembelian='$_GET[id]'");
        $detail = $ambil->fetch_assoc();
        ?>
        <!-- <pre><?php print_r($detail); ?></pre -->

         <strong><?php echo $detail['id_pelanggan']; ?> </strong> <br>
         <p>
           <?php echo $detail['telepon_pelanggan']; ?> <br>
           <?php echo $detail['email_pelanggan']; ?> <br>
           <?php echo $detail['nama_pelanggan']; ?>
         </p>
         <p>
           Tanggal : <?php echo $detail['tanggal_pembelian']; ?> <br>
           Total : <?php echo $detail['total_pembelian']; ?>
         </p>

         <table class="table table-bordered">
           <thead>
             <tr>
               <th>No</th>
               <th>Nama produk</th>
               <th>Harga</th>
               <th>Jumlah</th>
               <th>Subtotal</th>
             </tr>
           </thead>
           <tbody>
             <?php $nomor=1; ?>
             <?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk JOIN produk ON
                                    pembelian_produk.id_produk=produk.id_produk
                                    WHERE pembelian_produk.id_pembelian='$_GET[id]'"); ?>
            <?php while ($pecah=$ambil->fetch_assoc()) { ?>
             <tr>
               <td><?php echo $nomor; ?></td>
               <td><?php echo $pecah['nama_produk']; ?></td>
               <td><?php echo $pecah['harga_produk']; ?></td>
               <td><?php echo $pecah['jumlah']; ?></td>
               <td>
                 <?php echo $pecah['harga_produk']*$pecah['jumlah']; ?>
               </td>
             </tr>
             <?php $nomor++; ?>
           <?php } ?>
           </tbody>


         <div class="row">
           <div class="col-md-7">
             <div class="alert alert-info">
               <p>Silahkan melakukan pembyaran Rp. <?php echo
               number_format($detail['total_pembelian']); ?></p> ke <br>
               <strong>BANK MANDIRI 123-440990-1123 AN. TIGABERSAUDARA</strong>
             </div>
           </div>
         </div>

      </div>
    </section>


  </body>
</html>
