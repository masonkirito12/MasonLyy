<?php
include_once("../connection/db.php");
include_once("../security_member.php");
mysqli_set_charset($conn, 'utf8'); 

$date = date('Y-m-d');
if(!empty($_GET['name'])){
	  $bookname = " AND name like '%".$_GET['name']."%'" ;
  }else{
	  $bookname = "";
  }
// Select Book List
$query_book = "SELECT * FROM book WHERE status = 'active' ".$bookname." ORDER BY id ASC";
$result_book = mysqli_query($conn,$query_book);
// Select Borrow List
$select_borrow = "SELECT * FROM borrow WHERE status = 'return' AND member_id = ".$_SESSION['id']."";
$resultborrow = mysqli_query($conn,$select_borrow);
$rowborrow = mysqli_num_rows($resultborrow);
// Select Pending List
$select_pending = "SELECT * FROM borrow WHERE status = 'pending' AND member_id = ".$_SESSION['id']."";
$resultpending = mysqli_query($conn,$select_pending);
$rowpending = mysqli_num_rows($resultpending);
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
            include("../sidebar2.php");
            ?>
        </div>
        <div class="main-panel">
            <div class="card card-plain">
                <div class="card-header" data-background-color="purple">
                    <h4 class="title">Book Information</h4>
                    <p class="category"></p>
                </div>
                <form class="navbar-form navbar-left" role="search">
                    <div class="form-group  is-empty">
                        <input id="myInput" type="text" class="form-control" placeholder="Search">
                        <span class="material-input"></span>
                    </div>
                    <button type="submit" name="search" class="btn btn-white btn-round btn-just-icon">
                        <i class="material-icons">search</i>
                        <div class="ripple-container"></div>
                    </button>
                </form>
                <div class="card-content table-responsive">
                    <table class="table table-hover">
                    <tr>
                        <thead>
                            <th>NO</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Author</th>
                            <th>Language</th>
                            <th>Quantity</th>
                            <th>Add Cart</th>
                        </thead>
                    </tr>
                    <tbody id="myTable">    
                        <?php 
						    $i_rows = 1;
						    while ($row = mysqli_fetch_assoc($result_book)){ 
                            // Select Success Book Quantity
                            $borrow_qtt = "SELECT *,count(bd.book_id) as quantity FROM book_detail bd
                                           INNER JOIN book b ON b.id = bd.book_id
                                           WHERE b.name = '".$row['name']."' and bd.status = 'success'
                                           group by bd.book_id";
                            $result_borrow = mysqli_query($conn,$borrow_qtt);
                            $row_borrow = mysqli_fetch_assoc($result_borrow);
                            // Select Book List (Borrow)
                            $select_detail = "SELECT *,bd.id as bid FROM book_detail bd
                                              INNER JOIN book b ON b.id = bd.book_id
                                              WHERE bd.status = 'return' AND b.name = '".$row['name']."'";
                            $result_detail = mysqli_query($conn,$select_detail);
                            $row_detail = mysqli_fetch_assoc($result_detail);
                            // Select Book List (Pending)
                            $pendingbook = "SELECT *,bd.id as bid FROM book_detail bd
                                              INNER JOIN book b ON b.id = bd.book_id
                                              WHERE bd.status = 'pending' AND b.name = '".$row['name']."'";
                            $resultpendingbook = mysqli_query($conn,$pendingbook);
                            $rowpendingbook = mysqli_fetch_assoc($resultpendingbook);
                            // Select Book List (Cart)
                            $onpending = "SELECT *,bd.id as bid FROM book_detail bd
                                              INNER JOIN book b ON b.id = bd.book_id
                                              WHERE bd.status = 'onpending' AND b.name = '".$row['name']."'";
                            $resultonpending = mysqli_query($conn,$onpending);
                            $rowonpending = mysqli_fetch_assoc($resultonpending);
                            // Get Book ID
                            if(!empty($row_detail)){
                                $borrow = " AND book_id = '".$row_detail['bid']."'";
                            }else{
                                $borrow = " AND book_id = '0'";
                            }
                            if(!empty($rowpendingbook)){
                                $bookp = " AND book_id = '".$rowpendingbook['bid']."'";
                            }else{
                                $bookp = " AND book_id = '0'";
                            }
                            if(!empty($rowonpending)){
                                $bookonp = " AND c.book_id = '".$rowonpending['bid']."'";
                            }else{
                                $bookonp = " AND c.book_id = '0'";
                            }
                            // Select Borrow Book List
                            $selectborrow = "SELECT * FROM borrow WHERE status = 'return' ".$borrow." AND member_id = '".$_SESSION['id']."'";
                            $resultselectborrow = mysqli_query($conn,$selectborrow);
                            $borrow_list = mysqli_fetch_assoc($resultselectborrow);
                            // Select Pending Book List
                            $selectpending = "SELECT * FROM borrow WHERE status = 'pending' ".$bookp." AND member_id = '".$_SESSION['id']."'";
                            $resultselectpending = mysqli_query($conn,$selectpending);
                            $pending_list = mysqli_fetch_assoc($resultselectpending);
                            // In Cart Book
                            $selectcart = "SELECT * FROM cart c
                                           INNER JOIN book_detail bd ON bd.id = c.book_id
                                           INNER JOIN book b ON b.id = bd.book_id
                                           WHERE c.member_id = '".$_SESSION['id']."' ".$bookonp."";
                            $resultcart = mysqli_query($conn,$selectcart);
                            $cart_list = mysqli_fetch_assoc($resultcart);
                            // Borrow Book
                            $borrowbook = "SELECT *,MAX(id) as bid FROM book_detail WHERE status = 'success' AND book_id = '".$row['id']."'";
                            $resultborrowbook = mysqli_query($conn,$borrowbook);
                            $rowborrowbook = mysqli_fetch_assoc($resultborrowbook);
                            ?>
                            <tr>
    						    <td><?php echo $i_rows++ ?></td>
                                <td><img style="height:130px; width:100px;" src="<?php echo 
    					             $row['image']; ?>"></td>
                                <td><?php echo $row['name'];?></td>
                                <td><?php echo $row['author'];?></td>
                                <td><?php echo $row['language'];?></td>
                                <td><?php echo $row_borrow['quantity']; ?></td>
                                <td>
                                <?php if($row_borrow['quantity'] <= 0){ echo "Empty"; }
                                      elseif(!empty($borrow_list)){ echo "Plesae Return Book"; }
                                      elseif(!empty($pending_list)){ echo "Please Wait...This Book Is Pending"; }
                                      elseif(!empty($cart_list)){ echo "This Book Already In Your Cart"; }
                                      else{ ?><a href="cart.php?id=<?php echo $rowborrowbook['bid'];?>"><i class="material-icons">shopping_cart</i></a>
                                <?php }?>
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