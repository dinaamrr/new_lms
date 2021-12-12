<?php session_start(); ?>
<?php include "connection.php";
if (isset($_SESSION['admin'])) {

if(isset($_POST['submit'])) {
	$timer = $_POST['timer'];
	$query = "UPDATE `questions` SET `timer` = '$timer' " ;
	$run = mysqli_query($conn , $query) or die(mysqli_error($conn));
	/*if (mysqli_affected_rows($conn) > 0 ) {
		echo "<script>alert('Question successfully added'); </script> " ;
	}
	else {
		"<script>alert('error, try again!'); </script> " ;
	}
	*/
}

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
				<h2 style="color: black">Add Time</h2>
				<form method="post" action="">

					<p>
						<input type="text" name="timer" required="">
					</p>
					
					
					
					<p>
						
						<input type="submit" name="submit" value="Submit">
					</p>
				</form>
			</div>
		</main>

		

	</body>
</html>

<?php } 
else {
	header("location: admin.php");
}
?>