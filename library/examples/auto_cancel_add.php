<?
include_once("../connection/db.php");
include_once("../security_member.php");

$qry = "SELECT * FROM borrow WHERE status='pending'";
$result = mysqli_query($conn,$qry);
$num = mysqli_num_rows($result);

while ($row=mysqli_fetch_array($result)) 
{
	$reminder=$row['daypass'];
	$collectdate=strtotime($row['collect_date']);
	$today = strtotime(date('Y-m-d'));
	if ($collectdate<$today) {
		$reminder+=1;
		$update= "UPDATE borrow set daypass='".$reminder."' WHERE id='".$row['id']."'";
		$updateresult=mysqli_query($conn,$update);
		if($row['daypass']>3)
		{
			$updateq= "UPDATE book_detail set status='success' WHERE id='".$row['id']."'";
			$updateqresult=mysqli_query($conn,$updateq);
			$delete="UPDATE borrow SET status='cancel' WHERE id='".$row['id']."'";
			$deleteresult=mysqli_query($conn,$delete);
		}
	}	
} 
?>
