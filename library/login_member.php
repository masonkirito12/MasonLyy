<?php
include_once("connection/db.php");

if(isset($_POST['sign_in'])){
	if(!empty($_POST['username']) && !empty($_POST['password'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		
	    $query = "SELECT * FROM member where username = '".$username."'AND password='".$password."' AND status != 'delete'";
		$result = mysqli_query($conn,$query);
		$row = mysqli_fetch_assoc($result);
		$rows = mysqli_num_rows($result);
		
			if($rows == 1){
					$_SESSION['username'] = $row['username'];
					$_SESSION['password'] = $row['password'];
					$_SESSION['name'] = $row['name'];
					$_SESSION['id'] = $row['id'];
					
					if(isset($_POST["remember"])){
					setcookie ("member_login",$_POST["username"],time()+ (10 * 365 * 24 * 60 * 60));
				    setcookie ("member_password",$_POST["password"],time()+ (10 * 365 * 24 * 60 * 60));
					
					echo "<script>
					window.location.href='examples/information_book.php';
					</script>";
				}else {
					setcookie ("member_login","");
					setcookie ("member_password","");
					
					echo "<script>
					window.location.href='examples/information_book.php';
					</script>";
				}
			}else{
				  echo "<script> 
				  window.location.href='member.php';
				  alert('Wrong Username and Password!Please try again')
				  </script>";
			}
	}else{
		  echo "<script> 
		  window.location.href='member.php';
		  alert('Wrong Username and Password!Please try again')
		  </script>";
	}
	
}
?>