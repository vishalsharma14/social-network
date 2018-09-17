
<?php
$server="localhost";
$username="root";
$password="";
$dbname="myDB";


if(isset($_POST['user'])&&isset($_POST['pass']))
{	session_start();
	$user=$_POST['user'];
    $pass=$_POST['pass'];
    $_SESSION['aduser']=$user;
    $_SESSION['adpass']=$pass;
}

else
{	//$SA = (session_status() == PHP_SESSION_ACTIVE);
	session_start();
	if(!isset($_SESSION['aduser']))
		header('location:admin.html');
	else
	{
		$user=$_SESSION['aduser'];
		$pass=$_SESSION['adpass'];
	}
	
}



$conn=mysqli_connect($server,$username,$password,$dbname);

if(isset($user)&&isset($pass))
{
$login=0;
$sql= "SELECT* FROM admin";
$result=mysqli_query($conn,$sql);
$i=0;
if(mysqli_num_rows($result)>0)
{
	while($rows = mysqli_fetch_assoc($result))
	{
		if($user==$rows["username"]&&$pass===$rows["password"])
			{					
				$login=1;
			}
			
	}
}

if($login==0)
{
	echo "Invalid Username or Password";
}
else
{
?>

<!DOCTYPE html>
<html>
<head>
<title>Home Page</title>

<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body bgcolor="beige" background="24.jpg">
<div>
	<h3>Welcome ADMINISTRATOR!!!!!</h3>
<div class="top">
	<ul>
		<li><a href="admin.php">Delete All</a></li>
		<li><a href="Delete All.php">Delete All</a></li>
		<li><a href="View Users.php">View Users</a></li>
		<li><a href="signout.php">SIGN OUT</a></li>

	</ul>
	


</div>



</div>

</body>


</html>

<?php
}
}

else
{
	header('location: admin.html');
}

mysqli_close($conn);

?>

