<?php include('config.php');
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM usern WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: index.php');
  	}else 
	{
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}
 ?>
<!DOCTYPE html>
<html>
<head>
  <title>Login Page</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Login</h2>
  </div>
	 
  <form method="post" action="login.php">
  
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
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
  	<p>
  		Not yet a member? <a href="register.php">Sign up</a>
  	</p>
  </form>
</body>
</html>