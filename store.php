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
  $query = $db->query("SELECT * FROM seller WHERE Username='$username'");
  $userRow=$query->fetch_array();
  
   if (isset($_POST['storebtn'])) {
	$storeName = mysqli_real_escape_string($db, $_POST['store']);
	$result=$db->query("INSERT INTO store(storeName, SellerID) VALUES ('$storeName', $userRow[SellerID])");
  	header("location: store.php");
  }
  if (isset($_POST['deletebtn'])) {
	$result=$db->query("DELETE FROM store WHERE SellerID = $userRow[SellerID]");
  	header("location: store.php");
  }
  if (isset($_POST['categorybtn'])) {
  	header("location: category.php");
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
  <body background="back2.png" >
</div>
  <form method="post" action="store.php">
    <nav class="top-bar" data-topbar role="navigation">
      <ul class="title-area">
        <li class="name">
          <h1><a href="seller.php">Welcome, <?php echo $userRow['Email'];?></a></h1>
        </li>
        <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
      </ul>
      <section class="top-bar-section">
        <ul class="right">
          <li><a href="store.php">Store</a></li>
          <li><a href="orders.php">My Orders</a></li>
		  <li><a href="buyer.php">Switch to Buyer</a></li>
		  <button type="submit" class="btn" name="logout">Log Out</button>		
        </ul>
      </section>
    </nav>
	 <?php
		 $check = $db->query("SELECT * FROM store WHERE SellerID=$userRow[SellerID]");
		 $count=$check->num_rows;
		 if($count==0){
			 ?>
	<div style="margin: 10px 0px 10px 0px; width: 30%;padding: 40px 40px;">
  	  <label><b>Enter Store Name</b></label>
  	  <input type="text" placeholder="Store Name" name="store" required>
	  <button type="submit" class="btn" name="storebtn">Add Store</button>		
  	</div>
	<?php
		 }else{
			 $name = $db->query("SELECT * FROM store WHERE sellerID=$userRow[SellerID]");
			 $userRow=$name->fetch_array();
		?>
		<div style="margin: 10px 0px 10px 0px; width: 30%;padding: 40px 40px; ">
  	  <label style = "font-size:1.5em;"><b>Store Name: <?php echo $userRow['StoreName'];?> </b></label>
	  <button type="submit" class="btn" name="categorybtn">Add Categories</button>	
	  <button type="submit" class="btn" name="deletebtn">Delete Store</button>	
	  	  </div>
		<?php
		 }
		 ?>
    <div class="row" style="margin-top:550px;">
      <div class="small-12">
        <footer style="margin-top:550;">
           <p style="text-align:center; font-size:0.8em;">&copy; Amaal's Souq. All Rights Reserved.</p>
        </footer>
      </div>
    </div>
	</form>
  </body>
</html>
