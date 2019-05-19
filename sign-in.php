<!DOCTYPE html>

<html>

<head>
	<meta charset="utf-8"/>
	<title>Sign in</title>
	
	<?php require "startup.php"; ?> 
</head>

<?php include_once "header.php"?>

	<div class="container">
		<div class="content-container">
			<div class="left-container">
				<form action="login.php" method="post">
					<label>Email</label>
					<input type="text" name="email-field" id="email-field" required="true">
					<br><br>

					<label>Password</label>	
					<input type="password" name="password-field" id="password-field" required="true">
					<br><br>
					
					<button type="submit" id="login-button">Login</button>

					<a class="container-links" href="#">Reset password</a><br><br>

					<div class="error-holders"> <?php if(isset($_SESSION["loginErr"])){ echo $_SESSION["loginErr"]; $_SESSION["loginErr"] = "";}?></div>
				</form>
			</div>
			<div class="right-container"></div>
		</div>
	</div>

<?php include_once "footer.php"?>