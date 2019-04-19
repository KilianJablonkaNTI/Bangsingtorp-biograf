<?php
session_start();
?>
<!DOCTYPE html>

<html>

<head>
	<meta charset="utf-8"/>
	<title>Sign up</title>
	
	<?php require "startup.php"; ?>
	
	<script type="text/javascript" src="scripts/site-specific/sign-up-script.js"></script>
</head>

<?php include_once "header.php"?>
	
	<div class="container">
		<div>
			<label>Username</label>
			<input type="text" id="username-field" placeholder="Firstname Lastname"><snap id="username-Err"></snap>
			<br><br>

			<label>Email</label>
			<input type="text" id="email-field"><snap id="email-Err"></snap>
			<br><br>

			<label>Password</label>
			<input type="password" id="password-field"><snap id="password-Err"></snap>
			<br><br>

			<label>Confirm Password</label>
			<input type="password" id="confirm-password-field"><snap id="cpassword-Err"></snap>
			<br><br>

			<div id="register-success"></div>

			<button type="button" id="register-button">Sign up</button>

			<a href="sign-in.php">Already registerd?</a>

		</div>
	</div>

<?php include_once "footer.php"?>