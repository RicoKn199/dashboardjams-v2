<?php
session_start();
//koneksi ke database
$koneksi = new mysqli("localhost","root","","trainittoko");
?>
<!DOCTYPE html>
<html>
  <head>
    <title>PT ANTARI JAYA MANDIRI</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <link rel="stylesheet" href="css/modal.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  </head>
  <body style="text-align:center;">

  

<!-- konten -->
<section class="konten">
  <!-- <div class="container">
    <div class="sol-sm-10">
      <img src="img/LOGO.png" alt="" style="width:1112px;height:5rem;margin-left:1rem;">
    </div>
  </div> -->
  <?php include 'menu.php'; ?>
  <div class="">
    <div class="col-sm-12">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="img/slider1.jpeg" alt="..." style="margin-left:7.5rem;">
      <div class="carousel-caption">
      	<h3>Business Information</h3>
      </div>
    </div>
    <div class="item">
      <img src="img/slider2.jpeg" alt="..." style="margin-left:7.5rem;">
      <div class="carousel-caption">
      	<h3>Business Retail</h3>
      </div>
    </div>
    <div class="item">
      <img src="img/slider3.jpeg" alt="..." style="margin-left:7.5rem;">
      <div class="carousel-caption">
      	<h3>Business Analityc</h3>
      </div>
    </div>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="fas fa-angle-left"></span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="fas fa-angle-right"></span>
  </a>
</div> <!-- Carousel -->
    </div>
  </div>
  <div class="">
    <div class="col-sm-12">
    <h1 style="padding-bottom:3rem;">Produk</h1>
  
<div class="rows">
  <?php $ambil = $koneksi->query("SELECT * FROM produk"); ?>
  <?php while($perproduk = $ambil->fetch_assoc()) { ?>

  <div class="col-sm-3">
    <div class="thumbnail">
      <img src="foto_produk/<?php echo $perproduk['foto_produk']; ?>" alt="" id="myImg" class="img-responsive">
      <div class="caption">
        <h3><?php echo $perproduk['nama_produk']; ?></h3>
        <h5>Rp. <?php echo number_format($perproduk['harga_produk']); ?></h5>
        <a href="beli.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-primary">Beli</a>
        <a href="detail.php?id=<?php echo $perproduk["id_produk"]; ?>" class="btn btn-default">Detail</a>
      </div>
    </div>
  </div>
<?php }  ?>
<div id="myModal" class="modal">
  <span class="close">&times;</span>
  <img class="modal-content" id="img01">
  <img class="modal-content" id="img01">
  <div id="caption"></div>
</div>
</div>

    </div>
</div>
</section>
<?php include 'footer.php'; ?>


<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById('myImg');
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
    modal.style.display = "none";
}
</script>


  </body>
</html>
