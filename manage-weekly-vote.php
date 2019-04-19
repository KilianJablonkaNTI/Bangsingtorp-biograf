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
	<title>Bängsingtorp biograf</title>

	<?php require "startup.php"; ?>

	<link rel="stylesheet" href="stylesheets/site-specific/manage-weekly-vote-stylesheet.css">
	<script type="text/javascript" src="manage-weekly-vote-script.js"></script>
	
</head>

<?php include_once "header.php"; ?>

	<div class="content-container">
		<?php include_once "get-movies-of-the-week.php";?>
	</div>

	<script type="text/javascript" src="manage-movies-script.js"></script>
<?php include_once "footer.php"; }?>