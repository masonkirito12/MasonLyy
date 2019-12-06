<!DOCTYPE html>
<html>
<head>
	<title></title>
	<h1>SELECT *,o.id oid,m.name mname,m.ic mic,b.image bimage,b.name bname,bd.barcode barcode,o.collect_date collect_date,o.borrow_date borrow_date,o.return_date return_date,o.status ostatus,o.pay_price pay_price FROM borrow o INNER JOIN member m ON m.id = o.member_id INNER JOIN book_detail bd ON bd.id = o.book_id INNER JOIN book b ON b.id = bd.book_id WHERE m.id = '8' AND o.status IN ('success','cancel')</h1>
</head>
<body>

</body>
</html>