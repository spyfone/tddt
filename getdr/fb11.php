<?php  
    error_reporting(0);
	if($_GET['url'] != ""){
	$fblink = $_GET['url'];
	}
	$fdata = facebookstream($fblink);
?>

<?php
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

function linkHD($data) {
    if (preg_match('/hd_src_no_ratelimit:"([^"]+)"/', $data, $result)) {
        return $result[1];
    } else {
    	return;
    }	
}

function linkSD($data) {
    if (preg_match('/sd_src_no_ratelimit:"([^"]+)"/', $data, $result)) {
        return $result[1];
    } else {
    	return;
    }	
}

function facebookstream($link) {
	$fetch = curl($link);
	$resHD = linkHD($fetch);
	$resSD = linkSD($fetch);
 	if($resHD != '') {
 		$source = '[{"type": "video/mp4", "label": "HD", "file": "'.$resHD.'"}, {"type": "video/mp4", "label": "SD", "file": "'.$resSD.'"}]';
 		return $source;
	} else {
 		$source = '[{"type": "video/mp4", "label": "SD", "file": "'.$resSD.'"}]';
 		return $source;
	}	
}
?>

	<link href="http://hdofilm.com/getdr/jwplayer/skins/prime.min.css" rel="stylesheet" type="text/css" />
	<link href="http://hdofilm.com/getdr/jwplayer/jw-logo/jw-logo-bar.css" rel="stylesheet" type="text/css" />

	<style type="text/css">
		html,body { 
			height:100%; 
			width:100%; 
			padding:0; 
			margin:0; 
		}
		#player {
			height:100%;
			width:100%; 
			padding:0; 
			margin:-3px;
		}
		
	</style>

<div id="player"></div>
<script type="text/javascript" src="jwplayer/jwplayer.js"></script>
<script type="text/javascript">
	jwplayer.key = "aXPs/0l4yPK0R9xfJbGN6Y9xnny9A3kOjoKBNQ==";
	var playerInstance = jwplayer("player");
		playerInstance.setup({
			sources:<?php echo $fdata ?>,
			autostart: true,
			controls: true,
			skin: {name: "prime"},
			width: "100%",
			height: "95%",
			aspectratio: "16:9",
                        image: "",
                        primary: 'html5',
			fullscreen: "true",
			preload: "auto",
			abouttext: "Player By HDOFilm.com",
			aboutlink: "https://hdofilm.com",
			logo: {file: 'http://hdofilm.com/wp-content/uploads/2017/11/favicon-1.png',hide: false,position: 'top-left'},
            sharing:{
			    link: "",
			    code: "",
				heading: "Chia sẻ",
				sites: ["facebook","twitter","tumblr","googleplus","reddit","linkedin","interest","email"],
			},          
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
