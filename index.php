<?php
session_start();
include "connection.php";
?>
<?php 
if (isset($_SESSION['id'])) {
	header("location: home.php");
}
?>
<?php
if (isset($_POST['email'])) {
$email = mysqli_real_escape_string($conn , $_POST['email']);
$password =  $_POST['password'];
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
	$checkmail = "SELECT * from users WHERE email = '$email' && password = '$password'";
	$runcheck = mysqli_query($conn , $checkmail) or die(mysqli_error($conn));
	if (mysqli_num_rows($runcheck) > 0) {
		$played_on = date('Y-m-d H:i:s');
		$update = "UPDATE users SET played_on = '$played_on' WHERE email = '$email' ";
		$runupdate = mysqli_query($conn , $update) or die(mysqli_error($conn));
		$row = mysqli_fetch_array($runcheck);
			$id = $row['id'];
			$_SESSION['id'] = $id;
			$_SESSION['email'] = $row['email'];
		header("location: home.php");
	}
	else {
 		echo "<script> alert('wrong combination'); </script>";
}
}
else {
	echo "<script> alert('Invalid Email'); </script>";
}
}



?>

<html>
	<head>
		<title>Online Quiz</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>

	<body>
		<header>
			<div class="container">
				<h1 style="padding-bottom: 30px;">Online Quiz</h1>
				<a href="index.php" class="start">Home</a>
				<a href="admin.php" class="start">Admin Panel</a>

			</div>
		</header>

		<main>
		<div class="container">
				<p style="font-size: 25px" >Enter Your Email:</p>

				<form method="POST" action="">
				<input  style="font-size:large" type="email" name="email" required="" >
                <p style="font-size: 25px " >Enter Your Password:</p>
				<form method="POST" action="">
				<input  style="font-size:large" type="password" name="password" required="" >
				<input  style="font-size:large" type="submit" name="submit" value="Login">
				<p style="font-size: 15px">Don't have an account.?<a href="signup.php"><u>Register here.</u></a></p>

			</div>

		</main>

		<footer>
			<div class="container">
				Copyright @ E-learning
			</div>
		</footer>

	</body>
</html>