<?php  
    error_reporting(0);
    include "funcfb.php";
	if($_GET['url'] != ""){
		$str = urldecode($_GET['url']);
		$str = substr($str, 0);
	$fblink = base64_decode($str);
	}
	$fdata = facebookstream($fblink);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Facebook Stream Player</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<link href="http://hdofilm.com/getdr/jwplayer/skins/prime.min.css" rel="stylesheet" type="text/css" />
	<link href="http://hdofilm.com/getdr/jwplayer/jw-logo/jw-logo-bar.css" rel="stylesheet" type="text/css" />
	    
</head>
<body>
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
			sources: <?php echo $fdata ?>,
			autostart: true,
			controls: true,
			skin: {name: "prime"},
			width: "1280",
			height: "533",
			aspectratio: "16:9",
                        image: "",
                        primary: 'html5',
			fullscreen: "true",
			preload: "auto",
			abouttext: "Player By HDOFilm.com",
			aboutlink: "https://hdofilm.com",
            sharing:{
			    link: "",
			    code: "",
				heading: "Chia sẻ",
				sites: ["facebook","twitter","tumblr","googleplus","reddit","linkedin","interest","email"],
			},          
		});
</script>
</body>
</html>