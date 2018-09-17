<?php

session_start();
if(isset($_SESSION['user']))
{
	//$a=$_SESSION['friend'];
	for($i=0;$i<100;$i++)
	{	$t="searched".$i;
		if(isset($_POST[$t]))
		{
			$a=$_POST[$t];
		}
	}
	$user=$_SESSION['user'];
	require 'database.php';

		$sql="INSERT INTO request VALUES('$a','$user')";
		
?>
			<!DOCTYPE html>
			<html>
			<head>
			<title>Home Page</title>
			 <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
			<style type="text/css" src="script.js"></style>
			</head>

			<body bgcolor="beige" background="24.jpg">
			<div>
			<div class="nav">
			<nav id="primary_nav_wrap">
			<ul>
				<li><a href="profile.php"><span>HOME</span></a></li>
				<li><a href="#"><span>PROFILE</span></a></li>
				<li><a href=""><span>FRIENDS</span></a>
					<ul>
						<li><a href="viewfriends.php">FRIEND LIST</a></li>
						<li><a href="requests.php">FRIEND REQUESTS</a></li>
					</ul>
				</li>
				
				<li>
				<form action="search.php" method="POST">
				<input type="text" placeholder="Search friend" name="friend" class="searchbox">
				</li>
				<li>
				    <button type="submit" class="search"></button>
					</form>
				</li>

						
				
				<li style="float:right"><a href=""><span>OPTIONS</span></a>
					<ul>
						<li><a href="chngpass.php">Change Password</a></li>
						<li><a href="signout.php">Sign Out</a></li>
					</ul>

				</li>
			</ul>

			</nav>
		</div>
		

			<?php 
			if($q=mysqli_query($conn,$sql))
		{	
				?>

			<h3 align="center"><?php echo "Request Sent"; ?></h3>
			<?php
			header('location:search.php');
		    }
		    else
		    {
		    ?>
			<h3 align="center"><?php echo "Already Requested!!!!"; ?></h3>
			<?php 
			}
			 ?>

			</div>

			</body>


			</html>
		<?php



}
else
header('location: login.php');

?>