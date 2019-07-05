<?php
error_reporting(0);

if($_GET['url'] != ""){
	$link = $_GET['url'];
}
if(substr_count($link,"photo")>0){
    $type='photo'; $arg='photo';
    }
    elseif(substr_count($link,"video")>0){
    $type='video'; $arg='video';
    }
    elseif(substr_count($link,"id")>0){
    $type='id'; $arg='id';
    }
    else{
    $type='id'; $arg='/';
    }

$arr1=explode($arg,$link);

if($arg=='photo'){
$arr2=explode($arg,$arr1[1]);
$arr3=explode('_',$arr2[0]);

$id=$arr3[0];
$item_id=substr($arr3[1],0,9);
}
elseif($arg=='video'){
$arr2=explode($arg,$arr1[1]);
$arr3=explode('_',$arr2[0]);

$id=$arr3[0];
$item_id=substr($arr3[1],0,9);
}
elseif($arg=='id' || $arg=='/'){

$id=$arr1[1];
$item_id=$arr1[1];
}
echo $link;
echo '<br>id = '.$id.'<br>item_id = '.$item_id;
?>