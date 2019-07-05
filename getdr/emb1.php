<?php
error_reporting(0);
if($_GET['url'] != ""){
	$file = $_GET['url'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <style>*{margin:0;padding:0;}</style>
    <script data-cfasync="false" src="http://jwpsrv.com/library/SakQCEfSEeOHhRIxOQfUww.js"></script>
</head>
<body>
   <div id="player_wrapper" style="position: relative; display: block; width: 100%; height: 490px;">
      <a id="beforeswfanchor0" href="#player" tabindex="0" title="Flash start" style="border:0;clip:rect(0 0 0 0);display:block;height:1px;margin:-1px;outline:none;overflow:hidden;padding:0;position:absolute;width:1px;" data-related-swf="player"></a>

      <object type="application/x-shockwave-flash" data="http://p.jwpcdn.com/6/12/jwplayer.flash.swf" width="100%" height="100%" bgcolor="#000000" id="player" name="player" class="jwswf swfPrev-beforeswfanchor0 swfNext-afterswfanchor0" tabindex="0">
         <param name="allowfullscreen" value="true">
         <param name="allowscriptaccess" value="always">
         <param name="seamlesstabbing" value="true">
         <param name="wmode" value="opaque">
       </object>

       <a id="afterswfanchor0" href="#player" tabindex="0" title="Flash end" style="border:0;clip:rect(0 0 0 0);display:block;height:1px;margin:-1px;outline:none;overflow:hidden;padding:0;position:absolute;width:1px;" data-related-swf="player"></a>

       <div id="player_aspect" style="display: none;">
       </div>

       <div id="player_jwpsrv" style="position: absolute; top: 0px; z-index: 10;"><div class="afs_ads" style="width: 1px; height: 1px; position: absolute; background: transparent;">&nbsp;
       </div>
    </div>

  <script data-cfasync="false" type="text/javascript">
    jwplayer('player').setup({
    file: <?php echo $file?>,
        aboutlink: 'http://hdoflm.com',
        controls: 'true',
        abouttext: "Player By HDOFilm.com",
        width: '100%',
        height: '500',
        stretching: 'uniform',
        autostart: 'true',
        primary: 'flash',
        skin: 'vapor',
        androidhls: 'true',
    });
  </script>
</body>
</html>