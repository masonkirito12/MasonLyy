<?php
include_once("connection/db.php");
?>
<!DOCTYPE html>
<html>

<!-- Head -->
<head>

	<title>Library Management Member Login Form </title>

	<!-- Meta-Tags -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="keywords" content="Library Member Login Form Widget Responsive, Login Form Web Template, Flat Pricing Tables, Flat Drop-Downs, Sign-Up Web Templates, Flat Web Templates, Login Sign-up Responsive Web Template, Smartphone Compatible Web Template, Free Web Designs for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design" />
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<!-- //Meta-Tags -->

	<!-- Style --> <link rel="stylesheet" href="css/style3.css" type="text/css" media="all">

	<!-- Fonts -->
		<link href="//fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
	<!-- //Fonts -->

</head>
<!-- //Head -->

<!-- Body -->
<body>
	<div class="send-button w3layouts agileits" style="padding-left: 95em;">
	<a href="index.php">
		<input type="submit" name="sign_in" value="Back" style="width: 310px;
    margin-top: 60px;
    background: black;">
	</a>
				
		</div>
	<h1>LIBRARY MANAGEMENT MEMBER LOGIN FORM</h1>

	<div class="container w3layouts agileits" style="width:30%;">
		<h2 style="margin-left:38%;">Sign In</h2>
		<form action="login_member.php" method="post">
			<input type="text" Name="username" placeholder="Username" required="" value="<?php
            if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>" class="input-field">
			<input type="password" Name="password" placeholder="Password" required="" value="<?php 
			if(isset($_COOKIE["member_password"])) { echo $_COOKIE["member_password"]; } ?>" class="input-field">
		<ul class="tick w3layouts agileits">
			<li>
				<input type="checkbox" id="brand1" value="" name="remember" <?php 
				if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?>>
				<label for="brand1"><span></span>Remember me</label>
			</li>
		</ul>
		<div class="send-button w3layouts agileits">
				<input type="submit" name="sign_in" value="Sign In">
		</div>
        </form>
	</div>
	<div class="footer w3layouts agileits">
		<p style="color: black;"> &copy; 2019 Library Member Login Form. All Rights Reserved </p>
	</div>

</body>
<!-- //Body -->

</html>