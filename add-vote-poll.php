<?php

include_once "conn.php";

//The name of the folder.
$folder = "images/movies-of-the-week-covers";
 
//Get a list of all of the file names in the folder.
$files = glob($folder . '/*');
 
//Loop through the file list.
foreach($files as $file){
    //Make sure that this is a file and not a directory.
    if(is_file($file)){
        //Use the unlink function to delete the file.
        unlink($file);
    }
}

for($i = 0; $i < 4; $i++)
{	
	$target_dir = "images/movies-of-the-week-covers/";
	$target_file = $target_dir . basename($_FILES["movieCover".$i]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	//Cheks if the file is an image. 
	if(isset($_POST["submit"])) {
	    $check = getimagesize($_FILES["movieCover".$i]["tmp_name"]);
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
	if ($_FILES["movieCover".$i]["size"] > 500000) {
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
	        move_uploaded_file($_FILES["movieCover".$i]["tmp_name"], "images/movies-of-the-week-covers/" . $_FILES["movieCover".$i]["name"]);
	        $imageFilePath = "images/movies-of-the-week-covers/" .$_FILES["movieCover".$i]["name"];

	        $fileSet = true;
	    }

	$movieTitle = $_POST["movieTitle".$i];

	//Updates the movies for the vote poll. 
	try{
	    $sql = "UPDATE movies_of_the_week SET movieTitle=:movieTitle, coverFilePath=:imageFilePath WHERE ID=$i";
	    $stmt = $pdo->prepare($sql);
	    
	    $stmt->bindParam(":movieTitle", $movieTitle);
	    $stmt->bindParam(":imageFilePath", $imageFilePath);

	    $stmt->execute();

	    

	} catch(PDOException $e){
	    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
	}	
}

