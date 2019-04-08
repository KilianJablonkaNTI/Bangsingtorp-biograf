<?php

include_once "conn.php";

$moviesToDelete = $_POST["moviesToDel"];
$amountToDelete = $_POST["amountToDel"];

$secondComPos = 0;
$nextPartStart = 0;

for ($i = 0; $i < $amountToDelete; $i++)
{	
	//Getting the positions of the commas in the string.
	$firstComPos = strpos($moviesToDelete , ",", $secondComPos);	
	$secondComPos = strpos($moviesToDelete , ",", $firstComPos + 1);

	//Gets the length of the title to delete.
	$length = ($secondComPos - $firstComPos - 1);

	//Gets one of the movies to delete.
	$movieToDelete = substr($moviesToDelete, $firstComPos + 1, $length);

	//Deletes the user from the users table in the database. 
	try{
	    $sql = "DELETE FROM movies WHERE movieTitle='$movieToDelete'";  
	    $pdo->exec($sql);

	    echo "OK";
	    

	} catch(PDOException $e){
	    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
	}
}	