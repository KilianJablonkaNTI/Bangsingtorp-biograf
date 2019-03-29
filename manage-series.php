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

	<script type="text/javascript" src="manage-series-script.js"></script>
</head>

<?php include_once "header.php"; ?>

	<div class="container">
		<div>
			<label>Series title</label>
			<input type="text" id="seriesTitle">
			<br><br>

			<label>Releas date</label>
			<input type="text" id="releaseDate">
			<br><br>

			<label>Series description</label>
			<input type="text" id="seriesDescription">
			<br><br>

			<label>Cover picture</label>
			<input type="file" id="seriesCover">
			<br><br>

			<button type="button" id="add-series-button">Add series</button>
		</div>
	</div>

<?php include_once "footer.php"; ?>