<?php
include_once "conn.php";

//Checks if the movie title field is empty. 
if(empty($_POST["movieTitle"])){
    $titleErr = "Title requierd.";
}
else {
    $movieTitle = htmlspecialchars($_POST["movieTitle"]);
    $titleErr = "";
}

//Checks if the release date field is empty.
if(empty($_POST["releaseDate"])){
    $dateErr = "Release date requierd.";
}
else {
    $releaseDate = htmlspecialchars($_POST["releaseDate"]);
    //Checks if the release date is in the right format. 
    if(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$releaseDate)){
        $dateErr = "";
    }
    else{
        $dateErr = "The Release date must be in YYYY-MM-DD format.";
    }
}

//Checks if the movie description field is empty. 
if(empty($_POST["movieDescription"])){
    $descriptionErr = "Description requierd.";
}
else {
    $movieDescription = htmlspecialchars($_POST["movieDescription"]);
    $descriptionErr = "";
}

//Checks if a image file has bin selected.
if(empty($_FILES["movieCover"]["name"])){
    $imgErr = "Image requierd.";
}
else{
    $target_dir = "images/movie-covers/";
    $target_file = $target_dir . basename($_FILES["movieCover"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    //Cheks if the file is an image. 
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["movieCover"]["tmp_name"]);
        if($check !== false) {
            $imgErr = "";
        } else {
            $imgErr = "The file is not an image.";
        }
    }

    // Check if file already exists
    else if(file_exists($target_file)) {
        $imgErr = "A file with the same name does already exist.";
    }

    // Check file size
    else if($_FILES["movieCover"]["size"] > 10485760) {
        $imgErr = "The file is to large, maximun file size is: 10MB";
    }

    // Allow certain file formats
    else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $imgErr = "The img file is not in jpg, png or jpeg format.";
    }
    else {
        $imgErr = "";
    }
}


//Checks if there were no errors. 
if($titleErr == "" && $dateErr == "" && $descriptionErr == "" && $imgErr == ""){  
    //Uploades the file into the folder "uloaded_images" on the localserver.
    move_uploaded_file($_FILES["movieCover"]["tmp_name"], "images/movie-covers/" . $_FILES["movieCover"]["name"]);
    $imageFilePath = "images/movie-covers/" .$_FILES["movieCover"]["name"];        

    try{
        $sql = "INSERT INTO movies (movieTitle, releaseDate, movieDescription, coverFilePath) VALUES (:movieTitle, :releaseDate, :movieDescription, :imageFilePath)";
        $stmt = $pdo->prepare($sql);
        
        $stmt->bindParam(":movieTitle", $movieTitle);
        $stmt->bindParam(":releaseDate", $releaseDate);
        $stmt->bindParam(":movieDescription", $movieDescription);
        $stmt->bindParam(":imageFilePath", $imageFilePath);

        $stmt->execute();
        echo "Done";

    } catch(PDOException $e){
        die("ERROR: Could not able to execute $sql. " . $e->getMessage());
    }

}

//If there was and error then the messeges get send back and get diplayd on the site.
else{
    echo "tErr:" .$titleErr. ",rErr:" .$dateErr. ",dErr:" .$descriptionErr. ",iErr:" . $imgErr;
}