// v3.1.0
//Docs at http://simpleweatherjs.com
 


function loadWeather(wdays,wloc){

 $.simpleWeather({
    location: wloc,
    woeid: '',
    unit: 'c',
    success: function(weather) {
	city = weather.city;
	temp = weather.temp+'&deg;C';
	wcode = '<img class="weathericon" src="images/weathericons/' + weather.code + '.svg">';
	wind = weather.wind.speed + ' ' + weather.units.speed;
	humidity = weather.humidity + ' %';
	updated = weather.updated;

	var iconcode='';
	var fi= new Array();
	var fd= new Array();
	for (var i=1;i<=wdays;i++){
		fi[i]= weather.forecast[i].code;
		fd[i] = weather.forecast[i].day;
		iconcode += '<span><img src="images/weathericons/' + fi[i] + '.svg" /><br />' + fd[i] + '</span>';
	}


	$(".location").text(city);
	$(".temperature").html(temp);
	$(".climate_bg").html(wcode);
	$(".windspeed").html(wind);
	$(".humidity").text(humidity);
	$(".updated").text(updated);	
	$(".forecast").html(iconcode);	
    },
    error: function(error) {
      $(".error").html('<p>'+error+'</p>');
    }
  });
}
