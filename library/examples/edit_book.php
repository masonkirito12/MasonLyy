<?php
include_once("../connection/db.php");
include_once("../security.php");
mysqli_set_charset($conn, 'utf8');

if(!empty($_GET['id'])){
	$id = " WHERE id ='".$_GET['id']."'";
}else{
	$id = "";
}

$date = date('Y-m-d');

$query = "SELECT * FROM book ".$id." ";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($result);

if(isset($_POST['edit'])){
	if(!empty($_POST['name']) && !empty($_POST['author']) && !empty($_POST['price']) && $_POST['language'] != "Select"){
		
	//if image is not empty
	if(!empty($_FILES['image']['name']))
	{	
		//take the image extensions
		$ext = explode('.', $_FILES['image']['name']);
		
		//change the extensions to lower cases
		$ext = strtolower(array_pop($ext));
		
		//$file = 'img/P'.date('YmdHis').'.'.$ext;
		$file = 'img/'.$_FILES['image']['name'];
		//check the extension type
		if(($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png')){ 
			$target_path = $file;
		}else{
			$error_ext = 1;
		}
		//check the file is exists in img folder or not
		if(file_exists($file)){
			$file_exists = 1;
		}
	}
	
	if(isset($error_ext)){
		echo "<script>alert('Please upload .jpg, .jpeg or .png file only.')</script>"; 
	}elseif(isset($file_exists)){
		echo "<script>alert('Image already exists, please choose another image or change the image name.')</script>"; 
	}elseif(isset($target_path) && !move_uploaded_file($_FILES['image']['tmp_name'], $target_path)){
		echo "<script>alert('Image failed to upload image')</script>";  
	}else{
	
		$name = $_POST['name'];
		$author = $_POST['author'];
        $price = $_POST['price'];
		$language = $_POST['language'];
		
		if(isset($file) && !empty($file)){
			$new_file = ", image = '".$file."'";
		}else{
			$new_file = "";
		}
		$qry_edit = "Update book SET name = '".$name."', author = '".$author."', price = '".$price."', language = '".$language."' ".$new_file." WHERE id = '".$_GET['id']."'";
		
		if($result_edit = mysqli_query($conn,$qry_edit)){
			echo "<script>
			      window.location.href='dashboard.php';
				  alert('Edit Success')
			      </script>";
		}else{
		    echo "<script>
                  window.location.href='dashboard.php';
    		      alert('Failed To Edit!')
    		      </script>";
		}
	}	
    }
}

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
                    <h4 class="title">Edit Book</h4>
                    <p class="category"></p>
                </div>
                <form method="post" action="edit_book.php?id=<?php echo $_GET['id'];?>" enctype="multipart/form-data">
                    <div class="card-content table-responsive">
                        <div class="col-md-6">
                            <label>Name</label><br>
                            <input type="text" required="required" name="name" value="<?php echo $row['name'] ?>"/>
                            <br><br>
                            <label>Author</label><br>
                            <input type="text" required="required" name="author" value="<?php echo $row['author'] ?>"/>
                            <br><br>
                            <label>Price</label><br>
                            <input type="text" required="required" name="price" value="<?php echo $row['price'] ?>"/>
                            <br><br>
                            <button type="submit" name="edit" style="font-size:15px; height:40px; width:75px;">
                            Save</button>
                        </div>
                        <div class="col-md-6">
                            <label>Language</label><br>
                            <select name="language">
                            <option value="">Select</option>
                            <option value="accounting" <?php if($row['language'] == 'accounting'){echo "selected=\"selected\"";}?>>Accounting</option>
                            <option value="business" <?php if($row['language'] == 'business'){echo "selected=\"selected\"";}?>>Business</option>
                            <option value="multimedia" <?php if($row['language'] == 'multimedia'){echo "selected=\"selected\"";}?>>Multimedia</option>
                            <option value="networking" <?php if($row['language'] == 'networking'){echo "selected=\"selected\"";}?>>Networking</option>
                            <option value="programming" <?php if($row['language'] == 'programming'){echo "selected=\"selected\"";}?>>Programming</option>
                            </select><br><br>
                            <label>Image</label>
                            <input type="file" name="image" onchange="readURL(this);" value="<?php echo $row['image'] ?>"/>
                            <br>
                            <img style="height:80px; width:60px; margin-left:25px;" id="blah"
                            src="<?php echo $row['image']; ?>">
                        </div>
                    </div>
                </form>
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
function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result)/*
                    .width(150)
                    .height(200)*/;
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
</html>