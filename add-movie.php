<?php
include_once "conn.php";

$movieTitle = $_POST["movieTitle"];
$releaseDate = $_POST["releaseDate"];
$movieDescription = $_POST["movieDescription"]; 
 

    $userSet = false;
    $userTimeSet = false;
    $fileSet = false;

    $target_dir = "images/movie-covers/";
    $target_file = $target_dir . basename($_FILES["movieCover"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    //Cheks if the file is an image. 
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["movieCover"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
            echo "fileNotImg";
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        $uploadOk = 0;
        echo "fileDoesExists";
    }

    // Check file size
    if ($_FILES["movieCover"]["size"] > 500000) {
        $uploadOk = 0;
        echo "fileToLarge";
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif") {
        $uploadOk = 0;
        echo "fileNotOkImg";
    }

    if($uploadOk == 1)
        {  
            //Uploades the file into the folder "uloaded_images" on the localserver.
            move_uploaded_file($_FILES["movieCover"]["tmp_name"], "images/movie-covers/" . $_FILES["movieCover"]["name"]);
            $imageFilePath = "images/movie-covers/" .$_FILES["movieCover"]["name"];

            $fileSet = true;
        

//Inserts a new user with the apartmentnr, fullname, passwrod 
//and puctireadress that the user has enterd. 
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

else 
	echo "Problem with the image!";


