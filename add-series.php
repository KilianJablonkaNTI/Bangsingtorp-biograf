<?php
session_start();
include_once "conn.php";

$seriesTitle = $_POST["seriesTitle"];
$releaseDate = $_POST["releaseDate"];
$seriesDescription = $_POST["seriesDescription"]; 
$coverFilePath = "test/file/path..."; 


//Inserts a new user with the apartmentnr, fullname, passwrod 
//and puctireadress that the user has enterd. 
try{
    $sql = "INSERT INTO series (seriesTitle, releaseDate, seriesDescription, coverFilePath) VALUES (:seriesTitle, :releaseDate, :seriesDescription, :coverFilePath)";
    $stmt = $pdo->prepare($sql);
    
    $stmt->bindParam(":seriesTitle", $seriesTitle);
    $stmt->bindParam(":releaseDate", $releaseDate);
    $stmt->bindParam(":seriesDescription", $seriesDescription);
    $stmt->bindParam(":coverFilePath", $coverFilePath);

    $stmt->execute();
    echo "Done";

} catch(PDOException $e){
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}