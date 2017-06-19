<?php

// User settings
// Edit the parameters in this file to cusomise your KitchenTV

// ##### Date / Timezone #####
// You can safely disable my default timezone by adding // to the start of the line.
date_default_timezone_set("America/New_York"); 
// You do not need to edit this unless you know what you are doing.
$date= strtoupper(date("M jS l", time()));

// ##### Weather #####
// see weather.js file
// weather location
$wloc="90210";
// weather forecast days, MAX 9
$wdays=5;

// ##### IP Checker, 0=off 1=on #####
$ipchecker=0;

// ##### Your IP address #####
// You need to update this if your IP changes to turn off the on-screen warining
// To check your ip visit whatismyip.com
$ip="153.189.6.28";

// alternate file method - just create this text file with your IP & nothing else.
//$ip=file_get_contents('ip.txt');

// ##### YouTube #####
// set the height of the youtube player. 500 or 600 generally works best.
// you should set this so that the buttons at the bottom of the screen are still visible.
$yt_height = 484;
// additionally check the main.css file for #ytplayer so you can set a black border above the video 

// Video streams
// name = a short name or abreviation to help you remmeber the channel. A 2 letter code is recommended; BB, FR, MC
// url = the youtube video ID
// time = to display the video in seconds
// mus = 0 or 1. mus=0 channels will switch between each other, as will mus=1, but they wont cross over unless you manually click.
// Its is designed to have MUSIC separate from other content. So you can put the Kitchen TV into music mode.

// BBC News
$streams[]=array(
    "name" => "SN",
    "url" => "y60wDzZt8yg",
    "time" => 1200,
    "mus" => 0
);

// Monstercat Music
$streams[]=array(
    "name" => "MC",
    "url" => "cCmJdLA5b1I",
    "time" => 300,
    "mus" => 1
);

// France 24 News
$streams[]=array(
    "name" => "FR",
    "url" => "Fwxuzl4ZrHo",
    "time" => 1200,
    "mus" => 0
);

// Music Hound
$streams[]=array(
    "name" => "MH",
    "url" => "WNFFx08d6_I",
    "time" => 300,
    "mus" => 1
);

// Nasa live
$streams[]=array(
    "name" => "NS",
    "url" => "RtU_mdL2vBM",
    "time" => 300,
    "mus" => 0
);

// No Copyright Sounds
$streams[]=array(
    "name" => "NC",
    "url" => "1-AODuJpCG4",
    "time" => 300,
    "mus" => 1
);

// Some channels change their url frequently, so watch out for that & pick what works for you.


?>