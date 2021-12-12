<?php 
session_start();
if (isset($_SESSION['admin'])) {
?>




<!DOCTYPE html>
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
				<a href="add.php" class="start">Add Question</a>
				<a href="allquestions.php" class="start">All Questions</a>
				<a href="time.php" class="start">Add Time</a>
				<a href="students.php" class="start">Students</a>
				<a href="exit.php" class="start">Logout</a>

			</div>
		</header>

		<main>
			<div class="container">
				<h2>Welcome back, Admin</h2>
				</div>
				</main>
				</body>
				</html>

				<?php } 
				else {
				header("location: admin.php");
				}
				?>