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
	<title><?php echo $_GET["selectedObject"]?></title>

	<?php require "startup.php"; ?>

	<link rel="stylesheet" href="stylesheets/site-specific/load-movie-or-series-stylesheet.css">
	<script type="text/javascript" src="movies-user-script.js"></script>
</head>

<?php include_once "header.php"; ?>

	<div class="content-container">
			<?php include_once "load-selected-movie.php";?>
	</div>

<?php include_once "footer.php"; }?>