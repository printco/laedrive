<?php

$options = array(
        CURLOPT_RETURNTRANSFER => true,     // return web page
        CURLOPT_HEADER         => false,    // don't return headers
        CURLOPT_FOLLOWLOCATION => true,     // follow redirects
        CURLOPT_ENCODING       => "",       // handle all encodings
        CURLOPT_USERAGENT      => "laedrive", // who am i
        CURLOPT_AUTOREFERER    => true,     // set referer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
        CURLOPT_TIMEOUT        => 120,      // timeout on response
        CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
        CURLOPT_SSL_VERIFYPEER => false,	// Disabled SSL Cert checks
		CURLOPT_SSL_VERIFYHOST => false     // 
    );

$ch = curl_init( "https://171.99.133.30:24443/laedrive/list.php" );
curl_setopt_array( $ch, $options );

$content = curl_exec( $ch );
curl_close( $ch );

echo $content;