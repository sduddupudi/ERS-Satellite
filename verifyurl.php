<?php 
include 'db_connection.php';
session_start();
	if(!empty($_SESSION["userID"])){
	  echo "<script>window.location = '".$siteURL."lobby.php';</script>";  
	}
	if(isset($_GET['id']))
	{
		$id=base64_decode($_GET['id']);
		$sql = "UPDATE user SET verifyStatus=1 WHERE userID=$id";
		if ($conn->query($sql) === TRUE) {
		   echo "<script>window.location = '".$siteURL."verifydone.php';</script>";
		} else {
		  echo "Error updating record: " . $conn->error;
		}
	}
?>