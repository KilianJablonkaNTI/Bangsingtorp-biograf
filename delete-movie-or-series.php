<?php

include_once "conn.php";

$movieOrSeries = $_POST["movieOrSeries"];
$title = $movieOrSeries ."Title";
$deleteTitle = $_POST["toDelete"];
$amountToDelete = $_POST["amountToDel"];
$deletedAmount = 0;

if($movieOrSeries == "movie"){
	$table = "movies";
	$folder = "images/movie-covers";
}
else{
	$table = "series";
	$folder = "images/series-covers";
}

$secondComPos = 0;
$nextPartStart = 0;

for ($i = 0; $i < $amountToDelete; $i++)
{	
	//Getting the positions of the commas in the string.
	$firstComPos = strpos($deleteTitle , ",", $secondComPos);	
	$secondComPos = strpos($deleteTitle , ",", $firstComPos + 1);

	//Gets the length of the title to delete.
	$length = ($secondComPos - $firstComPos - 1);

	//Gets one of the movies to delete.
	$toDelete = substr($deleteTitle, $firstComPos + 1, $length);

	//Deletes the image for the movie or series in thier folders. 
	try{
		$sql = "SELECT coverFilePath FROM $table WHERE $title='$toDelete'";

		foreach ($pdo->query($sql) as $row) {
			$fileToDelete = $row["coverFilePath"];
		}

		unlink($fileToDelete);

	} catch(PDOException $e){
	    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
	}


	//Deletes the a movie or a series from their tables in the database. 
	try{
	    $sql = "DELETE FROM $table WHERE $title='$toDelete'";  
	    $pdo->exec($sql);

	   	$deletedAmount++;

	} catch(PDOException $e){
	    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
	}
}	

if($deletedAmount == $amountToDelete)
	echo "success";

else
	echo "fail";