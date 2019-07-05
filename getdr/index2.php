<?php
error_reporting(0);
include "curl_gd.php";
$str = urldecode($_GET['url']);
$str = substr($str, 0); 
$linkDrive = base64_decode($str);
$sub1 = $_GET['sub'];
$sub = substr($sub1, 0, -1);
 $thumbnail=$_GET['thumbnail'];
 $linkdown = Drive($linkDrive);
$file = '[{"type": "video/mp4", "label": "HD", "file": "'.$linkdown.'"}]';

function genSub($sub) {
	if ($sub) {
		$array = explode('|', $sub);
		foreach($array as $array_sub) {
			$dsub = explode(',', $array_sub);
			$list .= "{file:'".$dsub[0]."',label:'".$dsub[1]."',kind:'captions'},";
		}
		$data = 'tracks:['.rtrim($list,',').']';
		return $data;
	}
}

?>


<div id="player"></div>
<script type="text/javascript" src="jwplayer/jwplayer.js"></script>
<script type="text/javascript">
	jwplayer.key = "aXPs/0l4yPK0R9xfJbGN6Y9xnny9A3kOjoKBNQ==";
	var playerInstance = jwplayer("player");
		playerInstance.setup({
			sources: <?php echo $file?>,
			autostart: false,
			controls: true,
			skin: {name: "seven"},
			width: "100%",
			height: "100%",
			aspectratio: "16:9",
                        image: "<?php echo $thumbnail; ?>",
                        primary: 'html5',
			fullscreen: "true",
			preload: "auto",
			abouttext: "Player By gomoviestheme",
			aboutlink: "https://gomoviestheme.ga",
                        logo: {file: 'http://goplayhd.top/wp-content/uploads/2017/06/gomovies-favicon.png',hide: true,position: 'top-right'},
                       <?php echo $sub ? genSub($sub) . "," : ""; ?> 
                        captions:{color:'#ffff00',fontSize:20,backgroundOpacity:30},


		});
</script>
<style type="text/css">
body{padding: 0; margin: 0;background: #000}
.jwplayer.jw-flag-aspect-mode, .video-js {width:100% !important; height: 100% !important}
#player{text-align: center;color:#fff;}
</style>
<!-- Histats.com  START  (aync)-->
<script type="text/javascript">var _Hasync= _Hasync|| [];
_Hasync.push(['Histats.start', '1,3848063,4,0,0,0,00010000']);
_Hasync.push(['Histats.fasi', '1']);
_Hasync.push(['Histats.track_hits', '']);
(function() {
var hs = document.createElement('script'); hs.type = 'text/javascript'; hs.async = true;
hs.src = ('//s10.histats.com/js15_as.js');
(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(hs);
})();</script>
<noscript><a href="/" target="_blank"><img  src="//sstatic1.histats.com/0.gif?3848063&101" alt="contatore gratuito" border="0"></a></noscript>
<!-- Histats.com  END  -->