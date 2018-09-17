<?php

$server="127.0.0.1";
$username="u758500678_sn";
$password="social14";
$dbname="u758500678_socia";

$conn=mysqli_connect($server,$username,$password,$dbname);
if($conn)
echo "connection successful";
else
die(mysqli_error());

?>