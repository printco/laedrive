<?php

$entry = $_GET['entry'];
$target = "./upload/";
if( is_file("$target$entry") ) {
	if( unlink("$target$entry") ){
		echo "<div>Delete $entry success</div>";
	}
}
echo "<div><a href='index.php'>Home</a></div>";
