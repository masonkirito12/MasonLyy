<?php
include_once("../connection/db.php");
include_once("../security.php");

$date = date('Y-m-d');

if(!empty($_GET['language'])){
    $language = " AND language like '%".$_GET['language']."%'" ;
}else{
    $language = "";
}
// Select Book List
$query_book = "SELECT * FROM book WHERE status = 'active'".$language." ORDER BY id ASC";
$result_book = mysqli_query($conn,$query_book);
// Get Pending Book List
$select_pending = "SELECT * FROM borrow WHERE status = 'pending'";
$result_pending = mysqli_query($conn,$select_pending);
$rows = mysqli_num_rows($result_pending);
// Get Expired Book List
$select_return = "SELECT * FROM borrow WHERE status = 'return' AND return_date < '".$date."'";
$result_return = mysqli_query($conn,$select_return);
$rows1 = mysqli_num_rows($result_return);
?>
<!DOCTYPE html>
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
            <div class="card card-plain">
                <div class="card-header" data-background-color="purple">
                    <h4 class="title">Book Information</h4>
                    <p class="category"></p>    
                </div>
                <form class="navbar-form navbar-left" role="search" method="get">
                    <div class="form-group  is-empty">
                        <input id="myInput" type="text" class="form-control" placeholder="Search">
                        <span class="material-input"></span>
                    </div>
                    <button type="submit" class="btn btn-white btn-round btn-just-icon">
                        <i class="material-icons">search</i>
                        <div class="ripple-container"></div>
                    </button>
                </form>
                <div class="card-content table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <thead>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Author</th>
                                <th>Type</th>
                                <th>Price</th>
                                <th>Total Quantity</th>
                                <th>Available Quantity</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </thead>
                        </tr>
                        <tbody id="myTable">
                        <?php 
						    $i_rows = 1;
						    while ($row = mysqli_fetch_assoc($result_book)){ 
                            $book_qtt = "SELECT *,count(bd.book_id) as quantity FROM book_detail bd
                                         INNER JOIN book b ON b.id = bd.book_id
                                         WHERE b.name = '".$row['name']."' and bd.status != 'delete'
                                         group by bd.book_id";
                            $result_qtt = mysqli_query($conn,$book_qtt);
                            $row_qtt = mysqli_fetch_assoc($result_qtt);

                            $borrow_qtt = "SELECT *,count(bd.book_id) as quantity FROM book_detail bd
                                           INNER JOIN book b ON b.id = bd.book_id
                                           WHERE b.name = '".$row['name']."' and bd.status = 'success'
                                           group by bd.book_id";
                            $result_borrow = mysqli_query($conn,$borrow_qtt);
                            $row_borrow = mysqli_fetch_assoc($result_borrow);
                            $sumquantity="SELECT book_id,quantity FROM book_issue WHERE book_id='".$row['id']."'";
                            $sumresult= mysqli_query($conn,$sumquantity);

                            $sum=0;
                            while ($quantity = mysqli_fetch_array($sumresult)) 
                            {
                              $sum+=$quantity['quantity'];
                            }
                            ?>
                            <tr>
						    <td><?php echo $i_rows++ ?></td>
                            <td><img style="height:130px; width:100px;" src="<?php echo $row['image']; ?>"></td>
                            <td><?php echo $row['name'];?></td>
                            <td><?php echo $row['author'];?></td>
                            <td><?php echo $row['language'];?></td>
                            <td><?php echo $row['price'];?></td>
                            <td><?php echo $row_qtt['quantity']-$sum; ?></td>
                            <td><?php echo $row_borrow['quantity']-$sum;?></td>
                            <td><a class="material-icons" href="edit_book.php?id=<?php echo $row['id']; ?>">border_color</a></td>
                            <td><a class="material-icons" href="delete_book.php?id=<?php echo $row['id'];?>" onclick="return confirm('Confirm to Delete this Record?')">delete</a>
                            </td>
                            </tr> 
						<?php }?>
                        </tbody>
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