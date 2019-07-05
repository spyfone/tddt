<center>
<form action="" method="post">
<input type="text" name="URL" size="100" />
<input type="submit" /></form><br />
<?php
function getlink($url)
{  
          $source = file_get_contents($url);  
          $link="";  
          preg_match("%<source src=\"(.+)\" type=\"video\/mp4\"%i",$source,$link);  
          return $link[1];
}
if($_POST['URL'])
{  
          echo '<video controls="" autoplay="" name="media"><source src="'.getlink($_POST['URL']).'" type="video/mp4">';
}
?>
</center>