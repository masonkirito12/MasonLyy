<?
include_once("../connection/db.php");
include_once("../security_member.php");

	if(!empty($_GET['id']))
	{
		$select= "SELECT *,count(bd.book_id) as quantity FROM book_detail bd WHERE book_id='".$_GET['id']."'";
		$book_id   = $_GET['id'];
		$member_id = $_SESSION['id'];
		$date = date('Y-m-d');
		$status    = 'success';

		$qry="INSERT INTO reserve (book_id,member_id,`date`,status) VALUES ('$book_id','$member_id','$date','$status')";
		$select2="SELECT * FROM reserve WHERE book_id='".$book_id."' AND member_id='".$member_id."' AND status='success'";
		$result2=mysqli_query($conn,$select2);
		$num = mysqli_num_rows($result2);
		if ($num>0) {
			echo"<script>
			alert('Already reserve');
	        window.location.href='reserve1.php';
	         </script>";
	        break;
		}
		if ($result = mysqli_query($conn,$qry))
		{
			echo"<script>
	         window.location.href='reserve1.php';
	         </script>";
			
		}else{
			echo "<script>
				  window.location.href='reserve.php';
				  alert('Failed To Add Cart!');
				  </script>";
		}
	}
?>