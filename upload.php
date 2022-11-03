<?php

require_once "permanantdrive.php";

//print_r($_FILES);die;
if( isset($_FILES["uploadingfile"]) ){
	if (!$_FILES["uploadingfile"]["tmp_name"]) {//No file chosen
		echo "ERROR: Please browse for a file before clicking the upload button.";
		exit();
	} else {
		$type_allow = array(
			"application/x-zip-compressed",
			"application/x-gzip",
			"application/zip"
		);
		$extension = pathinfo($_FILES['uploadingfile']['name'], PATHINFO_EXTENSION);//Gets the file extension
		$type = $_FILES["uploadingfile"]["type"];
		if ( in_array($type,$type_allow) ) {//Check if allow type
			$folderPath = "./upload/";//Directory to put file into
			$original_file_name = $_FILES["uploadingfile"]["name"];//File name
			$size_raw = $_FILES["uploadingfile"]["size"];//File size in bytes
			$size_as_mb = number_format(($size_raw / 1048576), 2);//Convert bytes to Megabytes
			if (move_uploaded_file($_FILES["uploadingfile"]["tmp_name"], "$folderPath" . $_FILES["uploadingfile"]["name"] . "")) {//Move file
				echo "<div>$original_file_name upload is complete</div>";
				//echo "$original_file_name uploaded to $folderPath it is $size_as_mb Mb.";
				$full_path = "$folderPath" . $_FILES["uploadingfile"]["name"];
				$r = upload_file_to_permanant_drive($full_path);
				if( $r == true ){
					echo "<div>Upload file to permanant drive success</div>";
					exit;
				}
			}
		} else {
			echo "<div>";
			echo "<div>Your mime type: $type</div>";
			echo "<div>Allow only these type</div>";
			echo "<ul>";
			foreach($type_allow as $k=>$v){
				echo "<li>$v</li>";
			}
			echo "</ul>";
			echo "</div>";
			exit;
		}
	}
} else {
	echo "Empty file object";
}