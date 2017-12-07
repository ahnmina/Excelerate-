<!--code snippet to connect to database-->
<?php
session_start();
$server = 'localhost';
$dbUser = 'root';
$dbPassword='password';
$dbName = 'exceleratedb2';
$shopperID = $_SESSION['shopper_id']; //variable to store session variable of shopperID
$cartID = $_SESSION['cart_id'];//variable to store session variable of cartID

$db = mysqli_connect($server,$dbUser,$dbPassword,$dbName);
$query = "SELECT shopper.* FROM shopper WHERE s_id=(SELECT DISTINCT s_id FROM cart WHERE c_id = $cartID)"; //get shopper info using cart id
$result = mysqli_query($db, $query);
$row=mysqli_fetch_array($result);

updateCartTotal($db);
?>

<html>
<!--code to style the nav bar (centers the checkout sign with item count)-->
<style>
.navbar-brand-centered {
    position: absolute;
    left: 40%;
    display: block;
    width: 250px;
    text-align: center;
    background-color: #eee;
}
.navbar>.container .navbar-brand-centered,
.navbar>.container-fluid .navbar-brand-centered {
    margin-left: -80px;
}
</style>

<!--Nav bar (displays checkout sign with total items in cart)-->
<nav class="navbar navbar-default" role="navigation">
<div class="navbar-header">
  <a href="user_main.php" class="navbar-brand navbar-brand-left">Excelerate
  <!-- <span class="symbol"><img src="images/logo.svg" alt="" /></span><span class="title">Excelerate</span></a> -->
  <a class="navbar-brand navbar-brand-centered">Checkout (
    <?php
      echo $_SESSION['cartTotal'];
      $_SESSION['cartTotal'] > 1 ?
      print " items " : print " item "
    ?>
  )</a>
</div>
</nav>

<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-9">
<!--Step1 Shipping Address-->
        <div class="row">
          <div class="col-sm-3">
            <p>1 Shipping Address</p>
          </div>
          <div class="col-sm-9">
            <?php
              echo $row['first_name'];
              echo '&nbsp;';
              echo $row['last_name'];
              echo '<br>';
              echo $row['shipping_addr'];
              echo '<br>';
              echo $row['city'];
              echo '&nbsp;';
              echo $row['state'];
              echo '&nbsp;';
              echo $row['zipcode'];
            ?>
            <!--Update Shipping Address-->
            <br>
                    <button class="btn btn-link" data-toggle="collapse" data-target="#updateAddress">Change Shipping Address</button>
                    <div id="updateAddress" class="collapse">
                      <div class="container">
                        <div class="row-fluid">
                          <form name="updateAddress" method="post" action="updateAddressCheckout.php">
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
          </div>
        </div>


        <!-- add a line -->
        <div class="row">
          <div class="col-sm-12">
            <hr>
          </div>
        </div>

<!--Step2 Payment Method-->
    <div class="row">
      <div class="col-sm-3">
          <p>2 Payment Method</p>
      </div>
      <div class="col-sm-9">
        <?php
          $accountResultSet = getPaymentAccounts();
          if( mysqli_num_rows($accountResultSet) > 0 ) {
            echo "<div class='row'>";
            echo "<div class='col-sm-12'>";
            echo "<div class='control-group'>";
            echo "  <label class='control-label' for='acct_id'>Select Payment Type</label>";
            echo "  <div class='controls'>";
            echo "    <select class='span3' name='acct_id' id='acct_id' onchange='getAcctID(this)''>";
            echo "<option value = ''></option>";
            while($row=mysqli_fetch_array($accountResultSet)){
              echo "<option value=".$row['a_id'].">" .$row['card_type']. " ending in ".substr($row['card_num'],-4)."</option>";
              // echo $row['card_type']. " ending in ".substr($row['card_num'],-4);
            }
            echo "</select>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
          }
        ?>

        <button class="btn btn-link" data-toggle="collapse" data-target="#payment">Add payment method</button>
        <div id="payment" class="collapse">
          <div class="container">
          	<div class="row-fluid">
                <form class="form-horizontal" method="post" action="paymentInfo.php">
                  <fieldset>
                    <div id="legend">
                      <legend class="">Payment</legend>
                    </div>

                    <!--Card type-->
                    <div class="control-group">
                      <label class="control-label" for="cardType">Card Type</label>
                      <div class="controls">
                        <select class="span3" name="cardType" id="cardType">
                          <option></option>
                          <option value="Master Card">Master Card</option>
                          <option value="VISA">VISA</option>
                          <option value="Discover">Discover</option>
                          <option value="American Express">American Express</option>
                        </select>
                      </div>
                    </div>

                    <!-- Name -->
                    <div class="control-group">
                      <label class="control-label"  for="cardHolderName">Card Holder's Name</label>
                      <div class="controls">
                        <input type="text" id="cardHolderName" name="cardHolderName" placeholder="" class="input-xlarge">
                      </div>
                    </div>
                    <!-- Card Number -->
                    <div class="control-group">
                      <label class="control-label" for="cardNum">Card Number</label>
                      <div class="controls">
                        <input type="text" id="cardNum" name="cardNum" placeholder="" class="input-xlarge">
                      </div>
                    </div>

                    <!-- Expiration Date-->
                    <div class="control-group">
                      <label class="control-label" for="expDate">Card Expiration Date</label>
                      <div class="controls">
                        <select class="span3" name="expMonth" id="expMonth">
                          <option></option>
                          <option value="01">Jan (01)</option>
                          <option value="02">Feb (02)</option>
                          <option value="03">Mar (03)</option>
                          <option value="04">Apr (04)</option>
                          <option value="05">May (05)</option>
                          <option value="06">June (06)</option>
                          <option value="07">July (07)</option>
                          <option value="08">Aug (08)</option>
                          <option value="09">Sep (09)</option>
                          <option value="10">Oct (10)</option>1
                          <option value="11">Nov (11)</option>
                          <option value="12">Dec (12)</option>
                        </select>
                        <select class="span2" name="expYear">
                          <!-- <option value="13">2013</option>
                          <option value="14">2014</option>
                          <option value="15">2015</option>
                          <option value="16">2016</option> -->
                          <option value="17">2017</option>
                          <option value="18">2018</option>
                          <option value="19">2019</option>
                          <option value="20">2020</option>
                          <option value="21">2021</option>
                          <option value="22">2022</option>
                          <option value="23">2023</option>
                        </select>
                      </div>
                    </div>

                    <!-- CVV -->
                    <div class="control-group">
                      <label class="control-label"  for="ccv">Card CCV</label>
                      <div class="controls">
                        <input type="password" id="ccv" name="ccv" placeholder="" class="span2">
                      </div>
                    </div>

                    <!-- Submit -->
                    <div class="control-group">
                      <div class="controls">
                        <br>
                        <button class="btn btn-success">Add</button>
                      </div>
                    </div>

                  </fieldset>
                </form>
              </div>
          </div>
        </div>

      </div>
    </div>

    <!-- add a line -->
    <div class="row">
      <div class="col-sm-12">
        <hr>
      </div>
    </div>

    <!--Step3 Review Items and Shipping-->
        <div class="row">
          <div class="col-sm-3">
              <p>3 Review Items and Shipping</p>
          </div>
          <div class="col-sm-9">
            <?php
            $cartID = $_SESSION['cart_id'];
            $joinedSQL = "SELECT item.*, cart_has_item.quantity FROM `item`, `cart_has_item` WHERE item.p_id = cart_has_item.p_id and cart_has_item.c_id = $cartID";
            $result = mysqli_query($db, $joinedSQL);
            while($row=mysqli_fetch_array($result)){
              $source= '<img src="data:image/jpeg;base64,'.base64_encode( $row['picture'] ).'" height="125" width="200"/>';
              echo $source;
              echo '<br>';
              echo $row['display_name'];
              echo '<br>';
              echo 'Quantity: '. $row['quantity'];
              echo '<br>';
              echo 'Price: ' . $row['price'];
              echo '<br>';
              echo '<br>';
            }
            ?>
          </div>
        </div>

    </div>
      <div class="col-sm-3">
        <?php
        //code to show the total amount to pay
        $totalQry = "SELECT sum(item.price) as cartTotal from item, cart_has_item where item.p_id = cart_has_item.p_id and cart_has_item.c_id = $cartID group by cart_has_item.c_id"; // get the total for all items in the cart
        $totalResult = mysqli_query($db, $totalQry);
        $totalRow=mysqli_fetch_array($totalResult);
        $cartTotal = $totalRow['cartTotal']; //sum of the purchase total
        $_SESSION['cartTotal'] = $cartTotal;  //session variable to store the cart total purchase sum
        echo 'Your order total: $'.$cartTotal;
        ?>
        <form action="confirm.php" method='post'>
            <input type="hidden" id='acctid' name="acctid" value="" />
            <input type="submit" value="Place Your Order" />
        </form>
      </div>
    </div>
  </div>

</body>

<script type="text/javascript">
  function getAcctID(sel){
    //alert("here");
    document.getElementById("acctid").value = sel.options[sel.selectedIndex].value;
    //alert(sel.options[sel.selectedIndex].value);

  }
</script>

<!--scripts for bootstrap-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</html>

<?php
function getPaymentAccounts(){
  $server = 'localhost';
  $dbUser = 'root';
  $dbPassword='password';
  $dbName = 'exceleratedb2';

  $db = mysqli_connect($server,$dbUser,$dbPassword,$dbName);
  $shopID = $_SESSION['shopper_id'];
  $query = "SELECT * FROM payment_account WHERE s_id=$shopID";
  $result = mysqli_query($db, $query);
  return $result;
}

//fix this function
function getAccountInfo(){
  $server = 'localhost';
  $dbUser = 'root';
  $dbPassword='password';
  $dbName = 'exceleratedb2';

  $db = mysqli_connect($server,$dbUser,$dbPassword,$dbName);
  $shopID = $_SESSION['shopper_id'];
  $query = "SELECT * FROM payment_account WHERE s_id=$shopID";
  $result = mysqli_query($db, $query);
  while($row=mysqli_fetch_array($result)){
    echo "<div class='row'>";
    echo $row['card_type']. " ending in ".substr($row['card_num'],-4);
    echo "</div>";
  }
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
