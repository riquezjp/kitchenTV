


// YOU TUBE ########
var player, time_update_interval = 0;
function onYouTubeIframeAPIReady() {
    player = new YT.Player('ytplayer', {
        events: {
            onReady: initialize
        }
    });
}
function initialize(){

    // Update the controls on load
    updateTimerDisplay();
    updateProgressBar();

    // Clear any old interval.
    clearInterval(time_update_interval);

    // Start interval to update elapsed time display and
    // the elapsed part of the progress bar every second.
    time_update_interval = setInterval(function () {
        updateTimerDisplay();
        updateProgressBar();
    }, 1000)
    // custom (paul)
    // for on/off times 
    checkVol();
}

// This function is called by initialize()
function updateTimerDisplay(){
    // Update current time text display.
    $('#current-time').text(formatTime( player.getCurrentTime() ));
    $('#duration').text(formatTime( player.getDuration() ));
}

function formatTime(time){
    time = Math.round(time);

    var minutes = Math.floor(time / 60),
    seconds = time - minutes * 1000;

    seconds = seconds < 10 ? '0' + seconds : seconds;

    return minutes + ":" + seconds;
}

// This function is called by initialize()
function updateProgressBar(){
    // Update the value of our progress bar accordingly.
    $('#progress-bar').val((player.getCurrentTime() / player.getDuration()) * 100);
}

// This function is called by initialize()
function checkVol(){
	// later than off time or earlier than on time
    if (off < 0 || on > 0){
        player.setVolume(0);
    } 
    
    // initial volume
if(vol==-1){
    player.setVolume(20);
    player.mute();
}else{
    player.setVolume(vol);
}

}



// BUTTONS ###################

// which button is selected when loading a page click
if(vol==20){ $( "#vol20" ).addClass( "von" ); }
if(vol==50){ $( "#vol50" ).addClass( "von" ); }
if(vol==100){ $( "#vol100" ).addClass( "von" ); }
if(vol==-1){ set_vol(-1);}

function set_vol(level){
    // accepted levels
    // -1 mute
    // 1 unmute
    // 20, 50, 100 
    
    //Mute
    if(level==-1){
        if (typeof player != 'undefined') {
            player.mute();
        }
        $( "#mute-toggle" ).text('o');
        $( "#mute-toggle" ).addClass("muted");
        $( "#vol20" ).addClass( "volmute" );
        $( "#vol50" ).addClass( "volmute" );
        $( "#vol100" ).addClass( "volmute" );
        $( "#f_vol" ).val(-1);    
    }

    //unMute
    if(level==1){
         player.unMute();
        $( "#mute-toggle" ).text('x');
        $( "#mute-toggle" ).removeClass("muted");
        $( "#vol20" ).removeClass( "volmute" );
        $( "#vol50" ).removeClass( "volmute" );
        $( "#vol100" ).removeClass( "volmute" );
        $( "#f_vol" ).val(vol);    
    }  
    if(level==20){
        player.setVolume(20);
        vol=20;
        $( "#vol20" ).addClass( "von" );
        $( "#vol50" ).removeClass( "von" );
        $( "#vol100" ).removeClass( "von" );
        $( "#f_vol" ).val('20');
    }
    if(level==50){
        player.setVolume(50);
        vol=50;
        $( "#vol20" ).removeClass( "von" );
        $( "#vol50" ).addClass( "von" );
        $( "#vol100" ).removeClass( "von" );
        $( "#f_vol" ).val('50');
    }
    if(level==100){
        player.setVolume(100);
        vol=100;
        $( "#vol20" ).removeClass( "von" );
        $( "#vol50" ).removeClass( "von" );
        $( "#vol100" ).addClass( "von" );
        $( "#f_vol" ).val('100');
    }
}

 $('#mute-toggle').on('click', function() {
    if(player.isMuted()){
        set_vol(1);   
        // incase we forgot the old volume 
        if(vol==-1){ set_vol(20);}       
    }else{
        set_vol(-1);
    }
});

$('#vol20').on('click', function () {
        if(player.isMuted()==false){ set_vol(20);}
});
$('#vol50').on('click', function () {
      if(player.isMuted()==false){set_vol(50);}
});
$('#vol100').on('click', function () {
      if(player.isMuted()==false){set_vol(100);}
});
// #######################



function showNews(headlines){
    var hlen = headlines.length;
    var i=0;
    setInterval(function(){
         $( "#news" ).html(headlines[i]);
          i=i+1;
          if(i>hlen-1){i=0;}
        }, 20000);
}

function auto_volume(){
	
var now = new Date();
var vofftime = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 17, 30, 0, 0) - now;
var vontime = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 7, 30, 0, 0) - now;
var off=vofftime;
var on=vontime;
    if (vofftime < 0) {
        vofftime += 86400000; // it's after 5:30pm
    }
    if (vontime < 0) {
         vontime += 86400000; // it's after 7:30am
    }         
    setTimeout(function(){ set_vol(-1)
                                        $( "#vol20" ).removeClass( "von" );
                                        $( "#vol50" ).removeClass( "von" );
                                        $( "#vol100" ).removeClass( "von" );                                                   
                                        }, vofftime);
    setTimeout(function(){ set_vol(1); set_vol(20);}, vontime);	
}
