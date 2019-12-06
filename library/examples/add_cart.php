<?php
include_once("../connection/db.php");
include_once("../security_member.php");
mysqli_set_charset($conn, 'utf8'); 
  
$date = date('Y-m-d');
// Get Book Cart List & Book Detail
$select = "SELECT *,c.id cartid,bd.id bdid FROM cart c
           INNER JOIN book_detail bd ON bd.id = c.book_id
           INNER JOIN book b ON b.id = bd.book_id
		   WHERE c.member_id = '".$_SESSION['id']."' ORDER BY c.id ASC";
$result = mysqli_query($conn,$select);
// Search Cart List Have Record Or Not
$select_cart = "SELECT * FROM cart where member_id = '".$_SESSION['id']."'";
$result_cart = mysqli_query($conn,$select_cart);
$row_cart = mysqli_fetch_assoc($result_cart);
// Insert Borrow Book
if(isset($_POST['sumbit'])){
    $cartinsert = "SELECT * FROM cart WHERE member_id = '".$_SESSION['id']."'";
    $resultinsert = mysqli_query($conn,$cartinsert);    
    $numinsert = mysqli_num_rows($resultinsert);
    $rowinsert = mysqli_fetch_assoc($resultinsert);

    for ($insert=0; $insert < $numinsert; $insert++){ 
        // Select Cart Detail
        $selectdetail = "SELECT * FROM cart WHERE member_id = '".$_SESSION['id']."'";
        $resultdetail = mysqli_query($conn,$selectdetail);
        $rowdetail = mysqli_fetch_assoc($resultdetail);
        // Get Data
        $memberid = $_SESSION['id'];
        $bookid = $rowdetail['book_id'];
        // Change Book Detail Status
        $changedetail = "UPDATE book_detail SET status = 'pending' WHERE id = '".$bookid."'";
        if($resultchange = mysqli_query($conn,$changedetail)){
		    $insertborrow = "INSERT INTO borrow (member_id,book_id,collect_date,status) 
                             VALUES ('$memberid','$bookid','$date','pending')";
            if($resultinsertb = mysqli_query($conn,$insertborrow)){	
                $deletecart = "DELETE FROM cart WHERE member_id = '".$memberid."' AND book_id = '".$bookid."'";
                if($resultdeletec = mysqli_query($conn,$deletecart)){
                }
            }
        }
	}
    echo "<script>
          window.location.href='information_book.php';
          </script>";
}
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
                    <h4 class="title">Book Cart</h4>
                    <p class="category"></p>
                </div>
                <div class="card-content table-responsive">
                    <form role="form" method="post" action="add_cart.php">
                        <table class="table table-hover">
                        <tr>
                            <thead>
                                <th>NO</th>
                                <th>Image</th>
                                <th>Barcode</th>
                                <th>Name</th>
                                <th>Author</th>
                                <th>Language</th>
                                <th>Collect Date</th>
                                <th>Return Date</th>
                                <th>Cancel</th>
                            </thead>
                        </tr>
                        <?php 
							$i_rows = 1;
							while($row = mysqli_fetch_assoc($result)){ 
                            $today = date('Y-m-d');
                            $returndate = date('Y-m-d', strtotime($today. ' + 14 days'));
                            ?>
                                <tr>
								    <td><?php echo $i_rows++ ?></td>
                                    <td><img style="height:130px; width:100px;" src="<?php echo 
							             $row['image']; ?>"></td>
                                    <td><?php echo $row['barcode']; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['author']; ?></td>
                                    <td><?php echo $row['language']; ?></td>
                                    <td><?php echo $today; ?></td>
                                    <td><?php echo $returndate; ?></td>
                                    <td>
                                    <a class="material-icons" href="cancel_cart.php?id=<?php echo $row['cartid'] ?>&book_id=<?php echo $row['bdid'] ?>">cancel</a>
                                    </td>
                                </tr> 
                        <?php }?>
                        </table>
                        <?php if(!empty($row_cart['id'])){?>
                            <button type="submit" value="sumbit" name="sumbit" style="float:right; width:100px;">
                                <i class="material-icons">done</i>
                            </button>
                        <?php }?>
                    </form>
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