<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Shopify | Explore</title>
	<link rel="icon" href="/wdpro/icon.png">
	<meta charset="UTF-8">
	<style type="text/css">
	body{
		background-color: white;
		background-repeat: no-repeat;
		z-index: -1;
		margin: 0px;
	}
	#toolbar{
		background-color: black;
		z-index:1;
		width: 100%;
		position: fixed;
		height: 10vh;
		align-items: center;
	}
	#search{
		width: 50%;
		height: 8vh;
		border-style: solid;
		border-color: white;
		background-color: black;
		color: white;
		border-width: 1px;
		right: 23vh;
		bottom: 1vh;
		top: 1vh;
		position: absolute;
	}
	#search input{
		padding-left: 10px;
		border-width:  0px;
		height: 7vh;
		width: 80%;
		font-size: 4vh;
		bottom: 0.3vh;
		position: absolute;
		background-color: black;
		color: white;
	}
	#search button{
		background-color: black;
		background-image: url("/wdpro/explore.png");
		height: 8vh;
		width: 8vh;
		background-size: 100%;
		float: right;
		border-width:0px;
		background-position: center;
	}
	#search button:hover{
		border-width: 1px;
		border-color: #ffd500;
	}
	#cart{
		position: absolute;
		top: 1vh;
		height: 8vh;
		width: 8vh;
		background-image: url("/wdpro/cart.png");
		background-size: 100%;
		border-width: 0px;
		right: 2vh;
	}	
	#logout{
		position: absolute;
		top: 1vh;
		height: 8vh;
		width: 8vh;
		background-image: url("/wdpro/logout.png");
		background-size: 100%;
		border-width: 0px;
		right: 12vh;
	}
	#cart:hover{
		border-width: 1px;
		border-color: #ffd500;
	}
	#logout:hover{
		border-width: 1px;
		border-color: #ffd500;
	}
	#home{
		background-color:black;
		background-image: url("/wdpro/logol.png");
		background-repeat: no-repeat;
		background-position: center;
		background-size: 100% auto;
		height: 10vh;
		width: 30vh;
		left: 2vh;
		position: absolute;
		border-style: none;
	}
	#home:hover{
		border-style: solid;
		border-color: #ffd500;
	}
	#grid-container{
		display:grid;
		color: black;
		margin-top: 6vh;
		top: 8vh;
		grid-row-gap: 2vw;
		height: 100%;
		z-index: 0;
		position: absolute;
		grid-template-columns: 22vw 22vw 22vw 22vw;
		grid-column-gap: 4vw;
	}
	#grid-item{
		background-color: gray;
		height: 27vw;
		width: 22vw;
		border-style: solid;
		border-width: 2px;
	}
	#grid-item .pimg{
		background-color: white;
		height: 22vw;
		width: 22vw;
		background-repeat: no-repeat;
		background-position: center;
		background-size: 100% auto;
	}
	#grid-item .btn{
		background: black;
		color: white;
		height: 5vw;
		width: 22vw;
		border-style: none;
	}
	#grid-item .btn:hover{
		background: white;
		color: black;
	}
	#toolbar img{
		height: 96%;
		width: auto;
		top: 2%;
		left: 1px;
		position: absolute;
	}
	#details{
		width: 100%;
		height: 30vw;
		background-color: rgba(0,0,0,0.95);
		display: none;
		z-index: 2;
		padding-right: 5vh;
		position: absolute;
	}
	#closeBtn{
		margin: 0px;
		height: 5vh;
		right: 5vw;
		color: white;
		background-color: black;
		top: 2vh;
		border-width: 0px;
		position: absolute;
	}
	#closeBtn:hover{
		background-color: white;
		color: black;
	}
	#display-grid{
		top: 5vw;
		width: 100vw;
		height: 20vw;
		display: grid;
		grid-template-columns:10% 30% 5% 5% 40% 10%;
		position: absolute;
	}
	#display-grid-details{
		border-style: none;
		border-color: white;
		color:white;
		padding-left: 10px;
	}
	#display-grid-img{
		background-color: white;
		background-size: auto 100%;
		background-repeat: no-repeat;
		background-position: center;
	}
	#add-to-cart{
		height: 7vh;
		border-width: 0px;
		background-color: black;
		color: white;
	}
	#add-to-cart:hover{
		background-color: white;
		color: black;
	}
	#add-to-cart:active{
		background-color: yellow;
		color: black;
	}
	#d{
		border-style: solid;
		border-width: 0px 1px 0px 0px;
		border-color: white;
	}
	</style>
	<script type="text/javascript">
	 	var items="";
	 	var i=0;
	 	var closedetails=function(){
	 		document.getElementById("details").style.display="none";
	 	};
	 	var displaydetails=function(el){
	 		getprice(el);
	 		document.getElementById("details").style.display="block";
	 		document.getElementById("details").style.top=el.offsetTop+"px";
	 	};
		var add=function(){
			items+="<div id='grid-item'><div class='pimg' style='background-image:url(/wdpro/0.jpg);'></div><Button class='btn' onclick='displaydetails(this);' id=''>V I E W</Button></div>";
			document.getElementById("grid-container").innerHTML=items;
		};
		var fetchproducts=function(){
			var search=document.getElementById("searchtext").value;
			var con=new XMLHttpRequest();
			con.onreadystatechange=function(){
				if(con.readyState==4 && con.status==200){
					var res=con.responseText;
					if(res.search("Warning")!=-1){
						//server sends "warning" message if connectivity problem is encountered
						alert("Can't connect to database  :(\nPlease try again later.");
					}
					else if(res=="not available")
						alert("Sorry :(\nItem currently unavailable.");
					else
						document.getElementById("grid-container").innerHTML=con.responseText;
				}
			};
			con.open("GET","/wdpro/getproducts.php?search="+search,true);
			con.send();
		};
		var getprice=function(el){
			var con=new XMLHttpRequest();
			var p_name=el.getAttribute("id");
			con.onreadystatechange=function(){
				if(con.readyState==4 && con.status==200){
					document.getElementById("product_name").innerHTML=p_name;
					var res=con.responseText.split(",");
					document.getElementById("product_price").innerHTML="Rs."+res[0]+"/-";
					//alert(res[1]);
					document.getElementById("display-grid-img").setAttribute("style","background-image:url("+res[1]+");background-position:center");
					document.getElementById("add-to-cart").setAttribute("value",p_name);					
				}
			};
			con.open("GET","/wdpro/getproducts.php?p_name="+p_name,true);
			con.send();
		};
		window.onload=function(){
			fetchproducts();
			document.getElementById("searchtext").addEventListener("keydown",function(e){
				if(e.key=="Enter"){
					fetchproducts();
				}
			});
			document.cookie="||";
		}
		var addtocart=function(el){
			var p_name=el.getAttribute("value");
			//alert(p_name);
			var con=new XMLHttpRequest();
			con.onreadystatechange=function(){
				if(this.readyState==4 && this.status==200){
					if(this.responseText=="1"){
						//alert("Order Placed");
					}
					else{
						alert(this.responseText);
					}
				}
			}
			con.open("GET","/wdpro/order.php?action=addtocart&p_name="+p_name,true);
			con.send();
		}
	</script>
</head>
<body>
	<div id="toolbar">
		<img src="/wdpro/logo.png" onclick="window.location.assign('/wdpro/');" title="Home">
		<div id="search">
			<input type="text" placeholder="Search..." id="searchtext"></input>
			<button title="Search" onclick="fetchproducts();"></button>
		</div>
		<button id="cart" onclick="window.location.assign('/wdpro/cart.html');" title="Cart"></button>
		<button id="logout" onclick="window.location.assign("/wdpro/?lgt=true");" title="Logout"></button>	
	</div>
	<br>
	<div id="grid-container">
	</div>
	<div id="details">
		<button onclick="closedetails();" id="closeBtn"> C L O S E </button>
		<div id="display-grid">
			<div></div>
			<div id="display-grid-img"></div>
			<div id="d"></div>
			<div></div>
			<div id="display-grid-details">
				<button id="add-to-cart" value="" onclick="addtocart(this);">ADD TO CART</button><br><br>
				<span id="product_name"></span><br>
				<span id="product_price"></span>
			</div>
			<div></div>
		</div>
	</div>
	<?php
		if(isset($_SESSION['uname'])){
		}
		else{
			echo "<script>window.location.assign('/wdpro/userlogin.php');</script>";
		}
	?>
	<script type="text/javascript">
		
	</script>
</body>
</html>