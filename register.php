<?php 

$host ='localhost';
        $user = 'root';
        $pass = '';
        $db = 'carweb';
        $con = mysqli_connect($host,$user,$pass,$db);

error_reporting(0);

session_start();

if (isset($_SESSION['name'])) {
    header("Location: ./add-car.php");
}

if (isset($_POST['submit'])) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$cpassword = md5($_POST['cpassword']);
    $phone = $_POST['phone'];


	if ($password == $cpassword) {
		$sql = "SELECT * FROM users WHERE email='$email'";
		$result = mysqli_query($conn, $sql);
		if (!$result->num_rows > 0) {
			$sql = "insert into users (name, email, password, phone)
					values ('$name', '$email', '$password','$phone')";
			$result = mysqli_query($con, $sql);
			if ($result) {
				echo "<script>alert('Wow! User Registration Completed.')</script>";
				$name = "";
				$email = "";
				$_POST['password'] = "";
				$_POST['cpassword'] = "";
                $phone = "";
			} else {
				echo "<script>alert('Woops! Something Wrong Went.')</script>";
			}
		} else {
			echo "<script>alert('Woops! Email Already Exists.')</script>";
		}
		
	} else {
		echo "<script>alert('Password Not Matched.')</script>";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="register.css">

	<title>Auth</title>
</head>
<body>
	<div class="container">
		<form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>
			<div class="input-group">
				<input type="text" placeholder="Name" name="name" value="<?php echo $name; ?>" required>
			</div>
			<div class="input-group">
				<input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
                </div>
            <div class="input-group">
				<input type="password" placeholder="Confirm Password" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required>
			</div>
            <div class="input-group">
				<input type="text" placeholder="Phone" name="phone" value="<?php echo $phone; ?>" required>
			</div>
			<div class="input-group">
				<button name="submit" class="btn">Register</button>
			</div>
			<p class="login-register-text">Have an account? <a href="./login.php">Login Here</a>.</p></br>
			<a href="./index.php">Or view our cars</a>
		</form>
	</div>
</body>
</html>