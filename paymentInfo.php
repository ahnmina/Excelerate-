<?php
session_start();
$server = 'localhost';
$dbUser = 'root';
$dbPassword='password';
$dbName = 'exceleratedb2';

$db = mysqli_connect($server,$dbUser,$dbPassword,$dbName);

// Get the card holder's name, card number, card expiration date, and card cvv from checkout.php
$cardHolder = mysqli_real_escape_string($db, $_REQUEST['cardHolderName']);
$cardNum = mysqli_real_escape_string($db, $_REQUEST['cardNum']);
$expMonth = mysqli_real_escape_string($db, $_REQUEST['expMonth']);
$expYear= mysqli_real_escape_string($db, $_REQUEST['expYear']);
$ccv = mysqli_real_escape_string($db, $_REQUEST['ccv']);
$cardType  = mysqli_real_escape_string($db, $_REQUEST['cardType']);

$shopperID = $_SESSION['shopper_id'];

//insert a validation maybe

//put those values into database (payment account table)
$paymentAccount = "SELECT * FROM payment_account WHERE s_id = $shopperID";
$paymentAcctResult = mysqli_query($db, $paymentAccount);
// if(mysqli_num_rows($paymentAcctResult) == 0){
  $paymentQuery = "INSERT INTO `payment_account` (`cardholder_name`, `card_ccv`, `card_num`, `exp_month`,  `exp_year`, `s_id`,`card_type`)
                VALUES ('$cardHolder', '$ccv','$cardNum',$expMonth,$expYear,$shopperID,'$cardType')";
  $result = mysqli_query($db, $paymentQuery);

  header("Location:checkout.php"); 
// } else {
  //get card number, if found in database show an error message or something
// }
 ?>
