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
  
  $query = $db->query("SELECT * FROM orderr WHERE BuyerID=$userRow[BuyerID]");
  //$orderRow = $query->fetch_array();
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
  <form method="post" action="checkout.php">
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
	<h3>Order History:</h3>
	</div>
	</form>
       <?php
	     $query = $db->query("SELECT * FROM orderr WHERE BuyerID=$userRow[BuyerID]");
          //$result = $db->query("SELECT * FROM order_product WHERE OrderID=$orderRow[OrderID]");
          if($query){
			  while($obj2 = $query->fetch_object()){
				$result = $db->query("SELECT * FROM order_product WHERE OrderID=$obj2->OrderID");
            while($obj = $result->fetch_object()) {
              echo '<div style="padding: 0px 100px;">';
              echo '<p style= "display: inline-block; ">' . 'Quantity:  '.$obj->Quantity.' , OrderID:   '.$obj->OrderID.' , ProductID:   '.$obj->ProductID.' , StoreID:   '.$obj->StoreID.'</p>';
              echo '</div>';
			  }}
          }
          ?>
	
  </body>
</html>
