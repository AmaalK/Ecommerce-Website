<?php 
  include('config.php');
  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: index.php');
  }
  if (isset($_POST['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: index.php");
  }
  $username = $_SESSION['username'];
  $query = $db->query("SELECT * FROM buyer WHERE Username='$username'");
  $userRow=$query->fetch_array();
  
  $query = $db->query("SELECT * FROM cart WHERE BuyerID=$userRow[BuyerID]");
  $cartRow = $query->fetch_array();
  
  if (isset($_GET['action']))
  {
	if($_GET['action'] == 'add'){  
  $productID = $_GET['id'];
  $storeID = $_GET['store'];
  $categoryID = $_GET['category'];
  $productName = $_GET['name'];
  header("location: cart.php");
  $check_email = $db->query("SELECT * FROM cart_product WHERE CartID=$cartRow[CartID] AND ProductID=$productID AND StoreID=$storeID" );
  $cartProduct = $check_email->fetch_array();
  $count=$check_email->num_rows;
  if($count==1){
	  $quantity = 1;
	  $quantity += $cartProduct['Quantity'];
	  $qq=$db->query("UPDATE cart_product SET Quantity=$quantity WHERE CartID=$cartRow[CartID] AND ProductID=$productID AND StoreID=$storeID");}
  else{$qq=$db->query("INSERT INTO cart_product (Quantity, ProductID, CartID, StoreID)
  VALUES(1, $productID, $cartRow[CartID], $storeID)");}}
  else if ($_GET['action'] == remove){
	    $productID = $_GET['id'];
		$cartID = $_GET['cart'];
		  $storeID = $_GET['store'];
		 header("location: cart.php");
		$qq=$db->query("DELETE FROM cart_product WHERE CartID=$cartID AND ProductID=$productID AND StoreID=$storeID");
  }
  }
  if (isset($_POST['checkout'])) {
	$date= date("Y-m-d");
	  
	$result = $db->query("SELECT * FROM cart_product WHERE CartID=$cartRow[CartID]");
	$qq=$db->query("INSERT INTO orderr (BuyerID, OrderDate)
       VALUES($userRow[BuyerID], '$date')");
	$ordrID = $db->insert_id;
	  if($result){
            while($obj = $result->fetch_object()) {
              $qq=$db->query("INSERT INTO order_product (Quantity, OrderID, ProductID, StoreID)
				VALUES($obj->Quantity, $ordrID, $obj->ProductID, $obj->StoreID)");
            }
	  }
	 $qq=$db->query("DELETE FROM cart_product WHERE CartID=$cartRow[CartID]");
  	header("location: checkout.php");
  }
?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Amaal's Souq</title>
    <link rel="stylesheet" href="css/foundation.css" />
  </head>
  <body background="back2.png">
</div>
  <form method="post" action="cart.php">
    <nav class="top-bar" data-topbar role="navigation">
      <ul class="title-area">
        <li class="name">
          <h1><a href="buyer.php">Welcome, <?php echo $userRow['Email'];?></a></h1>
        </li>
        <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
      </ul>
      <section class="top-bar-section">
        <ul class="right">
          <li><a href="search.php">Products</a></li>
          <li><a href="cart.php">View Cart</a></li>
          <li><a href="checkout.php">My Orders</a></li>
		  <li><a href="seller.php">Switch to Seller</a></li>
		  <button type="submit" class="btn" name="logout">Log Out</button>		
        </ul>
      </section>
    </nav>
	<div style="margin: 10px 0px 10px 0px; width: 30%;padding: 0px 100px; ">
	<h3>Items in Cart:</h3>
	<button type="submit" class="btn" name="checkout">Check Out</button>
	</div>
	</form>
       <?php
          $result = $db->query("SELECT * FROM cart_product WHERE CartID=$cartRow[CartID]");
          if($result){
            while($obj = $result->fetch_object()) {
              echo '<div style="padding: 0px 100px;">';
              echo '<p style= "display: inline-block; ">' . 'ProductID:  '.$obj->ProductID.' , Quantity:   '.$obj->Quantity.'</p>';
			  echo '<a href="cart.php?action=remove&id='.$obj->ProductID.'&cart='.$obj->CartID.'&store='.$obj->StoreID.'"><input type="submit" value="Remove From Cart" style="clear:both; background: #0078A0; border: none; color: #fff; font-size: 1em; padding: 10px; margin:4px 10px;" /></a>';
              echo '</div>';
            }
          }
          ?>
	
  </body>
</html>
