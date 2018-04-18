<?php 
include('config.php');
if (isset($_POST['submit'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $fname = mysqli_real_escape_string($db, $_POST['fname']);
  $lname = mysqli_real_escape_string($db, $_POST['lname']);
  $phone = mysqli_real_escape_string($db, $_POST['phone']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password2']);

  if ($password != $password2) {
	array_push($errors, "The two passwords do not match");
  }
  
  $check_email = $db->query("SELECT Email FROM usern WHERE Email='$email'");
  $count=$check_email->num_rows;
  if($count==1){array_push($errors, "Email already exists.");}
  
  $check_email = $db->query("SELECT Email FROM usern WHERE phoneno='$phone'");
  $count=$check_email->num_rows;
  if($count==1){array_push($errors, "Phone number already exists.");}
  
  $check_email = $db->query("SELECT Email FROM usern WHERE username='$username'");
  $count=$check_email->num_rows;
  if($count==1){array_push($errors, "Username already exists.");}
  
  if (count($errors) == 0) {
  	$password = md5($password);

  	$query = $db->query("INSERT INTO usern (username, email, password, phoneNo, firstName, LastName) 
  			  VALUES('$username', '$email', '$password', '$phone', '$fname', '$lname')");
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Register</h2>
  </div>
	
  <form method="post" action="register.php">

	<?php  if (count($errors) > 0) : ?>
		<div class="error">
			<?php foreach ($errors as $error) : ?>
			<p><?php echo $error ?></p>
			<?php endforeach ?>
		</div>
	<?php  endif ?> 
	
	<div class="input-group">
  	  <label><b>Userame</b></label>
	  <input placeholder="Enter First Name" name="username" required>
  	</div>
	
	<div class="input-group">
  	  <label><b>First Name</b></label>
	  <input  placeholder="Enter First Name" name="fname" required>
  	</div>
	
	<div class="input-group">
  	  <label><b>Last Name</b></label>
	  <input  placeholder="Enter Last Name" name="lname" required>
  	</div>
	
  	<div class="input-group">
  	  <label><b>Phone Number</b></label>
	  <input  placeholder="Enter Phone Name" name="phone" required>
  	</div>
	
  	<div class="input-group">
  	  <label><b>Email</b></label>
  	  <input type="email" placeholder="Enter Email" name="email" required>
  	</div>
	
  	<div class="input-group">
  	  <label><b>Password</b></label>
  	  <input type="password" placeholder="Enter Password" name="password" required>
  	</div>
  	<div class="input-group">
  	  <label><b>Confirm password</b></label>
  	  <input type="password" placeholder="Confirm Password " name="password2" required>
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="submit">Register</button>
  	</div>
	<p class="member">
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
  	
  </form>
</body>
</html>