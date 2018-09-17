<?php
session_start();
if(isset($_SESSION['user']))
{
	$user=$_SESSION['user'];
	if(isset($_POST['friend']))
	$f=trim($_POST['friend']);
	else
		$f=0;
	$l=(strlen($f));
	if(!isset($_POST['friend']))
		{
			$_POST['friend']="";
			$l=0;
		}
	
	if($l!=0)
	{	
		$friend=$_POST['friend'];
		require 'database.php';

		$sql="SELECT username,Name from userdetails";
		$result=mysqli_query($conn,$sql);
		$f=0;
		$fr=array();
		$fu=array();
		if(mysqli_num_rows($result)>0)
		{
			while($rows=mysqli_fetch_assoc($result))
			{
				if($rows["username"]!=$user)
				{
					if(stripos($rows["Name"],$friend)!==false)
					{
						$fr[]=$rows["Name"]."<br>";
						$fu[]=$rows["username"];
						$f=1;
					}
				}
			}
		}



	}

	else
	{
		$friend=$_POST['friend'];
		require 'database.php';

		$sql="SELECT username,Name from userdetails";
		$result=mysqli_query($conn,$sql);
		$f=0;
		$fr=array();
		if(mysqli_num_rows($result)>0)
		{
			while($rows=mysqli_fetch_assoc($result))
			{
				if($rows["username"]!=$user)
				{
					
						$fr[]=$rows["Name"]."<br>";
						$fu[]=$rows["username"];
						$f=1;
				
				}
			}
		}

	}
}
else
{
	header('location: login.php');
}

$friend=array();
$sql="SELECT* FROM friends";
$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)>0)
		{
			while($rows=mysqli_fetch_assoc($result))
			{
				if($user==$rows['username'])
				$friend[]=$rows["friend"];	
			}
		}
$sql="SELECT* FROM request";
$req=array();
$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)>0)
		{
			while($rows=mysqli_fetch_assoc($result))
			{
				if($user==$rows['request'])
				$req[]=$rows["username"];	
			}
		}


?>


						<!DOCTYPE html>
						<html>						
						<head>
						<title>Search Results</title>
<link rel="shortcut icon" type="image/x-icon" href="Images/icon.ico" />

						 <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
						<style type="text/css" src="script.js"></style>
						</head>

						<body bgcolor="beige" background="24.jpg">
						<div>
			<?php include('common.php'); ?>
							


						</div>
						
						<div  class="jumbotron" id="searchback">

							<br>
							<br>
							<table align="center" class="table" style="width:700px">
								
<?php
$status=array();


for($i=0;$i<count($fu);$i++)
{	
	$status[]="Add Friend";
}

for($i=0;$i<count($fu);$i++)
{ for($j=0;$j<count($friend);$j++)
	{
		if(!strcmp($fu[$i],$friend[$j]))
		{
			$status[$i]="Friend";
		}
	}
}


for($i=0;$i<count($fu);$i++)
{ for($j=0;$j<count($req);$j++)
	{
		if(!strcmp($fu[$i],$req[$j]))
		{
			$status[$i]="Requested";
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
	$b="b".$i;
	?>
	<tr class="rowback"><td><img src="<?php 
			if($statpic==0)
			{
				echo $target1;
			}
			else
			{
				echo "Images/person.png";
			}

			?>" width="80px" height="80px" class="img-circle"></td>

		<?php
	?>
	<td><form action="userprofile.php" method="POST" class="fpro">
				<input type="hidden" value="<?php echo $fu[$i]; ?>" name="upr">
				<button type="submit" class="btn btn-link"><h2><?php echo $fr[$i]; ?></h2></button>
			</form></td>
	<?php
	$a=$fu[$i];
	$temp="searched".$i;
	//$_SESSION['friend']=$a;

?>
	<?php 
	if($status[$i]!="Requested"&&$status[$i]!="Friend")
			{ ?>
	<td><form action="add.php" method="POST">
		<input type="hidden" name="<?php echo $temp ?>" value="<?php echo $a?>">
		<br>
		<input type="submit" class="btn btn-primary" name="submit" value="<?php echo'+ Add Friend'; ?>" >
		

	</form></td>
		<?php 
		}
		else
		{
			?>
			<td>
				<br><input type="submit" class="btn btn-primary" name="submit" value="<?php echo $status[$i] ?>"></td>
	
	

<?php
}
echo"</tr>";
}
if($f==0)
	echo "<h3 align=\"center\">No user found!!!!!</h3>";



?>
									
							</table>

						</div>

						</div>

						</body>


						</html>