<?php
session_start();
$server = 'localhost';
$dbUser = 'root';
$dbPassword='password';
$dbName = 'exceleratedb2';

$db = mysqli_connect($server,$dbUser,$dbPassword,$dbName);
if(isset($_GET['p_id']) && isset($_GET['quantity'])) {
  $cartID = $_SESSION['cart_id'];
  $qty = $_GET['quantity'];
  $pid = $_GET['p_id'];
  $updateQty = "UPDATE cart_has_item set quantity=$qty where c_id=$cartID and p_id=$pid";
  mysqli_query($db, $updateQty);
}
updateCartTotal($db);

if(isset($_GET['p_id']) && isset($_GET['c_id'])){
  deleteFromCart($_GET['p_id'],$_GET['c_id'], $db);
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
                      <p align="left">
                       <a href="user_main.php" class="logo">
                          <span class="symbol"><img src="images/logo.svg" alt="" /></span><span class="title">Excelerate</span>
                        </a>
                      </p>
					<!-- Nav -->
                      <!--Add the shopping cart icon-->
                  <nav>
                    <ul>
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
  <!-- view contents of cart -->

  <?php
  $cartID = $_SESSION['cart_id'];
  $joinedSQL = "SELECT item.*, cart_has_item.quantity FROM `item`, `cart_has_item` WHERE item.p_id = cart_has_item.p_id and cart_has_item.c_id = $cartID";
  $searchResult = mysqli_query($db, $joinedSQL);
  if(mysqli_num_rows($searchResult) == 0){
    echo "<center><h4>Your cart is empty!</h4></center><br>";
  }else{
  while($row=mysqli_fetch_array($searchResult)){
    echo '<center>';
    echo '<div class="row">';
    echo'<div class="col-sm-6">';
    echo '<center>';
    $source= '<img src="data:image/jpeg;base64,'.base64_encode( $row['picture'] ).'" height="150" width="200"/>';
    echo $source;
    echo '<br>';
    echo '&nbsp;'. $row['display_name'];
    echo '<br>';
    echo '&nbsp;Price: '. $row['price'];
    echo '<br>';
    echo '<a href="viewCart.php?c_id='.$cartID.'&amp;p_id='.$row['p_id'].'" class="btn">Delete</a>';
    echo'</div>';

    echo'<div class="form-group" class="col-sm-6">';
    echo'<label for="'.$row['p_id'].'">Quantity:</label>';
    echo'<select class="form-control" id="'.$row['p_id'].'" onchange="location = this.value;">';
    if ($row['quantity'] == 1) {
      echo'<option value="viewCart.php?quantity=1&amp;p_id='.$row['p_id'].'" selected>1</option>';
    } else {
      echo'<option value="viewCart.php?quantity=1&amp;p_id='.$row['p_id'].'">1</option>';
    }
    if ($row['quantity'] == 2) {
      echo'<option value="viewCart.php?quantity=2&amp;p_id='.$row['p_id'].'" selected>2</option>';
    } else {
      echo'<option value="viewCart.php?quantity=2&amp;p_id='.$row['p_id'].'">2</option>';
    }
    if ($row['quantity'] == 3) {
      echo'<option value="viewCart.php?quantity=3&amp;p_id='.$row['p_id'].'" selected>3</option>';
    } else {
      echo'<option value="viewCart.php?quantity=3&amp;p_id='.$row['p_id'].'">3</option>';
    }
    if ($row['quantity'] == 4) {
      echo'<option value="viewCart.php?quantity=4&amp;p_id='.$row['p_id'].'" selected>4</option>';
    } else {
      echo'<option value="viewCart.php?quantity=4&amp;p_id='.$row['p_id'].'">4</option>';
    }
    echo'</select>';
    echo'</div>';
    echo'</div>';
    echo '<hr style="display: block;border-width: 3px;border-style: inset;">';
  }
  echo "<form action='checkout.php'>";
  echo "<input type='submit' value='Proceed to Checkout' />";
  echo "</form>";
  echo '</center>';
}
 ?>




   <?php
   //delete from cart function
   function deleteFromCart($productID,$cartID, $db){
     $itemQuery = "DELETE FROM cart_has_item WHERE p_id='$productID' and c_id=$cartID";
     $result = mysqli_query($db, $itemQuery);
     getProductName($productID,$db);
     updateCartTotal($db);
   }

   function getProductName($productID, $db){
     $query = "SELECT * FROM item WHERE p_id ='$productID'";
     $result = mysqli_query($db, $query);
     $row=mysqli_fetch_array($result);
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
    <center>
    <form action="user_main.php">
        <input type="submit" value="Back" />
    </form>
  </center>

  </div>
  </body>

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
  </html>
