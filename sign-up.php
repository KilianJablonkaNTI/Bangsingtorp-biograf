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
		<div class="content-container">
			<div class="left-container">
				<label>Username</label>
				<input type="text" id="username-field" placeholder="Firstname Lastname"><span class="error-holders" id="username-Err"></span>
				<br><br>

				<label>Email</label>
				<input type="text" id="email-field" placeholder="example@example.com"><span class="error-holders" id="email-Err"></span>
				<br><br>

				<label>Password</label>
				<input type="password" id="password-field" placeholder="10 characters minimum"><span class="error-holders" id="password-Err"></span>
				<br><br>

				<label>Confirm Password</label>
				<input type="password" id="confirm-password-field" placeholder="Repeat password"><span class="error-holders" id="cpassword-Err"></span>
				<br><br>

				<button type="button" id="register-button">Sign up</button>

				<a class="container-links" href="sign-in.php">Already registerd?</a>

				<div>
					<div class="success-holders close-holders" id="register-success"></div><img class="close-btn-img" id="close-suc-msg" src="images/icons/baseline-close-24px.svg">
				</div>
			</div>

			<div class="right-container"></div>
		</div>
	</div>

<?php include_once "footer.php"?>