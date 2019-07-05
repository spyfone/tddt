<?php
$id='5HDw7sQE2H0';
$dt=file_get_contents("http://www.youtube.com/get_video_info?video_id=$id&el=embedded&ps=default&eurl=&gl=US&hl=en");
$x=explode("&",$dt);
$t=array(); $g=array(); $h=array();

foreach($x as $r){
    $c=explode("=",$r);
    $n=$c[0]; $v=$c[1];
    $y=urldecode($v);
    $t[$n]=$v;
}
$streams = explode(',',urldecode($t['url_encoded_fmt_stream_map']));
foreach($streams as $dt){ 
    $x=explode("&",$dt);
    foreach($x as $r){
        $c=explode("=",$r);
        $n=$c[0]; $v=$c[1];
        $h[$n]=urldecode($v);
    }
    $g[]=$h;
}
print_r($g);
echo "\r\n</pre>";
?>