<?php

// index initialisations

// initial volume 20, or use what was sent in the post/get
$vol=(isset($_REQUEST['f_vol'])?$_REQUEST['f_vol']:100);
// mus default is 0, or use what was sent in the post/get
$mus=(isset($_REQUEST['mus'])?$_REQUEST['mus']:0);
// youtube time to display in seconds
// multiplier m
$m=1000;

$s=getS($streams);
$n=$streams[$s]['name'];
$u=$streams[$s]['url'];
$t=$streams[$s]['time']*$m;

$next=whatsnext($s,$mus,$streams);
//$next=($s==count($streams)?1:$s+1);




// php functions

// what is the next video stream to play
function whatsnext($s,$mus,$streams){
    $next=0;
    $i=0;
        foreach($streams as $k1 => $k2){
            if($mus==1 && $i>$s && $k2['mus']==1 && $next==0) {
                $next=$i;
            }
            if($mus==0 && $i>$s && $k2['mus']==0 && $next==0){
                $next=$i;
            }
        $i++;
    }
   //$next=($next==0?1:$next);
    return $next;
}

// background colouring for the clock depending on the time of day
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

// get top 20 headlines from BBC news website RSS feed
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

// strip CDATA tags
function clean($val){
    $val=str_replace("'","",$val);
    $val=str_replace("<![CDATA[","",$val);
     $val=str_replace("]]>","",$val);
    return $val;
}

// verify that the stream key is valid otherwise default to key 0 (first listed stream in the array)
function getS($streams){
$output=0;
    if(isset($_GET['s']) && array_key_exists($_GET['s'],$streams)){
        $output=$_GET['s'];
    } 
    return $output;
}

// CSS class "play" to highlight the currently playing stream button
function isPlaying($key){
    $c="";
    if(isset($_GET['s']) && $_GET['s']==$key){
        $c=" play";
    }
    return $c;
}
// CSS class "newsbutton" to highlight news stream buttons
// we identify this by ones set with time over 1000 as they play longer than the music channels
// obviously this depends on your taste so this may not work for you.
// disable it by commenting out the line
//$classname=" newsbutton";

function isNews($t){
    $classname="";
    if($t>1000){
        $classname=" newsbutton";
    }
    return $classname;
}

// Show an onscreen warning if your IP address changes
// Useful if you run a home webserver.
// disable this  feature in config.php
function check_IP($ip){
    $realIP = file_get_contents("http://ipecho.net/plain");
    $value="";
   if(!empty($realIP) && $ip != $realIP){
        $value="<div class=\"ipchange\">IP CHANGE<br>$realIP<br><span style=\"font-size: small;\">old: $ip</span></div>";
    }
    return $value;
}

// not used - could be used for an IP change warning
function mail_test(){
    
    $to="test@gmail.com";
    $subject = "mail test";
	$header = "From: pi@test.net\n";
	$header .= "Reply-To: pi@test.net\n";
	$header .= "Return-Path: pi@test.net\n";
	
	$message = "===============================================\n";
	$message .="This is a test\n";
	$message .="===============================================\n";
	$message .="\n";

    $result=mail($to,$subject,$message,$header);
    
    return $result;
}

?>