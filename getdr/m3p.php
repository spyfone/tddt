<?php
error_reporting(0);
$url = $_GET['url']
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
	<title>Play Video Streeming</title>
</head>
<body>

	<script src="https://content.jwplatform.com/libraries/DbXZPMBQ.js"></script>
	<script type="text/javascript">
		var playerInstance = jwplayer("myElement");
		playerInstance.setup({
			file: "<?php echo $url?>",
			allowfullscreen: true,
			width: '100%',
			aspectratio: '16:9',
			}
		);
	</script>
<?php echo $url?>
</body>
</html>
