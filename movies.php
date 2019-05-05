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
	<script type="text/javascript" src="scripts/site-specific/movies-user-script.js"></script>
</head>

<?php include_once "header.php"; ?>

	<div class="content-container">
		<form action="load-in-movie-or-series.php" id="movie">
			<?php include_once "get-movies-user.php";?>
		</form>
	</div>

<?php include_once "footer.php"; }?>