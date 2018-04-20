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
  <form method="post" action="search.php">
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
		<label style = "font-size:1.2em;"><b>Search Products:</b></label>
	    	  <input type="text" placeholder="Product Name" name="productName">
		<button type="submit" class="btn" name="productbtn">Search</button>
	  	  </div>	
		  </form>
		  <h3 style="padding: 0px 100px;">Products available:</h3>
        <?php
		if (!isset($_POST['productbtn'])){
          $result = $db->query("SELECT * FROM product");
          if($result){
            while($obj = $result->fetch_object()) {
              echo '<div style="padding: 0px 100px;">';
              echo '<p style= "display: inline-block; ">' . 'Product:  '.$obj->productName.' , StoreID:   '.$obj->StoreID.'</p>';
              echo '<a href="cart.php?action=add&id='.$obj->ProductID.'&store='.$obj->StoreID.'&category='.$obj->CategoryID.'&name='.$obj->productName.'"><input type="submit" value="Add To Cart" style="clear:both; background: #0078A0; border: none; color: #fff; font-size: 1em; padding: 10px; margin:4px 10px;" /></a>';
              echo '</div>';
            }
		}}
		else if (isset($_POST['productbtn']))
		{
		$productName = mysqli_real_escape_string($db, $_POST['productName']);
	      $result = $db->query("SELECT * FROM product WHERE productName = '$productName'");
          if($result){
            while($obj = $result->fetch_object()) {
              echo '<div style="padding: 0px 100px;">';
              echo '<p style= "display: inline-block; ">' . 'Product:  '.$obj->productName.' , StoreID:   '.$obj->StoreID.'</p>';
              echo '<a href="cart.php?action=add&id='.$obj->ProductID.'&store='.$obj->StoreID.'&category='.$obj->CategoryID.'&name='.$obj->productName.'"><input type="submit" value="Add To Cart" style="clear:both; background: #0078A0; border: none; color: #fff; font-size: 1em; padding: 10px; margin:4px 10px;" /></a>';
              echo '</div>';
            }
		}
		}
          ?>
	
  </body>
</html>
