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
	<title>Bängsingtorp biograf</title>

	<?php require "startup.php"; ?>
	<link rel="stylesheet" type="text/css" href="stylesheets/components/table-stylesheet.css">
</head>

<?php include_once "header.php"?>
	
	<div class="container">
		<div class="content-container">
			<div class="left-container">
				<?php include_once "get-votes.php"; ?>
			</div>
		</div>
	</div>

<?php include_once "footer.php"; }?>