<?php
	include_once "conn.php";

	$_SESSION["email"] = htmlspecialchars($_POST["email-field"]);
	$password = htmlspecialchars($_POST["password-field"]);

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
                    header("Location: admin-startpage.php");    
                }
                else
                {
                    $_SESSION["signed-in-as"] = "user";
                    header("Location: user-startpage.php");
                }
            } else {
                $_SESSION["loginErr"] = "Email and password are not matching.";
                header("Location: sign-in.php");
            }           
        }
        // Free result set
        unset($result);
    } else{
        $_SESSION["loginErr"] = "Email and password are not matching.";
        header("Location: sign-in.php");
    }
} catch(PDOException $e){
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
} 