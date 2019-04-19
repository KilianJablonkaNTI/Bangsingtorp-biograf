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
</head>

<?php include_once "header.php"?>
	
	<div class="container">
		<div>
			<?php include_once "get-votes.php"; ?>
		</div>
	</div>

<?php include_once "footer.php"; }?>