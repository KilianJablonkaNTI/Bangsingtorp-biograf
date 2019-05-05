<?php

if(!isset($_SESSION)){
	session_start();
}

if($_SESSION["signed-in-as"] != "admin"){
	header("Location: index.php");
}

else { ?>
<!DOCTYPE html>

<html>

<head>
	<meta charset="utf-8"/>
	<title>Weekly Vote</title>

	<?php require "startup.php"; ?>

	<link rel="stylesheet" href="stylesheets/site-specific/manage-weekly-vote-stylesheet.css">
	<link rel="stylesheet" href="stylesheets/components/table-stylesheet.css">
	<script type="text/javascript" src="scripts/components/sort-table.js"></script>
	<script type="text/javascript" src="scripts/site-specific/manage-weekly-vote-script.js"></script>
</head>

<?php include_once "header.php"; ?>

	<div class="content-container" id="content-container">
		<?php include_once "get-movies-of-the-week.php";?>
	</div>
	
<?php include_once "footer.php"; }?>