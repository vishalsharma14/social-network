<!DOCTYPE html>
<html>
<head>
 <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
<title>Change Password</title>
<link rel="shortcut icon" type="image/x-icon" href="Images/icon.ico" />

<link rel="stylesheet" type="text/css" href="style.css">

</head>

<body bgcolor="beige" align="center">
<div class="jumbotron" style="height:660px">
<?php include('common.php');?>
<div class="jumbotron" style="width:800px; margin-left:250px" >
	
<h2>Change Password</h2>



<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="form-horizontal"  align="center">
 <div class="form-group" >
 <table class="table" >
 	<tr>
<td><label>Old Password:</label></td>
<td><input type="password" class="form-control" size="25" placeholder="Enter old Password" name="old" required></td>
</tr>
<tr>
<td><label>New Password:</label></td>
<td><input type="password" class="form-control" size="25" placeholder="Enter New Password" name="new" required></td>
</tr>
<tr>
<td><label>Re enter New Password:</label></td>
<td><input type="password" class="form-control" size="25" placeholder="Re Enter New Password" name="new1" required></td>
</tr>
<tr>
	<td>
<button type="submit" class="btn btn-primary" name="submit" style="width:200px"><b>Change Password</b></button>
	</td>
</tr>
</table>


</form>

</div>


<?php
	session_start();
	if(!isset($_SESSION['user']))
		header('location: login.php');
	$user=$_SESSION['user'];
	if(isset($_POST['submit']))
	{	
		$pass=sha1($_POST['old']);
		$n1=sha1($_POST['new']);
		$n2=sha1($_POST['new1']);
		if($n1!=$n2)
			echo "New Passwords do not match";
		else
		{
			require 'database.php';
			
			$login=0;
			$sql= "SELECT* FROM userdetails";
			$result=mysqli_query($conn,$sql);
			$i=0;
			if(mysqli_num_rows($result)>0)
			{
				while($rows = mysqli_fetch_assoc($result))
				{
					if($user===$rows["username"]&&$pass===$rows["password"])
						{	$u=$rows["username"];
							$sql="Update userdetails set password='$n1' where username='$u'";
							if(mysqli_query($conn,$sql))
							echo "Password updated successfully";
							$login=1;
						}
						
				}
			}

			if($login==0)
			{
				echo "Old Password does not match";
			}

			

			mysqli_close($conn);

		}
			
	}
	

?>
</div>
</div>
</body>

</html>