<?php
if( isset($_FILES['uplfile']) ){
	if( is_uploaded_file($_FILES['uplfile']['tmp_name']) ){
		if( move_uploaded_file($_FILES['uplfile']['tmp_name'],"./upload/".$_FILES['uplfile']['name']) ){
			echo "<div>Upload success</div>";
		}
	}
}
?>
<html>
	<title>Lae Drive</title>
	<body>
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
					echo "<li><a href='$full_path'>$entry</a></li>";
				}
			}
			closedir($dir);
		?>
		</ul>
	</div>
</html>