<?php
<form action="" method="post">
 <input type="url" name="link" placeholder="Link server drive">
 <input type="submit" value="Get link">
</form>
if(isset($_POST['link'])) {
 $get = file_get_contents($_POST['link']);
 $cat = explode(',["fmt_stream_map","', $get); $cat = explode('"]', $cat[1]);
 $cat = explode(',', $cat[0]);
 foreach($cat as $link){
  $cat = explode('|', $link);
  $links = str_replace(array('\u003d', '\u0026'), array('=', '&'), $cat[1]);
  if($cat[0] == 37) {$f1080p = $links;}
  if($cat[0] == 22) {$f720p = $links;}
  if($cat[0] == 59) {$f480p = $links;}
  if($cat[0] == 43) {$f360p = $links;}
 }
 if(isset($f1080p)){
  echo '1080p: '.$f1080p.'
720p: '.$f720p.'
480p: '.$f480p.'
360p: '.$f360p;
 } elseif(isset($f720p)){
  echo '720p: '.$f720p.'
480p: '.$f480p.'
360p: '.$f360p;
 } elseif(isset($f480p)){
  echo '480p: '.$f480p.'
360p: '.$f360p;
 } else {
  echo '360p: '.$f360p;
 }
}
?>