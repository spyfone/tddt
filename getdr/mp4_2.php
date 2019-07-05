<?php
error_reporting(E_ERROR | E_PARSE);
function YouTuBe($link) {
$content = curl($link);
if(preg_match('/;ytplayer\.config\s*=\s*({.*?});/', $content, $matches)) {
	$jsonData = json_decode($matches[1], true);
	$streamMap = $jsonData['args']['url_encoded_fmt_stream_map'];
	$videoUrls = array();
	$streamMap = explode(',', $streamMap);
	$streamMap = @array_reverse($streamMap);
	foreach ($streamMap as $url){
		$url = str_replace('\u0026', '&', $url);
		$url = urldecode($url);
		parse_str($url, $value);
		$dataURL = $value['url'];
		unset($value['url']);
		if(in_array($value['itag'],array(18,35,22))) {
			$height = (int)str_replace(array(18,35,22),array(360,480,720),$value['itag']);
			$data[$height] = array(
			'url' => str_replace('"', "'", $dataURL.'&'.urldecode(http_build_query($value))),
			'type' => 'mp4');
		}
	}
}
if($data[720][url] and $data[480][url]) {
	$source .= '360p=>'.$data[360][url].'|480p=>'.$data[480][url].'|720p=>'.$data[720][url];
} elseif($data[720][url]) {
	$source .= '360p=>'.$data[360][url].'|720p=>'.$data[720][url];
} elseif($data[480][url]) {
	$source .= '360p=>'.$data[360][url].'|480p=>'.$data[480][url];
} else {
	$source .= '360p=>'.$data[360][url];
}
return $source;
}
?>