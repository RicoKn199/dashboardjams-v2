<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION["pelanggan"]))
{
  echo "<script>alert('silahkan login');</script>";
  echo "<script>location='login.php';</script>";
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Checkout</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
  </head>
  <body>
    <?php include 'menu.php'; ?>

    <section class="konten">
      <div class="container">
        <h1>Keranjang Belanja</h1><hr>
        <table class="table table-bordered">
           <thead>
             <tr>
               <th>No</th>
               <th>Nama</th>
               <th>Harga</th>
               <th>Jumlah</th>
               <th>Subharga</th>

             </tr>
           </thead>
           <tbody>
             <?php $nomor=1; ?>
             <?php $totalbelanja = 0; ?>
            <?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
              <?php
                 $ambil = $koneksi->query("SELECT * FROM produk");
                 $pecah = $ambil->fetch_assoc();
                 $subharga = $pecah["harga_produk"]*$jumlah;
               ?>

             <tr>
               <td><?php echo $nomor; ?></td>
               <td><?php echo $pecah["nama_produk"]; ?></td>
               <td>Rp. <?php echo number_format($pecah["harga_produk"]); ?></td>
               <td><?php echo $jumlah; ?></td>
               <td>Rp. <?php echo number_format($subharga); ?></td>
             </tr>
             <?php $nomor++; ?>
             <?php $totalbelanja+=$subharga; ?>
           <?php endforeach; ?>
           </tbody>
           <tfoot>
             <tr>
               <th colspan="4">Total</th>
               <th>Rp. <?php echo number_format($totalbelanja) ?></th>
             </tr>
           </tfoot>

        </table>
         <form method="post">
           <div class="row">
             <div class="col-sm-4">
               <div class="form-group">
                 <input type="text" readonly value="<?php echo  $_SESSION['pelanggan']
                 ['nama_pelanggan']; ?>" class="form-control">
               </div>
             </div>
             <div class="col-sm-4">
               <div class="form-group">
                 <input type="text" readonly value="<?php echo  $_SESSION['pelanggan']
                 ['telepon_pelanggan']; ?>" class="form-control">
               </div>
             </div>
             <div class="col-sm-4">
               <div class="form-group">
                 <input type="text" value="Masukkan alamat" class="form-control">
               </div>
             </div>
             <div class="col-sm-4">
               <select class="form-control" name="id_ongkir">
                 <option value="">Pilih Kurir</option>
                  <?php
                  $ambil = $koneksi->query("SELECT * FROM kurir");
                  while($perkurir = $ambil->fetch_assoc()){
                  ?>
                 <option value="<?php echo $perkurir["id_kurir"] ?>">
                   <?php echo $perkurir['nama'] ?>
                  Rp. <?php echo number_format($perkurir['tarif']) ?>
                 </option>
               <?php } ?>
               </select>
             </div>
           </div>
           <button class="btn btn-primary" name="checkout">Checkout</button>
         </form>
         <?php
         if (isset($_POST["checkout"]))
         {
            $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
            $id_kurir = $_POST["id_kurir"];
            $tanggal_pembelian = date("y-m-d");

            $ambil = $koneksi->query("SELECT * FROM kurir WHERE id_kurir='$id_kurir'");
            $arraykurir = $ambil->fetch_assoc();
            $tarif = $arraykurir['tarif'];

            $total_pembelian = $totalbelanja + $tarif;
            // menyimpan data pembelian
            $koneksi->query("INSERT INTO pembelian (id_pelanggan,id_kurir,tanggal_pembelian,total_pembelian)
                              VALUES ('$id_pelanggan','$id_kurir','$tanggal_pembelian','$total_pembelian')");
            //mendapatkan id_pembelian yang barusan terjadi
            $id_pembelian_barusan = $koneksi->insert_id;

            foreach ($_SESSION["keranjang"] as $id_produk => $jumlah)
            {
              $koneksi->query("INSERT INTO pembelian_produk (id_pelanggan,id_produk,jumlah) VALUES ('$id_pembelian','$id_produk','$jumlah') ");
            }
            // mengosongkan Keranjang
            unset($_SESSION["keranjang"]);
            echo "<script>location='nota.php?id=$id_pembelian_barusan'</script>";
         }
         ?>

      </div>
    </section>


  </body>
</html>
