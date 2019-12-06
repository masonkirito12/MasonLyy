<?php
include_once("../connection/db.php");
include_once("../security_member.php");
mysqli_set_charset($conn, 'utf8'); 

$date = date('Y-m-d');

// Get Book List
$select = "SELECT *,o.id oid,m.name mname,m.ic mic,b.image bimage,b.name bname,bd.barcode barcode,o.collect_date collect_date,o.borrow_date borrow_date,o.return_date return_date,o.status ostatus,o.pay_price pay_price FROM borrow o
           INNER JOIN member m ON m.id = o.member_id
           INNER JOIN book_detail bd ON bd.id = o.book_id
           INNER JOIN book b ON b.id = bd.book_id
           WHERE m.id = '".$_SESSION['id']."' AND o.status IN ('success','cancel')";
$result = mysqli_query($conn,$select);
// Select Borrow List
$select_borrow = "SELECT * FROM borrow WHERE status = 'return' AND member_id = ".$_SESSION['id']."";
$resultborrow = mysqli_query($conn,$select_borrow);
$rowborrow = mysqli_num_rows($resultborrow);
// Select Pending List
$select_pending = "SELECT * FROM borrow WHERE status = 'pending' AND member_id = ".$_SESSION['id']."";
$resultpending = mysqli_query($conn,$select_pending);
$rowpending = mysqli_num_rows($resultpending);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="../assets/img/favicon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Library Management System</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="../assets/css/material-dashboard.css?v=1.2.0" rel="stylesheet" />
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="../assets/css/demo.css" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
</head>

<style>
.numberCircle {
border-radius: 50%;
behavior: url(PIE.htc);
/* remove if you don't care about IE8 */
padding: 2px;
background: #fff;
border: 2px solid #666;
color: #666;
text-align: center;
font: 15px Arial, sans-serif;
}
</style>

<body>
    <div class="wrapper">
        <div class="sidebar" data-color="purple" data-image="../assets/img/sidebar-1.jpg">
           
            <?
            include("../sidebar2.php");
            ?>
        </div>
        <div class="main-panel">
            <div class="card card-plain">
                <div class="card-header" data-background-color="purple">
                    <h4 class="title">History Record</h4>
                    <p class="category"></p>
                </div>
                    <div class="card-content table-responsive">
                        <table class="table table-hover">
                        <tr>
                            <thead>
                                <th>NO</th>
                                <th>Image</th>
                                <th>Barcode</th>
                                <th>Name</th>
                                <th>Author</th>
                                <th>Language</th>
                                <th>Collect Date / Borrow Date</th>
                                <th>Return Date</th>
                                <th>Status</th>
                            </thead>
                        </tr>
                            <?php 
							$i_rows = 1;
							while($row = mysqli_fetch_assoc($result)){ ?>
                                <tr>
							    <td><?php echo $i_rows++ ?></td>
                                <td><img style="height:130px; width:100px;" src="<?php echo 
						             $row['bimage']; ?>"></td>
                                <td><?php echo $row['barcode']; ?></td>
                                <td><?php echo $row['bname']; ?></td>
                                <td><?php echo $row['author']; ?></td>                                                
                                <td><?php echo $row['language']; ?></td>
                                <?php if($row['ostatus'] == "cancel"){ ?>
                                <td><?php echo $row['collect_date']; ?></td>
                                <td><?php echo ""; ?></td>
                                <?php }else{ ?>
                                <td><?php echo $row['borrow_date']; ?></td>
                                <td><?php echo $row['return_date']; ?></td>
                                <?php }?>
                                <td><?php if($row['ostatus'] == "success"){ echo "Returned"; }
								else if($row['ostatus'] == "cancel"){ echo "Cancel"; }?></td>
                                </tr>
                            <?php }?>
                        </table>
                    </div>
            </div>
        </div>
    </div>
</body>
<!--   Core JS Files   -->
<script src="../assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../assets/js/material.min.js" type="text/javascript"></script>
<!--  Charts Plugin -->
<script src="../assets/js/chartist.min.js"></script>
<!--  Dynamic Elements plugin -->
<script src="../assets/js/arrive.min.js"></script>
<!--  PerfectScrollbar Library -->
<script src="../assets/js/perfect-scrollbar.jquery.min.js"></script>
<!--  Notifications Plugin    -->
<script src="../assets/js/bootstrap-notify.js"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!-- Material Dashboard javascript methods -->
<script src="../assets/js/material-dashboard.js?v=1.2.0"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="../assets/js/demo.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();
    });
	$(function() {
    $( ".datepicker" ).datepicker({
		dateFormat: "yy-mm-dd"
		});
    });
</script>
</html>