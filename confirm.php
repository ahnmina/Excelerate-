<!--
	Phantom by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<?php
//need this snipet of code (up until $db) to connect to database
session_start();
$server = 'localhost';
$dbUser = 'root';
$dbPassword='password';
$dbName = 'exceleratedb2';
$cartID = $_SESSION['cart_id']; //variable to store cartID from session variable
$shopperID = $_SESSION['shopper_id']; //variable to store shopperID from session variable

$db = mysqli_connect($server,$dbUser,$dbPassword,$dbName);

$acct_id = mysqli_real_escape_string($db, $_REQUEST['acctid']); //get the accountID from checkout.php
$dateProc = (string)date("Y-m-d h:i:sa"); //get the date to add that as a value

$totalQry = "SELECT sum(item.price) as cartTotal from item, cart_has_item where item.p_id = cart_has_item.p_id and cart_has_item.c_id = $cartID group by cart_has_item.c_id"; // get the total for all items in the cart
$totalResult = mysqli_query($db, $totalQry);
$totalRow=mysqli_fetch_array($totalResult);
$cartTotal = $totalRow['cartTotal']; //sum of the purchase total
//$cartTotal = $_SESSION['cartTotal']; // session variable from checkout.php

$paymentQry = "INSERT INTO payment (amount, a_id, date_proc, s_id) VALUES ($cartTotal, $acct_id, '$dateProc', $shopperID)"; // insert into payment table
$result = mysqli_query($db, $paymentQry);

$payIDQry = "SELECT MAX(pay_id) as payid from payment WHERE s_id=$shopperID";
$result2 = mysqli_query($db, $payIDQry);
$row=mysqli_fetch_array($result2);

$payID = $row['payid'];
$_SESSION['payID'] = $payID;

$selectPayment = "SELECT * from payment WHERE pay_id=$payID";
$result3 = mysqli_query($db, $selectPayment);
if (!$result3) {
    printf("Error: %s\n", mysqli_error($db));
    exit();
}
$row=mysqli_fetch_array($result3); //to get payment id to show on the confirmation page
?>

<html>
	<head>
		<title>Confirmation</title>
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
							<p align="left">
								<a href="index.html" class="logo">
									<span class="symbol"><img src="images/logo.svg" alt="" /></span><span class="title">Excelerate</span>
								</a>
							</p>

							<!-- Nav -->
								<nav>
									<ul>
                    <li><strong>Welcome <?php echo $_SESSION['user']?></strong></a></li>
                    <li><a href="account.php"><strong>My Account</strong></a></li>
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
							<li><a href="index.html">Home</a></li>
							<li><a href="about.html">About</a></li>
							<li><a href="products.html">Products</a></li>
							<li><a href="signin.html">Sign In</a></li>
							<li><a href="register.html">Register</a></li>
						</ul>
					</nav>

				<!-- Main -->
				<center>
					<div id="main" class="wrapper style1">
					<div class="container">
						<header class="major">
							<h2>Confirmation</h2>
							<p>Success! Your order number is <?php echo "<strong>".$payID."</strong>. "?> Your order is on its way.</p>

							<?php
							//After order has been confirmed, need to add that purchase info into purchases table
								$cartItemPurchaseQry = "SELECT p_id FROM cart_has_item WHERE c_id=$cartID";
								$result = mysqli_query($db, $cartItemPurchaseQry);
								while($row=mysqli_fetch_array($result)){
									$p_idFromCart = $row['p_id'];
									$purchaseQry = "INSERT INTO purchases (s_id,c_id,p_id) VALUES ($shopperID,$cartID,$p_idFromCart)";
									$result2 = mysqli_query($db, $purchaseQry);
								}

							//set number of items to cart to 0
							$emptyCartQry = "DELETE FROM cart_has_item WHERE c_id=$cartID";
							$result2 = mysqli_query($db, $emptyCartQry);
							$_SESSION['cartTotal'] = "";
							?>
						</header>
						</center>

						<center>
						<div class="12u$">

						<ul><a href="index.php" class="button">Home</a>
						<a href="user_main.php" class="button">Back to Shopping</a></ul>
						</div>
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

	</body>
</html>
