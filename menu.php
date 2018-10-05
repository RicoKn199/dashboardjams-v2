<html dir="ltr" lang="en">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
 <!--custom css  -->
<link rel="stylesheet" href="css/menu.css">
<!-- link boostrap -->


<!-- navbar -->
<body>

<div class="">
  <div class="col-sm-12">
  <nav class="navbar navbar-inverse" style="margin-top:1rem;">
  <div class="">
  <ul class="nav navbar-nav">
    <li><a href="index.php">PT. ANTARI JAYA MANDIRI</a></li>
    <li style="margin-left:90.9rem;"><a href="keranjang.php">Keranjang</a></li>

    <li><a href="about.html">About Us</a></li>
    <!--  -->
    <?php if (isset($_SESSION["pelanggan"])): ?>
      <li><a href="logout.php">Logout</a></li>
    <?php else: ?>
      <li><a href="login.php">Login</a></li>
      <li><a href="daftar.php">Daftar</a></li>
    <?php endif; ?>
    <!--  -->

    <li><a href="checkout.php">Checkout&nbsp;&nbsp;&nbsp;<i class="fas fa-shopping-cart"></i></a></li>
    
  </ul>
</div>
</nav>
  </div>
</div>


<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>

