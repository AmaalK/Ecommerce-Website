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
  
  $storeName = $db->query("SELECT * FROM store WHERE sellerID=$userRow[SellerID]");
  $storeRow=$storeName->fetch_array();
  
  $category = $db->query("SELECT * FROM category WHERE sellerID=$userRow[SellerID]");
  //$categoryRow=$category->fetch_array();
  $product = $db->query("SELECT productName, categoryID FROM product WHERE sellerID=$userRow[SellerID]");
  
  if (isset($_POST['deletebtn'])) {
	$categoryName = mysqli_real_escape_string($db, $_POST['category']);
	if(empty($categoryName)){array_push($errors, "Category name is empty.");}
	else{
	$check_email = $db->query("SELECT categoryName FROM category WHERE CategoryName='$categoryName' AND SellerID=$userRow[SellerID]");
    $count=$check_email->num_rows;
    if($count==1){$result=$db->query("DELETE FROM category WHERE CategoryName='$categoryName' AND SellerID=$userRow[SellerID]");
  	header("location: category.php");}
	else{
	array_push($errors, "Category name does not exist.");}}
  }
  if (isset($_POST['categorybtn'])) {
	$categoryName = mysqli_real_escape_string($db, $_POST['category']);
	if(empty($categoryName)){array_push($errors, "Category name is empty.");}
	else{$check_email = $db->query("SELECT categoryName FROM category WHERE CategoryName='$categoryName' AND SellerID=$userRow[SellerID]");
    $count=$check_email->num_rows;
	if($count==1){array_push($errors, "Category name already exists.");}
	else {$result=$db->query("INSERT INTO category(CategoryName,storeID,sellerID) VALUES ('$categoryName',$storeRow[StoreID],$userRow[SellerID])");
  	header("location: category.php");}}
  }
   if (isset($_POST['productbtn'])) {
	$productCategory = mysqli_real_escape_string($db, $_POST['productCategory']);
	$productName = mysqli_real_escape_string($db, $_POST['productName']);
	if(empty($productCategory) || empty($productName)){array_push($errors, "Please fill in the product information.");}
	else{
		$getCat = $db->query("SELECT categoryID FROM category WHERE categoryName='$productCategory'");
		$getCat = $getCat->fetch_array();
		$check_email = $db->query("SELECT productID FROM product WHERE productName='$productName' AND SellerID=$userRow[SellerID] AND CategoryID=$getCat[categoryID]");
		$count=$check_email->num_rows;
	if($count==1){array_push($errors, "Product name already exists in that category.");}
	else {
		$result=$db->query("INSERT INTO product(categoryID,storeID,sellerID, productName) VALUES ($getCat[categoryID] ,$storeRow[StoreID],$userRow[SellerID], '$productName')");
		header("location: category.php");}}
  }
  if (isset($_POST['productdelete'])) {
	$productCategory = mysqli_real_escape_string($db, $_POST['productCategory']);
	$productName = mysqli_real_escape_string($db, $_POST['productName']);
	if(empty($productCategory) || empty($productName)){array_push($errors, "Please fill in the product information.");}
	else{
	$getCat = $db->query("SELECT categoryID FROM category WHERE categoryName='$productCategory'");
	$getCat = $getCat->fetch_array();
	$check_email = $db->query("SELECT productID FROM product WHERE productName='$productName' AND SellerID=$userRow[SellerID] AND CategoryID=$getCat[categoryID]");
	$count=$check_email->num_rows;
    if($count==1){$result=$db->query("DELETE FROM product WHERE productName='$productName' AND SellerID=$userRow[SellerID] AND CategoryID=$getCat[categoryID]");
  	header("location: category.php");}
	else{
	array_push($errors, "Item does not exist.");}}
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
  <form method="post" action="category.php">
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
	<div style="margin: 10px 0px 10px 0px; width: 30%;padding: 20px 40px; ">
	
  	  <label style = "font-size:1.5em;"><b>Store Name: <?php echo $storeRow['StoreName'];?> </b></label>
	  	  </div>
		  <div style="margin: 10px 0px 10px 0px; width: 30%;padding: 0px 40px; ">
		  <?php  if (count($errors) > 0) : ?>
		<div class="error">
			<?php foreach ($errors as $error) : ?>
			<p><?php echo $error ?></p>
			<?php endforeach ?>
		</div>
	<?php  endif ?> 
  	  <label style = "font-size:1.2em;"><b>Edit Categories:</b></label>
	    	  <input type="text" placeholder="Category Name" name="category">
		<button type="submit" class="btn" name="categorybtn">Add Category</button>	
	    <button type="submit" class="btn" name="deletebtn">Delete Category</button>	

		  	  <label style = "font-size:1.2em;"><b>Available Categories:</b></label>

			<?php
			$row = array();
			while($row = mysqli_fetch_array($category)){
			echo "<b>" . $row['CategoryName'] . "</b>,  ";
			}
		  ?>
	  	  </div>
		  
		  <div style="margin: 10px 0px 10px 0px; width: 30%;padding: 0px 40px; ">
  	  <label style = "font-size:1.2em;"><b>Edit Products:</b></label>
	    	  <input type="text" placeholder="Product Name" name="productName">
			  <input type="text" placeholder="Category Name" name="productCategory">

		<button type="submit" class="btn" name="productbtn">Add Product</button>	
	    <button type="submit" class="btn" name="productdelete">Delete Product</button>	

		  	  <label style = "font-size:1.2em;"><b>Available Products:</b></label>

	  	  </div>
			<?php
			$row = array();
			$row2 = array();
			echo "<table style='width:30%'>";
			echo "<tr><th>Product Name</th><th>Product Category</th></tr>";
			while($row = $product->fetch_assoc()){
				$getCategory = $db->query("SELECT categoryName FROM category WHERE categoryID=$row[categoryID]");
				$getCategory = $getCategory->fetch_array();
				$getCategory = $getCategory['categoryName'];
				echo "<tr><td>" . $row['productName'] . "</td><td>" . $getCategory . "</td></tr>";
			}
		  ?>
   
	</form>
  </body>
</html>
