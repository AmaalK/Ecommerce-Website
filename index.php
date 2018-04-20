<?php include('config.php');
unset($_SESSION['username']);
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  if (count($errors) == 0) {
  	$password = md5($password);
	$username = md5($username);
  	$query = "SELECT * FROM usern WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  if ($_POST['user'] == "buyer"){header('location: buyer.php');}
	  if ($_POST['user'] == "seller"){header('location: seller.php');}
  	}else 
	{
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}
$db->close();
 ?>
<!DOCTYPE html>
<html>
<head>
  <title>Login Page</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
  <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
  <div class="header">
  	<h2>Login</h2>
  </div>
	 
  <form method="post" action="index.php">
  
  	<?php  if (count($errors) > 0) : ?>
		<div class="error">
			<?php foreach ($errors as $error) : ?>
			<p><?php echo $error ?></p>
			<?php endforeach ?>
		</div>
	<?php  endif ?> 
	
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" placeholder="Enter Username" name="username" required >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" placeholder="Enter Password" name="password" required>
  	</div>
	
	<div class="input-group">
	      <div class="col-half">
        <h4>Log in as:</h4>
        <div class="input-group">
          <input type="radio" name="user" value="buyer" id="user-buyer" checked="true"/>
          <label for="user-buyer">Buyer</label>
          <input type="radio" name="user" value="seller" id="user-seller"/>
          <label for="user-seller">Seller</label>
        </div>
      </div>
      </div>
	  
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
  	<p>
  		Not yet a member? <a href="register.php">Sign up</a>
  	</p>
  </form>
</body>
</html>