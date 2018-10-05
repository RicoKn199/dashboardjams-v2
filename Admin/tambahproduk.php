<h2>Tambah Produk</h2>

<form method="post" enctype="multipart/form-data">
  <div class="form-group">
      <label>nama</label>
      <input type="text" class="form-control" name="nama">
    </div>
    <div class="form-group">
        <label>harga (Rp)<label>
        <input type="number" class="form-control" name="harga">
      </div>
      <div class="form-group">
          <label>jumlah <label>
          <input type="number" class="form-control" name="jumlah">
        </div>
        <div class="form-group">
            <label>foto <label>
            <input type="file" class="form-control" name="foto">
          </div>
          <div class="form-group">
              <label>deskripsi <label>
              <textarea class="form-control" name="deskripsi" rows="10"></textarea>
            </div>
            <button class="bt btn-primary" name="save">simpan</button>
  </form>
  <?php
  if(isset($_POST['save']))
  {
    $nama =$_FILES['foto']['name'];
    $lokasi=$_FILES['foto']['tmp_name'];
    move_uploaded_file($lokasi, "../foto_produk/".$nama);
    $koneksi->query("INSERT INTO produk
          (nama_produk,harga_produk,jumlah,foto_produk,deskripsi_produk)
          VALUES('$_POST[nama]','$_POST[harga]','$_POST[jumlah]','$nama','$_POST[deskripsi]')");

        echo "  <div class='alert alert-info'>Data Tersimpan</div>";
        echo "<meta http-equiv='refresh' content='l;url=index.php?halaman=produk'>";

  }
  ?>
