<?php
session_start();
?>
<!DOCTYPE html>

<html>

<head>
	<meta charset="utf-8"/>
	<title>Sign in</title>
	
	<?php require "startup.php"; ?> 

	<script type="text/javascript" src="scripts/site-specific/sign-in-script.js"></script>
</head>

<?php include_once "header.php"?>

	<div class="container">
		<div>
			<form action="login.php" method="post">
				<label>Email</label>
				<input type="text" name="email-field" id="email-field">
				<br><br>

				<label>Password</label>	
				<input type="password" name="password-field" id="password-field">
				<br><br>

				<button type="submit" id="login-button">Login</button>

				<a href="#">Reset password</a>
			</form>
		</div>
	</div>

<?php include_once "footer.php"?>