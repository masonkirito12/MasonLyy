<?php
if (!isset($_SESSION['id']) || ($_SESSION['id'] == "")){
	echo "<script>
		  window.location.href = '../index.php'
		  alert('Login First.')
		  </script>";
}
?>