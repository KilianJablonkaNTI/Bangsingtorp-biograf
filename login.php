<?php
	include_once "conn.php";

	$_SESSION["email"] = $_POST["email-field"];
	$password = $_POST["password-field"];

  try{
    $sql = "SELECT * FROM users WHERE email ='".$_SESSION["email"]."'"; 
    $result = $pdo->query($sql);
    
    if($result->rowCount() > 0){

        while($row = $result->fetch()){

            $row["email"];
            $row["password"];
            
            $hash=$row["password"];
            
            //Checks if the password matches.
            if (password_verify($password, $hash)) {
                
                if($row["ID"] == 1)
                {
                    $_SESSION["signed-in-as"] = "admin";
                    include_once "admin-startpage.php";    
                }
                else
                {
                    $_SESSION["signed-in-as"] = "user";
                    include_once "user-startpage.php";
                }
            } else {
                $_SESSION["loginErr"] = "Username and password are not matching.";
                include_once "sign-in.php";
            }           
        }
        // Free result set
        unset($result);
    } else{
        $_SESSION["loginErr"] = "Username and password are not matching.";
        include_once "sign-in.php";
    }
} catch(PDOException $e){
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
} 