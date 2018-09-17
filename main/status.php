<?php
require 'database.php';

session_start();
	if(!isset($_SESSION['user']))
		header('location:main.php');


$user=$_SESSION['user'];

if(isset($_POST['status']))
{
	$status=$_POST['status'];
}
else
	header('location:profile.php');




$sql="INSERT into status VALUES('$user','$status')";
if(mysqli_query($conn,$sql));
{
	header('location:profile.php');
}


mysqli_close($conn);

?>