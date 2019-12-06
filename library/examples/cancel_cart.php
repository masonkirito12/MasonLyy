<?php
include_once("../connection/db.php");
include_once("../security_member.php");

if(!empty($_GET['id']) && !empty($_GET['book_id'])){

	$delete_cart = "DELETE FROM cart WHERE id = '".$_GET['id']."'";
	if($result_delete = mysqli_query($conn,$delete_cart)){
	 	$update = "UPDATE book_detail SET status = 'success' WHERE id = '".$_GET['book_id']."'";
	 	if($result_update = mysqli_query($conn,$update)){
			echo "<script>
				  window.location.href='add_cart.php';
				  </script>";
	 	}
	}else{
		echo "<script>
			  window.location.href='add_cart.php';
			  alert('error');
			  </script>";
	}
}
?>