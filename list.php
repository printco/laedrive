<?php

$dir = opendir("./upload");
while( $entry = readdir() ){
	if( $entry == '..' || $entry == '..' ) continue;
	$full_path = "./upload/$entry";
	if( is_file($full_path) ){
		$file_date = filemtime($full_path);
		$file_ymd = date("d/m/Y H:i:s",$file_date);
		$del = "<a href='delete.php?entry=$entry' style='color:red' onclick='return confirmDelete();'>Delete</a>";
		$jsConfirm = "onclick=\"return confirmDownload()\"";
		if( $entry == "readme.txt" ){
			$del = "";
			$jsConfirm = "";
		}
		echo "<tr><td><a href='$full_path' $jsConfirm>$entry</a></td><td>$file_ymd</td><td>$del</td></tr>";
	}
}
closedir($dir);


