<?php

$upload_max_filesize = ini_get("upload_max_filesize");

$upload = false;
$css = "";
if( isset($_FILES['uplfile']) ){
	$upload = true;
	$f = $_FILES['uplfile'];
	$msg = "";
	$css = "error";
	if( $f['error'] == 1 ){
		$msg = "Error " . $f['error'];
	} else {
		if( is_uploaded_file($f['tmp_name']) ){
			if( move_uploaded_file($f['tmp_name'],"./upload/".$f['name']) ){
				
				$css = "success";
				$msg = "Upload file success";
			}
		}
	}
}
?>
<html>
	<title>Lae Drive</title>
	<head>
	<link rel="icon" type="image/x-icon" href="favicon.ico">
	<style>
	body{
		font-family: sans-serif;
		font-size: 13px;
	}
	.success {
		background: #d6f3d6;
		padding: 5px;
		width: 300px;
		text-align: center;
		margin: 5px;
		border: 1px solid green;
		font-weight: bold;
		color: green;
	}
	.error {
		background: #efe3d8;
		padding: 5px;
		width: 300px;
		text-align: center;
		margin: 5px;
		border: 1px solid #c77955;
		font-weight: bold;
		color: #ef7242;
	}
	.noti {
		font-size: 10px;
		padding: 3px 0;
		background: #f9f9e5;
		border: 1px solid #e5e5b7;
		color: #4a4a2b;
		width: 310px;
		margin-bottom: 22px;
	}
	</style>
	</head>
	<body>
		<div class='noti'>Maximum upload file size <?php echo $upload_max_filesize;?></div>
		<?php
		if( $upload ){
			echo "<div class='msg $css'>$msg</div>";
		}
		?>
		<form method="post" enctype="multipart/form-data">
			<input type="file" name="uplfile" />
			<input type="submit" value="Upload" />
		</form>
	</body>
	<div>
		<ul>
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
		?>
		</ul>
	</div>
</html>