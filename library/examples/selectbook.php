<?php
include_once("../connection/db.php");

$id = $_POST['id'];
$book_detail = "SELECT * FROM book WHERE id = '$id'";
$result_detail = mysqli_query($conn,$book_detail);
$row_detail = mysqli_num_rows($result_detail);
$row_bookdetail = mysqli_fetch_assoc($result_detail);

$data = array('author'=>$row_bookdetail['author'],'price'=>$row_bookdetail['price'],'image'=>$row_bookdetail['image'],'language'=>$row_bookdetail['language']);

echo json_encode($data);
?>