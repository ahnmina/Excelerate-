<!DOCTYPE HTML>
<!--
	Phantom by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<?php
session_start();
$server = 'localhost';
$dbUser = 'root';
$dbPassword='password';
$dbName = 'exceleratedb2';

$db = mysqli_connect($server,$dbUser,$dbPassword,$dbName);
?>
<html>
	<head>

		<title>Excelerate</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body>
		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<div class="inner">

							<!-- Logo -->
								<a href="index.php" class="logo">
									<span class="symbol"><img src="images/logo.svg" alt="" /></span><span class="title">Excelerate</span>
								</a>

							<!-- Nav -->
								<nav>
									<ul>
										<?php
											if($_SESSION['user'] == ""){
												echo '<li><a href="register.html">Create Account</a></li>';
												echo '<li><a href="signin.html">Login</a></li>';
											}else{
												echo '<li><strong>Welcome '. $_SESSION['user'] . '</strong></a></li>';
												echo '<li><a href="account.php"><strong>My Account</strong></a></li>';
												echo '<li><a href="viewCart.php"><span class="glyphicon glyphicon-shopping-cart"></span><strong>Cart</strong><span class="badge">' .$_SESSION['cartTotal'].'</span></a></li>';
												echo '<li><a href="signin.html"><strong>Log Out</strong></a></li>';
											}
										 ?>
										<!-- <li><a href="register.html">Create Account</a></li> -->
										<!-- <li><a href="signin.html">Login</a></li> -->
										<li><a href="#menu">Menu</a></li>
									</ul>
								</nav>

						</div>
					</header>

				<!-- Menu -->
					<nav id="menu">
						<h2>Menu</h2>
						<ul>
							<li><a href="index.php">Home</a></li>
							<li><a href="about.html">About</a></li>
							<li><a href="user_main.php">Products</a></li>
							<li><a href="signin.html">Sign In</a></li>
							<li><a href="register.html">Register</a></li>
						</ul>
					</nav>

				<!-- Main -->
					<div id="main">
						<div class="inner">
							<header>
								<center><h1>EXCELERATE</h1>
								<h2>Your one-stop shop for everything you need to excel in school</h2>
								<h3> Exclusive to students </h3>
								</center>
							</header>
							<section>

<!--SLIDESHOW-->
<p>

<center><p class="w3-center">Accelerate your success with Excelerate - everything you need to excel in school.</p></center>

<div class="w3-content w3-display-container">
  <a href="about.html"><img class="mySlides" src="images/about.jpg" style="width:100%" style="height:50%"></a>
  <a href="register.html"><img class="mySlides" src="images/register.jpg" style="width:100%"></a>
  <a href="products.html"><img class="mySlides" src="images/products.jpg" style="width:100%"></a>
<center>
	<br>
  <button class="w3-button" onclick="plusDivs(-1)">&#10094; Prev</button>
  <button class="w3-button" onclick="plusDivs(1)">Next &#10095;</button>
</center>
</div>

<script>
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  x[slideIndex-1].style.display = "block";
}
</script>
</br>
</br>

<!--CATEGORIES-->
									<hr> </hr>
									<h1> OUR PRODUCTS </h1>
									<hr> </hr>
							<section class="tiles">
								<article class="style1">
									<span class="image">
										<img src="images/stationery.jpg" alt="" width="200" height="275" />
									</span>
									<a href="stationery.html">
										<h2>Stationery</h2>
										<div class="content">
											<p>Pens, pencils, markers, highlighers</p>
										</div>
									</a>
								</article>
								<article class="style2">
									<span class="image">
										<img src="images/textbook.jpg" alt="" width="200" height="275" />
									</span>
									<a href="textbook.html">
										<h2>Textbooks</h2>
										<div class="content">
											<p>Search through our large database of required readings</p>
										</div>
									</a>
								</article>
								<article class="style3">
									<span class="image">
										<img src="images/laptop.jpg" alt="" width="200" height="275" />
									</span>
									<a href="electronics.html">
										<h2>Electronics</h2>
										<div class="content">
											<p>All of your technology needs in one spot</p>
										</div>
									</a>
								</article>
								<article class="style4">
									<span class="image">
										<img src="images/dorm.jpg" alt="" width="200" height="275" />
									</span>
									<a href="dorm.html">
										<h2>Dorm Supplies</h2>
										<div class="content">
											<p>Create your home away from home</p>
										</div>
									</a>
								</article>
								<article class="style5">
									<span class="image">
										<img src="images/uva_gear.jpg" alt="" width="200" height="275" />
									</span>
									<a href="schoolgear.html">
										<h2>School Gear</h2>
										<div class="content">
											<p>Pump up your school spirit and sport some school gear</p>
										</div>
									</a>
								</article>
								<article class="style6">
									<span class="image">
										<img src="images/pic06.jpg" alt="" width="200" height="275" />
									</span>
									<a href="generic.html">
										<h2>Miscellaneous</h2>
										<div class="content">
											<p>Can't find what you need? It's probably here!</p>
										</div>
									</a>
								</article>

							</section>
						</div>
					</div>

				<!-- Footer -->
					<footer id="footer">
						<div class="inner">
							<section>
								<h2>Get in touch</h2>
								<form method="post" action="#">
									<div class="field half first">
										<input type="text" name="name" id="name" placeholder="Name" />
									</div>
									<div class="field half">
										<input type="email" name="email" id="email" placeholder="Email" />
									</div>
									<div class="field">
										<textarea name="message" id="message" placeholder="Message"></textarea>
									</div>
									<ul class="actions">
										<li><input type="submit" value="Send" class="special" /></li>
									</ul>
								</form>
							</section>
							<section>
								<h2>Follow</h2>
								<ul class="icons">
									<li><a href="#" class="icon style2 fa-twitter"><span class="label">Twitter</span></a></li>
									<li><a href="#" class="icon style2 fa-facebook"><span class="label">Facebook</span></a></li>
									<li><a href="#" class="icon style2 fa-instagram"><span class="label">Instagram</span></a></li>
									<li><a href="#" class="icon style2 fa-dribbble"><span class="label">Dribbble</span></a></li>
									<li><a href="#" class="icon style2 fa-github"><span class="label">GitHub</span></a></li>
									<li><a href="#" class="icon style2 fa-500px"><span class="label">500px</span></a></li>
									<li><a href="#" class="icon style2 fa-phone"><span class="label">Phone</span></a></li>
									<li><a href="#" class="icon style2 fa-envelope-o"><span class="label">Email</span></a></li>
								</ul>
							</section>
							<ul class="copyright">
								<li>&copy; Untitled. All rights reserved</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
							</ul>
						</div>
					</footer>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

			<!--Code that implements Bootstrap-->
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	</body>
</html>
