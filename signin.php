<?php

$server = 'localhost';
$dbUser = 'root';
$dbPassword='password';
$dbName = 'exceleratedb2';

$db = mysqli_connect($server,$dbUser,$dbPassword,$dbName)
or die('Error connecting to MySQL server.');

// Get the username and password that was entered in signin.html
$email = mysqli_real_escape_string($db, $_REQUEST['email']);
$password = mysqli_real_escape_string($db, $_REQUEST['password']);
//Check to see if the username and password are in the database
$query = "SELECT * FROM shopper WHERE email='$email'";
mysqli_query($db, $query) or die('Error querying database.');

$result = mysqli_query($db, $query);
$row = mysqli_fetch_array($result);

if ($row["email"] == $email && $row['password']== $password) {
  session_start();
  //once the user logs in, session will keep track of the user's activity until he/she logs out
  $_SESSION["user"] = $row['first_name'];
  $_SESSION["shopper_id"] = $row['s_id'];
  //once the user logs in, cart is inserted into database
      $c_id = $_SESSION["shopper_id"];
      $c_name = $_SESSION['user'] ."Cart";
      $date_opened = date("Y-m-d h:i:sa");
      $s_id = $_SESSION['shopper_id'];
//insert value into cart table in database
  $cartQuery = "INSERT INTO `cart` (`c_id`, `s_id`, `cname`, `date_opened`)
                VALUES ('$c_id', '$s_id','$c_name','$date_opened')";
  mysqli_query($db, $cartQuery);
  $_SESSION["cart_id"] = $c_id; //<-- cart session so that you can use this later to update cart_has_items table
//insert values into cart table in database
$has_itemsQuery = "INSERT INTO `cart` (`c_id`, `s_id`, `cname`, `date_opened`)
              VALUES ('$c_id', '$s_id','$c_name','$date_opened')";

  header("Location:user_main.php"); //<-- redirects to the main user page
} else {
  echo "<script>
  alert('Wrong username and/or password');
  window.location.href='signin.html';
  </script>";
}

?>
