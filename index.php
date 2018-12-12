<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="icon" href="/wdpro/icon.png">
		<title>Shopify</title>
		<meta charset="utf-8">
		<style type="text/css">
			body{
				background-image: url("bgimg.jpg");
				margin-right: 0px;
				margin-left: 0px;
				padding: 0px;
			}
			#logbtn:hover{
				border-style: solid;
				border-color: #ffd500;
			}
			#logbtn{
				height: 8vh;
				width: 8vh;
				background-repeat: no-repeat;
				border-style: none;
				background-color: black;
				background-image: url("/wdpro/member.png");
				background-position: center;
				background-size: 100% auto;
				right: 1vh;
				bottom: 1vh;
				position: absolute;
			}
			img{
				height: 100%;
				left: 0px;
				width: auto;
			}
			#header{
				top: 0px;
				height: 10vh;
				width: 100%;
				background: black;
				position: relative;
				margin-bottom: 3vh;
			}
			hr{
				border-style: solid;
				border-color: black;
				margin-bottom: 1%;
			}
			#prev{
				height: 100%;
				opacity: 0.8;
				background-color: black;
				background-image: url("previous.jpg");
				background-repeat: no-repeat;
				background-position: center;
				background-size: 100% auto;
				border-width: 0px;
			}
			#next{
				height: 100%;
				opacity: 0.8;
				background-color: black;
				background-image: url("next.jpg");
				background-repeat: no-repeat;
				background-position: center;
				background-size: 100% auto;
				border-width: 0px;
			}
			#next:hover{
				opacity: 1;
			}
			#prev:hover{
				opacity: 1;
			}
		
			#offers{
				height: 55vh;
				width: 100%;
				position: relative;
				display: grid;
				grid-template-columns: 10% 80% 10%;
			}
			#indicator{
				width: 100%;
				bottom: 0%;
			}
			#image{
				height: 100%;
				background-color: rgba(0,0,0,1);
				background-image: url("0.jpg");
				background-size: auto 100%;
				background-repeat: no-repeat;
				background-position: center;
			}
			.dot{
				height: 10px;
  				width: 10px;
  				margin: 15px;
  				background-color: black;
				border-radius: 5px;
				display: inline-block;
			}
			#footer{
				font-size: 20px;
				bottom: 10px;
				bottom: 0px;
				right: 10px;
				position: absolute;
				color: black;
			}
		</style>
		<script type="text/javascript">
			var i=0;
			var prev=function(){
				document.getElementById(""+i).style.background="black";
				i=i-1;
				if(i==-1)
					i=2;
				document.getElementById(""+i).style.background="#ff2100";
			};
			var next=function(){
				document.getElementById(""+i).style.background="black";
				i=(i+1)%3;
				document.getElementById(""+i).style.background="#ff2100";
				document.getElementById("image").style.backgroundImage="url("+i+".jpg)";
			};
			var gotologin=function(){
				window.location.assign("/wdpro/userlogin.php");
			};
			setInterval(next,3000);
		</script>
	</head>
	<body>
		<div id="header">
			<img src="/wdpro/logo.png">
			<button id="logbtn" title="Sign In" onclick="gotologin();"></button>
		</div>
		
		<center>
			<div id="offers">
					<button id="prev" onclick="prev()"></button>
					<div id="image"></div>
					<button id="next" onclick="next()"></button>
			</div>
			<div id="indicator">
					<span class="dot" id="0"></span>
					<span class="dot" id="1"></span>
					<span class="dot" id="2"></span>
			</div>
		</center>
		<div id="footer">
			<label>© 2018 SHOPIFY</label>
		</div>
		<script type="text/javascript">
			document.getElementById("0").style.background="#ff2100";
		</script>
		<?php
			if(isset($_GET['lgt'])){
				session_destroy();
			}
		?>
	</body>
</html>