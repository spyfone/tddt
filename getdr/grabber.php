<?php
/*************************************
/////////////////////////////////////////////////////////////////////////////////////
// WebVideo Grabber           	                                                        //
// From: http://dn.vc                                                                          //
// Selling or Producing of this script code is not allowed without our        //
permission                                                                                        //
// DO NOT REMOVE THIS NOTICE                                                       //
/////////////////////////////////////////////////////////////////////////////////////
**************************************/
if (isset($_GET{'url'})){
	$url=$_GET{'url'};
	$url=trim($url);

	if (strstr($_GET['url'],"youtube.com")){
		$data = @file_get_contents($_GET['url']);
		@preg_match('#/watch_fullscreen\\?video_id=([a-z0-9-_]+)&l=([0-9]+)&t=([a-z0-9-_]+)#i', $data, $matches);
		if (ereg($matches[1], $_GET['url'])) {
			Header("Location: http://www.youtube.com/get_video?video_id=$matches[1]&l=$matches[2]&t=$matches[3]");
		}
	}
		
	
	if (strstr($_GET['url'],"ifilm.com")){
		$file=@file($url);
		$count=count($file);
	
		$flag=0;
		for ($i=0;$i<$count;$i++){
			if (strstr($file[$i],"so.addVariable") and strstr($file[$i],"getStream")){
					$main=$file[$i]; $flag=1; break;
			}
		}

	if ($flag==1){
		$parse=explode("http://",$main);
		$parse1=explode("?e=",$parse[1]);

		$ifilm="http://".$parse1[0]."?e=";
		Header("Location:$ifilm");
		}
		if ($flag==0){
			Header("Location: http://ifilm-840.vo.llnwd.net/o/contentstore/getStream/2826840_300.flv?e=");
		}
	}

	

	if (strstr($_GET['url'],"dailymotion.com")){
		$file=@file($url);
		$count=count($file);

		$flag=0;
		for ($i=0;$i<$count;$i++){
			if (strstr($file[$i],"addVariable") and strstr($file[$i],".flv") and strstr($file[$i],'"url"')){
				$main=$file[$i]; $flag=1; break;
			}
		}
	if ($flag==1){
		$parse=explode("http%3A%2F%2F",$main);
		$parse1=explode('");',$parse[1]);
		$parse1[0]=str_replace("%2F","/",$parse1[0]);
		$parse1[0]=str_replace("%3F","?",$parse1[0]);
		$parse1[0]=str_replace("%3D","=",$parse1[0]);

		$dailymotion="http://".$parse1[0];
		Header("Location: $dailymotion");
		}
		if ($flag==0){
			Header("Location: http://www.dailymotion.com/get/14/320x240/flv/2197705.flv?key=467179fa53996b0c93b92c2bba62724612a2e36");
		}
	}

	if (strstr($_GET['url'],"blip.tv")){
		$file=@file($url);
		$count=count($file);

		for ($i=0;$i<$count;$i++){
			if (strstr($file[$i],"setPrimaryMediaUrl")){
				$main=$file[$i]; break;
			}
		}

		$parse=explode('setPrimaryMediaUrl("',$main);
		$parse1=explode('?source=',$parse[1]);

		$blip=$parse1[0];
		Header("Location: $blip");
	}

	if (strstr($_GET['url'],"break.com")){
		$file=@file($url);
		$count=count($file);

		$main="";
		for ($i=0;$i<$count;$i++){
			$main=$main.$file[$i];
		}

		$parse=explode("sGlobalFileName='",$main);
		$parse1=explode("'",$parse[1]);

		$name=$parse1[0];


		$parse2=explode("sGlobalContentFilePath='",$main);
		$parse3=explode("'",$parse2[1]);

		$fp=$parse3[0];
		$break="http://media1.break.com/dnet/media/".$fp."/".$name.".flv";
		Header("Location: $break");

	}
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>WebVideo Grabber</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">
function showurl(info){
  	info = info + 1;
  	for (i=1;i<=5;i++){
		if (i!=info){
  		document.getElementById('example_'+i).style.display = 'none';
		}
		else {document.getElementById('example_'+i).style.display = 'inline';}
  	}
}
</script>
<style type="text/css">
<!--
body {
font-family: sans-serif;
font-size: 12px;
width: 334px;
margin: 40px auto 20px auto;
}
#url {
font-size: 1em;
color: #222222;
background-color: #F8F8F8;
width: 295px;
margin: 0px 0px 4px 0px;
padding: 3px;
border-color: #333333 #CCCCCC #CCCCCC #333333;
border-style: solid;
border-width: 1px;
}
.submit
{ background-color: #000000;
repeat-x top; height:22px;
border:1px solid #666666;
color:#FFF; font-size:12px;
font-weight:bold;
}
#loading, #frame {
	padding: 6px;
	display: none;
}
.chooser_info {
font-size: 10px;
font-family: arial;
color: #ff0000;
}
.chooser_info_hide {
font-size: 10px;
font-family: arial;
color: #ff0000;
display: none;
}
-->
</style>
</head>

<body bgcolor="#000000"><a href="grabber.php"><img src="logo.gif" alt="WebVideo Grabber" border="0"></a><br><br>

<form method=get action="" name=form>
		<input type="text" id="url" name="url" /><br>
		<select name=site onChange="showurl(document.form.site.selectedIndex);" >
			<option value=youtube>YouTube</option>
			<option value=ifilm>iFilm</option>
			<option value=dailymotion>DailyMotion</option>
			<option value=blip>Blip.tv</option>
			<option value=break>Break.com</option>
		</select>

		<input type="submit" class="submit" value="Save Video" />
		</form>
	
<div>
<p>

<font id="example_1" class="chooser_info" onClick="document.form.url.value='http://www.youtube.com/watch?v=b0l4QAkzkl4'">example link: <u>http://www.youtube.com/watch?v=b0l4QAkzkl4</u></font>
<font id="example_2" class="chooser_info_hide" onClick="document.form.url.value='http://www.ifilm.com/video/2873091'">example link: <u>http://www.ifilm.com/video/2873091</u></font>
<font id="example_3" class="chooser_info_hide" onClick="document.form.url.value='http://www.dailymotion.com/video/xqq55_4-joels'">example link: <u>http://www.dailymotion.com/video/xqq55_4-joels</u></font>
<font id="example_4" class="chooser_info_hide" onClick="document.form.url.value='http://blip.tv/file/298628'">example link: <u>http://blip.tv/file/298628</u></font>
<font id="example_5" class="chooser_info_hide" onClick="document.form.url.value='http://www.break.com/index/amateur-ghosts.html'">example link: <u>http://www.break.com/index/amateur-ghosts.html</u></font>

</div>
</body>
</html>

    created
    Jul '07
    last reply
    Oct '14
    10
    replies
    3.7k
    views
    6
    users
    1
    link
