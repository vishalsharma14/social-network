<?php
require 'database.php';
session_start();
	if(!isset($_SESSION['user']))
		header('location:main.php');


$uname=$_SESSION['name'];
$user=$_SESSION['user'];

if(isset($_POST['upr']))
{
	$user=$_POST['upr'];
}





 $sql="SELECT* from user";
    $result=mysqli_query($conn,$sql);
		
		if(mysqli_num_rows($result)>0)
		{
			while($rows = mysqli_fetch_assoc($result))
			{
				if($user===$rows["username"])
					{	$fname=$rows["firstname"];
						$lname=$rows["lastname"];
						$dob=$rows["birthday"];
						$sex=$rows["gender"];
						$usname=$rows["username"];
						$email=$rows["email"];
						$home=$rows["hometown"];	
						$current=$rows["currentplace"];		
						$mob=$rows["mobile"];			
						
					}
					
			}
		}
		$date=$dob[8].$dob[9]."-".$dob[5].$dob[6]."-".$dob[0].$dob[1].$dob[2].$dob[3];


$target="upload/$user."."jpg";
$ex=1;
if (file_exists($target)) {
    
    $ex = 0;
}

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
</head>

<body bgcolor="beige" background="24.jpg">
<div>
	
		<?php include('common.php'); ?>
		<br>
		





		</div>
		<div class="jumbotron col-md-12">

		<br>
		<br>

		<div class="col-md-4" >
			<img src="<?php 
			if($ex==0)
			{
				echo $target;
			}
			else
			{
				echo "Images/person.png";
			}

			?>" width="250px" height="250px">
			
			<?php echo "<h2>&nbsp;&nbsp;".$fname." ".$lname."</h2>"; 
			echo '<div class="jumbotron col-md-6">';
			if(!isset($_POST['upr']))
			{ 
				?>
			<form action="upload.php" method="post" enctype="multipart/form-data" align="center">
		    <b>Update Profile Pic :</b>
		    <input type="file" name="fileToUpload" id="fileToUpload" style="width:250px; margin-top:10px" class="btn btn-primary">
		    <button type="submit" name="submit" style="width:100px; height:30px; margin-top:10px" class="btn btn-primary">Update</button>
			</form>
			<?php
			}
			?>
			</div>
	

</div>
<div class="col-md-8">
			
			<table class="table">
				<tr>
					<th>Personal Information</th>
				</tr>
				<tr>
					<td>First Name :</td>
					<td><?php echo $fname;?></td>
				</tr>
				<tr>
					<td>Last Name :</td>
					<td><?php echo $lname;?></td>
				</tr>
				<tr>
					<td>Birthday :</td>
					<td><?php echo $date;?></td>
				</tr>
				<tr>
					<td>Gender :</td>
					<td><?php echo $sex;?></td>
				</tr>
				<tr>
					<td>User Name :</td>
					<td><?php echo $usname;?></td>
				</tr>
				<tr>
					<td>Email-id :</td>
					<td><?php echo $email;?></td>
				</tr>
				<tr>
					<td>Mobile No. :</td>
					<td><?php echo $mob;?></td>
				</tr>
				<tr>
					<td>Hometown :</td>
					<td><?php echo $home;?></td>
				</tr>
				<tr>
					<td>Current City :</td>
					<td><?php echo $current;?></td>
				</tr>


			</table>
			
		</div>



</div>
</div>

</body>

</html>


<?php





mysqli_close($conn);

?>