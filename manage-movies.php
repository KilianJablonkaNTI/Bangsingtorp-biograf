<?php

if(!isset($_SESSION)){
	session_start();
}

if($_SESSION["signed-in-as"] != "admin"){
	include_once "index.php";
}

else { ?>

<!DOCTYPE html>

<html>

<head>
	<meta charset="utf-8"/>
	<title>Manage Movies</title>


	<?php require "startup.php"; ?>

	<link rel='stylesheet' href='stylesheets/site-specific/manage-movies-stylesheet.css'>
	<script type="text/javascript" src="manage-movies-script.js"></script>
	
</head>

<?php include_once "header.php"; ?>

	<div class="content-container">
		<div class="add-movie">
			<label>Movie title</label>
			<input type="text" id="movieTitle"><snap id="title-Err"></snap>
			<br><br>

			<label>Releas date</label>
			<input type="text" id="releaseDate"><snap id="date-Err"></snap>
			<br><br>

			<label>Movie description</label>
			<input type="text" id="movieDescription"><snap id="description-Err"></snap>
			<br><br>

			<label>Cover picture</label>
			<input type="file" id="movieCover"><snap id="image-Err"></snap>
			<br><br>
			<p id="success-message"></p>
			<button type="button" id="add-movie-button">Add movie</button>
		</div>
		<div>
			<button type="button" id="deleteMoviesButton">Delete</button>
			<div class="movie-table"></div>
		</div>

	</div>

<?php include_once "footer.php"; }?>