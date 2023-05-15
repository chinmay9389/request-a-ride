<?php

	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$db = "reqride";
		
	$db = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("unable to connect");		 

?>