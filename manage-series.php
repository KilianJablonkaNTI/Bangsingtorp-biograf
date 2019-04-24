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
	<title>Manage series</title>


	<?php require "startup.php"; ?>

	<link rel='stylesheet' href='stylesheets/site-specific/manage-movies-series-stylesheet.css'>
	<script type="text/javascript" src="manage-series-script.js"></script>
	
</head>

<?php include_once "header.php"; ?>

	<div class="content-container">
		<div class="add-movies-series">
			<label>Series title</label>
			<input type="text" class="data-elements" id="seriesTitle"><span class="error-holders" id="title-Err"></span>
			<br><br>

			<label>Releas date</label>
			<input type="text" class="data-elements" id="releaseDate"><span class="error-holders" id="date-Err"></span>
			<br><br>

			<label>Series description</label>
			<textarea class="data-elements" id="seriesDescription"></textarea><span class="error-holders" id="description-Err"></span>
			<br><br>

			<label>Cover picture</label>
			<input type="file" class="data-elements" id="seriesCover"><span class="error-holders" id="image-Err"></span>
			<br><br>

			<button type="button" id="add-series-button">Add series</button><span id="success-message"></span>
		</div>
		<div class="movies-series-table">
			<button type="button" id="delete-series-button">Delete</button><span id="delete-message"></span><br>
			<div class="series-table"></div>
		</div>

	</div>

<?php include_once "footer.php"; }?> 