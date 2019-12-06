<?php
include_once("../connection/db.php");
include_once("../security.php");
mysqli_set_charset($conn, 'utf8'); 

$date = date('Y-m-d');
// Select Book List
    $select = "SELECT o.id oid,m.name mname,m.ic mic,b.image bimage,b.name bname,bd.barcode barcode,o.borrow_date borrow_date,o.return_date return_date,o.status ostatus,b.price bprice FROM borrow o
           INNER JOIN member m ON m.id = o.member_id
           INNER JOIN book_detail bd ON bd.id = o.book_id
           INNER JOIN book b ON b.id = bd.book_id
           WHERE o.status = 'return' AND o.id = '".$_GET['id']."'ORDER BY o.collect_date ASC ";
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
                                    <h4 class="title">Checked Return Book List</h4>
                                </div>
                                <form action="collect.php?id=<?php echo $_GET['id'];?>&bid=<?php echo $_GET['bid'];?>&status=return" method="post" role="form">
                                <div class="card-content table-responsive">
                                    <table class="table">
                                        <thead class="text-primary">
                                            <th>Name</th>
                                            <th>IC</th>
                                            <th>Book Image</th>
                                            <th>Book Name</th>
                                            <th>Barcode</th>
                                            <th>Borrow Date</th>
                                            <th>Return Date</th>
                                        </thead>
                                        <tbody id="myTable">
                                        <?php 
										$row = mysqli_fetch_assoc($result);

                                        $return_date = $row['return_date'];
                                        $date3 = date_create("$date");
                                        $returndate = date_create("$return_date");
                                        $diff = date_diff($date3,$returndate);
                                        $many_days = $diff->d;
                                        // count how many days over return date
                                        $datetime1 = time();
                                        $datetime2 = strtotime($return_date);
                                        $between = $datetime1 - $datetime2;
                                        $count_days = round($between / (60 * 60 * 24));

                                        if($date > $return_date){
                                            $paylateprice = $diff->d * 5;
                                        }else{
                                            $paylateprice = "0";
                                        }
                                        $paymissprice = $row['bprice'];
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
                                            </tr>
                                        <thead class="text-primary">
                                        <th>Charge Option</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>How Many Days</th>
                                        <th>Charge Per Day</th>
                                        <th>Total Charge</th>
                                        </thead>
                                        <tr>
                                        <td>
                                        <label>Charge option :</label>
                                        </td>
                                        <td><select name="return_status" id="return_status">
                                        <option value="">Choose</option>
                                        <option value="late_price" <?php if($count_days > 0) echo 'selected="selected"';?>>Late</option>
                                        <option value="miss_price">Book Missing</option>
                                        </select></td>
                                        <td></td>
                                        <td></td>
                                        <td id="days" style="visibility:hidden;"><?php if($date > $return_date){ echo $many_days; }else{ echo 0; } ?></td>
                                        <td id="chargeprice" style="visibility:hidden;">RM5.00</td>
                                        <td>
                                        <span id="lateprice" style="visibility:hidden;"><?php echo "RM".$paylateprice; ?>
                                        </span>
                                        <span id="missprice" style="visibility:hidden;">
                                        RM<?php echo $paymissprice; ?>
                                        </span>
                                        </td>
                                        <input type="text" style="visibility:hidden;" name="borrowdate" value="<?php echo $row['borrow_date'] ?>">
                                        <input type="text" style="visibility:hidden;" name="paylateprice" value="<?php echo $paylateprice; ?>">
                                        <input type="text" style="visibility:hidden;" name="paymissprice" value="<?php echo $paymissprice; ?>">
                                        </tr>
                                        </tbody id="myTable">
                                    </table>
                                    <button type="submit" value="sumbit" name="sumbit" style="float:right;
                                      width:100px; margin-top:50px;">
                                          <i class="material-icons">done</i>
                                     </button>
                                </div>
                                </form>
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
<script>
    var counts = "<?php Print($count_days); ?>";
    //use ajax to run the check
    if(counts > 0){
        $('#days').attr("style","visibility: visible");
        $('#chargeprice').attr("style","visibility: visible");
        $('#lateprice').attr("style","visibility: visible");
        $('#missprice').attr("style","visibility: hidden");
    }
</script>
<script>
$( document ).ready(function() {
    $('#return_status').change(function(){
        var select =  $('#return_status').val();
        //use ajax to run the check  
        if(select == 'late_price'){
            $('#days').attr("style","visibility: visible");
            $('#chargeprice').attr("style","visibility: visible");
            $('#lateprice').attr("style","visibility: visible");
            $('#missprice').attr("style","visibility: hidden");
        }else if(select == 'miss_price'){
            $('#days').attr("style","visibility: hidden");
            $('#chargeprice').attr("style","visibility: hidden");
            $('#lateprice').attr("style","visibility: hidden");
            $('#missprice').attr("style","visibility: visible");
        }else{
            $('#days').attr("style","visibility: hidden");
            $('#chargeprice').attr("style","visibility: hidden");
            $('#lateprice').attr("style","visibility: hidden");
            $('#missprice').attr("style","visibility: hidden");
        }   
    });  
});
</script>