<?php
include_once("connection/db.php");

$date = date('Y-m-d');
if(isset($_POST['sign_up'])){
	if(!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['phone_number'])){
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$phone_number = $_POST['phone_number'];
		
		$insert = "INSERT INTO admin_login (username,email,password,phone,status,create_date) VALUES 
		                                   ('$username','$email','$password','$phone_number','ADMIN','$date')";
        if($result = mysqli_query($conn,$insert)){
			echo "<script>
			       window.location.href='index.php';
				   alert('Success Sign Up')
			      </script>";
		}
	}else
		{
			echo "<script>
			       window.location.href='index.php';
				   alert('error')
			      </script>";
		}
}
?>