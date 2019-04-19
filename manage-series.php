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

	<link rel='stylesheet' href='stylesheets/site-specific/manage-series-stylesheet.css'>
	<script type="text/javascript" src="manage-series-script.js"></script>
	
</head>

<?php include_once "header.php"; ?>

	<div class="content-container">
		<div class="add-series">
			<label>Series title</label>
			<input type="text" id="seriesTitle"><snap id="title-Err"></snap>
			<br><br>

			<label>Releas date</label>
			<input type="text" id="releaseDate"><snap id="date-Err"></snap>
			<br><br>

			<label>Series description</label>
			<input type="text" id="seriesDescription"><snap id="description-Err"></snap>
			<br><br>

			<label>Cover picture</label>
			<input type="file" id="seriesCover"><snap id="image-Err"></snap>
			<br><br>
			<p id="success-message"></p>
			<button type="button" id="add-series-button">Add series</button>
		</div>
		<div>
			<button type="button" id="deleteseriessButton">Delete</button>
			<div class="series-table"></div>
		</div>

	</div>

<?php include_once "footer.php"; }?> 