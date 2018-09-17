<?php
$target_dir = "upload/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
session_start();
$user=$_SESSION['user'];

/*
// Check if image file is a actual image or fake image
if(isset($_POST["reg"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}*/

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    //$uploadOk = 0;
}


// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif"&&$imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG"
&& $imageFileType != "GIF" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

if($uploadOk==1)
{ 
$temp = explode(".",$_FILES["fileToUpload"]["name"]);
$newfilename = $user. '.' ."jpg";
if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "upload/" . $newfilename))
{
    header('location:userprofile.php');
}
}
?>
