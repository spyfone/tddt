<?php
	$URL = "https://drive.google.com/get_video_info?docid=".$_SERVER["QUERY_STRING"];
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
$ip = rand(0,255).'.'.rand(0,255).'.'.rand(0,255).'.'.rand(0,255);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("REMOTE_ADDR: $ip", "HTTP_X_FORWARDED_FOR: $ip"));
	curl_setopt($curl, CURLOPT_URL, $URL);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$response_data = urldecode(urldecode(curl_exec($curl)));

	curl_close($curl);												// Close Curl
	
	//status
	$protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http";
	$shot = "https://drive.google.com/vt?id=".$_SERVER["QUERY_STRING"];
	$sharing = $protocol."://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
	if(preg_match("/errorcode=100/", $response_data) && strlen($_SERVER["QUERY_STRING"])!= "28"){
		$title = "請輸入正確的影片辨識碼。";
	} elseif(preg_match("/errorcode=100/", $response_data)) {
		$title = "這部影片不存在。";
	} elseif(preg_match("/errorcode=150/", $response_data)) {
		$title = "您沒有這部影片的存取權限。";
	} else {
		$title = preg_replace("/&BASE_URL.*/", Null, preg_replace("/.*title=/", Null, $response_data));
	}
?>