<?php 
include('config.php');
if (isset($_POST['submit'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $fname = mysqli_real_escape_string($db, $_POST['fname']);
  $lname = mysqli_real_escape_string($db, $_POST['lname']);
  $phone = mysqli_real_escape_string($db, $_POST['phone']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  $password2 = mysqli_real_escape_string($db, $_POST['password2']);
  $creditCardNo = mysqli_real_escape_string($db, $_POST['creditCardNo']);
  $creditCardPin = mysqli_real_escape_string($db, $_POST['creditCVC']);
  
  
  if ($password != $password2) {
	array_push($errors, "The two passwords do not match");
  }
  
  $check_email = $db->query("SELECT Email FROM usern WHERE Email='$email'");
  $count=$check_email->num_rows;
  if($count==1){array_push($errors, "Email already exists.");}
  
  $check_email = $db->query("SELECT Email FROM usern WHERE creditCardNo='$creditCardNo'");
  $count=$check_email->num_rows;
  if($count==1){array_push($errors, "Credit Card Number already exists.");}
  
  $check_email = $db->query("SELECT Email FROM usern WHERE phoneno='$phone'");
  $count=$check_email->num_rows;
  if($count==1){array_push($errors, "Phone number already exists.");}
  
  $check_user = md5($username);
  $check_email = $db->query("SELECT Email FROM usern WHERE username='$check_user'");
  $count=$check_email->num_rows;
  if($count==1){array_push($errors, "Username already exists.");}
  
  if (count($errors) == 0) {
  	$password = md5($password);
	$username = md5($username);
  	$query = $db->query("INSERT INTO usern (username, email, password, phoneNo, firstName, LastName, creditCardNo, CreditCardPin) 
  			  VALUES('$username', '$email', '$password', $phone, '$fname', '$lname', $creditCardNo, $creditCardPin)");
	
	$query2=$db->query("SELECT * FROM usern WHERE Username='$username'");
	$userRow=$query2->fetch_array();
	
	$qq=$db->query("INSERT INTO buyer (CreditCardNo, UserID, Email, PhoneNo, Username)
			  VALUES($userRow[CreditCardNo], $userRow[UserID], '$userRow[Email]', $userRow[PhoneNo], '$userRow[Username]')");
	
	$qq=$db->query("INSERT INTO seller (UserID, Email, PhoneNo, Username)
			  VALUES($userRow[UserID], '$userRow[Email]', $userRow[PhoneNo], '$userRow[Username]')");
	
	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
	
	if ($_POST['user'] == "buyer"){header('location: buyer.php');}
	if ($_POST['user'] == "seller"){header('location: seller.php');}
   }
}
$db->close();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
  <link rel="stylesheet" href="css/style.css">

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
  	  <label><b>Username</b></label>
	  <input placeholder="Enter Username" name="username" required>
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
	  <input type="number" placeholder="Enter Phone Name" name="phone" required>
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

	 <div class="input-group">
	      <div class="col-half">
        <h4>Type of User</h4>
        <div class="input-group">
          <input type="radio" name="user" value="buyer" id="user-buyer" checked="true"/>
          <label for="user-buyer">Buyer</label>
          <input type="radio" name="user" value="seller" id="user-seller"/>
          <label for="user-seller">Seller</label>
        </div>
      </div>
      </div>
	<div class="row">
      <h4>Payment Details</h4>
	  <label><b>Credit Card Number</b></label>

      <div class="input-group input-group-icon">
	  
        <input type="Number" placeholder="Card Number" name="creditCardNo" required>
        <div class="input-icon"><i class="fa fa-credit-card"></i></div>
      </div>
	  <label><b>Credit Card CVC</b></label>

      <div class="col-half">
        <div class="input-group input-group-icon">
          <input type="Number" placeholder="Card CVC" name="creditCVC" required>
          <div class="input-icon"><i class="fa fa-user"></i></div>
        </div>
      </div>
    </div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="submit">Register</button>
  	</div>
	<p class="member">
  		Already a member? <a href="index.php">Sign in</a>
  	</p>
  	
  </form>
 
</body>
</html>