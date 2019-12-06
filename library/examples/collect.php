<?php
include_once("../connection/db.php");
include_once("../security.php");

$date = date('Y-m-d');
$returndate = date('Y-m-d', strtotime($date. ' + 14 days'));
$creater = $_SESSION['name'];

if($_GET['status'] == "pending"){
$update = "UPDATE borrow SET borrow_date = '".$date."', return_date = '".$returndate."', created_borrow = '".$creater."', status = 'return' WHERE id = '".$_GET['id']."'";
	if($result = mysqli_query($conn,$update)){
		$update_book = "UPDATE book_detail SET status = 'return' WHERE id = '".$_GET['bid']."'";
		if($result = mysqli_query($conn,$update_book)){
			echo"<script>
		         window.location.href='notifications.php';
		         </script>";
		}
	}
}

if($_GET['status'] == "return"){
	$days = $_POST['borrowdate'];
    $dateborrow = date_create("$days");
    $datereturn = date_create("$date");
    $diff = date_diff($dateborrow,$datereturn);
    $many_days = $diff->d;
	if($_POST['return_status'] == "late_price"){
		$update = "UPDATE borrow SET return_date = '".$date."', created_return = '".$creater."', status = 'success', return_days = '".$many_days."', return_status = 'late', pay_price = '".$_POST['paylateprice']."' WHERE id = '".$_GET['id']."'";
		if($result = mysqli_query($conn,$update)){
			$update_book = "UPDATE book_detail SET status = 'success' WHERE id = '".$_GET['bid']."'";
			if($result = mysqli_query($conn,$update_book)){
				echo"<script>
					 window.location.href='notifications.php';
					 </script>";
			}
		}
	}elseif($_POST['return_status'] == "miss_price"){
		$update = "UPDATE borrow SET return_date = '".$date."', created_return = '".$creater."', status = 'success', return_days = '".$many_days."', return_status = 'missing', pay_price = '".$_POST['paymissprice']."' WHERE id = '".$_GET['id']."'";
		if($result = mysqli_query($conn,$update)){
			$update_book = "UPDATE book_detail SET status = 'delete' WHERE id = '".$_GET['bid']."'";
			if($result = mysqli_query($conn,$update_book)){
				echo"<script>
					 window.location.href='notifications.php';
					 </script>";
			}
		}
	}else{
		$update = "UPDATE borrow SET return_date = '".$date."', created_return = '".$creater."', status = 'success', return_days = '".$many_days."', return_status = 'none', pay_price = '0' WHERE id = '".$_GET['id']."'";
		if($result = mysqli_query($conn,$update)){
			$update_book = "UPDATE book_detail SET status = 'success' WHERE id = '".$_GET['bid']."'";
			if($result = mysqli_query($conn,$update_book)){
				echo"<script>
					 window.location.href='table.php';
					 </script>";
			}
		}
	}
}
//reserve
if (isset($_POST['reserve'])) 
{

    $choosereserve="SELECT member_id FROM reserve WHERE id='".$_POST['reserve']."'";
    $reserveresult=mysqli_query($conn,$choosereserve);
    $reservenum= mysqli_num_rows($reserveresult);
    $reserverow=mysqli_fetch_array($reserveresult);
   
    $selectborrow="SELECT * FROM borrow WHERE id='".$_POST['book_id']."'";
    $resultborow=mysqli_query($conn,$selectborrow);
    $resultborownum= mysqli_num_rows($resultborow);
    $resultborowrow=mysqli_fetch_array($resultborow);
    
    $memberid=$reserverow[0];
    $date=date('Y-m-d');
    $bookid=$resultborowrow['book_id'];
    //insert
    $borrowqry="INSERT INTO borrow (member_id,book_id,collect_date,status) 
                         VALUES ('$memberid','$bookid','$date','pending')";
     if ($borrowresult=mysqli_query($conn,$borrowqry))
    {
        $updateborrow="UPDATE borrow set return_date = '".$date."', created_return = '".$creater."', status = 'success', return_days = '".$many_days."', return_status = 'none', pay_price = '0' WHERE id='".$resultborowrow[0]."'";
        $updateborrowresult=mysqli_query($conn,$updateborrow);
        $update_book2 = "UPDATE book_detail SET status = 'success' WHERE id = '".$_GET['bid']."'";
        $result2 = mysqli_query($conn,$update_book2);
        $changedetail = "UPDATE reserve set status='delete' WHERE id='".$_POST['reserve']."'";
        $resultchange = mysqli_query($conn,$changedetail);
        echo"<script>
        window.location.href='return_book.php';
        alert('Success');
        </script>";
        
    }else{
        echo "<script> 
              alert('Failed To Add Cart!');
              </script>";
    }                   
}
?>