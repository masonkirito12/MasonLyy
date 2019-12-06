<?php
error_reporting(0);
include_once("../connection/db.php");
include_once("../security.php");
mysqli_set_charset($conn, 'utf8');

$date = date('Y-m-d');
$name = $_SESSION['name'];

if(isset($_POST['add'])){
	if(!empty($_POST['quantity'])){
		$quantity = $_POST['quantity'];
        $bookid = $_POST['cmbStatus'];

        for ($insert=0; $insert < $quantity; $insert++) { 
            // Select Last Barcode
            $select = mysqli_query($conn,"SELECT barcode FROM book_detail ORDER BY id DESC LIMIT 1");
            $barcode = mysqli_fetch_assoc($select);
            $newbarcode = $barcode['barcode'] + 1 ;
            // Insert New Book Detail
            $insert_book = "INSERT INTO book_detail (book_id,barcode,created_date,created_by,status)
                       VALUES ('$bookid','$newbarcode','$date','$name','success')";
            if ($result = mysqli_query($conn,$insert_book)){
            }
        }
        echo "<script>
              window.location.href='dashboard.php';
              alert('Success Insert')
              </script>";
    }else{
        echo "<script>
              window.location.href='add_book.php';
              alert('Failed To Insert!')
              </script>";
    }
}

// Select Book List
$query_book = "SELECT * FROM book WHERE status = 'active' ORDER BY id ASC";
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
    <!-- Another -->
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://rawgit.com/adrotec/knockout-file-bindings/master/knockout-file-bindings.css'>

    <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" media="screen">
    
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
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
                    <h4 class="title">Add Quantity</h4>
                    <p class="category"></p>
                </div>
                <form method="post" action="add_book.php" enctype="multipart/form-data">  
                    <div class="card-content table-responsive">
                        <div class="col-md-6">
                            <label>Name</label><br>
                            <select class="selectpicker" name="cmbStatus" id="name" data-live-search="true" required>
                            <option value="">Select</option>
                            <?php while($abc = mysqli_fetch_assoc($result_book)){ ?>
                            <option value="<?php echo $abc['id'];?>"><?php echo $abc['name']; ?></option>
                            <?php } ?>
                            </select><br><br>
                            <label>Quantity</label><br>
                            <input type="text" required="required" name="quantity" /><br><br><br>
                            <button type="submit" name="add" style="font-size:15px; height:40px; width:75px;">Add
                            </button>
                        </div>
                        <div class="col-md-6">
                            <label>Author</label><br>
                            <input type="text" readonly="readonly" id="author" name="author" value="<?php echo $row_bookdetail['author']; ?>" /><br><br>
                            <label>Price</label><br>
                            <input type="text" readonly="readonly" id="price" name="price" value="<?php echo $row_bookdetail['price']; ?>" /><br><br>
                            <label>Language</label><br>
                            <input type="text" readonly="readonly" id="language" name="language" value="<?php echo $row_bookdetail['language']; ?>" /><br><br>
                            <label>Image</label><br>
                            <img style="width:160px; height:175px;" id="image" src="<?php echo $row_bookdetail['image']?>">
                        </div>
                    </div>
                </form>
            </div>             
        </div>
    </div>
</body>
<!--   Core JS Files   -->
<script src="../assets/js/jquery.js" type="text/javascript"></script>
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
<!-- Another -->
<script>
    $('#name').on('change',function(){
       
        var selected = $(this).find("option:selected").val();
       
            //use ajax to run the check  
        $.post("selectbook.php", { id: selected },  
            function(result){  
                    var result1 = JSON.parse(result);
                    $('#author').val(result1.author);
                    $('#price').val(result1.price);
                    $('#language').val(result1.language);
                    $('#image').attr("src",result1.image);
            });  
 });

</script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.datatables.min.js" charset="utf8"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js" charset="utf8"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/knockout/3.1.0/knockout-min.js'></script>
<script src='https://rawgit.com/adrotec/knockout-file-bindings/master/knockout-file-bindings.js'></script>
<script type="text/javascript">
    $(document).ready(function() {

        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();

    });



</script>

</html>