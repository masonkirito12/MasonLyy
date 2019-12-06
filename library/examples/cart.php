<?php
include_once("../connection/db.php");
include_once("../security_member.php");

if(!empty($_GET['id'])){

	$mid = $_SESSION['id'];
	$bookid = $_GET['id'];
	$date = date('Y-m-d');

	 $query = "INSERT INTO cart  (member_id,book_id,created_date) VALUES ('$mid','$bookid','$date')";
	
	if ($result = mysqli_query($conn,$query)){
		$update_book = "UPDATE book_detail SET status = 'onpending',created_date='$date' WHERE id = '".$bookid."'";

		if($result_pending = mysqli_query($conn,$update_book)){
			echo"<script>
		         window.location.href='add_cart.php';
		         </script>";
		}
	}else{
		echo "<script>
			  window.location.href='information_book.php';
			  alert('Failed To Add Cart!');
			  </script>";
	}
}

?>