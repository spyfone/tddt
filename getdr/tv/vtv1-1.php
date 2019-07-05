<style>html,body{margin:0;}</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link title="Phan mem gian diep" rel='shortlink' href='http://phanmemgiandiep.net'/>


<!-- ------------------------ Style ------------------------ -->


<style> .video-js {width: 100%; height: 100%;} #videojs {width: 100%; height: 100%;}</style>
<meta name="referrer" content="no-referrer">
<link href="/player/video-js.min.css" rel="stylesheet">
<script src="/player/videojs-ie8.min.js"></script>
<script src="/player/video.min.js"></script>
<script src="/player/videojs-contrib-hls.min.js"></script>
<script src="/player/vjs-hls.min.js"></script>
<body onLoad="init()">
<div id="videojs"><video id="restre" autoplay preload="auto" height="100%" width="100%" class="video-js" controls data-setup='{"language": "vi"}'></video></div>
<script> function play(csmtalk) {src = csmtalk;
			player = videojs("restre");
			player.ready(function() {
			player.src({src: src, type: "application/x-mpegURL",});});
            player.play();}
		    function reload(i) {if (player.paused() && player.error_ != null ){var url = ''; if(url != ''){{ play(url);}} 
			else play('http://antv.xemtvhd.com:1935/live/_definst_/VTV1_H_5374560ab1atyu33dfee617ce3516ca502d/playlist.m3u8?token=M5btc7AylwSDWGhXrS27YAjIovKaSfhA7Coo0YZ9dAhZS483VId2Zfg3n9DP80X3C6HyoPIjEcKIYuPlFKVquE4gffBjPEhXXGDtHEdybwzA8FGXye5w93d04tgvxHK5vbxvxWCHfjr');}}
	    	function init() {var i = 1; play('http://antv.xemtvhd.com:1935/live/_definst_/VTV1_H_5374560ab1atyu33dfee617ce3516ca502d/playlist.m3u8?token=M5btc7AylwSDWGhXrS27YAjIovKaSfhA7Coo0YZ9dAhZS483VId2Zfg3n9DP80X3C6HyoPIjEcKIYuPlFKVquE4gffBjPEhXXGDtHEdybwzA8FGXye5w93d04tgvxHK5vbxvxWCHfjr');
		    setInterval(function() {reload(i); i++ }, 3000);}
		</script>
</body>

</html>