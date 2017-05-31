# kitchenTV
Kitchen TV; weather, clock, live news feeds &amp; video for Raspberry pi using PHP/javascript

This is a WEB based (PHP, Javascript) app I put together from various tools & scripts found on the web to create my own Kitchen TV : News, Clock & Weather music player & web browser display.

Here is a youtube video of it in action : https://www.youtube.com/watch?v=U5OF6tn-Ccg

If you want to set up the same thing: ======

1) Download my web files & upload to your own web space or host them locally.
This is the original download, but you can just use the github files now eh? ;-)
http://bit.ly/2myjcHM

2) EDIT the files to personalise it for your own needs:

* weather.js EDIT your city, country location.

* images/cface4.png EDIT the clock image if you want your own design. You will find the background colours for sunset, sunrise etc in the images folder too.

* index.php has a list of the YouTube LIVE channels, you can edit the list for your own channels
You just need the video ID, time in seconds you want it to display for (e.g.: 1200 seconds is 20 mins) & the Name to show in the Icon - A 2 letter code works best like SN for SkyNews ;-)

* The page layout is designed to fit my 720p TV. It will work on other screens but you would probably want to adjust the column widths etc slightly so it suits your screen. Look in the CSS files to adjust those parts. 

* The www web browsing works in a frame, so it doesnt always work well with some websites - just be aware of this, you can always right-click open in new tab to get around that.

==============
+++ UPDATE ++++

If your BBC news feed isnt working you need to update the script to remove CDATA tags.

index.php, line 198
Update the clean function with str_replace to remove CDATA tags.

My download link above includes a fixed version & also without the music player - i found it to a little too resource hungry.

+++ UPDATE ++++
KitchTV 20161030 ZIP file on the download link above is updated with some minor fixes.
Also, now if you manually click on a news video the live stream will only show news (mus=0) feeds. If you click on a music stream it will switch to music only (mus=1)

---------------

The resources I used to put this together:

- Building a weather App - Upamanyu Das
https://www.youtube.com/watch?v=lpLUx-0t7aE

- HTML5 analogue clock
https://www.script-tutorials.com/html5-clocks/

- YouTube Javascript API
https://developers.google.com/youtube/js_api_reference#GettingStarted

- Cincopa music player https://www.cincopa.com/
Still trying this out, you can remove it from index.php line 150 or sign up for your own account & replace it.
