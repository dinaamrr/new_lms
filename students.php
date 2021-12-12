<?php session_start(); ?>
<?php include "connection.php";
if (isset($_SESSION['admin'])) {
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Online Quiz</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/style1.css">
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

		
	<h1> All Students</h1>
	<table class="data-table">
		<caption class="title">All Quiz Students</caption>
		<thead>
			<tr>
			<th>Student Id</th>
			<th>Email</th>
			<th>Taked On</th>
			<th>Score</th>
			</tr>
		</thead>
		<tbody>
		<?php 
            
            $query = "SELECT * FROM users ORDER BY played_on DESC";
            $select_students = mysqli_query($conn, $query) or die(mysqli_error($conn));
            if (mysqli_num_rows($select_students) > 0 ) {
            while ($row = mysqli_fetch_array($select_students)) {
                $id = $row['id'];
                $email = $row['email'];
                $played_on = $row['played_on'];
                $score = $row['score'];
                echo "<tr>";
                echo "<td>$id</td>";
                echo "<td>$email</td>";
                echo "<td>$played_on</td>";
                echo "<td>$score</td>";
              
                echo "</tr>";
             }
         }
        ?>
	
		</tbody>
		
	</table>
</body>
</html>

<?php } 
else {
	header("location: admin.php");
}
?>

