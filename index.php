<?php
require_once("config.php");
require_once("inc_library.php");
?>
<html>
<head>
    <meta charset="utf-8">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700,inherit,400" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="weather.css">
    <link rel="stylesheet" href="main.css">

    <script type="text/javascript">
        // PHP dependant js vars ~
        // page udate after t seconds
        setTimeout(function(){ document.forms["poster"].submit(); }, <?php echo $t; ?>);
        // volume ON/OFF morning/evening
        var on, off, vol = <?php echo $vol; ?>;
        // bbc headlines 
        var headlines =[<?php echo getHeadlines($news_url); ?>];

    </script>
</head>

<body>
<?php if($ipchecker==1){echo check_IP($ip);} ?>

    <div class ="col1">

    
      
        <span id="digi">
            <span id="dc"></span><br />
            <span id="date"><?php echo $date; ?></span>
        </span>

        <div class="<?php echo $aspect; ?>">

 <div class="videoWrapper"><iframe id="ytplayer" width="650" height="349" src="https://www.youtube.com/embed/<?php echo $u; ?>?rel=0&amp;autoplay=1&amp;enablejsapi=1" frameborder="0" allowfullscreen></iframe>
        </div>



        <div class="weather">
            <div class="w_left">
                <p class="temperature"></p>
                <p class="location"></p>
            </div>
            <div class="w_right">
                <div class="climate_bg"></div>
                <p class="forecast"></p>
                
                <div class="info_bg"> 
                    <p class="i1"><img class="dropicon" src="images/Droplet.svg"><span class="humidity"></span></p>       
                    <p class="i2"><img class="windicon" src="images/Wind.svg"><span  class="windspeed"></span></p>
                    <div style="clear: both;"></div>
                </div>
            </div>
    
            <p class="updated"></p>
            <div style="clear: both;"></div>
        </div>

        <div id="nav">
                      <ul>
                <li>Vol</li>
                <li class="btn" id="mute-toggle">x</li>
                <li class="btn" id="vol20">20</li>
                <li class="btn" id="vol50">50</li>
                <li class="btn" id="vol100">100</li>
            </ul>
            
               <ul class="vid">
                <li>Vid</li>
                <?php
                foreach($streams as $key => $value){
                    ?>
                <a href="index.php?s=<?php echo $key; ?>&amp;mus=<?php echo $streams[$key]['mus']; ?>"><li class="btn2<?php echo isPlaying($key); ?><?php echo isNews($streams[$key]['time']/$m); ?>"><?php echo $streams[$key]['name']; ?></li></a>
                <?php
                $s++;
                }
                ?>
            </ul>
            
            <ul class="vid">
                <a href="web_browse.php"><li class="btn2">www</li></a>
                        </ul>


        </div>
        </div>
  
    </div>


    <div class="col2 <?php echo bg('col2'); ?>">
        <a href="javascript:;" onclick="document.forms['poster'].submit();">
            <div class="clocks">
                <canvas id="canvas" width="500" height="500"></canvas>
            </div>
        </a>

        <div id="news"></div>

    </div>
    <div style="clear: both;"></div>

    <form id="poster" method="post" action="index.php?s=<?php echo $next; ?>">
        <input type="hidden" id="f_vol" name="f_vol" value="<?php echo $vol; ?>" />
        <input type="hidden" id="mus" name="mus" value="<?php echo $mus; ?>" />
    </form>

    <script src="https://www.youtube.com/iframe_api"></script>
    <script src="jquery-2.2.3.min.js"></script>
    <script src="jquery.simpleWeather.min.js"></script>
    <script src="weather.js"></script>
    <script src="jsclock.js"></script>
    <script src="library.js"></script>

    <script type="text/javascript">    
        auto_volume();
        showNews(headlines);
        loadWeather(<?php echo $wdays.",'".$wloc."','".$wunit."'"; ?>);
    </script>
    
</body>
</html>

<?php
// EOF
?>