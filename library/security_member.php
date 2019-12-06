<?php
if (!isset($_SESSION['id']) || ($_SESSION['id'] == "")){
	echo "<script>
		  window.location.href = '../member.php'
		  alert('Login First.')
		  </script>";
}
?>