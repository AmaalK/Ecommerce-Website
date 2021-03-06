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
  $db->close();
?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Amaal's Souq</title>
    <link rel="stylesheet" href="css/foundation.css" />
  </head>
  <body background="back.png">
</div>
  <form method="post" action="buyer.php">
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
