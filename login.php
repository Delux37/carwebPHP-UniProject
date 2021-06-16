<?php 

$server = "localhost";
$user = "root";
$pass = "";
$database = "carweb";

$conn = mysqli_connect($server, $user, $pass, $database);

session_start();

error_reporting(0);

if (isset($_SESSION['name'])) {
    header("Location: ./add-car.php");
}

if (isset($_POST['login'])) {
	$email = $_POST['email'];
	$password = md5($_POST['password']);

	$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['name'] = $row['name'];
		$_SESSION['id'] = $row['user_id'];
		header("Location: ./add-car.php");
	} else {
		echo "<script>alert('Woops! Email or Password is Wrong.')</script>";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="register.css">

	<title>Auth</title>
</head>
<body>
	<div class="container">
		<form action="" method="POST">
			<p class="text" style="font-size: 2rem; font-weight: 800;">Login</p>
			<div class="input-group">
				<input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
			</div>
			<div class="input-group">
				<button name="login" class="btn">Login</button>
			</div>
			<p>Don't have an account? <a href="./register.php">register!</a></p></br>
			<a href="./index.php">Or view our cars</a>
		</form>
	</div>
</body>
</html>