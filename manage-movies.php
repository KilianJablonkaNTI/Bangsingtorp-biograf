<?php
if(!isset($_SESSION))
{
	session_start();
}
?>
<!DOCTYPE html>

<html>

<head>
	<meta charset="utf-8"/>
	<title>Bängsingtorp biograf</title>


	<?php require "startup.php"; ?>

	<link rel='stylesheet' href='stylesheets/site-specific/manage-movies-stylesheet.css'>
	
</head>

<?php include_once "header.php"; ?>

	<div class="content-container">
		<div class="add-movie">
			<label>Movie title</label>
			<input type="text" id="movieTitle">
			<br><br>

			<label>Releas date</label>
			<input type="text" id="releaseDate">
			<br><br>

			<label>Movie description</label>
			<input type="text" id="movieDescription">
			<br><br>

			<label>Cover picture</label>
			<input type="file" id="movieCover">
			<br><br>

			<button type="button" id="add-movie-button">Add movie</button>
		</div>
		<div>
			<button type="button" id="deleteMoviesButton">Delete</button>
			<div class="movie-table"></div>

		</div>

	</div>

	<script type="text/javascript" src="manage-movies-script.js"></script>
<?php include_once "footer.php"; ?>