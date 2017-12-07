<!--code snippet to connect database/server-->
<?php
session_start();
$server = 'localhost';
$dbUser = 'root';
$dbPassword='password';
$dbName = 'exceleratedb2';

$db = mysqli_connect($server,$dbUser,$dbPassword,$dbName);

$currentPassword = mysqli_real_escape_string($db, $_REQUEST['current_password']);
$newPassword = mysqli_real_escape_string($db, $_REQUEST['new_password']);
$shopperID = $_SESSION['shopper_id'];

$shopperQuery = "SELECT * FROM shopper WHERE password='$currentPassword' and s_id=$shopperID";
$result2 = mysqli_query($db, $shopperQuery);
$row = mysqli_fetch_array($result2);

if($row['password'] == $currentPassword){
  $query = "UPDATE shopper SET password='$newPassword' WHERE s_id=$shopperID";
  $result = mysqli_query($db, $query);
  echo "<script>
  alert('Password changed!');
  window.location.href='account.php';
  </script>";
}else{
  echo "<script>
  alert('Incorrect password');
  window.location.href='account.php';
  </script>";
}
 ?>
