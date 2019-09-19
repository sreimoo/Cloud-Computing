<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8 " />
	<title>Uploaded photos</title>
  <meta name = "description" content = "Assignment-1b Cloud Computing Architecture"/>
  <meta name = "keywords" content ="ec2,aws,cloud"/>
  <meta name = "author" content = "Sanee Salim - 101887181"/>
  <link rel = "stylesheet" src = "getphotos.css"/>
  
</head>
<body>
<?php
echo ("1111");
   require 'aws/aws-autoloader.php';
   use aws\Aws\S3\Exception\S3Exception;
   use aws\AWS\S3\S3Client;
   use aws\Aws\S3\MultipartUploader;
   
 
    $s3_client = new S3Client([
				 'version' => 'latest',
				 'region' => 'ap-southeast-2b']);   
	$upfile = $_FILES["fname"]["tmp_name"];
    $path = "/var/www/html/cos20019/photoalbum/uploads";
   $is_file_uploaded = move_uploaded_file($upfile,$path);
	if($is_file_uploaded){
		
		$uploader = new MultipartUploader(
		 $s3_client,'/var/www/html/cos20019/uploads/capture.png',['bucket' => 'assignment1b-sanee-101887181','key' => 'capture.png']);
		 try{
			 $result = $uploader->upload();
		 }
		 catch (S3Exception $e){
			
		}
 }
 else{
	 echo ("File upload failure, try again");
 }
 
	require_once "settings.php";	
	$conn = @mysqli_connect ($host,$user,$pwd,$sql_db);	
	if (!$conn) {
		echo "<p> Database connection failure</p>".mysqli_connect_error();
	} 
	else{
	
 	$title = trim($_POST["PhotoTitle"]);
		$date = trim($_POST["Date"]);
		$keyword = trim($_POST["Keywords"]);
	$sql_table = "photos";
	$query = "insert into $sql_table (title,DateOfPhoto,keyword) values ($title,$date,$keyword);";
		
	$result = mysqli_query($conn,$query);
if (!$result) {					
		echo "<p> Something is wrong with query</p>";
		echo $query;
			}
			else {
				echo "<p>Upload successful</p>";
			}
	}
	
?>