<?php 
include_once("connection/db.php");
require_once("PHPMailer/class.phpmailer.php");
require_once("PHPMailer/function.php");

$date = date('Y-m-d');
$select_return = "SELECT *,m.name mname,b.name bname,o.id oid,o.status ostatus,m.email memail FROM borrow o
           INNER JOIN member m ON o.member_id = m.id
           INNER JOIN book b ON o.book_id = b.id
		   WHERE o.status = 'return' AND date(o.collect_date) + INTERVAL o.day_of_return DAY <= curdate()";
$result_return = mysqli_query($conn,$select_return);
while($row = mysqli_fetch_array($result_return)){

	$to = $row['email'];
	$to_name =  $row['mname'];
	$subject = "The book(".$row['bname'].") you borrowed date are pass";
	$message = nl2br("Dear ".$row['mname'].", \r\n
				Please return the book to synergy college.");

	$header = "From: Synergy College Library";

	sendEmail($to,$to_name,$subject,$message,$header);
	
}


$select_pening = "SELECT *,m.name mname,b.name bname,o.id oid,o.status ostatus FROM borrow o
           INNER JOIN member m ON o.member_id = m.id
           INNER JOIN book b ON o.book_id = b.id
		   WHERE o.status = 'pening'  AND o.collect_date > ".$date."";
$result_pening = mysqli_query($conn,$select_pening);
while($row2 = mysqli_fetch_array($result_pening)){

	$to = $row2['email'];
	$to_name =  $row2['mname'];
	$subject = "The book(".$row2['bname'].") time you have set is now";
	$message = nl2br("Dear ".$row2['mname'].", \r\n
				Please come synergy college your book.");

	$header = "From: Synergy College Library";

	sendEmail($to,$to_name,$subject,$message,$header);
	
}
?>