<?php
session_start();
if(isset($_SESSION['user'])&&isset($_POST['statdel']))
{
	$suser=$_POST['statuser'];
	$smsg=$_POST['statmsg'];
	require 'database.php';

	$sql="DELETE FROM status where username='$suser' and status='$smsg'";
	if(mysqli_query($conn,$sql))
	{
		header('location:profile.php');
	}
	else
	{
		echo "error!!!";
	}
}

else
{
	header('location:profile.php');
}






?>