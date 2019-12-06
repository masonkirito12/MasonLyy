<?php

session_start();
unset($_SESSION['username']);
unset($_SESSION['password']);
unset($_SESSION['id']);
session_destroy();
echo "<script>
	  window.location.href='index.php';
	   </script>";
?>