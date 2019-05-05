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
	<link rel="stylesheet" type="text/css" href="stylesheets/components/fields-stylesheet.css">
	<link rel="stylesheet" type="text/css" href="stylesheets/site-specific/startpage-stylesheet.css">
	<script type="text/javascript" src="scripts/site-specific/startpage-script.js"></script>


</head>

<?php include_once "header.php"; ?>

	<div class="content-container">
		<div class="left-container">
			<div class="vote-poll-header">
				<h1 id="poll-title">Movies of the week</h1>
				<p id="vote-text"></p>
				<a class="container-links" id="to-vote-btn" href="sign-in.php">Login or sign up to vote</a>	
			</div>

			<?php include_once "load-movies-to-vote.php";?>
		</div>

		<div class="right-container">
			<h1>Bängsingtorp biograf</h1>
			<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin consectetur augue nec diam tristique facilisis. Mauris molestie sapien vitae justo consectetur, non tempus ligula congue. Ut sit amet pharetra nulla, dapibus posuere diam. Phasellus ex nibh, gravida a bibendum non, faucibus in ipsum. Ut id accumsan nunc, id vulputate dolor. <br><br> 

			Proin et bibendum massa, quis malesuada nulla. Morbi ac magna tellus. Aliquam placerat libero semper mauris pellentesque fermentum eu eget erat. Nulla facilisi. Nam sed fermentum nulla. Integer tincidunt ex at pulvinar pulvinar. Praesent ac fermentum ipsum, sed scelerisque neque. Duis ac dui purus. Donec ante quam, placerat ut volutpat eget, rhoncus dictum diam. Aenean efficitur, massa in placerat hendrerit, mi lorem viverra eros, id tristique turpis dolor varius turpis.<br><br>

			Vestibulum consequat erat quis ligula finibus, ac lacinia ligula dapibus. Quisque pulvinar fringilla elit quis malesuada. Sed diam odio, tincidunt vitae urna ut, tempus lacinia mauris. Quisque luctus arcu et nunc pharetra, sed faucibus felis ornare. Etiam lobortis odio ac nulla sagittis consequat. Nam sem nisi, maximus ut augue in, molestie commodo urna. Cras auctor eu felis nec euismod. Vestibulum sollicitudin id eros a vehicula. Donec commodo magna eu sem placerat, et cursus nibh interdum. Duis ullamcorper non magna pharetra rhoncus. Duis vel pharetra augue. Proin enim leo, gravida et tristique vitae, molestie sed dolor. Vivamus mattis, urna non molestie consequat, ante purus volutpat tortor, vitae efficitur nisi diam sed risus. Etiam et cursus lectus, ac interdum leo. Nullam porta nibh id tellus maximus tincidunt eu id urna. Sed porttitor fringilla nulla, faucibus cursus diam. </p>
		</div>
	</div>

<?php include_once "footer.php"; ?>