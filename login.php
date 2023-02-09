<?php
require_once "logging.php";

session_start();

if( isset($_SESSION['username']) ){
	header("Location: index.php");
}

if( count($_POST) > 0 ){
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if( ($username == "r" && $password == "1234")
		|| ($username == "c" && $password == "1234")
		|| ($username == "l" && $password == "1234")
	){
		$_SESSION['username'] = $username;
		
		write_log("$username loggin to system");
		
		header("Location: index.php");
	}
}
?>
<html>
	<head>
		<title>Lae Drive</title>
	</head>
	<body>
	<form name="login" method="post" action="login.php">
	  <input type="text" name="username" placeholder="Username" />
	  <input type="password" name="password" placeholder="Password" />
	  <input type="submit" value="Login" />
	</form>
	</body>
</html>