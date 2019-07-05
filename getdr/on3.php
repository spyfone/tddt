<!DOCTYPE html>

<html lang="en">

  <head>

  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>quetoi36..Net Ð?c bao blog thanh hoa</title>

  </head>

  <body>

  <?php

  /* if(!isset($_POST['token']) && !isset($_SESSION['token'])){

        $_SESSION['token'] = md5(uniqid(rand(), true));

        }

        */

  ?>

     <div class="container">

     <form class="bs-example form-horizontal" method = "POST" style = "padding-top: 40px;">

     <div class="form-group">

        <label class="col-lg-2 control-label">URL c?a Video</label>

        <div class="col-lg-10">

         <textarea type="text" class="form-control" name="video" placeholder="http://onbox.vn/nhan-dien-nhung-co-nang-co-nguy-co-fa-ca-doi-v966418.html,http://onbox.vn/365-ngay-hanh-phuc-chia-tay-vi-muon-nhuong-ban-trai-cho-em-ho-v967065.html"></textarea>

         Chú ý n?u b?n Get nhi?u link cùng m?t lúc thì hãy s?p x?p chúng dúng theo th? t?. Và m?i link cách nhau b?i d?u ","

        </div>

     </div>     

     <div class="form-group">

        <div class="col-lg-10 col-lg-offset-2"> 

         <button type="submit" class="btn btn-primary">Grab</button> 

        </div>

     </div>

     </form>

     <div class="col-lg-10 col-lg-offset-2">

<?php

function onbox($url)

{

    $ch = @curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);

    $head[] = "Connection: keep-alive";

    $head[] = "Keep-Alive: 300";

    $head[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";

    $head[] = "Accept-Language: en-us,en;q=0.5";

    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36');

    curl_setopt($ch, CURLOPT_HTTPHEADER, $head);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    curl_setopt($ch, CURLOPT_TIMEOUT, 60);

    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);

    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

    curl_setopt($ch, CURLOPT_HTTPHEADER, array(

        'Expect:'

    ));

    $page = curl_exec($ch);

    curl_close($ch);

    return $page;

}

if(isset($_POST)){

    $urls = explode(",",$_POST['video']);

    $count = count($urls);

        if($urls['0'] == NULL){$count = 0;}

        if($count != 0 ){

            foreach($urls as $url){

                $string= onbox(trim($url));

                                preg_match("#<iframe.*src='(.*)'.*>#imsU", $string, $onbox);

                                $string2 = onbox($onbox[1]);

                                preg_match("#file: '(.*)'#imsU", $string2, $link_video);

                                echo $link_video[1]."<br />";

                                               }

   

            }

}

?>

</div></div></div>

  </body>



</html>