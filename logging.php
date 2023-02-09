<?php

function write_log($msg){
	$log_date = date("Ymd");
	$date = date("Y-m-d H:i:s");
	if( ! file_exists("./log") ){
		mkdir("./log/");
	}
	file_put_contents("./log/laedrive.${log_date}.log","$date > $msg\r\n",FILE_APPEND);
}