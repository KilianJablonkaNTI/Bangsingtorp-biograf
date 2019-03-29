<?php
	session_start();
	include_once "conn.php";

	$_SESSION["email"] = $_POST["email-field"];
	$password = $_POST["password-field"];

  try{
     $sql = "SELECT * FROM users WHERE email ='".$_SESSION["email"]."'"; 
    $result = $pdo->query($sql);
    if($result->rowCount() > 0){

        while($row = $result->fetch()){

            $row["email"];
            $row["userPassword"];
            
            $hash=$row["userPassword"];
            
            //Checks if the password matches.
            if (password_verify($password, $hash)) {
                
                if($row["ID"] == 12)
                {
                    $_SESSION["signed-in-as"] = "admin";

                    echo 'Done';
                    include_once "admin-startpage.php";    
                }
                else
                {
                    $_SESSION["signed-in-as"] = "user";
                    echo 'Done';
                    include_once "user-startpage.php";
                }
            } else {
                echo 'Fail';
                include_once "sign-in.php";
            }           
        }
        // Free result set
        unset($result);
    } else{
        echo "<br> No records matching your query were found.";
        include_once "sign-in.php";
    }
} catch(PDOException $e){
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
} 