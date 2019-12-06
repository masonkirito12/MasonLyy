<?
include_once("../connection/db.php");
include_once("../security.php");

if(!empty($_GET['id']))
{
   
    //Borrow
    echo $borrowqry="INSERT INTO borrow (member_id,book_id,collect_date,status) 
                         VALUES ('$memberid','$bookid','$date','pending')";
    if ($result = mysqli_query($conn,$qry))
    {
        echo"<script>
         window.location.href='reserve1.php';
         </script>";
        
    }else{
        echo "<script>
              window.location.href='reserve.php';
              alert('Failed To Add Cart!');
              </script>";
    }
}
?>