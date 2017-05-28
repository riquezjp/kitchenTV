<?php
date_default_timezone_set("Asia/Tokyo"); 
$date= strtoupper(date("M jS l", time()));

//$mail_test=mail_test();

$vol=(isset($_REQUEST['f_vol'])?$_REQUEST['f_vol']:20);
$mus=(isset($_REQUEST['mus'])?$_REQUEST['mus']:0);
// youtube code, time to display in seconds
// multiplier m
$m=1000;

// sky news
$streams[1]['name']="SN";
$streams[1]['url']="y60wDzZt8yg";
$streams[1]['time']=1200*$m;
$streams[1]['mus']=0;

// monstercat music
$streams[2]['name']="MC";
$streams[2]['url']="T1H39aSWMM";
$streams[2]['time']=300*$m;
$streams[2]['mus']=1;


// france 24 news
$streams[3]['name']="FR";
$streams[3]['url']="1Ydto3Iyzic";
$streams[3]['time']=1200*$m;
$streams[3]['mus']=0;


// jp weather
//$streams[3]['name']="JP";
//$streams[3]['url']="kfTq_A9nBM0";
//$streams[3]['time']=300*$m;
//$streams[3]['mus']=0;

// mixhound chillstep 
$streams[4]['name']="MH";
$streams[4]['url']="vA08pZypWM";
$streams[4]['time']=300*$m;
$streams[4]['mus']=1;

// nasa
$streams[5]['name']="NS";
$streams[5]['url']="RtU_mdL2vBM";
$streams[5]['time']=300*$m;
$streams[5]['mus']=1;

// NCS
$streams[6]['name']="NC";
$streams[6]['url']="asmVy7PgTeQ";
$streams[6]['time']=300*$m;
$streams[6]['mus']=1;

// earthquake
//$streams[7]['name']="EQ";
//$streams[7]['url']="nnJ-1x81yoA";
//$streams[7]['time']=300*$m;
//$streams[7]['mus']=0;


// mixhound chillstep dxVzsVFAw34
// deephouse fFppH4_sXBc
// NCS wCe1zFNSAzU
// traplife j5tUmWzEAO4

// goodlife music DekL5q5e9lM
// chillhop cafe mx6t6E24SSM

$s=getS($streams);
$n=$streams[$s]['name'];
$u=$streams[$s]['url'];
$t=$streams[$s]['time'];


$next=whatsnext($s,$mus,$streams);

function whatsnext($s,$mus,$streams){
    $next=0;
    $i=1;
        foreach($streams as $k1 => $k2){
            if($mus==1 && $i>$s && $k2['mus']==1 && $next==0) {
                $next=$i;
            }
            if($mus==0 && $i>$s && $k2['mus']==0 && $next==0){
                $next=$i;
            }
        $i++;
    }
   $next=($next==0?1:$next);
    return $next;
}


//$next=($s==count($streams)?1:$s+1);
?>
<html>
<head>
    <meta charset="utf-8">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700,inherit,400" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="weather.css">
    <link rel="stylesheet" href="rasp.css">

    <script type="text/javascript">
        // PHP dependant js vars ~
        // page udate after t seconds
        setTimeout(function(){ document.forms["poster"].submit(); }, <?php echo $t; ?>);
        // volume ON/OFF morning/evening
        var on, off, vol = <?php echo $vol; ?>;
        // bbc headlines 
        var headlines =[<?php echo getHeadlines(); ?>];
    </script>
</head>

<body>
<?php
echo check_IP();
?>
    <div class ="col1">
        <p><iframe id="ytplayer" width="100%" height="500" src="https://www.youtube.com/embed/<?php echo $u; ?>?rel=0&autoplay=1&enablejsapi=1" frameborder="0" allowfullscreen></iframe>
        </p>
        <span id="digi">
            <span id="dc"></span><br />
            <span id="date"><?php echo $date; ?></span>
        </span>

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
                <a href="web.php"><li class="btn2">www</li></a>
                        </ul>


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
    </script>
    
</body>
</html>

<?php
function bg($id){
    $col2=array('col1_sunrise','col1_morning','col1_midday','col1_evening','col1_night');
    $hr=date('H', time()); 

    if($hr<=5){
        $class=${$id}[4];
    }elseif($hr<=9){
        $class=${$id}[0];
    }elseif($hr<=12){
        $class=${$id}[1]; 
    }elseif($hr<=17){
        $class=${$id}[2];    
    }elseif($hr<=20){
        $class=${$id}[3];
    }else{
        $class=${$id}[4];
    }
    return $class;
}

function getHeadlines(){
    $html="";
    $file=file_get_contents("http://feeds.bbci.co.uk/news/rss.xml?edition=uk"); 
    preg_match_all("%<title>(.*?)</title>%s", $file, $titles,PREG_PATTERN_ORDER,920);
    preg_match_all("%<link>(.*?)</link>%s", $file, $links,PREG_PATTERN_ORDER,920);
    preg_match_all("%<description>(.*?)</description>%s", $file, $desc,PREG_PATTERN_ORDER,920);

    for($i=0;$i<=19;$i+=2){
        $html.="'<a href=\"".$links[1][$i]."\">".clean($titles[1][$i])."</a><br><span>".clean($desc[1][$i])."</span>',";
    }
    return $html;
}

function clean($val){
    $val=str_replace("'","",$val);
    $val=str_replace("<![CDATA[","",$val);
     $val=str_replace("]]>","",$val);
    return $val;
}

function getS($streams){
$output=1;
    if(isset($_GET['s']) && array_key_exists($_GET['s'],$streams)){
        $output=$_GET['s'];
    } 
    return $output;
}

function isPlaying($key){
    $c="";
    if(isset($_GET['s']) && $_GET['s']==$key){
        $c=" play";
    }
    return $c;
}

function isNews($t){
    $classname="";
    if($t>1000){
        $classname=" newsbutton";
    }
    return $classname;
}


function check_IP(){
    $realIP = file_get_contents("http://ipecho.net/plain");
    $value="";
    $file="ip.txt";
    $contents=file_get_contents($file);
   if(!empty($realIP) && $contents != $realIP){
   // if($contents != $realIP){
        $value="<div class=\"ipchange\">IP CHANGE<br>$realIP<br><span style=\"font-size: small;\">old: $contents</span></div>";
    }
    return $value;
}


function mail_test(){
    
    $to="riquez@gmail.com";
    $subject = "mail test";
	$header = "From: pi@d4damage.net\n";
	$header .= "Reply-To: pi@d4damage.net\n";
	$header .= "Return-Path: pi@d4damage.net\n";
	
	$message = "===============================================\n";
	$message .="This is a test\n";
	$message .="===============================================\n";
	$message .="\n";

    $result=mail($to,$subject,$message,$header);
    
    return $result;
}
?>