<?php

//$r = upload_file_to_permanant_drive("./upload/production.fleet.20170422.zip");
//echo "Result:$r\n";

function upload_file_to_permanant_drive($filepath){

	// data fields for POST request
	$fields = array("uploadingfile"=>$filepath);

	// files to upload
	$filenames = array($filepath);

	$files = array();
	$content_type = "application/octet-stream";
	foreach ($filenames as $f){
	   $files[$f] = file_get_contents($f);
	   //var_dump($files[$f]);die;
	   $content_type = mime_content_type($filepath);
	   //var_dump($type);die;
	}

	// URL to upload to
	//$url = "https://localhost/laedrive/upload.php";
	$url = "https://171.99.133.30:24443/laedrive/upload.php";

	$curl = curl_init();

	$url_data = http_build_query($fields);

	$boundary = uniqid();
	$delimiter = '-------------' . $boundary;

	$post_data = build_data_files($boundary, $fields, $files, $content_type);


	curl_setopt_array($curl, array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_MAXREDIRS => 10,
		//CURLOPT_TIMEOUT => 30,
		//CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POST => 1,
		CURLOPT_POSTFIELDS => $post_data,
		CURLOPT_HTTPHEADER => array(
			//"Authorization: Bearer $TOKEN",
			"Content-Type: multipart/form-data; boundary=" . $delimiter,
			"Content-Length: " . strlen($post_data)
		),
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_SSL_VERIFYHOST => false
	));

	//
	$response = curl_exec($curl);

	if( strpos($response,"upload is complete") > 0 ){
		curl_close($curl);
		return true;
	}
	//$info = curl_getinfo($curl);
	//echo "code: ${info['http_code']}";

	//print_r($info['request_header']);

	//if( $response == false ){
	//	$err = curl_error($curl);
	//	curl_close($curl);
	//}
	
	return false;

}

function build_data_files($boundary, $fields, $files, $content_type){
    $data = '';
    $eol = "\r\n";

    $delimiter = '-------------' . $boundary;

	$form_name = "";
	$file_name = "";

    foreach ($fields as $form_name => $file_name) {
		$data .= "--" . $delimiter . $eol
            . 'Content-Disposition: form-data; name="' . $form_name . "\"".$eol.$eol
            . $file_name . $eol;
		$file_name = basename($file_name);
		break;
    }

    foreach ($files as $name => $content) {
        $data .= "--" . $delimiter . $eol
            . 'Content-Disposition: form-data; name="' . $form_name . '"; filename="' . $file_name . '"' . $eol
            . 'Content-Type: '.$content_type.$eol
            . 'Content-Transfer-Encoding: binary'.$eol
            ;

        $data .= $eol;
        $data .= $content . $eol;
    }
    $data .= "--" . $delimiter . "--".$eol;
	//die($data);

    return $data;
}