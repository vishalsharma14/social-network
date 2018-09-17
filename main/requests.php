<?php
session_start();
if(isset($_SESSION['user']))
{
	$user=$_SESSION['user'];
	
		
		require 'database.php';

		$sql="SELECT* from request";
		$result=mysqli_query($conn,$sql);
		$f=0;
		$fu=array();
		if($result)
		{
			while($rows=mysqli_fetch_assoc($result))
			{
				if($rows["username"]==$user)
				{
						$fu[]=$rows["request"];
						$f=1;

					
				}
			}
		}


		

}
else
{
	header('location: login.php');
}




?>


						<!DOCTYPE html>
						<html>						
						<head>
						<title>Friend Requests</title>
<link rel="shortcut icon" type="image/x-icon" href="Images/icon.ico" />

						 <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
						<style type="text/css" src="script.js"></style>
						</head>

						<body bgcolor="beige" background="24.jpg">
						<div>
						<?php include('common.php'); ?>
						<div class="jumbotron">
							<br>
							<table align="center" class="table" style="width:700px">
								<tr>
<?php
$fr=array();
$sql="SELECT* from userdetails";
		$result=mysqli_query($conn,$sql);
	

/*for($i=0;$i<count($fu);$i++)
{	
	if($result)
		{
			while($rows=mysqli_fetch_assoc($result))
			{	
				if($rows["username"]==$fu[$i])
				{		
						$fr[]=$rows["Name"];
				}
			}
		}
	

}*/

$fr=array();
$sql="SELECT* from userdetails";
		$result=mysqli_query($conn,$sql);
	
$k=0;
$i=0;
$c=array();
$d=array();

while($rows=mysqli_fetch_assoc($result))
{	$c[]=$rows["username"];
	$d[]=$rows["Name"];
}
	

for($i=0;$i<count($fu);$i++)
{	$b=$fu[$i];
	
			for($j=0;$j<count($c);$j++)
			{ 
				if($c[$j]==$b)
				{
						$fr[$k]=$d[$j];
					
						$k++;
					
				}
			}
		

}




for($i=0;$i<count($fr);$i++)
{	

						$uss=$fu[$i];
						$target1="upload/$uss."."jpg";
						$statpic=1;
						if (file_exists($target1)) {
						    
						    $statpic = 0;
						}

	?>
	<tr><td><img src="<?php 
			if($statpic==0)
			{
				echo $target1;
			}
			else
			{
				echo "Images/person.png";
			}

			?>" width="80px" height="80px" class="img-circle" ></td>
		<?php
?>
<td><form action="userprofile.php" method="POST" class="fpro">
				<input type="hidden" value="<?php echo $fu[$i]; ?>" name="upr">
				<button type="submit" class="btn btn-link"><h2><?php echo $fr[$i]; ?></h2></button>
			</form></td>
<?php
//$_SESSION['req']=$fu[$i];
$temp="requested.$i";
$a=$fu[$i];


?>

	<td><form action="accept.php" method="POST">
		<input type="hidden" name="<?php echo "requested" ?>" value="<?php echo $a?>">
		<br>
		<input type="submit" class="btn btn-primary" name="submit1" value="Accept">
	</form></td>
	<td><form action="reject.php" method="POST">
		<input type="hidden" name="rejected" value="<?php echo $a?>">
		<br>
		<input type="submit" class="btn btn-danger" name="submit" value="Reject">
	</form></td>

<?php
}

if($f==0)
		{
			echo "<h2 align=\"center\">No pending request!!!</h2>";
		}



?>
								</tr>	
							</table>

						</div>

						</div>

						</body>


						</html>