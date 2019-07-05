<?php
error_reporting(0);
if($_GET['url'] != ""){
	$str = urldecode($_GET['url']);
	$str = substr($str, 0);
	$url = base64_decode($_GET['url']);
	$sub1 = $_GET['sub'];
	$sub = substr($sub1, 0, -1);
	$thumbnail=$_GET['thumbnail'];

}
parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
$id = $my_array_of_vars['v'];

parse_str(file_get_contents('http://www.youtube.com/get_video_info?video_id='.$id), $info);
$medyalar = explode(',', $info['url_encoded_fmt_stream_map']);
foreach($medyalar as $medya) {
    parse_str($medya, $this);
    $js .= '{"type": "video/mp4", "label": "'.$this['quality'].'px", "file": "'.$this['url'].'"},';
}
$fdata = "[".$js."]";

echo $url;
echo $id;
echo $fdata;
?>
