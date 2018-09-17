<?php
session_start();
if(isset($_SESSION['user']))
{
	$user=$_SESSION['user'];
	//$req=$_SESSION['req'];
	/*for($i=0;$i<100;$i++)
	{	$t="requested".$i;
		if(isset($_POST[$t]))
		{
			$a=$_POST[$t];
		}
	}*/
		$req=$_POST['rejected'];
		require 'database.php';

		$sql="DELETE FROM request where request='$req'  && username='$user'";
		if(mysqli_query($conn,$sql))
		{	


		

?>


						<!DOCTYPE html>
						<html>						
						<head>
						<title>Home Page</title>
						<link rel="stylesheet" type="text/css" href="style.css">
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
		<div class="leftpane">
			<ul>
				<li><a href="news.php">News Feed</a></li>
				<li><a href="userprofile.php">Profile</a></li>
				<li><a href="messages.php">Messages</a></li>
				<li><a href="vewfriends.php">Friends</a></li>
			</ul>	
		</div>
						</div>
						<div align="center"><h2>Request Deleted!!!</h2></div>
						</body>


						</html>

<?php

}
header('location: requests.php');
}
else
{
	header('location: profile.php');
}

?>