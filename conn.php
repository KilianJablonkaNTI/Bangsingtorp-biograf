<?php
if(!isset($_SESSION))
{
	session_start();
}

//Trys to conect to the database. 
try{
    $pdo = new PDO("mysql:host=localhost;dbname=basic_bangbio", "root", "");
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
}