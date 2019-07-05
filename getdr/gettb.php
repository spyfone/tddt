<?php
//Code by vuvanhoan
@set_time_limit(0);
$id = $_GET['url']; //'zXpCUTPmAp8';
parse_str(file_get_contents('http://www.youtube.com/get_video_info?video_id='.$id), $info);
$medyalar = explode(',', $info['url_encoded_fmt_stream_map']);
foreach($medyalar as $medya) {
    parse_str($medya, $this);
    $js .= '<source src="'.$this['url'].'" type="video/mp4" data-res="'.$this['quality'].'px" />';
}
echo $medyalar
echo $medya
echo parse_str
?>