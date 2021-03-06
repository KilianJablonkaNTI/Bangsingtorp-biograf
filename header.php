<?php 
	if(!isset($_SESSION)){
		session_start();
	}
?>
<body>
	<div class="container">
		<div class="header">

			<?php if($_SESSION["signed-in-as"] == "none"){ ?> 
				<div class="start-header">
					<div class="left-bar">
						<a class="bar-links" href="startpage.php">Bängsingtorp biograf</a>
					</div>

					<div class="" lass="right-bar">
						<a class="bar-links" href="sign-in.php">Sign in</a>
						<a class="bar-links" href="sign-up.php">Sign up</a>	
					</div>
				</div>
			<?php }?>

			<?php if($_SESSION["signed-in-as"] == "user"){ ?>
				<div class="user-header">
					<div class="left-bar">
						<a class="bar-links" href="user-startpage.php">Bängsingtorp biograf</a>
					</div>

					<div class="middle-bar">
						<a class="bar-links" href="movies.php">Movies</a>
						<a class="bar-links" href="series.php">Series</a>
					</div>

					<div class="right-bar">
						<a class="bar-links" href="index.php">Sign out</a>
					</div>
				</div>
			<?php }?>

			<?php if($_SESSION["signed-in-as"] == "admin"){ ?>
				<div class="admin-header">
					<div class="left-bar">
						<a class="bar-links" href="admin-startpage.php">Bängsingtorp biograf</a>
					</div>

					<div class="middle-bar">
						<a class="bar-links" href="manage-weekly-vote.php">Weekly vote</a>
						<a class="bar-links" href="manage-movies.php">Manage movies</a>
						<a class="bar-links" href="manage-series.php">Manage series</a>
					</div>

					<div class="right-bar">
						<a class="bar-links" href="index.php">Sign out</a>
					</div>
				</div>
			<?php }?>

		</div>