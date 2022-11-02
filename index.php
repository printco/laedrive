<?php

$upload_max_filesize = ini_get("upload_max_filesize");
$post_max_size = ini_get("post_max_size");

?>
<!DOCTYPE html>
<html lang="en">
	<title>Lae Drive</title>
	<head>
	<link rel="icon" type="image/x-icon" href="favicon.ico">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" src="upload.js"></script>
	<script type="text/javascript" src="jquery.js"></script>
	</head>
	<body>
		<div class='noti' style="padding:5px 0 5px 5px;">
			<div>Maximum upload file size <?php echo $upload_max_filesize;?></div>
			<div>Maximum post data size <?php echo $post_max_size;?></div>
		</div>
		<div class="container">
			<div class="row text-center">
				<div class="col-2"></div>
				<div class="col-8">
					<form id="upload_form" enctype="multipart/form-data" method="post">
						<div class="form-group">
							<input type="file" name="uploadingfile" id="uploadingfile">
						</div>
						<div class="form-group">
							<input class="btn btn-primary" type="button" value="Upload File" name="btnSubmit"
								   onclick="uploadFileHandler()">
						</div>
						<div class="form-group">
							<div class="progress" id="progressDiv">
								<progress id="progressBar" value="0" max="100" style="width:100%; height: 1.2rem;"></progress>
							</div>
						</div>
						<div class="form-group">
							<h3 id="status"></h3>
							<p id="uploaded_progress"></p>
						</div>
					</form>
				</div>
				<div class="col-2"></div>
			</div>
		</div>
		<div>
			<ul id="filelist">
			<?php
				require_once "list.php";
			?>
			</ul>
		</div>
	</body>
</html>