<?php
include_once "conn.php";

$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"]; 

$passwordDB = password_hash($password,PASSWORD_DEFAULT);

//Inserts a new user with the apartmentnr, fullname, passwrod 
//and puctireadress that the user has enterd. 
try{
    $sql = "INSERT INTO users (username, email, userPassword) VALUES (:username, :email, :password)";
    $stmt = $pdo->prepare($sql);
    
    $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $passwordDB);

    $stmt->execute();
    echo "Done";

} catch(PDOException $e){
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}
