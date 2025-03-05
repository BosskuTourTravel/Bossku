<?php
include "../db=connection.php";
include "../slug.php";

$id = $_POST['id'];
$stamp = date("Y-m-d H:i:s");  
if($id==1){
	$email = $_POST['email'];
	$password = $_POST['password'];

	$query = "SELECT count(*) as total from member WHERE email='".$email."' AND password='".$password."'";
	$rs=mysqli_query($con,$query);
	$data = mysqli_fetch_assoc($rs);
	
	if($data['total']==1){
		header("Location:".$domain_web); 
	}else{
		$query2 = "SELECT count(*) as total from login_staff WHERE email='".$email."' AND password='".$password."'";
		$rs2=mysqli_query($con,$query2);
		$data2 = mysqli_fetch_assoc($rs2);
		if($data2['total']==1){
			session_start();
			$query3 = "SELECT * from login_staff WHERE email='".$email."' AND password='".$password."'";
			$rs3=mysqli_query($con,$query3);
			$row3 = mysqli_fetch_array($rs3);

			$_SESSION['staff'] = $row3['name'];
			$_SESSION['staff_id'] = $row3['id'];
			$_SESSION['type'] = $row3['type'];
			$_SESSION['destroy'] = 0;
			header("Location:".$domain_web."Admin"); 
		}else{
			header("Location: ".$domain_web."member/index.php?err=1"); 
		}
		
	}


}else if($id==2){
	$email = $_POST['email'];
	$password = $_POST['password'];
	$name = $_POST['name'];
	$address = $_POST['address'];
	$phone = $_POST['phone'];

	$sql = "INSERT INTO member VALUES ('','".$name."','".$address."','".$phone."','".$email."','".$password."','".$stamp."')";
	if (mysqli_query($con, $sql)) {
		echo "New record created successfully";
		header("Location: ".$domain_web."member/"); 
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
		header("Location: https://holidaymyboss.com"); 
	}
	$con->close();
}else{
	$email = $_POST['email'];
}


?>