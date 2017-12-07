<!DOCTYPE HTML>
<!--
	Phantom by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->

<!--code snippet to connect database/server-->
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
		<title>Excelerate - Stationery</title>
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
							<p align='left'>
								<a href="index.html" class="logo">
									<span class="symbol"><img src="images/logo.svg" alt="" /></span><span class="title">Excelerate</span>
								</a>
							</p>

							<!-- Nav -->
								<nav>
									<ul>
                    <!--Add the shopping cart icon-->
										<li><strong>Welcome <?php echo $_SESSION['user']?></strong></a></li>
                    <!-- <li><a href="viewCart.php"><span class="glyphicon glyphicon-shopping-cart"></span><strong>Cart</strong></a></li> -->
                    <li><a href="viewCart.php"><span class="glyphicon glyphicon-shopping-cart"></span><strong>Cart</strong><span class="badge"><?php echo $_SESSION['cartTotal'] ?></span></a></li>
                    <li><a href="index.html"><strong>Log Out</strong></a></li>
                    <li><a href="#menu">Menu</a></li>
									</ul>
								</nav>

						</div>
					</header>

				<!-- Menu -->
					<nav id="menu">
						<h2>Menu</h2>
						<ul>
							<li><a href="user_main.php">Home</a></li>
							<li><a href="about.html">About</a></li>
							<li><a href="products.html">Products</a></li>
							<li><a href="signin.html">Sign In</a></li>
							<li><a href="register.html">Register</a></li>
						</ul>
					</nav>

				<!-- Main -->
					<section id="four" class="wrapper style1 special fade-up">
					<div class="container">
						<header class="major">
							<h2>Stationery</h2>

						</header>
						<div class="box alt">
							<div class="row uniform">
								<section class="4u 6u(medium) 12u$(xsmall)">
								<a href="pens.php" <span class="image"><img src="images/pens.jpeg"  width="100" height="100" alt="Image can't be loaded. Check your connection!" /></span></a>
									<h3>Pens</h3>
									<p> $2.50 </p>
								</section>
								<section class="4u 6u(medium) 12u$(xsmall)">
								<a href="pencil.php" <span class="image"><img src="images/pencil.jpeg"  width="100" height="100" alt="Image can't be loaded. Check your connection!" /></span></a>
									<h3>Pencils</h3>
									<p> $2.00 </p>
								</section>
								<section class="4u 6u(medium) 12u$(xsmall)">
								<a href="#" <span class="image"><img src="images/eraser.jpeg"  width="100" height="100" alt="Image can't be loaded. Check your connection!" /></span></a>
									<h3>Erasers</h3>
									<p> $1.50 </p>
								</section>
								<section class="4u 6u(medium) 12u$(xsmall)">
								<a href="#" <span class="image"><img src="images/planner.jpg"  width="100" height="100" alt="Image can't be loaded. Check your connection!" /></span></a>
									<h3>2018 Planners</h3>
									<p> $10.00</p>
								</section>
								<section class="4u 6u(medium) 12u$(xsmall)">
								<a href="#" <span class="image"><img src="images/notebook.jpeg"  width="100" height="100" alt="Image can't be loaded. Check your connection!" /></span></a>
									<h3>Notebooks</h3>
									<p> $3.00 ea </p>
								</section>
								<section class="4u 6u(medium) 12u$(xsmall)">
								<a href="#" <span class="image"><img src="images/graphpaper.jpeg"  width="100" height="100" alt="Image can't be loaded. Check your connection!" /></span></a>
									<h3>Graph Paper</h3>
									<p> $0.50 </p>
								</section>

							</div>
						</div>
						<footer class="major">
						</footer>
					</div>


				</section>
							</section>

					</div>
				</div>

        <center>
        <form action="user_main.php">
          <br>
            <input type="submit" value="Back" />
        </form>
      </center>

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
