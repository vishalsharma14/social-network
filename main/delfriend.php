<?php
session_start();
if(isset($_SESSION['user'])&&isset($_POST['unfr']))
{
	$fuser=$_POST['fr'];
	$user=$_SESSION['user'];
	require 'database.php';

	$sql="DELETE FROM friends where username='$user' and friend='$fuser'";

	if(mysqli_query($conn,$sql))
	{	
		$sql1="DELETE FROM friends where username='$fuser' and friend='$user'";

		if(mysqli_query($conn,$sql1))
		{	
			
			header('location:viewfriends.php');
		}
	}
	else
	{
		echo "error!!!";
	}
}

else
{
	header('location:viewfriends.php');
}






?>