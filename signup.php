<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
//include 'signup.php';
$server = 'localhost';
$dbUser = 'root';
$dbPassword='password';
$dbName = 'exceleratedb2';

$db = mysqli_connect($server,$dbUser,$dbPassword,$dbName)
or die('Error connecting to MySQL server.');

// Get the username and password that was entered in signin.html
$fname = mysqli_real_escape_string($db, $_REQUEST['fname']);
$lname = mysqli_real_escape_string($db, $_REQUEST['lname']);
$email = mysqli_real_escape_string($db, $_REQUEST['email']);
$address = mysqli_real_escape_string($db, $_REQUEST['address']);
$city = mysqli_real_escape_string($db, $_REQUEST['city']);
$state = mysqli_real_escape_string($db, $_REQUEST['state']);
$zip_code = mysqli_real_escape_string($db, $_REQUEST['zip_code']);
$password = mysqli_real_escape_string($db, $_REQUEST['password']);

//Insert user into database table 'shopper'
if(strlen($password) >= 8){
  $query = "INSERT INTO `shopper` (`first_name`, `last_name`, `mailing_addr`, `city`, `state`, `zipcode`, `shipping_addr`, `email`, `password`)
            VALUES ('$fname','$lname','$address','$city','$state','$zip_code','$address','$email','$password')";
  //$result = mysqli_query($db, $query);
  //If user was successfully added to database, echo statement
  if (mysqli_query($db, $query)) {
    echo "<script>
    alert('Successfully registered! You will now be redirected to the login page');
    window.location.href='signin.html';
    </script>";
  } else {
      echo "Error: " . $query . "<br>" . mysqli_error($db);
  }
}else{
  echo "<script>
  alert('Password must be at least 8 characters in length');
  window.location.href='register.html';
  </script>";
}


?>
