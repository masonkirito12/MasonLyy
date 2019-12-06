    <?php
include_once("../connection/db.php");
include_once("../security.php");
mysqli_set_charset($conn, 'utf8'); 

if(!empty($_GET['search'])){
	$search = " AND m.ic like '%".$_GET['search']."%'";
}else{
	$search = "";
}

if(!empty($_GET['id'])){
    $id = " AND o.id = '".$_GET['id']."'";
}else{
    $id = "";
}



$date = date('Y-m-d');
// Select Book List
$select = "SELECT o.id oid,m.name mname,m.ic mic,b.image bimage,b.name bname,bd.barcode barcode,o.borrow_date borrow_date,o.return_date return_date,o.status ostatus,bd.book_id book_id FROM borrow o
           INNER JOIN member m ON m.id = o.member_id
           INNER JOIN book_detail bd ON bd.id = o.book_id
           INNER JOIN book b ON b.id = bd.book_id
           WHERE o.status = 'return' ".$search." ".$id." ORDER BY o.borrow_date ASC";
$result = mysqli_query($conn,$select);
// Get Pending Book List
$select_pending = "SELECT * FROM borrow WHERE status = 'pending'";
$result_pending = mysqli_query($conn,$select_pending);
$rows = mysqli_num_rows($result_pending);
// Get Expired Book List
$select_return = "SELECT * FROM borrow WHERE status = 'return' AND return_date < '".$date."'";
$result_return = mysqli_query($conn,$select_return);
$rows1 = mysqli_num_rows($result_return);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
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
            include("../sidebar.php");
            ?>
        </div>
        <div class="main-panel">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="purple">
                                    <h4 class="title">Return Book List</h4>
                                </div>
                                <form class="navbar-form navbar-left" role="search">
                                    <div class="form-group  is-empty">
                                    <input id="myInput" type="text" class="form-control"  placeholder="Search">
                                    <span class="material-input"></span>
                                    </div>
                                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                                    <i class="material-icons">search</i>
                                    <div class="ripple-container"></div>
                                </button>
                                </form>

                                <div class="card-content table-responsive">
                                    <form method="post" action="collect.php">
                                    <table class="table">
                                        <thead class="text-primary">
                                            <th>Name</th>
                                            <th>IC</th>
                                            <th>Book Image</th>
                                            <th>Book Name</th>
                                            <th>Barcode</th>
                                            <th>Borrow Date</th>
                                            <th>Return Date</th>
                                            <th>View</th>
                                            <th>Status</th>
                                        </thead>
                                        <tbody id="myTable">
                                        <?php 
                                        while($row = mysqli_fetch_assoc($result)){ 
										//reserve
                                        $selectreserve="SELECT MIN(id) AS newid FROM reserve WHERE book_id='".$row['book_id']."' and status='success'";
                                        $resultreserve=mysqli_query($conn,$selectreserve);
                                        $numreserve= mysqli_num_rows($resultreserve);
                                        $rowreserve=mysqli_fetch_array($resultreserve);
                                        //
                                        $date = date('Y-m-d', strtotime($row['borrow_date']. ' + 14 days'));
                                        $idquery = mysqli_query($conn,"SELECT id as bid FROM book_detail WHERE barcode='".$row['barcode']."'");
                                        $idrow = mysqli_fetch_assoc($idquery);
                                        ?>
                                            <tr>
                                                <td><?php echo $row['mname'] ?></td>
                                                <td><?php echo $row['mic'] ?></td>
                                                <td><img style="height:130px; width:100px;" src="<?php echo 
										             $row['bimage']; ?>"></td>
                                                <td><?php echo $row['bname'] ?></td>
                                                <td><?php echo $row['barcode'] ?></td>
                                                <td><?php echo $row['borrow_date'] ?></td>
                                                <td><?php echo $row['return_date'] ?></td>
                                                <td><a class="material-icons" href="checked_return.php?id=<?php 
												echo $row['oid']?>&bid=<?php echo $idrow['bid']?>">
                                                search</a></td>

                                                <td><?
                                                if ($rowreserve['newid']!="") 
                                                {   
                                                    echo "<input type='hidden' name='book_id' value='$row[oid]'>";
                                                    echo "<button type='submit' class='btn btn-info' name='reserve' value='".$rowreserve['newid']."'>Reserve</button>";
                                                }
                                                ?></td>
                                            </tr>
                                        <?php }?>
                                        </tbody>
                                    </table>
                                </form>
                                </div>
                            </div>
                        </div>
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
<script type="text/javascript">

    $(document).ready(function() {

        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();

    });
 
</script>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
</html>