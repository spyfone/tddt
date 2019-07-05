<?php
//Code /xemtb.php?url=
@set_time_limit(0);
$id = $_GET['url']; //'zXpCUTPmAp8';
parse_str(file_get_contents('http://www.youtube.com/get_video_info?video_id='.$id), $info);
$medyalar = explode(',', $info['url_encoded_fmt_stream_map']);
foreach($medyalar as $medya) {
    parse_str($medya, $this);
    $js .= '{"type": "video/mp4", "label": "'.$this['quality'].'px", "file": "'.$this['url'].'"},';
}
$fdata = "[".$js."]";
?>
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

<link href="http://hdofilm.com/getdr/jwplayer/skins/prime.min.css" rel="stylesheet" type="text/css" />
<link href="http://hdofilm.com/getdr/jwplayer/jw-logo/jw-logo-bar.css" rel="stylesheet" type="text/css" />

<div id="player"></div>
<script type="text/javascript" src="http://hdofilm.com/getdr/jwplayer/jwplayer.js"></script>
<script type="text/javascript">
	jwplayer.key = "aXPs/0l4yPK0R9xfJbGN6Y9xnny9A3kOjoKBNQ==";
	var playerInstance = jwplayer("player");
		playerInstance.setup({
			sources:<?php echo $fdata ?>,
			autostart: false,
			controls: true,
			skin: {name: "prime"},
			width: "100%",
			height: "500",
			aspectratio: "16:9",
                        image: "",
                        primary: 'html5',
			fullscreen: "true",
			preload: "auto",
			abouttext: "Player By HDOFilm.com",
			aboutlink: "https://hdofilm.com",
			logo: {file: 'http://hdofilm.com/getdr/logo.png',hide: false,position: 'top-left'},
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
