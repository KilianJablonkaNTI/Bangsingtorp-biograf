<?php

if(!isset($_SESSION)){
	session_start();
}

if($_SESSION["signed-in-as"] != "user"){
	header("Location: index.php");
}

else { ?>

<!DOCTYPE html>

<html>

<head>
	<meta charset="utf-8"/>
	<title>Movies</title>

	<?php require "startup.php"; ?>

	<link rel="stylesheet" href="stylesheets/site-specific/movies-stylesheet.css">
</head>

<?php include_once "header.php"; ?>

	<div class="content-container">
		<div class="left-container">
			<form action="load-in-movie-or-series.php" id="movie">
				<?php include_once "get-movies-user.php";?>
			</form>	
		</div>
		<div class="right-container"></div>
	</div>

<?php include_once "footer.php"; }?>