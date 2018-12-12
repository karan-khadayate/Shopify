<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Shopify | Sign In</title>
	<link rel="icon" href="/wdpro/icon.png">
	<style type="text/css">
		body{
			background: url("/wdpro/bgimg.jpg");
			background-repeat: no-repeat;
			background-size: 100vw 100%;
			width: 99vw;
			min-height: 100vh;
		}	
		input{
			width: 97%;
			height: 7vh;
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
			background-color: rgba(0,0,0,0.85);
			padding-top: 2%;
			padding-right: 5%;
			padding-left: 5%;
			padding-bottom: 4%;
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
			<form method="POST" action="/wdpro/userlogin.php" autocomplete="off">
				<label>Welcome Again!</label><br><br>
				<input type="text" name="uname" placeholder="Enter your username" required="true"><br><br>
				<input type="password" name="password" placeholder="Enter your password" required="true"><br><br>
				<div id="msg"></div><br>
				<input type="submit" value=" L O G I N " id="submit"><br><br>
				<a href="/wdpro/userreg.php">Not registered yet?</a>
			</form>
	</center>
	<?php
		session_start();
		if(isset($_SESSION['uname'])){
			echo "<script>window.location.assign('/wdpro/explore.php');</script>";
		}
		else if(isset($_POST['uname']) && isset($_POST['password'])){
			if(preg_match("/['-]/",$_POST['uname']) || preg_match("/['-]/",$_POST['password']))
				echo "<script>alert('Invalid password.');</script>";
			else{
				$uname=$_POST['uname'];
				$con=mysqli_connect("localhost","userk","tiger","karan");
				if(!$con){
					echo "<script>alert('Can not connect to Database :(');window.location.assign('/wdpro/userlogin.php');</script>";
				}
				else{
					$query=mysqli_query($con,"SELECT * FROM customer WHERE c_uname='$uname';");
					if(mysqli_error($con))
						echo "Some error occured.";
					else if($query){
						$pass=mysqli_fetch_array($query,MYSQLI_NUM)[3];
						if(!strcmp($pass,$_POST['password']))
						{
							$_SESSION['uname']=$uname;
							echo "<script>window.location.assign('/wdpro/explore.php');</script>";
						}
						else
							echo "<script>alert('Incorrect details.');</script>";
					}
				}
			}
		}
	?>
</body>
</html>