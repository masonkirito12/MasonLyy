<?php
include_once("../connection/db.php");
include_once("../security.php");

$update = "UPDATE borrow SET status = 'cancel' where id = '".$_GET['id']."'";
	if($result = mysqli_query($conn,$update)){
		$update_book = "UPDATE book_detail SET status = 'success' WHERE id = '".$_GET['bid']."'";
		if($result = mysqli_query($conn,$update_book)){
			echo"<script>
		         window.location.href='notifications.php';
		         </script>";
		}
	}
?>