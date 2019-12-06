<?
$selectreserve = "SELECT * ,o.id oid,
						b.image bimage,
						m.name mname,
						m.ic mic,
						b.name bname,
						o.date reservedate,
						o.status ostatus
			FROM reserve o
           	LEFT JOIN member m ON o.member_id = m.id
           	LEFT JOIN book b ON o.book_id = b.id
           	WHERE m.id = '".$_SESSION['id']."'and o.status='success'";
$resultreserve = mysqli_query($conn,$selectreserve);

//$i_rows = 1;
while($rowreserve = mysqli_fetch_assoc($resultreserve)){ 
?>
<tr >
	<td><?php echo $i_rows++ ?></td>
	<td><img style="height:130px; width:100px;" src="<?php echo $rowreserve['bimage']; ?>"></td>
	<td><?php echo ""; ?></td>
	<td><?php echo $rowreserve['bname']; ?></td>
	<td><?php echo $rowreserve['author']; ?></td>                                                
	<td><?php echo $rowreserve['language']; ?></td>
	<td><?php echo $rowreserve['reservedate']; ; ?></td>
	<td><?php echo ""; ?></td>
	<td><?php if($rowreserve['ostatus'] == "success"){ echo "Reserve"; }?></td>
</tr>
<?
}
?>