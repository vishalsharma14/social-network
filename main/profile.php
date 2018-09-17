<?php
require 'database.php';


if(isset($_POST['user'])&&isset($_POST['pass']))
{	session_start();
	$user=$_POST['user'];
    $pass=sha1($_POST['pass']);
    $_SESSION['user']=$user;
    $_SESSION['pass']=$pass;
    $sql="SELECT* from userdetails";
    $result=mysqli_query($conn,$sql);
		
		if(mysqli_num_rows($result)>0)
		{
			while($rows = mysqli_fetch_assoc($result))
			{
				if($user===$rows["username"])
					{	$uname=$rows["Name"];						
						
					}
					
			}
		}





    $_SESSION['name']=$uname;
}

else
{	//$SA = (session_status() == PHP_SESSION_ACTIVE);
	session_start();
	if(!isset($_SESSION['user']))
		header('location:login.php');
	else
	{
		$user=$_SESSION['user'];
		$pass=$_SESSION['pass'];
		$uname=$_SESSION['name'];
	}
	
}



$target="upload/$user."."jpg";
$ex=1;
if (file_exists($target)) {
    
    $ex = 0;
}



$login=0;
$sql= "SELECT* FROM userdetails";
$result=mysqli_query($conn,$sql);
$i=0;
if(mysqli_num_rows($result)>0)
{
	while($rows = mysqli_fetch_assoc($result))
	{
		if($user===$rows["username"]&&$pass===$rows["password"])
			{	$n=$rows["Name"];
				$u=$rows["username"];
				
				//echo "Login Successful <br> <h1>Welcome ".$rows["Name"]."</h1>";
				//echo "E-mail id : ".$rows["email"];
				
				$login=1;
			}
			
	}
}

if($login==0)
{
	echo "Invalid Username or Password";

	header('location:signout.php');
}

else
{
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $uname ?></title>
<link rel="shortcut icon" type="image/x-icon" href="Images/icon.ico" />

<link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
<style type="text/css" src="script.js"></style>
<script type="text/javascript">
h=590;</script>
</head>

<body bgcolor="beige" background="cover.jpg">
<div>
	
		<?php include('common.php'); ?> 
		<br>
		<div class="jumbotron">
			<form action="status.php" method="POST">
			<textarea class="form-control" rows="5" cols="117" placeholder="What's on ur mind?" background="beige" name="status"></textarea>
			<button class="btn btn-primary btn-lg" type="submit" style="float:right; widht:100px">Post</button>
			</form>

			<br>
			<br>
			<br>
			<div>
			
				<legend>News Feed</legend>
					<?php
					$st=array();
					$u=array();
					$sql="SELECT* from status";
					$result=mysqli_query($conn,$sql);
					if($result)
					{	
						while($rows=mysqli_fetch_assoc($result))
						{
							$u[]=$rows['username'];
							$st[]=$rows['status'];

						}

					}

					$friends=array();
					$sql="SELECT* from friends";
					$result=mysqli_query($conn,$sql);
					while($rows=mysqli_fetch_assoc($result))
					{	if($user==$rows['username'])
						$friends[]=$rows["friend"];
					}




					$fr=array();
					$sql="SELECT* from userdetails";
							$result=mysqli_query($conn,$sql);
						
					
					$i=0;
					$c=array();
					$d=array();
					

					while($rows=mysqli_fetch_assoc($result))
					{	$c[]=$rows["username"];
						$d[]=$rows["Name"];
					}
						

					
						
						$friends[]=$user;
						$per=array();
						$stat=array();

						for($i=0;$i<count($u);$i++)
						{
							for($j=0;$j<count($friends);$j++)
							{
								if($u[$i]==$friends[$j])
								{
									$per[]=$u[$i];
									$stat[]=$st[$i];
								}
							}
						}
						$person=array();

						for($i=0;$i<count($per);$i++)
						{
							for($j=0;$j<count($c);$j++)
							{
								if($per[$i]==$c[$j])
								{
									$person[]=$d[$j];

								
								}
							}
						}

						?>
						<div class="table-responsive">
						<table class="table table-striped">
							<?php

									
		
					for($i=count($stat)-1;$i>=0;$i--)
					{	
						$uss=$per[$i];
						$target1="upload/$uss."."jpg";
						$statpic=1;
						if (file_exists($target1)) {
						    
						    $statpic = 0;
						}
						
							?>
							
							
					
					
						<tr>
							<td>
						<img src="<?php 
						if($statpic==0)
						{
							echo $target1;
						}
						else
						{
							echo "Images/person.png";
						}

						?>" width="80px" height="80px" style="float:left" class="img-circle"></td>
						&nbsp;&nbsp;
						<td><h3><?php echo $person[$i];?> : 			
						&nbsp;&nbsp;
						<?php echo $stat[$i];?></h3></td>
						
						
					
					<?php 
						if($user==$per[$i])
						{ 
							?>
							<td>
						<form action="delstat.php" method="POST" style="float:right">
							<input type="hidden" name="statuser" value="<?php echo $per[$i];?>">
							<input type="hidden" name="statmsg" value="<?php echo $stat[$i];?>">
							<button type="submit" class="btn btn-danger btn-xs" name="statdel">
								<span class="glyphicon glyphicon-remove"></span></button>
						</form>
					</td>
						
					
					<?php
						}
						else 
							echo"<td></td>";
						echo "</tr>";
					}
					?>


		</table></div>


			
		</div>

		</div>

		

		

		</div>
	

</div>




</div>


</body>

</html>


<?php

}




mysqli_close($conn);

?>