<?php
if(!isset($_SESSION))
{
	session_start();
}
echo "<link rel='stylesheet' href='stylesheets/common/css-reset.css'>";
echo "<link rel='stylesheet' href='stylesheets/components/header-stylesheet.css'>";
echo "<link rel='stylesheet' href='stylesheets/components/footer-stylesheet.css'>";
echo "<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto+Condensed'>";
echo "<link rel='stylesheet' href='stylesheets/common/common.css'>";
echo "<link rel='stylesheet' href='stylesheets/components/buttons-stylesheet.css'>";


echo "<script 
		src='https://code.jquery.com/jquery-3.3.1.js'
		integrity='sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60='
		crossorigin='anonymous'>
	  </script>";
