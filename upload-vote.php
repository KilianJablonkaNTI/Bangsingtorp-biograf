<?php

include_once "conn.php";

$movieTitle = $_POST["movieTitle"];

//Updates the movies for the vote poll. 
try{
    $sql = "UPDATE movie_votes SET movieTitle=:movieTitle WHERE email=:email";
    $stmt = $pdo->prepare($sql);
    
    $stmt->bindParam(":email", $_SESSION["email"]);
    $stmt->bindParam(":movieTitle", $movieTitle);

    $stmt->execute();
    echo "Done";

} catch(PDOException $e){
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}