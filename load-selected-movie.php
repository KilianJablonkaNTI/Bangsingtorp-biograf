<?php

include_once "conn.php";

$page = $_GET["page"];
$selectedObject = $_GET["selectedObject"];

if($page == "movies"){
	$searchTitle = "movieTitle";
	$searchDescription = "movieDescription";	
}
else{
	$searchTitle = "seriesTitle";
	$searchDescription = "seriesDescription";
}



$sql = "SELECT * FROM $page WHERE $searchTitle ='$selectedObject'"; 

foreach ($pdo->query($sql) as $row) {
    $title = $row[$searchTitle];
    $releaseDate = $row['releaseDate'];
    $description = $row[$searchDescription];
    $coverFilePath = $row['coverFilePath'];
}
?>

<div>
	<div class="info-header">
		<div class="img-holder">
			<img src="<?php echo $coverFilePath; ?>" class="header-img"/>	
		</div>
		

		<div class="header-middle">
			<h1><?php echo $title; ?></h1>
			<p><?php echo $description; ?>
		</div>

		<div class="general-info">
			<h2>General</h2>
			<h3>Release date</h3>
			<p><?php echo $releaseDate; ?></p><br>

			<h3>Runtime</h3>
			<p>Not available</p><br>

			<h3>Runtime</h3>		
			<p>Not available</p>

		</div>
		
	</div>
</div>