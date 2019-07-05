<?php
class YoutbeDownloader
{
    private static $endpoint = "http://www.youtube.com/get_video_info";
    public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new static();
        }
        return $instance;
    }
	public function getIdYoutube($url){
		preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $$url, $id);
		if(!empty($id)) {
			return $id = $id[0];
		}
		return $url;
	}
	
    public function getLink($id)
    {
        $API_URL = self::$endpoint . "?&video_id=" . $id;
        $video_info = $this->curlGet($API_URL);
        $url_encoded_fmt_stream_map = '';
        parse_str($video_info);
        if(isset($reason))
        {
            return $reason;
        }
        if (isset($url_encoded_fmt_stream_map)) {
            $my_formats_array = explode(',', $url_encoded_fmt_stream_map);
        } else {
            return 'Không có dòng d?nh d?ng mã hóa du?c tìm th?y.';
        }
        if (count($my_formats_array) == 0) {
            return 'Không có d?nh d?ng b?n d? dòng tìm th?y - là id video chính xác?';
        }
        $avail_formats[] = '';
        $i = 0;
        $ipbits = $ip = $itag = $sig = $quality = $type = $url = '';
        $expire = time();
        foreach ($my_formats_array as $format) {
            parse_str($format);
            $avail_formats[$i]['itag'] = $itag;
            $avail_formats[$i]['quality'] = $quality;
            $type = explode(';', $type);
            $avail_formats[$i]['type'] = $type[0];
            $avail_formats[$i]['url'] = urldecode($url) . '&signature=' . $sig;
            parse_str(urldecode($url));
            $avail_formats[$i]['expires'] = date("G:i:s T", $expire);
            $avail_formats[$i]['ipbits'] = $ipbits;
            $avail_formats[$i]['ip'] = $ip;
            $i++;
        }
        return $avail_formats;
    }
    function curlGet($URL)
    {
        $ch = curl_init();
        $timeout = 3;
        curl_setopt($ch, CURLOPT_URL, $URL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $tmp = curl_exec($ch);
        curl_close($ch);
        return $tmp;
    }
}
$qualitys = YoutbeDownloader::getInstance()->getLink($_GET['url']);
if(is_string($qualitys))
{
    echo    $qualitys;
}
else {
    foreach ($qualitys as $video) {
		$hit = 'hd720';
		$sit = '18';
		if($video['type'] = $hit) {
			$kq = $video['url'];
			
			
		} else {
			if($video['type'] = $sit) {
				$kq = $video['url'];
				echo $kq;
			}
		}
		#echo "<a href='" . $video['url'] . "'>" . $video['quality'] . "-" . $video['type'] . "</a></br>";	
        return $kq;
    }
} 

?>
