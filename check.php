<?php
	$val=$_GET["uname"];
	$con=mysqli_connect("localhost","userk","tiger","karan");
	$query=mysqli_query($con,"SELECT * FROM customer WHERE c_uname=$val");
	if(mysqli_fetch_array()){
		echo 1;
	}
	else{
		echo 0;
	}
?>