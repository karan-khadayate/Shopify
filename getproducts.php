<?php
	//search for products
	if(isset($_GET['search'])){
		$search=$_GET['search'];
		$con=mysqli_connect("localhost","userk","tiger","karan");
		if(!$con){
			echo "Can't Connect";
		}
		else{
			if($search=="")
				$query=mysqli_query($con,"SELECT * FROM product;");
			else
				$query=mysqli_query($con,"SELECT * FROM product where p_name like '%".$search."%';");
			if(mysqli_error($con))
				echo "Some error occured.";
			else if($query){
				$res="";
				while($row=mysqli_fetch_array($query,MYSQLI_ASSOC)){
					$res.="<div id='grid-item'><div class='pimg' style='background-image:url(".$row['p_path'].");'></div><Button class='btn' onclick='displaydetails(this);' id='".$row['p_name']."'>V I E W</Button></div>";
				}
				if($res==""){
					echo "not available";
				}
				echo $res;
			}
		}
	}
	//search for details of a product
	else if(isset($_GET['p_name'])){
		$p_name=$_GET['p_name'];
		$con=mysqli_connect("localhost","userk","tiger","karan");
		if(!$con){
			echo "<script>alert('DATABASE ERROR :(');</script>";
		}
		else{
			$query=mysqli_query($con,"SELECT * FROM product where p_name = '$p_name';");
			if(mysqli_error($con))
				echo "Some error occured.";
			else if($query){
				$row=mysqli_fetch_array($query,MYSQLI_ASSOC);
				echo $row['p_price'].",".$row['p_path'];
			}
		}
	}
?>