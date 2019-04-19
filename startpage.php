<?php
if(!isset($_SESSION)){
	session_start();
}
?>
<!DOCTYPE html>

<html>

<head>
	<meta charset="utf-8"/>
	<title>Bängsingtorp biograf</title>

	<?php require "startup.php"; ?>
</head>

<?php include_once "header.php"; ?>

	<div class="container">
		<div>
			This is the startpage.
		</div>
	</div>

<?php include_once "footer.php"; ?>