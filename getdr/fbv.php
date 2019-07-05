<?php
error_reporting(0);
function curl($url) {
    $ch = @curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    $head[] = "Connection: keep-alive";
    $head[] = "Keep-Alive: 300";
    $head[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
    $head[] = "Accept-Language: en-us,en;q=0.5";
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36');
    curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
    $page = curl_exec($ch);
    curl_close($ch);
    return $page;
}

function getFacebook($link){
    if(substr($link, -1) != '/' && is_numeric(substr($link, -1))){
        $link = $link.'/';
    }
    preg_match('/https:\/\/www.facebook.com\/(.*)\/videos\/(.*)\/(.*)\/(.*)/U', $link, $id); // link d?ng https://www.facebook.com/userName/videos/vb.IDuser/IDvideo/?type=2&theater
    if(isset($id[4])){
        $idVideo = $id[3];
    }else{
        preg_match('/https:\/\/www.facebook.com\/(.*)\/videos\/(.*)\/(.*)/U', $link, $id); // link d?ng https://www.facebook.com/userName/videos/IDvideo
        if(isset($id[3])){
            $idVideo = $id[2];
        }else{
            preg_match('/https:\/\/www.facebook.com\/video\.php\?v\=(.*)/', $link, $id); // link d?ng https://www.facebook.com/video.php?v=IDvideo
            $idVideo = $id[1];
            $idVideo = substr($idVideo, 0, -1);
        }
    }
    $embed = 'https://www.facebook.com/video/embed?video_id='.$idVideo; // dua link v? d?ng embed
    $get = curl($embed);
    $data = explode('[["params","', $get); // tách chu?i [["params"," thành m?ng
    $data = explode('"],["', $data[1]); // tách chu?i "],[" thành m?ng
    $data = str_replace(
        array('\u00257B', '\u002522', '\u00253A', '\u00252C', '\u00255B', '\u00255C\u00252F', '\u00252F', '\u00253F', '\u00253D', '\u002526'),
        array('{', '"', ':', ',', '[', '\/', '/', '?', '=', '&'),
        $data[0]
    ); // thay th? các ký t? mã hóa thành ký t? d?c bi?t
    $data = json_decode($data); // decode chu?i
    $video_data = $data->video_data; // get video data
    $progressive = $video_data->progressive;
    $linkDownload = array();
    if(isset($progressive->hd_src)){
        $linkDownload['HD'] = $progressive->hd_src;// link download HD
    }
    if(isset($progressive->sd_src)){
        $linkDownload['SD'] = $progressive->sd_src;// link download SD
    }
    $imageVideo = 'https://graph.facebook.com/'.$idVideo.'/picture'; // get ?nh thumbnail
    $return['imageVideo'] = $imageVideo; // ?nh thumb c?a video
    $return['linkDownload'] = $linkDownload; // link download video
    return $return;
}

if($_GET['url'] != ""){
	$link = $_GET['url'];
}

$getFacebook = getFacebook($link);
if($getFacebook){
    echo "Link ?nh: ".$getFacebook['imageVideo'];
    echo "Link download: ";
    print_r($getFacebook['linkDownload']); 
}
?>