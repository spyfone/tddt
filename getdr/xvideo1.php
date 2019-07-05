function get_youtube($code)
{
    $data = file_get_contents('http://youtube.com/get_video_info?video_id=' . $code . '&el=vevo&fmt=18&asv=2&hd=1');
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
get_youtube('kgs1u-6ASqk');