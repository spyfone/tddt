<?php
error_reporting(0);
//include "curl_gd.php";

if($_GET['url'] != ""){
	$url = $_GET['url'];
	//$linkdown = Drive($url);
	//$file = '[{"type": "video/mp4", "label": "HD", "file": "'.$linkdown.'"}]';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

<title>HDO Film - M3U8 Video Player</title>
<script src="//hdofilm.com/getdr/videojs/sleev.js"></script>

</head>
<body>

<video id="play" class="video-js sleev" >
</video>

<script>
 var Player = videojs("play", { 
"controls": true, 
"autoplay": true, 
"preload": "auto" ,
"playbackRates": [0.5, 1, 1.5, 2],
"width": 1200,
"height": 500,
 sources: [
{ src: '<?php echo $url?>', type: 'application/x-mpegURL', label:'720p'},
],

});videojs('play').videoJsResolutionSwitcher();     

  </script>
</body>
</html>