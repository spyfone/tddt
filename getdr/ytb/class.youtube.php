<?php
/**
 * (c) Copyright 2015 Hoang Hieu. All Rights Reserved.
 * skype Hoàng Hiếu: hieu_hidro
 * /** PHP Class YoutubeAvailible
 *  ================================================================================
 *  PHP class to get the file location of Youtube videos, mp3 audio download the video
 *  ================================================================================
 *  @category
 *  @package     youtube_getVideo
 *  @version     class.func.php
 *  @author      Hoàng Hiếu <hieu.gh@gmail.com>
 *  @copyright   Copyright 2015 Hoang Hieu. All Rights Reserved.
 *  @license     https://github.com/thien321091/
 *  @link        https://github.com/thien321091/php-youtube_getvideo/
 *  ================================================================================
 *  LICENSE: Permission is hereby granted, free of charge, to any person obtaining
 *  a copy of this software and associated documentation files (the "Software"),
 *  to deal in the Software without restriction, including without limitation the
 *  rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 *  copies of the Software, and to permit persons to whom the Software is furnished
 *  to do so, subject to the following conditions:
 *
 *    The above copyright notice and this permission notice shall be included in all
 *  copies or substantial portions of the Software.
 *
 *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 *  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 *  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 *  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY
 *  WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
 *  CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *  ================================================================================
 */

class YoutubeAvailible {
    private $url;
    private $id;
    private $stream;
    private $title;
    private $thumbnail;     
    function YoutubeAvailible() {
        $this -> url = '';
        $this -> id = '';
        $this -> stream = array();
    }

    private function getSize() {
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
     * Get Youtube ID from URL
     * @return string
     */
    private function getId() {
        $url = $this -> url;
        $pattern = '%^# Match any youtube URL
            (?:https?://)?  # Optional scheme. Either http or https
            (?:www\.)?      # Optional www subdomain
            (?:             # Group host alternatives
              youtu\.be/    # Either youtu.be,
            | youtube\.com  # or youtube.com
              (?:           # Group path alternatives
                /embed/     # Either /embed/
              | /v/         # or /v/
              | /watch\?v=  # or /watch\?v=
              )             # End path alternatives.
            )               # End host alternatives.
            ([\w-]{10,12})  # Allow 10-12 for 11 char youtube id.
            $%x';
        $result = preg_match($pattern, $url, $matches);
        if (false !== $result) {
            return $matches[1];
        }
        return '';
    }

    /**
     * Function process php to download file in client
     * @param $url = url from stream
     * @param @stype =
     */
    function downloadFile($url, $stype, $title, $type) {
        if ($type != "mp3") {
            header('Content-type: ' . $stype);
        } else {
            header("Content-Type: audio/mpeg, audio/x-mpeg, audio/x-mpeg-3, audio/mpeg3");
            header('Content-Description: File Transfer');
            header("Content-Transfer-Encoding: binary");
        }
        header('Content-Disposition: attachment; filename="' . $title . '.' . $type . '"');
        header("Content-length: " . $this -> getSize($url) . "\n\n");
        @readfile($url);
        ob_flush();
        flush();
    }
    /**
     *  Format the YouTube Video Title into a valid filename.
     *  @access  private
     *  @param   string   $str  Input string.
     *  @return  string   Returns cleaned input string.
     */
    private function canonicalize($str)
    {
        $str = trim($str); # Strip unnecessary characters from the beginning and the end of string.
        $str = str_replace("&quot;", "", $str); # Strip quotes.
        $str = self::strynonym($str); # Replace special character vowels by their equivalent ASCII letter.
        $str = preg_replace("/[[:blank:]]+/", "_", $str); # Replace all blanks by an underscore.
        $str = preg_replace('/[^\x9\xA\xD\x20-\x7F]/', '', $str); # Strip everything what is not valid ASCII.
        $str = preg_replace('/[^\w\d_-]/si', '', $str); # Strip everything what is not a word, a number, "_", or "-".
        $str = str_replace('__', '_', $str); # Fix duplicated underscores.
        $str = str_replace('--', '-', $str); # Fix duplicated minus signs.
        if(substr($str, -1) == "_" OR substr($str, -1) == "-") {
            $str = substr($str, 0, -1); # Remove last character, if it's an underscore, or minus sign.
        }
        return trim($str);
    }
    
    private function DecryptYouTubeCypher($signature)
    {
            $sigParts = explode('.', $signature);
            if (count($sigParts) == 2)
            {
                $sigParts[1] = substr(substr($sigParts[1], 0, 8) . substr($sigParts[0], 0, 1) . substr($sigParts[1], 9, 9) . substr($sigParts[1], -4, 1) . substr($sigParts[1], 19, 20) . substr($sigParts[1], 18, 1), 0, 40);
                $sigParts[0] = substr($sigParts[0], -40);
                $signature = strrev($sigParts[0] . '.' . $sigParts[1]);
            }
            return $signature;
    }
    /**
     *  Replace common special entity codes for special character
     *  vowels by their equivalent ASCII letter.
     *  @access  private
     *  @param   string   $str  Input string.
     *  @return  string   Returns cleaned input string.
     */
    private function strynonym($str)
    {
        $SpecialVowels = array(
            '&Agrave;'=>'A', '&agrave;'=>'a', '&Egrave;'=>'E', '&egrave;'=>'e', '&Igrave;'=>'I', '&igrave;'=>'i', '&Ograve;'=>'O', '&ograve;'=>'o', '&Ugrave;'=>'U', '&ugrave;'=>'u',
            '&Aacute;'=>'A', '&aacute;'=>'a', '&Eacute;'=>'E', '&eacute;'=>'e', '&Iacute;'=>'I', '&iacute;'=>'i', '&Oacute;'=>'O', '&oacute;'=>'o', '&Uacute;'=>'U', '&uacute;'=>'u', '&Yacute;'=>'Y', '&yacute;'=>'y',
            '&Acirc;'=>'A', '&acirc;'=>'a', '&Ecirc;'=>'E', '&ecirc;'=>'e', '&Icirc;'=>'I',  '&icirc;'=>'i', '&Ocirc;'=>'O', '&ocirc;'=>'o', '&Ucirc;'=>'U', '&ucirc;'=>'u',
            '&Atilde;'=>'A', '&atilde;'=>'a', '&Ntilde;'=>'N', '&ntilde;'=>'n', '&Otilde;'=>'O', '&otilde;'=>'o',
            '&Auml;'=>'Ae', '&auml;'=>'ae', '&Euml;'=>'E', '&euml;'=>'e', '&Iuml;'=>'I', '&iuml;'=>'i', '&Ouml;'=>'Oe', '&ouml;'=>'oe', '&Uuml;'=>'Ue', '&uuml;'=>'ue', '&Yuml;'=>'Y', '&yuml;'=>'y',
            '&Aring;'=>'A', '&aring;'=>'a', '&AElig;'=>'Ae', '&aelig;'=>'ae', '&Ccedil;'=>'C', '&ccedil;'=>'c', '&OElig;'=>'OE', '&oelig;'=>'oe', '&szlig;'=>'ss', '&Oslash;'=>'O', '&oslash;'=>'o'
        );
        return strtr($str, $SpecialVowels);
    }
    
    
    /**
     * Process video URL
     * @param $url string url of video file
     * @return void
     */
    function process($url) {
        $this -> url = $url;
        $id = $this -> getId();
        if (empty($id)) {
            throw new Exception("Không tồn tại id", 1);
            return false;
        }
        if (!preg_match('/^[A-Z0-9-_]+$/i', $id)) {
            throw new Exception("ID không đúng vui lòng nhập lại", 2);
            return false;
        }
        $this -> id = $id;

        @set_time_limit(0);
        parse_str(file_get_contents('http://www.youtube.com/get_video_info?video_id=' . $id), $info);
        if (!count($info['adaptive_fmts'])) {
            parse_str(file_get_contents("http://www.youtube.com/get_video_info?video_id=$id&el=vevo&ps=default&eurl=&gl=US&hl=en"), $info);
        }
        $titleVideo = $this->canonicalize($info['title']);
        $thumbnail = $info['iurl'];
        $this -> thumbnail = $thumbnail;
        $this -> title = $titleVideo;
        $fileStreams = explode(',', $info['adaptive_fmts']);

        foreach ($fileStreams as $stream) {
            parse_str($stream, $real_stream);
            //print_r($real_stream);
            //136:1280x720,137;1920x1080,264:2560x1440,266:3840x2160 // Mp4, clen: = byte / 1024^2 = MBi
            $type = 'mp4';
            $check = false;
            switch($real_stream['itag']) {
                case 137 :
                    $status = "Hight Quality: mp4, 1080p, 1920x1080";
                    $ratio = '1080p - HD';
                    break;
                case 264 :
                    $status = "Hight Quality: mp4, 2K, 2560x1440";
                    $ratio = 'Full HD - 2K';
                    break;
                case 266 :
                    $status = "Hight Quality: mp4, 4k, 3840x2160";
                    $ratio = 'Full HD - 4k';
                    break;
                case 140 :
                    $status = "Audio file: mp3, 128kbs";
                    $ratio = 'MP3 - 128kbs';
                    $type = 'mp3';
                    break;
                default :
                    $check = true;
                    break;
            }
            if (!$check) {
                $newtemp = array();
                $newtemp['itag'] = $real_stream['itag'];
                $newtemp['status'] = $status;
                $newtemp['psize'] = $real_stream['size'];
                $newtemp['leng'] = round($real_stream['clen'] / (pow(1024, 2)), 2);
                $newtemp['cleng'] = $real_stream['clen'];
                $newtemp['type'] = $type;
                $newtemp['ratio'] = $ratio;
                $newtemp['stype'] = $real_stream['type'];
                $newtemp['urlfile'] = $real_stream['url'];
                $this -> stream[] = $newtemp;
            }
        }
        $streams = explode(',', $info['url_encoded_fmt_stream_map']);
        foreach ($streams as $stream) {
            parse_str($stream, $real_stream);                        
            $check = true;
            $type = 'mp4';
            switch ($real_stream['itag']) {
                case 17 :
                    $status = 'Low Quality, 144p, 3GP, 0x0';
                    $ratio = '144p';
                    $type = '3gp';
                    break;
                case 36 :
                    $status = 'Low Quality, 240p, 3GP, 0x0';
                    $ratio = '240p';
                    $type = '3gp';
                    break;
                case 5 :
                    $status = 'Low Quality, 240p, FLV, 400x240';
                    $ratio = '240p';
                    $type = 'flv';
                    break;
                case 34 :
                    $status = 'Medium Quality, 360p, FLV, 640x360';
                    $ratio = '360p';
                    $type = 'flv';
                    break;
                case 35 :
                    $status = 'Standard Definition, 480p, FLV, 854x480';
                    $ratio = '480p';
                    $type = 'flv';
                    break;
                case 18 :
                    $status = 'Medium Quality, 360p, MP4, 480x360';
                    $ratio = '360p';
                    $type = 'mp4';
                    break;
                case 22 :
                    $status = 'High Quality, 720p, MP4, 1280x720';
                    $ratio = '720p';
                    $type = 'mp4';
                    break;
                case 37 :
                    $status = 'Full High Quality, 1080p, MP4, 1920x1080';
                    $ratio = '1080p - HD';
                    $type = 'mp4';
                    break;
                case 38 :
                    $status = 'Original Definition, MP4 HD (4K)';
                    $ratio = 'Full HD - 4K';
                    $type = 'mp4';
                    break;
                case 82 :
                    $status = 'Medium Quality 3D, 360p, MP4, 640x360';
                    $ratio = '3D 360p';
                    $type = 'mp4';
                    break;
                case 84 :
                    $status = 'High Quality 3D, 720p, MP4, 1280x720';
                    $ratio = '3D 720p';
                    $type = 'mp4';
                    break;
                case 43 :
                    $status = 'Medium Quality, 360p, WebM, 640x360';
                    $ratio = '360p';
                    break;
                case 44 :
                    $status = 'Standard Definition, 480p, WebM, 854x480';
                    $ratio = '480p';
                    break;
                case 45 :
                    $status = 'High Quality, 720p, WebM, 1280x720';
                    $ratio = '720p mHD';
                    $type = 'webm';
                    break;
                case 46 :
                    $status = 'Full High Quality, 1080p, WebM, 1280x720';
                    $ratio = '1080p HD';
                    $type = 'webm';
                    break;
                case 100 :
                    $status = 'Medium Quality 3D, 360p, WebM, 640x360';
                    $ratio = '360p';
                    $type = 'webm';
                    break;
                case 102 :
                    $status = 'High Quality 3D, 720p, WebM, 1280x720';
                    $ratio = '720p';
                    $type = 'webm';
                    break;
                default :
                    $check = false;
                    break;
            }
            if ($check) {
                $newtemp = array();
                $newtemp['itag'] = $real_stream['itag'];
                $newtemp['status'] = $status;
                $newtemp['type'] = $type;
                $newtemp['ratio'] = $ratio;
                $newtemp['stype'] = $real_stream['type'];
                $newtemp['urlfile'] = $real_stream['url'];
                $newtemp['leng'] = 0;
                $newtemp['cleng'] = 0;
                //$newtemp['sig'] = $this->DecryptYouTubeCypher($real_stream['s']);          
                $this -> stream[] = $newtemp;
            }
        }

        return true;
    }

    /**
     * function return json of object
     * @return string
     */
    function toJson() {
        if ($this -> stream) {
            return json_encode(array('videoid' => $this -> id, 
                                    'thumbnail' => $this -> thumbnail, 
                                    'title' => $this -> title, 
                                    'data' => $this -> stream));
        } else {
            echo json_encode(array('msg' => "Nothing"));
        }
    }

    /**
     * return array video type availible
     * @param string mp4, 3gp
     * @return array
     */
    function getVideo($type) {
        $arrFile = array();
        if ($type == 'mp4' || $type == '3gp' || $type == 'mp3') {
            if ($this -> stream) {
                foreach ($this->stream[$type] as $key => $value) {
                    $arrFile[] = $value['urlfile'];
                }
            }
        }
        return $arrFile;
    }

}

$hydro = new YoutubeAvailible();

?>
