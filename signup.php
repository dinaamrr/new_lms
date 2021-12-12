<?php
session_start();
include "connection.php";
?>
<?php 
if (isset($_SESSION['id'])) {
	header("location: index.php");
}
?>
<?php
if (isset($_POST['email'])) {
$email = mysqli_real_escape_string($conn , $_POST['email']);
$password =  $_POST['password'];
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
	$checkmail = "SELECT * from users WHERE email = '$email' && password = '$password'";
	$runcheck = mysqli_query($conn , $checkmail) or die(mysqli_error($conn));
    if (!(mysqli_num_rows($runcheck) > 0)) {
		$played_on = date('Y-m-d H:i:s');
		$query = "INSERT INTO users(email,played_on,password) VALUES ('$email','$played_on','$password')";
		$run = mysqli_query($conn, $query) or die(mysqli_error($conn)) ;
		if (mysqli_affected_rows($conn) > 0) {
			$query2 = "SELECT * FROM users WHERE email = '$email' && password = '$password' ";
			$run2 = mysqli_query($conn , $query2) or die(mysqli_error($conn));
			if (mysqli_num_rows($run2) > 0) {
				$row = mysqli_fetch_array($run2);
				$id = $row['id'];
				$_SESSION['id'] = $id;
				$_SESSION['email'] = $row['email'];
				header("location: index.php");
			}
		}
	}
	else{
		
		//header("location: index.php");
		echo "<script> alert('user already exists'); </script>";
	}
}
}
?>
<html>
	<head>
		<title>Signup</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>

	<body>
		<header>
			<div class="container">
				<h1 style="padding-bottom: 30px;">Register</h1>
				<a href="index.php" class="start">Home</a>
				<!-- <a href="admin.php" class="start">Admin Panel</a> -->


			</div>
		</header>

		<main>
		<div class="container">
				<p>Enter Your Email:</p>
				<form method="POST" action="">
				<input  style="font-size:large" type="email" name="email" required="" >
                <p>Enter Your Password:</p>
				<form method="POST" action="">
				<input  style="font-size:large" type="password" name="password" required="" >
				<input   style="font-size:large" type="submit" name="submit" value="Register" >

			</div>

		</main>

		<footer>
			<div class="container">
				Copyright @ E-learning
			</div>
		</footer>

	</body>
</html>