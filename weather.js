// v3.1.0
//Docs at http://simpleweatherjs.com

 loadWeather();
 


function loadWeather(){

 $.simpleWeather({
    location: 'Naha, Japan',
    woeid: '',
    unit: 'c',
    success: function(weather) {
	city = weather.city;
	temp = weather.temp+'&deg;C';
	wcode = '<img class="weathericon" src="images/weathericons/' + weather.code + '.svg">';
	wind = weather.wind.speed + ' ' + weather.units.speed;
	humidity = weather.humidity + ' %';
	updated = weather.updated;
	f1i = weather.forecast[1].code;
	f2i = weather.forecast[2].code;
	f3i = weather.forecast[3].code;
	f1d = weather.forecast[1].day;
	f2d = weather.forecast[2].day;
	f3d = weather.forecast[3].day;

	$(".location").text(city);
	$(".temperature").html(temp);
	$(".climate_bg").html(wcode);
	$(".windspeed").html(wind);
	$(".humidity").text(humidity);
	$(".updated").text(updated);	
	$(".forecast").html('<span><img src="images/weathericons/' + f1i + '.svg" /><br />' + f1d + '</span><span><img src="images/weathericons/' + f2i + '.svg" /><br />' + f2d + '</span><span><img src="images/weathericons/' + f3i + '.svg" /><br />' + f3d + '</span>');	
    },
    error: function(error) {
      $(".error").html('<p>'+error+'</p>');
    }
  });
}
