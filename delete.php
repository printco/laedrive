<?php

$entry = $_GET['entry'];
$target = "./upload/";
if( is_file("$target$entry") ) {
	if( unlink("$target$entry") ){
		echo "Delete $entry success";
	}
}
echo "<a href='index.php'>Home</a>";
