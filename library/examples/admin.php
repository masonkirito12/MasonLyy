<?php
include_once("../connection/db.php");
include_once("../security.php");

if(isset($_POST['register'])){
	if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['name'])){
		
		$username = $_POST['username'];
		$password = $_POST['password'];
        $name = $_POST['name'];
		$email = $_POST['email'];
        $creater = $_SESSION['name'];
        
	    $insert = "INSERT INTO admin(username,password,type,name,email,created_by,status) VALUES 
		           ('$username','$password','admin','$name','$email','$creater','active')";

        if($result = mysqli_query($conn,$insert)){
			echo "<script>
			       window.location.href='admin_list.php';
				   alert('Success To Register.')
			      </script>";
		}else{
			echo "<script>
			       window.location.href='admin.php';
				   alert('Please Try Again!')
			      </script>";
		}
	}else{
        echo "<script>
               window.location.href='admin.php';
               alert('Please Try Again!')
              </script>";
    }
}

$date = date('Y-m-d');
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
            <!-- <div class="content"> -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header" data-background-color="purple">
                                    <h4 class="title">Admin Information</h4>
                                    <p class="category">Complete Admin information</p>
                                </div>
                                <div class="card-content">
                                    <form method="post" action="admin.php">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Username</label>
                                                    <input type="text" name="username" class="form-control" required="required">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Password</label>
                                                    <input type="text" name="password" class="form-control" required="required">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Name</label>
                                                    <input type="text" name="name" class="form-control" required="required">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Email</label>
                                                    <input type="email" name="email" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group"> 
                                                    <div class="form-group label-floating">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary pull-right" name="register">
                                        Register</button>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                        </div>
                    </div>
                </div>
            <!-- </div> -->
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

</html>