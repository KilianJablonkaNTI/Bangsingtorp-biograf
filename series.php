<?php

if(!isset($_SESSION)){
	session_start();
}

if($_SESSION["signed-in-as"] != "user"){
	include_once "index.php";
}

else { ?>

<!DOCTYPE html>

<html>

<head>
	<meta charset="utf-8"/>
	<title>Series</title>

	<?php require "startup.php"; ?>
	<link rel="stylesheet" href="stylesheets/site-specific/movies-stylesheet.css">
</head>

<?php include_once "header.php"; ?>

	<div class="container">
		<div>
			<form action="load-in-movie-or-series.php" id="series">
				<?php include_once "get-series-user.php";?>
			</form>
		</div>
	</div>

<?php include_once "footer.php"; }?>