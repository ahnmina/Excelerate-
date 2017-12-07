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
								<a href="index.php" class="logo">
									<span class="symbol"><img src="images/logo.svg" alt="" /></span><span class="title">Excelerate</span>
								</a>
              </p>
							<!-- Nav -->
								<nav>
									<ul>
                    <!--Add the shopping cart icon-->
										<li><strong>Welcome <?php echo $_SESSION['user']?></strong></a></li>
                    <li><a href="account.php"><strong>My Account</strong></a></li>
                    <!-- <li><a href="viewCart.php"><span class="glyphicon glyphicon-shopping-cart"></span><strong>Cart</strong></a></li> -->
                    <li><a href="viewCart.php"><span class="glyphicon glyphicon-shopping-cart"></span><strong>Cart</strong><span class="badge">
                      <?php
                      echo $_SESSION['cartTotal'];
                      // if(isset($_GET['cartTotal'])){
                      //   echo $_SESSION['cartTotal'];
                      // }//else{
                      //   $_SESSION['cartTotal'] =0;
                      //   echo $_SESSION['cartTotal'];
                      // }
                      ?>
                    </span></a></li>
                    <li><a href="index.html"><strong>Log Out</strong></a></li>
                    <li><a href="#menu">Menu</a></li>
									</ul>
								</nav>

						</div>
					</header>
            <h1><center>My Account</center></h1>
<center>
  <!--Change Password-->
        <button class="btn btn-link" data-toggle="collapse" data-target="#changePassword">Change Password</button>
        <div id="changePassword" class="collapse">
          <div class="container">
            <div class="row-fluid">
              <form name="changePassword" method="post" action="changePassword.php">
                <br>
              Enter current password: <input type="password" name="current_password" pattern="[a-zA-Z0-9\s.]+"  required id="password" value="" placeholder="password" />
              Enter new password: <input type="password" name="new_password" pattern="[a-zA-Z0-9\s.]+"  required id="password" value="" placeholder="password" />
              <br>
              <input type="submit" value="Submit" />
            </form>
        </div>
          </div>
        </div>
<br>
<!--Update Shipping Address-->
        <button class="btn btn-link" data-toggle="collapse" data-target="#updateAddress">Update Shipping Address</button>
        <div id="updateAddress" class="collapse">
          <div class="container">
            <div class="row-fluid">
              <form name="updateAddress" method="post" action="updateAddress.php">
                <br>
                <strong>Current address saved to your account:</strong>
                <br>
                <?php
                $shopperID = $_SESSION['shopper_id'];
                $query = "SELECT shipping_addr,city,state,zipcode FROM shopper WHERE s_id=$shopperID";
                $result = mysqli_query($db, $query);
                $row=mysqli_fetch_array($result);
                echo $row['shipping_addr'];
                echo '<br>';
                echo $row['city'].' ,'.$row['state']. ' '.$row['zipcode'];
                ?>
                <br>
                <br>
              <strong>Enter updated address:</strong>
              <div class="12u$">
                <input type="text" name="newAddress" pattern="[a-zA-Z0-9\s.]+"  required id="address" value="" placeholder="Address" />
              </div>
            <div class="row uniform 33%">
              <div class="4u 12u$(xsmall)">
                <input type="text" name="newCity" pattern="[a-zA-Z\s]+"  required id="city" value="" placeholder="City" />
              </div>
              <div class="4u 12u$(xsmall)">
                <input type="text" name="newState" pattern="[a-zA-Z]{2}" required maxlength="2" id="state" value="" placeholder="State (2 letter code)" />
              </div>
              <div class="4u 12u$(xsmall)">
                <input type="text" pattern="[0-9]{5}" name="newZipcode" required maxlength="5" id="zip code" value="" placeholder="Zip code (5 digits)" />
              </div>
            </div>
              <br>
            <center>  <input type="submit" value="Submit" /></center>
            </form>
        </div>
          </div>
        </div>
    <br>
        <!--View purchases-->
              <button class="btn btn-link" data-toggle="collapse" data-target="#viewPurchases">View My Purchases</button>
              <div id="viewPurchases" class="collapse">
                <div class="container">
                  <div class="row-fluid">
                    <br>
                    <?php
                    $server = 'localhost';
                    $dbUser = 'root';
                    $dbPassword='password';
                    $dbName = 'exceleratedb2';

                    $db = mysqli_connect($server,$dbUser,$dbPassword,$dbName);
                      $shopperID = $_SESSION['shopper_id'];

                      $query="SELECT * FROM payment WHERE s_id=$shopperID";
                      $result = mysqli_query($db, $query);
                      echo '<table>';
                      echo '<tr>';
                        echo '<th> Amount Paid</th>';
                        echo '<th> Date of Purchase</th>';
                      echo '</tr>';
                      while($row= mysqli_fetch_array($result)){
                        echo '<tr>';
                          echo'<td>';
                            echo '$' .$row['amount'];
                          echo'</td>';
                          echo'<td>';
                            echo $row['date_proc'];
                          echo'</td>';
                        echo '</tr>';
                      }
                      echo '</table>';
                     ?>
                    <br>

              </div>
                </div>
              </div>
      <br>
</center>

<center>
<form action="user_main.php">
  <br>
    <input type="submit" value="Back" />
</form>
</center>

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
