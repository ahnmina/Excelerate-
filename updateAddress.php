<!--code snippet to connect database/server-->
<?php
session_start();
$server = 'localhost';
$dbUser = 'root';
$dbPassword='password';
$dbName = 'exceleratedb2';

$db = mysqli_connect($server,$dbUser,$dbPassword,$dbName);

$newAddress = mysqli_real_escape_string($db, $_REQUEST['newAddress']);
$newCity = mysqli_real_escape_string($db, $_REQUEST['newCity']);
$newState = mysqli_real_escape_string($db, $_REQUEST['newState']);
$newZipcode = mysqli_real_escape_string($db, $_REQUEST['newZipcode']);
$shopperID = $_SESSION['shopper_id'];

$query = "UPDATE shopper SET shipping_addr='$newAddress',city='$newCity',state='$newState', zipcode='$newZipcode'
          WHERE s_id=$shopperID";
$result = mysqli_query($db, $query);

if($result){
  echo "<script>
  alert('Shipping address has been updated!');
  window.location.href='account.php';
  </script>";
}
 ?>
