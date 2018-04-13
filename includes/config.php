<?php
	ob_start();

	session_start();

	$timezone = date_default_timezone_set("America/New_York");

	$con = mysqli_connect("cs5200-spring2018-yu.ctgkaydbplwu.us-east-2.rds.amazonaws.com", "yangfan", "Ok*64818503", "music",3306);

	if(mysqli_connect_errno()) {
		echo "Failed to connect: " . mysqli_connect_errno();
	}
?>