<!DOCTYPE html>

<html>

<head>
	<meta charset="utf-8"/>
	<title>Movies</title>

	<?php require "startup.php"; ?>

	<link rel="stylesheet" href="stylesheets/site-specific/movies-stylesheet.css">
	<script type="text/javascript" src="movies-user-script.js"></script>
</head>

<?php include_once "header.php"; ?>

	<div class="content-container">
		<?php include_once "get-movies-user.php";?>
	</div>

<?php include_once "footer.php"; ?>