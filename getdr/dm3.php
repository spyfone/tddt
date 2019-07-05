<?php
error_reporting(0);

if($_GET['url'] != ""){
	$url = $_GET['url'];
}
if($_GET['id'] != ""){
	$id = $_GET['id'];
$thumbnail_large_url='https://api.dailymotion.com/video/'.$id.'?fields=thumbnail_large_url';
$json_thumbnail = file_get_contents($thumbnail_large_url);
$get_thumbnail = json_decode($json_thumbnail, TRUE);
$img=$get_thumbnail['thumbnail_large_url'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

<title>HDO Film - M3U8 Video Player</title>
<link href="http://hdofilm.com/getdr/videojs/video-js.css" rel="stylesheet">
	<link href="http://hdofilm.com/getdr/videojs/video-tube-full.css" rel="stylesheet">
    <script src="http://hdofilm.com/getdr/videojs/video.js"></script>
	<script src="http://hdofilm.com/getdr/videojs/videojs-flash.js"></script>
	<script src="http://hdofilm.com/getdr/videojs/videojs-http-streaming.js"></script>
	<script src="http://hdofilm.com/getdr/videojs/videojs-http-streaming.min.js"></script>
</head>
<body>
<style>
body {
    height: 100%;
    margin: 0;
    overflow: hidden;
    position: absolute;
    width: 100%;
}
video,#play {
    min-height: 100%;
    min-width: 100%;
    position: absolute;
}

.fullscreen-bg {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    overflow: hidden;
 width: 100%;
    height: 100%;
}
.fullscreen-bg__video {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}
</style>

	<video id="play" class="video-js vidtube-full fullscreen-bg__video" controls preload="auto"
		poster="<?php echo $img?>" data-setup='{"autoplay": true}'>
		<source
		src="<?php echo $url?>"
		type="application/x-mpegURL">
		<track kind="captions" src="captions.en.vtt" srclang="en" label="English" default></track>		
	</video>


<script>
var player = videojs('play');
player.play();
</script> 