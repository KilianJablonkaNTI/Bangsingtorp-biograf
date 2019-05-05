<?php

include_once "conn.php";

$titleErr = "";
$imgErr = "";

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

$titleArray = array(4);
$imageFilePathArray = array(4);

for($i = 0; $i < 4; $i++)
{	
	if(empty($_FILES["movieCover".$i]["name"])){
		$imgErr = "Every movie must have an image.";
	}
	else{
		$target_dir = "images/movies-of-the-week-covers/";
		$target_file = $target_dir . basename($_FILES["movieCover".$i]["name"]);
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		//Cheks if the file is an image. 
		if(isset($_POST["submit"])) {
		    $check = getimagesize($_FILES["movieCover".$i]["tmp_name"]);
		    if($check !== false) {
		        $imgErr = "";
		    } else {
		    	$imgErr = "The file is not an image.";
		    }
		}

		// Check if file already exists
		if (file_exists($target_file)) {
		    $imgErr = "A file with the same name does already exist.";
		}

		// Check file size
		if ($_FILES["movieCover".$i]["size"] > 10485760) {
			$imgErr = "The file is to large, maximun file size is: 10MB";
		}

		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
		    $imgErr = "The img file is not in jpg, png or jpeg format.";
		}

		else{
			$movieTitle = htmlspecialchars($_POST["movieTitle".$i]);

			//Checks if the admin has selected a movie/title.
			if($movieTitle == "No movie selected"){
				$titleErr = "You have not selected four titles/moveis.";
			}
			else{
				$titleArray[$i] = $movieTitle;
			}
		}
	}
}

if($titleErr == "" && $imgErr == ""){
	for($i = 0; $i < 4; $i++){
		//Uploades the file into the folder "movies-of-the-week-covers" on the localserver.
		move_uploaded_file($_FILES["movieCover".$i]["tmp_name"], "images/movies-of-the-week-covers/" . $_FILES["movieCover".$i]["name"]);
		$imageFilePathArray[$i] = "images/movies-of-the-week-covers/" .$_FILES["movieCover".$i]["name"];

		//Updates the movies for the vote poll. 
		try{
		    $sql = "UPDATE movies_of_the_week SET movieTitle=:movieTitle, coverFilePath=:imageFilePath WHERE ID=$i";
		    $stmt = $pdo->prepare($sql);
		    
		    $stmt->bindParam(":movieTitle", $titleArray[$i]);
		    $stmt->bindParam(":imageFilePath", $imageFilePathArray[$i]);

		    $stmt->execute();


		} catch(PDOException $e){
		    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
		}
	}
	echo "success";	
}
else{
	echo "tErr:" .$titleErr. ",iErr:" .$imgErr;
}

