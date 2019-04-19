<?php

include_once "conn.php";

$movieTitle = "No movie selected";
$imageFilePath = "images/no-image-selected.jpg";

//Updates the movies for the vote poll. 
try{
    $sql = "UPDATE movies_of_the_week SET movieTitle=:movieTitle, coverFilePath=:imageFilePath WHERE ID IN (0, 1, 2, 3)";
    $stmt = $pdo->prepare($sql);
    
    $stmt->bindParam(":movieTitle", $movieTitle);
    $stmt->bindParam(":imageFilePath", $imageFilePath);

    $stmt->execute();

    //The name of the folder.
    $folder = "images/movies-of-the-week-covers";
     
    //Get a list of all of the file names in the folder.
    $files = glob($folder . '/*');
     
    //Loop through the file list.
    foreach($files as $file){
        //Make sure that this is a file and not a directory.
        if(is_file($file)){
            //Use the unlink function to delete the file.
            unlink($file);
        }
    }

} catch(PDOException $e){
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}	

try{
    $sql = "UPDATE movie_votes SET movieTitle='NULL'";
    $stmt = $pdo->prepare($sql);
    
    /*$stmt->bindParam(":movieTitle", $movieTitle);
    $stmt->bindParam(":imageFilePath", $imageFilePath);
*/
    $stmt->execute(); 

    include_once "get-movies-of-the-week.php";

} catch(PDOException $e){
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}   