<?php

$dir = opendir("./upload");
while( $entry = readdir() ){
	if( $entry == '..' || $entry == '..' ) continue;
	$full_path = "./upload/$entry";
	if( is_file($full_path) ){
		$del = "<a href='delete.php?entry=$entry' style='color:red'>Delete</a>";
		if( $entry == "readme.txt" ){
			$del = "";
		}
		echo "<li><a href='$full_path'>$entry</a>&nbsp;$del</li>";
	}
}
closedir($dir);


