<?php
session_start();
if(!isset($_SESSION['uname']))
	echo "<script>window.location.assign('/wdpro/');</script>";
if(!isset($_GET['action'])){}
if(!strcmp($_GET['action'],"addtocart"))
{
	if(isset($_GET['p_name'])){
		$con=mysqli_connect("localhost","userk","tiger","karan");
		if(!$con){
			echo "Can't connect";
		}
		else{
			$query=mysqli_query($con,"SELECT incart FROM cart WHERE o_c_uname='".$_SESSION['uname']."' and o_p_name='".$_GET['p_name']."';");
			if(mysqli_error($con)){
				echo "Some error occured.";
			}
			else{
				$no=-1;
				while ($row=mysqli_fetch_array($query,MYSQLI_NUM)) {
					$no=$row[0];
				}
				if($no==-1)
					$query=mysqli_query($con,"INSERT INTO CART VALUES('".$_SESSION['uname']."','".$_GET['p_name']."',1,0)");
				else
					$query=mysqli_query($con,"UPDATE cart set incart=".($no+1)." WHERE o_c_uname='".$_SESSION['uname']."' and o_p_name='".$_GET['p_name']."';");
				mysqli_commit($con);
				if(mysqli_error($con)){
					echo "Some error occured.";
				}
				else{
					echo "1";
				}
			}
		}
	}	
}
else if(!strcmp($_GET['action'],"removefromcart")){
	if(isset($_GET['p_name'])){
		$con=mysqli_connect("localhost","userk","tiger","karan");
		if(!$con){
			echo "Can't connect";
		}
		else{
			$query=mysqli_query($con,"SELECT incart,confirmed FROM cart WHERE o_c_uname='".$_SESSION['uname']."' and o_p_name='".$_GET['p_name']."';");
			if(mysqli_error($con)){
				echo "Some error occured.";
			}
			else{
				$row=mysqli_fetch_array($query,MYSQLI_NUM);
				if($row[0]==1 && $row[1]==0)
					$query=mysqli_query($con,"DELETE FROM cart WHERE o_c_uname='".$_SESSION['uname']."' and o_p_name='".$_GET['p_name']."';");
				else if($row[0]==1 && $row[1]!=0)
					$query=mysqli_query($con,"UPDATE cart set incart=".($row[0]-1)." WHERE o_c_uname='".$_SESSION['uname']."' and o_p_name='".$_GET['p_name']."';");
				else if($row[0]==0 && $row[1]!=0){}
				else if($row[0]>1)
					$query=mysqli_query($con,"UPDATE cart set incart=".($row[0]-1)." WHERE o_c_uname='".$_SESSION['uname']."' and o_p_name='".$_GET['p_name']."';");
				mysqli_commit($con);
				if(mysqli_error($con)){
					echo "Some error occured.";
				}
				else{
					echo "1";
				}
			}
		}
	}		
}
else if(!strcmp($_GET['action'],"getcartitems")){
		$con=mysqli_connect("localhost","userk","tiger","karan");
		if(!$con){
			echo "Can't connect";
		}
		else{
			$uname=$_SESSION['uname'];
			$query=mysqli_query($con,"SELECT o_p_name,incart FROM cart WHERE o_c_uname='".$uname."' and incart!=0;");
			if(mysqli_error($con)){
				echo "Some error occured.";
			}
			else{
				$res="";
				while ($row=mysqli_fetch_array($query,MYSQLI_NUM)) {
					$res.="<div id='cart-item'><label id='pname'>".$row[0]."</label><button id='inc' onclick='inc(this);'></button><label id='pcount'>".$row[1]."</label><button id='dec' onclick='dec(this);'></button></div>";
				}
				echo $res;
			}
		}		
}
else if(!strcmp($_GET['action'],"placeorder")){
		$con=mysqli_connect("localhost","userk","tiger","karan");
		if(!$con){
			echo "Can't connect";
		}
		else{
			$uname=$_SESSION['uname'];
			$query=mysqli_query($con,"SELECT o_p_name,incart FROM cart WHERE o_c_uname='".$uname."' and incart!=0;");
			if(mysqli_error($con)){
				echo "Some error occured.";
			}
			else{
				$res=0;
				while($row=mysqli_fetch_array($query,MYSQLI_NUM)){
					$qcost=mysqli_query($con,"SELECT p_price from product where p_name='".$row[0]."';");
					$res+=(intval(mysqli_fetch_array($qcost,MYSQLI_NUM)[0])*$row[1]);
					$que=mysqli_query($con,"UPDATE cart SET incart=0,confirmed=confirmed+".$row[1]." WHERE o_c_uname='".$uname."' and o_p_name='".$row[0]."';");
					if(mysqli_error($con))
						$res="-1";
					mysqli_commit($con);
				}
				if($res!=0)
					echo "Rs.".$res.".00/-";
				else
					echo "0";
			}
		}		
}
?>