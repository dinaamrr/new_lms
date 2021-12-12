<?php 
session_start();
include "connection.php";
if (isset($_SESSION['id'])) {
	
	if (isset($_GET['n']) && is_numeric($_GET['n'])) {
	        $qno = $_GET['n'];
	        if ($qno == 1) {
	        	$_SESSION['quiz'] = 1;
	        }
	        }
	        else {
	        	header('location: question.php?n='.$_SESSION['quiz']);
	        } 
	        if (isset($_SESSION['quiz']) && $_SESSION['quiz'] == $qno) {
			$query = "SELECT * FROM questions WHERE qno = '$qno'" ;
			$run = mysqli_query($conn , $query) or die(mysqli_error($conn));
			if (mysqli_num_rows($run) > 0) {
				$row = mysqli_fetch_array($run);
				$qno = $row['qno'];
                 $question = $row['question'];
                 $ans1 = $row['ans1'];
                 $ans2 = $row['ans2'];
                 $ans3 = $row['ans3'];
                 $ans4 = $row['ans4'];
                 $correct_answer = $row['correct_answer'];
                 $_SESSION['quiz'] = $qno;
                 $checkqsn = "SELECT * FROM questions" ;
                 $runcheck = mysqli_query($conn , $checkqsn) or die(mysqli_error($conn));
                 $countqsn = mysqli_num_rows($runcheck);
                 $time = time();
                 $_SESSION['start_time'] = $time;
                 $allowed_time = $countqsn * 0.025;
                 $_SESSION['time_up'] = $_SESSION['start_time'] + ($allowed_time * 540) ;
                 

			}
			else {
				echo "<script> alert('something went wrong');
			window.location.href = 'home.php'; </script> " ;
			}
		}
		else {
		echo "<script> alert('error');
			window.location.href = 'home.php'; </script> " ;
	}
?>
<?php 
$total = "SELECT * FROM questions ";
$run = mysqli_query($conn , $total) or die(mysqli_error($conn));
$totalqn = mysqli_num_rows($run);

?>
<html>
	<head>
		<title>online-quiz</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>

	<body>
		<header>
			<div class="container">
				<h1>online-quiz</h1>
			</div>
		</header>

		<main>
			<div class= "container">
			<div id="count"></div>
				<div class= "current">Question <?php echo $qno; ?> of <?php echo $totalqn; ?></div>
				<p class="question"><?php echo $question; ?></p>
				<form method="post" action="process.php">
					<ul class="choices">
					   <li><input name="choice" type="radio" value="a" required=""><?php echo $ans1; ?></li>
					   <li><input name="choice" type="radio" value="b" required=""><?php echo $ans2; ?></li>
					   <li><input name="choice" type="radio" value="c" required=""><?php echo $ans3; ?></li>
					   <li><input name="choice" type="radio" value="d" required=""><?php echo $ans4; ?></li>
					 
					</ul>
					<input style="font-size: large;" type="submit" value="Submit"> 
					<input type="hidden" name="number" value="<?php echo $qno;?>">
					<br>
					<br>
					<?php
					if ($_SESSION['quiz'] == 1){
					$query = "SELECT timer FROM questions" ;
			$run = mysqli_query($conn , $query) or die(mysqli_error($conn));
			
			$row = mysqli_fetch_array($run);
			
					$sec = $row[0] * 60;

					$_SESSION['counters'] = $sec;
					echo "<script>
						var count = ".$sec.";
						var interval = setInterval(function(){
  						document.getElementById('count').innerHTML=count;
  						count--;
  						document.cookie = 'timer=' + count;
  						if (count === 0){
    						clearInterval(interval);
    						window.location.href='results.php';
   
   						   
  								}
						}, 1000);
				
					</script>";						
					}
					else{
						echo "<script>
						
						var count =".$_COOKIE['timer'].";
						
						var interval = setInterval(function(){
  						document.getElementById('count').innerHTML=count;
  						count--;
  						document.cookie = 'timer=' + count;
  						if (count === 0){
    						clearInterval(interval);
   
   						    window.location.href='results.php';
  								}
						}, 1000);

						</script>";
					}


					
					?>
					
					<a href="results.php" class="start">Stop Quiz</a>

					
					
					
				</form>
			</div>
		</main>
</body>
</html>

<?php } 
else {
	header("location: home.php");
}
?>