<?php
error_reporting(0);
if($_GET['url'] != ""){
	$url=$_GET{'url'};
	

	if (strstr($_GET['url'],"youtube.com")){
		echo "Youtube"
	}
	if (strstr($_GET['url'],"facebook.com")){
		echo "Facebook"
	}
	
}
?>