<?php
session_start();
?>



<!DOCTYPE html>
<html>
<head>
<title>Social Network</title>

<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
<link rel="shortcut icon" type="image/x-icon" href="Images/icon.ico">

</head>

<body bgcolor="beige" background="Images/3.jpg" style="background-size:cover">

	<div style="color:floralwhite">
		<h1  style="Impact, Charcoal, sans-serif; padding-bottom:50px;"><center>SOCIAL NETWORK</center></h1>

	</div>
<div class="container">	
	
		<div>
			<div class="jumbotron"  style="width:500px; float:right; margin-right:-100px; margin-top:50px; opacity:0.85">
			<form action="profile.php" method="POST" class="form-horizontal">
		    <div class="form-group">
		      <label>Username:</label>
		      <input type="text" class="form-control" placeholder="Username" name="user" required>
		    </div>
		    <div class="form-group">
		      <label>Password:</label>
		      <input type="password" class="form-control" placeholder="Password" name="pass" required>
		    </div>
		    <button type="submit" class="btn btn-primary">Login</button>
			</form>
<br>
<label><h3>Not a member ?</h3></label>


			
		
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Register</button>
</div>

  <!-- Modal -->
  <div class="modal" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      
      
   

    		<div class="jumbotron">
    			<div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Register</h4>
        </div>
			
			<form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
				<table class="table">
					<tr> 
						
						<td >First Name :</td>
						<td><input type="text" size="25" class="form-control" placeholder="First Name" name="fname" required></td>
					</tr>
					<tr>
						<td>Last Name :</td>
						<td><input type="text" size="25" class="form-control" placeholder="Last Name" name="lname" required></td>
					</tr>
					<tr>
						<td>Gender :</td>
						<td><input type="radio" name="sex" value="Male" required>&nbsp;&nbsp;Male
							&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" name="sex" value="Female" required>&nbsp;&nbsp;Female</td>
					</tr>
					<tr>
						<td>Username :</td>
						<td><input type="text" size="25" class="form-control" placeholder="User name" name="user" required></td>
					</tr>
					<tr>
						<td>Email Id :</td>
						<td><input type="email" size="25" class="form-control" placeholder="Email-id" name="email" required></td>
					</tr>
					<tr>
						<td>Password :</td>
						<td><input type="password" size="25" class="form-control" placeholder="Password" name="pass" required></td>
					</tr>
					<tr>
						<td>Date of Birth :</td>
						<td><input type="date" size="25" class="form-control" name="dob" required></td>
					</tr>
					<tr>
						<td>Mobile :</td>
						<td><input type="number" size="25" class="form-control" placeholder="Mobile No." name="mob" required></td>
					</tr>
					<tr>
						<td>Home Town :</td>
						<td><input type="text" size="25" class="form-control" placeholder="Home Town" name="home" required></td>
					</tr>
					<tr>
						<td>Current City :</td>
						<td><input type="text" size="25" class="form-control" placeholder="Current City" name="current" required></td>
					</tr>
					<tr>
						<td><button type="submit" name="reg" class="btn btn-primary" >Register</button></td>
						<td><button type="reset" class="btn btn-primary">Reset</button></td>
					</tr>
			</form>
			
			
		</div>
	 </div>
	 </div>
  </div>





<footer>
<?php


if(isset($_POST['reg']))
{ 
require 'database.php';

$user=$_POST['user'];
$pass=sha1($_POST['pass']);
$name=$_POST['fname'];
$lname=$_POST['lname'];
$email=$_POST['email'];
$sex=$_POST['sex'];
$dob=$_POST['dob'];
$mob=$_POST['mob'];
$home=$_POST['home'];
$current=$_POST['current'];



/*$sql= "CREATE DATABASE myDB";
if(mysqli_query($conn,$sql))
	echo "Database created";
else {
    echo "Error creating database: " . mysqli_error($conn);
}*/

/*$sql="CREATE TABLE userdetails (
	username varchar(20),
	password varchar(100))";
if(mysqli_query($conn,$sql))
	echo "Table created";
else {
    echo "Error creating table: " . mysqli_error($conn);
}*/

if(isset($user)&&isset($pass)&&isset($name))
{

$chk=0;
$sql= "SELECT username FROM userdetails";
$result=mysqli_query($conn,$sql);
$i=0;
if(mysqli_num_rows($result)>0)
{
	while($rows = mysqli_fetch_assoc($result))
	{
		if($user===$rows["username"])
			{	
				$chk=1;
			}
			
	}
}


	$sql= "INSERT INTO userdetails VALUES('$name','$user','$pass')";
	if(mysqli_query($conn,$sql))
	{	$sql="INSERT INTO user VALUES('$user','$name','$lname','$dob','$sex','$email','$home','$current','$mob')";
		if(mysqli_query($conn,$sql))
		{

			echo "<script>alert(\"Resistration Successful\")</script>";
		}
		
		else
			die(mysqli_error($sql));
		

	}
	if($chk==1)
	{
		echo "<script>alert(\"User already registered !!!!\")</script>";
	}



}
else
{
	header('Location: main.php');
}

mysqli_close($conn);

}
?>



</footer


</body>


</html>