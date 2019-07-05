<?php
error_reporting(0);
$id = $_GET('url');
function youtube1($id){
	parse_str(file_get_contents('http://www.youtube.com/get_video_info?video_id='.$id), $info);
	$medyalar = explode(',', $info['url_encoded_fmt_stream_map']);
	foreach($medyalar as $medya) {
		parse_str($medya, $this);
		$source = '[{"type": "video/mp4", "label": "'.$this['quality'].'p", "file": "'.$this['url'].'"}]';
	}
print_r($source);
echo "\r\n</pre>";
}

function youtube($id)
{
    $data = file_get_contents('http://youtube.com/get_video_info?video_id=' . $id . '&el=vevo&fmt=18&asv=2&hd=1');
    parse_str($data , $details);
    $my_formats_array = explode(',' , $details['adaptive_fmts']);
    $avail_formats[] = '';
    $i = 0;
    $ipbits = $ip = $itag = $sig = $quality_label = '';
    $expire = time();
    foreach ($my_formats_array as $format) {
         parse_str($format);
         $avail_formats[$i]['itag'] = $itag;
         $avail_formats[$i]['quality'] = $quality_label;
         $type = explode(';', $type);
         $avail_formats[$i]['type'] = $type[0];
         $avail_formats[$i]['url'] = urldecode($url) . '&signature=' . $sig;
         parse_str(urldecode($url));
         $avail_formats[$i]['expires'] = date("G:i:s T", $expire);
         $avail_formats[$i]['ipbits'] = $ipbits;
         $avail_formats[$i]['ip'] = $ip;
         $i++;
     }
     var_dump($avail_formats);
}
?>
