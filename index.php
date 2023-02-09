<?php

session_start();
require_once "logging.php";

if( ! isset($_SESSION['username']) ){
	header("Location: login.php");
}

$username = $_SESSION['username'];
write_log("User-$username in system");

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
	<script>
	function confirmMeet(){
		if( confirm("Meeet?") ){
			return true;
		}
		return false;
	}
	
	function confirmDownload(){
		if( confirm("Download?") ){
			return true;
		}
		return false;
	}
	
	function confirmLogout(){
		if( confirm("Logout?") ){
			return true;
		}
		return false;
	}
	</script>
	</head>
	<body>
		<div id="info">
			<span>
		<?php
			echo "User name : $username";
			if( isset($_SESSION['username']) ){
				echo
				'<span id="logout">
					<a href="logout.php" onclick="return confirmLogout();">Logout</a>
				</span>';
			}
		?>
			<span>
		</div>
		<div id="wrap">
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
							<span id="waitstatus"></span>
						</div>
						<div class="form-group">
							<div class="progress" id="progressDiv">
								<progress id="progressBar" value="0" max="100" style="width:100%; height: 30px;"></progress>
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
		<div id="msteam-meet">
			<a href="https://teams.microsoft.com/dl/launcher/launcher.html?url=%2F_%23%2Fl%2Fmeetup-join%2F19%3Ameeting_ZTljYzY3ZDEtMjMyOC00MmQ5LWIwMDAtZTExZDBiNWMwYmFm%40thread.v2%2F0%3Fcontext%3D%257b%2522Tid%2522%253a%2522771863e0-ae69-42c9-9bb8-40e48d597651%2522%252c%2522Oid%2522%253a%2522cd50b393-2000-4c59-916d-f069a091654d%2522%257d%26anon%3Dtrue&type=meetup-join&deeplinkId=7651a5dd-34fc-4f29-abe7-c49fa0f95f3d&directDl=true&msLaunch=true&enableMobilePage=true&suppressPrompt=true" target="_blank" onclick="return confirmMeet()">Meeting</a>
		</div>
		<div id="filelist">
			<table>
				<thead>
				<tr><th>File Name</th><th>File Date</th><th>Size(KB)</th><th>Hash(SHA1)</th><th>&nbsp;</th></tr>
				</thead>
				<tbody>
				<?php
					require_once "list.php";
				?>
				</tbody>
			</table>
		</div>
		<?php
		if( isset($_SESSION['username']) ){
		?>
		<div id="logout">
			<a href="logout.php" onclick="return confirmLogout();">Logout</a>
		</div>
		<?php 
		}
		?>
		</div>
	</body>
</html>