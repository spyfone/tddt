<!DOCTYPE html>
<html lang="en">
<head>
 <style>html,body{margin:0;}</style>
<style> .video-js {width: 100%; height: 100%;} #videojs {width: 100%; height: 100%;}</style>
<meta name="referrer" content="no-referrer">
<link href="http://hdofilm.com/getdr/player/video-js.min.css" rel="stylesheet">
<script src="http://hdofilm.com/getdr/player/videojs-ie8.min.js"></script>
<script src="http://hdofilm.com/getdr/player/video.min.js"></script>
<script src="http://hdofilm.com/getdr/player/videojs-contrib-hls.min.js"></script>
<script src="http://hdofilm.com/getdr/player/vjs-hls.min.js"></script>
<script src="http://m.tvplay.vn/videojs/node_modules/video.js/dist/video-js.css"></script>
<link href="http://m.tvplay.vn/videojs/node_modules/video.js/dist/video-js.css" rel="stylesheet">
                        <script src="http://m.tvplay.vn/videojs/node_modules/video.js/dist/video.min.js"></script>
                        <script src="http://m.tvplay.vn/videojs/node_modules/videojs-ie8/dist/videojs-ie8.min.js"></script>
                        <script src="http://m.tvplay.vn/videojs/node_modules/videojs-contrib-hls/dist/videojs-contrib-hls.min.js"></script>
                        <script src="http://m.tvplay.vn/videojs/node_modules/videojs-youtube/dist/Youtube.min.js"></script>
                        <script src="http://m.tvplay.vn/videojs/node_modules/videojs-contrib-quality-levels/dist/videojs-contrib-quality-levels.min.js"></script>
                        <script src="http://m.tvplay.vn/videojs/node_modules/videojs5-hlsjs-source-handler/dist/videojs5-hlsjs-source-handler.min.js"></script>
                        <script src="http://m.tvplay.vn/videojs/node_modules/mobile-detect/mobile-detect.min.js"></script>
                        <script src="http://m.tvplay.vn/videojs/node_modules/videojs-responsive-controls/dist/videojs-responsive-controls.min.js"></script>
                        <script src="http://m.tvplay.vn/videojs/node_modules/videojs-watermark/dist/videojs.watermark.min.js"></script>
                        <link href="http://m.tvplay.vn/videojs/node_modules/videojs-watermark/dist/videojs.watermark.css" rel="stylesheet">
                        <div class="play" id="dv_play" style="width:100%;height:100%;overflow: hidden;margin: 0px;">
                            <div class="video-wrapper"> 
                                <video id="video-player" class="video-js vjs-default-skin" width="100"></video>
                            </div>
                        </div>
                        <script>    
                            var options =  { 
                                sources: [{ "type": "application/x-mpegURL", "src": "https://web.cdn.i-com.vn/icomhdvtv/smil:vtv1_hd.smil/playlist.m3u8?secret=byGWLKAgfx0wdHeZuNZL8w&time=1520718630"}],
                                poster:'https://edge2.cdn.i-com.vn/thumb/0x0/crop//Uploads/images/kenh/vtv1new.jpg',
                                    autoplay: true, 
                                    controls: true, 
                                    preload: 'auto',
                                    muted: false,
                                    loop: false, 
                                    playbackRates: [.25,.5,1, 1.5, 2],  
                                    html5: {
                                        hlsjsConfig:{
                                            debug: false
                                        }
                                    }
                                };
                                videojs('video-player', options, function(){    
                                    var player = this;   
                                    player.responsiveControls();   
                                    var md = new MobileDetect(window.navigator.userAgent);
                                    if(!md.mobile()){player.qualityPickerPlugin();}   
                                });
                                window.onresize=function(){
                                    $(".video-player-dimensions").css('width',document.getElementById("dv_play").offsetWidth+"px");
                                    $(".video-player-dimensions").css('height',(document.getElementById("dv_play").offsetWidth*0.5625)+"px");
                                }
                                $(".video-player-dimensions").css('width',document.getElementById("dv_play").offsetWidth+"px");
                                $(".video-player-dimensions").css('height',(document.getElementById("dv_play").offsetWidth*0.5625)+"px");
                        </script>
                                        </div><!--End image-->
</body>
<span style='position:absolute;top:10px;right:10px;font-size: 13px; font-weight: bold;color: #ff0;'><em>SERVER 2</em></span>
</html>
