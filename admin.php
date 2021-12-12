<?php
session_start();
include "connection.php";
if (isset($_SESSION['admin'])) {
	header("location: adminhome.php");
}
if (isset($_POST['password']))  {
	$password = mysqli_real_escape_string($conn , $_POST['password']);
	$adminpass = '$2y$10$8WkSLFcoaqhJUJoqjg3K8eWixJWswsICf7FTxehKmx8hpmIKYWqju';
	if (password_verify($password , $adminpass)) {
		$_SESSION['admin'] = "active";
		header("Location: adminhome.php");
	}
	else {
		echo  "<script> alert('wrong password');</script>";
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

			</div>
		</header>

		<main>
		<div class="container">
				<p style="font-size:25px">Enter Password:</p>
				<form method="POST" action="">
				<input style="font-size:large" type="password" name="password" required="" >
				<input style="font-size:large" type="submit" name="submit" value="Login"> 

			</div>


		</main>

		<footer>
			<div class="container">
				Copyright @ E-learning
			</div>
		</footer>

	</body>
</html>