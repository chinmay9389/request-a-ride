<?php
	session_start();
    if(!isset($_SESSION['userid'])){
        header("Location:index.html");
    }
	include 'connect.php';
	$status="Unavailable";
	$result=$db->query("update rider set rider_status = '$status' where rider_id = {$_SESSION['userid']}") or die($db->error);

	header("Location:riderHome.html");
?>