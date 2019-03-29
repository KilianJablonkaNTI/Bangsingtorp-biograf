<?php

include_once "conn.php";

$moviesToDelete = $_POST["moviesToDel"];



	//Deletes the user from the users table in the database. 
	try{
	    $sql = "DELETE FROM movies WHERE movieTitle='$d'";  
	    $pdo->exec($sql);

	} catch(PDOException $e){
	    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
	}
}

echo "OK";