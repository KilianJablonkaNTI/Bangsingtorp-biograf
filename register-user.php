<?php
include_once "conn.php";

//Checks if the email field isnt empty.
if(empty($_POST["email"])){
    $emailErr = "Email is requierd.";
}
else{
    //Converts the special characters in the string. 
    $email = htmlspecialchars($_POST["email"]);

    // Checks if the e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format.";
    }
    else {
        try{
            $sql = "SELECT * FROM users";   
            $result = $pdo->query($sql);
            
            if($result->rowCount() > 0){
                $emailExist = false;

                while($row = $result->fetch()){ 
                    if($row["email"] == $email) {
                        $emailExist = true;
                    }
                }
                unset($result);

                if($emailExist == true) {
                    $emailErr = "This email is already in use.";
                }
                else {
                    $emailErr = "";
                }
            } else{ 
                    $emailErr = "DB-Empty";
            }
        } catch(PDOException $e){
            die("ERROR: Could not able to execute $sql. " . $e->getMessage());
        }
    }
}

//Checks if the username field isnt empty.
if(empty($_POST["username"])){
    $nameErr = "Username requierd.";
}
else{
    //Converts the special characters in the string. 
    $username = htmlspecialchars($_POST["username"]);

    // Checks if the e-mail address is well-formed
    if (!preg_match("/^[a-zA-Z]*$/",$username)) {
        $nameErr = "Only letters and white space allowed.";
    }
    else {
        $nameErr = "";
    }
}

//Checks if the password field isn't empty.
if(empty($_POST["password"])){
    $passErr = "Password requierd.";
}
else {
    //Converts the special characters in the string. 
    $password = htmlspecialchars($_POST["password"]);
    if(strlen($password) < 10) {
        $passErr = "The password must at least be 10 characters long.";
    }
    else {
        $passErr = "";
    }
}


if(empty($_POST["cpassword"])){
    $cpassErr = "Confirm password requierd.";    
}
else if($_POST["cpassword"] != $_POST["password"]) {
    $cpassErr = "Passwords not matching.";   
}
else {
    //Converts the special characters in the string. 
    $cpassword = htmlspecialchars($_POST["cpassword"]);

    $cpassErr = "";
}

if($emailErr == "" || $emailErr == "DB-Empty" && $nameErr == "" && $passErr == "" && $cpassErr == ""){
    $passErr = "";
    $userRegisterd = false;
    $passwordDB = password_hash($password,PASSWORD_DEFAULT);

    //Inserts a new user into the database.
    try{
        $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $pdo->prepare($sql);
        
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $passwordDB);

        $stmt->execute();
        $userRegisterd = true;

    } catch(PDOException $e){
        $userRegisterd = false;
        die("ERROR: Could not able to execute $sql. " . $e->getMessage());
    }

    //Inserts a free space for the user to save the vote for the movies of the week.
    try{
        $sql = "INSERT INTO movie_votes (email, movieTitle) VALUES (:email, 'NULL')";
        $stmt = $pdo->prepare($sql);
        
        $stmt->bindParam(":email", $email);

        $stmt->execute();
        $userRegisterd = true;

    } catch(PDOException $e){
        die("ERROR: Could not able to execute $sql. " . $e->getMessage());
        $userRegisterd = false;
    }

    if($userRegisterd == true) {
        echo "Done";
    }
    else {
        echo "Error";
    }
}
else{
    echo "eErr:" .$emailErr. ",nErr:" .$nameErr. ",pErr:" .$passErr. ",cErr:" . $cpassErr;
}







