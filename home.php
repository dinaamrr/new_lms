<?php 
session_start();
include "connection.php";
if (isset($_SESSION['id'])) {
$query = "SELECT * FROM questions";
$run = mysqli_query($conn , $query) or die(mysqli_error($conn));
$total = mysqli_num_rows($run);
$queryt = "SELECT timer FROM questions" ;
			$runt = mysqli_query($conn , $queryt) or die(mysqli_error($conn));
			
			$rowt = mysqli_fetch_row($runt);
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
			</div>
		</header>

		<main>
			<div class="container">
				<h2>Welcome to Online Quiz !</h2>
				<p>This is just a simple quiz to test your knowledge!</p>
				<ul>
				    <li><strong>Number of questions: </strong><?php echo $total; ?></li>
				    <li><strong>Type: </strong>Multiple Choice</li>
				    <li><strong>Estimated time: </strong><?php echo implode("",$rowt); ?> minutes</li>
				     <li><strong>Score: </strong>   &nbsp; +1 point for each correct answer</li>
				</ul>
				<a href="question.php?n=1" class="start">Start Quiz</a>
				<a href="exit.php" class="add">Exit</a>

			</div>
		</main>

		<footer>
			<div class="container">
				Copyright @ E-learning
			</div>
		</footer>

	</body>
</html>
<?php unset($_SESSION['score']); ?>
<?php }
else {
	header("location: index.php");
}
?>