<?php
// HDO Film
// Flay Film File MP4
// ******************
error_reporting(0);
if($_GET['url'] != ""){
	$url = $_GET['url'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link href="http://vjs.zencdn.net/5.19/video-js.css" rel="stylesheet">
	<link href="http://hdofilm.com/getdr/videojs/video-tube-full.css" rel="stylesheet">
    <script src="http://vjs.zencdn.net/ie8/1.1/videojs-ie8.min.js"></script>
    <script src="http://vjs.zencdn.net/5.19/video.js"></script>

<link title="Theo Doi Dien Thoai" rel='shortlink' href='http://theodoidienthoai.net'/>
<link title="Theo Doi Di dong" rel='shortlink' href='http://theodoidienthoai.net'/>
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
	poster="poster.jpg" data-setup=''>
    <source src="<?php echo $url?>",
			type="video/mp4">
 <!-- <track kind="captions" src="example-captions.vtt" srclang="vi" label="Vietnamese" default></track>
     Tracks need an ending tag thanks to IE9 -->
    <track kind="subtitles" src="example-captions.vtt" srclang="vi" label="Vietnamese"default></track>
    <!-- Tracks need an ending tag thanks to IE9 -->
    <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
  </video>
