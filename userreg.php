<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="icon" href="/wdpro/icon.png">
	<title>Shopify | Sign Up</title>
	<style type="text/css">
		body{
			background: url("/wdpro/bgimg.jpg");
			background-repeat: no-repeat;
			background-size: 100vw 100%;
			width: 99vw;
		}	
		input{
			width: 97%;
			height: 5vh;
			margin: 1% 0%; 
			color: white;
			font-size: 110%;
			font-family: arial;
			background-color: rgba(0,0,0,0);
			border-color : white;
			border-width: 0px 0px 2px 0px;
			padding-left: 8px;
			padding-right: 4px;
		}
		form{
			margin-top: 10vh;
			margin-bottom: 10vh;
			background-color: rgba(0,0,0,0.85);
			padding-top: 2%;
			padding-right: 5%;
			padding-left: 5%;
			padding-bottom: 2%;
			width: 40%;
		}
		#submit{
			color: black;
			width: 100%;
			height: 7vh;
			margin: 1% 0%;
			border-width: 0px;
			background-color: #00d2ff;
		}
		label{
			color: #ffd500;
			margin: 1px;
			font-size: 160%;
			font-family: arial; 
		}
		a{
			color: #ffd500;
			font-size: 120%;
			width: 100%;
			font-family: arial;
		}
		a:hover{
			color: #00ff8d;
		}
	</style>
	<script type="text/javascript">
	</script>
</head>
<body>
	<center>
			<form method="POST" action="/wdpro/userreg.php" autocomplete="off">
				<label>Join us</label><br><br>
				<input type="text" name="name" placeholder="Enter your name" required="true"><br><br>
				<input type="text" name="id" placeholder="Enter your username" required="true"><br><br>
				<input type="text" name="email" placeholder="Enter your email id" required="true"><br><br>
				<input type="password" name="p1" placeholder="Enter your password" required="true"><br><br>
				<input type="password" name="p2" placeholder="Re-enter your password" required="true"><br><br>
				<div id="msg"></div><br>
				<input type="submit" value=" R E G I S T E R " id="submit"><br><br>
				<a href="/wdpro/userlogin.php">Already registered?</a>
			</form>
	</center>
	<?php
		if(isset($_POST['name'])){
			$con=mysqli_connect("localhost","userk","tiger","karan");
			if(!$con){
					echo "<script>alert('Can not connect to Database :(');window.location.assign('/wdpro/userlogin.php');</script>";
			}
			else{
				$name=$_POST["name"];
				$uname=$_POST["id"];
				$email=$_POST["email"];
				$p1=$_POST["p1"];
				$p2=$_POST["p2"];
				$query=mysqli_query($con,"SELECT * FROM customer WHERE c_uname='$uname'");
				if(mysqli_error($con)){
					echo "<script>alert('Some Error occured.');</script>";
				}
				//echo mysqli_error($con);
				if(mysqli_fetch_array($query)){
					echo "<script>alert('Username already used :(');</script>";
				}
				else{
					if(!strcmp($p1,$p2)){
						$query=mysqli_query($con,"INSERT INTO customer (c_name,c_uname,c_email,c_pass) values('$name','$uname','$email','$p1');");
						mysqli_commit($con);
						session_start();
						$_SESSION['uname']=$uname;
						echo "<script>alert('Successfully registerd.');</script>";
						echo "<script>window.location.assign('userlogin.php');</script>";
					}	
					else
						echo "<script>alert('Passwords do not match.');</script>";
				}
			}
		}
	?>
</body>
</html>