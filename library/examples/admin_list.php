<?php
include_once("../connection/db.php");
include_once("../security.php");

if(!empty($_GET['search'])){
	  $search = " AND name like '%".$_GET['search']."%'" ;
  }else{
	  $search = "";
  }
  
$date = date('Y-m-d');
$admin_informaion = "SELECT * FROM admin WHERE type = 'admin' AND status = 'active'".$search."";
$result_admin = mysqli_query($conn,$admin_informaion);

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
                 <div class="card card-plain">
                                <div class="card-header" data-background-color="purple">
                                    <h4 class="title">Admin Information List</h4>
                                    <p class="category"></p>
                                </div>
                                <form class="navbar-form navbar-left" role="search">
                                    <div class="form-group  is-empty">
                                        <input id="myInput" type="text" class="form-control" placeholder="Search Name">
                                        <span class="material-input"></span>
                                    </div>
                                    <button type="submit" class="btn btn-white btn-round btn-just-icon">
                                        <i class="material-icons">search</i>
                                        <div class="ripple-container"></div>
                                    </button>
                                </form>
                                <div class="card-content table-responsive">
                                    <table class="table table-hover">
                                        <thead class="text-primary">
                                            <th>NO</th>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>View</th>
                                        </thead>
                                        <tbody id="myTable">
                                        <?php
										 $i_rows = 1;
									     while ($row = mysqli_fetch_assoc($result_admin)) {?>
                                            <tr>
                                                <td><?php echo $i_rows++ ?></td>
                                                <td><?php echo $row['username'] ?></td>
                                                <td><?php echo $row['password'] ?></td>
                                                <td><?php echo $row['name'] ?></td>
                                                <td><?php echo $row['email'] ?></td>
                                                <td><a class="material-icons" href="admin_edit.php?id=<?php 
												echo $row['id'] ?>">search</a></td>
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