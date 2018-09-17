<?php
$server="localhost";
$username="root";
$password="";
$dbname="myDB";




$conn=mysqli_connect($server,$username,$password,$dbname);


$login=0;
$u=array();
$e=array();
$n=array();
$sql= "SELECT* FROM userdetails";
$result=mysqli_query($conn,$sql);
$i=0;
echo "List of Users <br><br>";
if(mysqli_num_rows($result)>0)
{
	while($rows = mysqli_fetch_assoc($result))
	{
		
				
			$u[$i]=$rows["username"];
			$e[$i]=$rows["email"];
			$n[$i]=$rows["Name"];
			$i++;
	}
}

echo "<table border=\"1\"><th>Name</th><th>User Name</th><th>Email id</th>";
for($j=0;$j<$i;$j++)
{
	echo "<tr>
	<td> $n[$j]</td>
	<td>$u[$j]</td>
	<td>$e[$j]</td>
	</tr>";
}

echo "</table>";

mysqli_close($conn);
?>