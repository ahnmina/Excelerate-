<!--Need to have this php code at the beginning in order to keep track of session and to maintain connection with server/database-->
<?php
session_start();
$server = 'localhost';
$dbUser = 'root';
$dbPassword='password';
$dbName = 'exceleratedb2';

$db = mysqli_connect($server,$dbUser,$dbPassword,$dbName);
$query = "SELECT * FROM item WHERE display_name = 'HP Laptop'";
$result = mysqli_query($db, $query);

updateCartTotal($db); //update the number of items in the cart

if(isset($_GET['p_id'])){
  addToCart($_GET['p_id'], $db);
}

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
            <h1><center>Electronics</center></h1>

            <!--Main-->
            <center>
              <div id="main" class="wrapper style1">
                <div class="container">
                  <header class="major">
                    <h2>Product Details</h2>
                    <!--Display the content (display item picture using the query defined at top of page)-->
                    <section id="content">
            <?php

                while($row=mysqli_fetch_array($result)){
                  $source= '<img src="data:images/jpeg;base64,'.base64_encode( $row['picture'] ).'" height="150" width="150"/>';
                  echo $source;
                  //echo '<a href="lamp.php?p_id='.$row['p_id'].'" class="btn btn-primary">Add to Cart</a>';
                  echo '<a href="hpLaptop.php?p_id='.$row['p_id'].'"></a>';
                  echo '<br>';
                  echo '<br>';
                  echo '<h3 align="center">'.$row['display_name'].'</h3>';
                  echo '<br>';
                  echo '<p align="center"> Price:'.$row['price'];
                  echo '<br>';
                  echo '<br>';
                  echo '<a href="hpLaptop.php?p_id='.$row['p_id'].'" class="btn btn-primary">Add to Cart</a>';
                  echo '<br>';
                }
            ?>
          </section>
      </div>
    </div>
    </center>

    <center>
    <form action="electronics.php">
        <input type="submit" value="Back" />
    </form>
  </center>
          <?php
          //add to cart function
          function addToCart($productID,$db){
            $cartID = $_SESSION['cart_id'];
            $checkPidInCart = "SELECT * from `cart_has_item` where c_id = $cartID and p_id = $productID";
            $productCnt = mysqli_query($db, $checkPidInCart);
            if (mysqli_num_rows($productCnt) > 0) {
              $incrementQuantity = "UPDATE `cart_has_item` set quantity = quantity+1 where c_id = $cartID and p_id = $productID";
              mysqli_query($db, $incrementQuantity);
            } else {
              $cartInsertQuery = "INSERT INTO `cart_has_item` (`p_id`, `c_id`, `quantity`)
                                    VALUES ('$productID','$cartID',1)";
              $result = mysqli_query($db, $cartInsertQuery);
            }
            updateCartTotal($db);
          }

          function updateCartTotal($db) {
            $cartID = $_SESSION['cart_id'];
            $query = "SELECT sum(quantity) as total FROM cart_has_item WHERE c_id = $cartID group by c_id";
            $result2 = mysqli_query($db, $query);
            $row=mysqli_fetch_array($result2);
            $cartTotal = $row['total'];
            $_SESSION['cartTotal'] = $cartTotal;
          }

           ?>

            <!-- Scripts -->
              <script src="assets/js/jquery.min.js"></script>
              <script src="assets/js/skel.min.js"></script>
              <script src="assets/js/util.js"></script>
              <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
              <script src="assets/js/main.js"></script>

        </body>
        </html>

        <!--Code that implements Bootstrap-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
