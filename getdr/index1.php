<?php
error_reporting(0);
include "curl_gd.php";

if($_GET['url'] != ""){
	$url = $_GET['url'];
	$linkdown = Drive($url);
	$file = '[{"type": "video/mp4", "label": "HD", "file": "'.$linkdown.'"}]';
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
	<title>Play link Google Drive</title>
</head>
<body>
<div id="myElement"></div>	
  <script src="https://content.jwplatform.com/libraries/DbXZPMBQ.js"></script>
	<script type="text/javascript">
		jwplayer("myElement").setup({
			playlist: [{
				"sources":<?php echo $file?>
			}],
            allowfullscreen: true,
			width: '100%',
			aspectratio: '16:9',
		});
	</script>
</body>
</html>
