<?php

session_start();

require_once "logging.php";

$entry = $_GET['entry'];
$target = "./upload/";
if( is_file("$target$entry") ) {
	if( unlink("$target$entry") ){
		
		$username = $_SESSION['username'];
		write_log("User-$username delete file : $entry");
		
		echo "<div>Delete $entry success</div>";
	}
}
echo "<div><a href='index.php'>Home</a></div>";
