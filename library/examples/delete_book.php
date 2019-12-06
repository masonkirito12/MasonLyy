<?php
include_once("../connection/db.php");
include_once("../security.php");

$updatebook = "Update book SET status = 'delete' WHERE id = '".$_GET['id']."'";

if($result = mysqli_query($conn,$updatebook)){

	$updatedetail = "Update book_detail SET status = 'delete' WHERE book_id = '".$_GET['id']."'";

	if($resultdetail = mysqli_query($conn,$updatedetail)){
		echo"<script>
		window.location.href = 'dashboard.php';
		</script>";
	}
}
?>