<?php

if(!isset($_SESSION)){
	session_start();
}

if($_SESSION["signed-in-as"] != "user"){
	include_once "index.php";
}

else { ?>

<!DOCTYPE html>

<html>

<head>
	<meta charset="utf-8"/>
	<title>Bängsingtorp biograf</title>

	<?php require "startup.php"; ?>

	<link rel="stylesheet" href="stylesheets/site-specific/user-startpage-stylesheet.css">
	<script type="text/javascript" src="user-startpage-script.js"></script>
</head>

<?php include_once "header.php"?>
	
	<div class="content-container">
		<?php include_once "get-vote-poll.php";?>
	</div>

<?php include_once "footer.php"; }?>