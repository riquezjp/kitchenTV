# kitchenTV
Kitchen TV; weather, clock, live news feeds &amp; video for Raspberry pi using PHP/javascript

This is a WEB based (PHP, Javascript) app I put together from various tools & scripts found on the web to create my own Kitchen TV : News, Clock & Weather music player & web browser display.

Here is a youtube video of it in action : https://www.youtube.com/watch?v=U5OF6tn-Ccg

If you want to set up the same thing: ======

1) Download my web files & upload to your own web space or host them locally.

2) EDIT the files to personalise it for your own needs:

* config.php has easy user settings you can change. A list of YouTube LIVE channels, you can edit the list for your own channels.
  - EDIT your city, country location for the weather api, how many days forecast

* images/cface4.png EDIT the clock image if you want your own design. You will find the background colours for sunset, sunrise etc in the images folder too.

* The page layout is designed to fit my TV. It will work on other screens but you would probably want to adjust slightly so it suits your screen. config.php adjust the height of the youtube video. main.css edit the #ytplayer border. Adjust CSS font sizes in weather.css & main.css to suit your needs. The defaults should work OK.

* The www web browsing works in a frame, so it doesnt always work well with some websites - just be aware of this, you can always right-click open in new tab to get around that.

==============

The resources I used to put this together:

- Building a weather App - Upamanyu Das
https://www.youtube.com/watch?v=lpLUx-0t7aE

- HTML5 analogue clock
https://www.script-tutorials.com/html5-clocks/

- YouTube Javascript API
https://developers.google.com/youtube/js_api_reference#GettingStarted

