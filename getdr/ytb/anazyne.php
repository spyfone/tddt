<?php
/**
 * (c) Copyright 2015 Hoang. All Rights Reserved.
 */
// Ensure the PHP extensions CURL and JSON are installed.
if (!function_exists('curl_init')) {
    throw new Exception('Script requires the PHP CURL extension.');
    exit(0);
}
// Downloading HD Videos may take some time.
ini_set('max_execution_time', 0);
// Writing HD Videos to your disk, may need some extra resources.
ini_set('memory_limit', '64M');

class GbYoutube {

    public function __construct() {
        $this -> YT_BASE_URL = "http://www.youtube.com/";
        $this -> CURL_UA = "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:11.0) Gecko Firefox/11.0";
        $this -> isvideo = false;
        $this -> isaudio = false;
        $this -> videoFile = "";
        $this -> AudioFile = "";
    }

    public function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    /**
     *  HTTP GET request with curl that writes the curl result into a local file.(youtube-dl)
     *  @access  private
     *  @param   string   $remote_file  String, containing the remote file URL to curl.
     *  @param   string   $local_file   String, containing the path to the file to save
     *                                  the curl result in to.
     *  @return  void
     */
    private function curl_get_file($remote_file, $local_file) {
        $ch = curl_init($remote_file);
        curl_setopt($ch, CURLOPT_USERAGENT, $this -> CURL_UA);
        curl_setopt($ch, CURLOPT_REFERER, $this -> YT_BASE_URL);
        $fp = fopen($local_file, 'w');
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);
    }

    /**
     *  Check on the command line if we can find an Ffmpeg installation on the script host. (youtube-dl)
     *  @access  private
     *  @return  boolean  Returns (boolean) TRUE if Ffmpeg is installed on the server,
     *                    or FALSE if not.
     */
    private function has_ffmpeg() {
        $sh = `which ffmpeg`;
        return (bool)(strlen(trim($sh)) > 0);
    }

    private function getFileToServer($url, $path) {
        clearstatcache();
        $newfname = $path;
        $file = fopen($url, "rb");
        if ($file) {
            if (file_exists($path)) {
                $newf = fopen($newfname, "wb");
            } else {
                $newf = fopen($newfname, "w");
                fclose($newf);
                $newf = fopen($newfname, "wb");
            }
            if ($newf)
                while (!feof($file)) {
                    fwrite($newf, fread($file, 1024 * 8), 1024 * 8);
                }
        }
        if ($file) {
            fclose($file);
        }
        if ($newf) {
            fclose($newf);
        }
    }

    public function Save_log($file, $message) {
        $Date = date("h:i:sA, d/m/Y");
        $dates = date("d-m-Y");
        if (file_exists("./logs/$dates-" . $file)) {
            $fp = fopen("./logs/$dates-" . $file, "a+");
            fputs($fp, "Lúc: $Date:  $message \n");
            fclose($fp);
        } else {
            $fp = fopen("./logs/$dates-" . $file, "w");
            fputs($fp, "Lúc: $Date:  $message \n");
            fclose($fp);
        }
    }

    public function sendRequest($data, $url) {
        $data = http_build_query($data);
        $context_options = array('http' => array('method' => 'POST', 'header' => "Content-type: application/x-www-form-urlencoded\r\n" . "Content-Length: " . strlen($data) . "\r\n", 'content' => $data));

        $context = stream_context_create($context_options);
        $result = file_get_contents($url, false, $context, -1, 40000);
        return $result;
    }

    public function getSize($url) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, TRUE);
        curl_setopt($ch, CURLOPT_NOBODY, TRUE);

        $data = curl_exec($ch);
        $size = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);

        curl_close($ch);
        return $size;
    }

    /**
     * Function process php to download file in client
     * @param $url = url from stream
     * @param @stype =
     */
    public function downloadFile($url, $stype, $title, $type, $size = 0) {
        if ($type != "mp3") {
            header('Content-type: ' . $stype);
        } else {
            header("Content-Type: audio/mpeg, audio/x-mpeg, audio/x-mpeg-3, audio/mpeg3");
            header('Content-Description: File Transfer');
            header("Content-Transfer-Encoding: binary");
        }
        header('Content-Disposition: attachment; filename="' . $title . '.' . $type . '"');
        header("Content-length: " . ($size ? $size : $this->getSize($url)) . "\n\n");
        @readfile($url);
        ob_flush();
        flush();
    }

    public function audioToServer($mp3Url, $videoId, $itag = '140') {
        $mp3Title = $videoId . "_" . $itag;
        $mp3FName = "audios/$mp3Title.mp4";
        if (!file_exists($mp3FName)) {
            $download = self::curl_get_file($mp3Url, $mp3FName);
            if ($download === FALSE) {
                throw new Exception("Saving mp3 failed.");
                exit();
            }
            if (!file_exists($mp3FName)) {
                throw new Exception("Saving $videoFilename to $path failed.");
                exit();
            }
        }
        $this -> isvideo = true;
        return $mp3Title;
    }

    public function videoToServer($videoId, $ytUrl, $itag) {
        $videoTitle = "youtubeid_".$videoId."_".$itag;
        $videoFilename = "$videoTitle.mp4";
        $video = 'videos/' . $videoFilename;

        //self::set_video($videoFilename);

        /** (youtube-dl)
         *  PHP doesn't cache information about non-existent files.
         *  So, if you call file_exists() on a file that doesn't exist,
         *  it will return FALSE until you create the file. The problem is,
         *  that once you've created a file, file_exists() will return TRUE -
         *  even if you've deleted the file meanwhile and the cache haven't
         *  been cleared! Even though unlink() clears the cache automatically,
         *  since we don't know which way a file may have been deleted (if it existed),
         *  we clear the file status cache to ensure a valid file_exists result.
         */
        clearstatcache();

        /**
         *  If the video does not already exist in the download directory,
         *  try to download the video and the video preview image.
         */
        if (!file_exists($video)) {
            touch($video);
            chmod($video, 0775);

            // Download the video.
            $download = self::curl_get_file($ytUrl, $video);

            if ($download === FALSE) {
                throw new Exception("Saving video failed.");
                exit();
            }
            if (!file_exists($video)) {
                return '';
            } else {
                return $videoTitle;
            }
        }
        $this -> isvideo = true;
        return $videoTitle;
    }
    //merging
    public function mergingAudio($videoName, $mp3Name) {
        $ffmpeg = self::has_ffmpeg();
        if ($ffmpeg === FALSE) {
            throw new Exception("You must have Ffmpeg installed in order to use this function.");
            return;
            //exit();
        } else if ($ffmpeg === TRUE) {
            // ffmpeg -i video.avi -i audio.mp3 -map 0 -map 1 -codec copy -shortest output_video.avi
            $outFiletitle = "Out_$videoName";
            $outFilePath = "outvideos/$outFiletitle.mp4";
            if (!file_exists($outFilePath)) {                
                try{
                    $cmd = 'ffmpeg -i videos/'.$videoName.'.mp4 -i audios/'.$mp3Name.'.mp4 -map 0.0 -map 1.0 -acodec copy -qscale 4 -vcodec mpeg4 '.$outFilePath;                    
                    //$cmd = 'ffmpeg -i videos/'.$videoName.'.mp4 -i audios/'.$mp3Name.'.mp4 -map 0.0 -map 1.0 -shortest '.$outFilePath;
                    $Ffmpeg = exec($cmd);
                }catch(exception $err){
                    throw new Exception($err->getMessage());
                    return;
                    //exit();
                }
                clearstatcache();
                if (file_exists($outFilePath) !== FALSE) {
                    return $outFiletitle;
                } else {
                    throw new Exception("Đã có lỗi sảy ra trong quá trình xử lý. Xin lỗi!");
                    return;
                    //exit();
                }
            } else {
                return $outFiletitle;
            }
        } else {
            throw new Exception("Cannot locate your Ffmpeg installation?! Thus, cannot convert the video into format.");
            return;
            //exit();
        }
    }

}
?>
