<?php

include_once "conn.php";

// Attempt select query execution
try{
    $sql = "SELECT * FROM movies_of_the_week";   
    $result = $pdo->query($sql);
    
    if($result->rowCount() > 0){ 


            //A div which can contain the movies to vote on,the movie a user 
            //has votet on or a message that there are no movies to vote on.
            echo "<div class='movie-container'>";
            $idEnd = 0;
            $emptyAmount = 0;

            /*A php while loop in which inserts all the 
            movies that you can vote on into a div.*/
            while($row = $result->fetch()){ 
                
                if($row["movieTitle"] == "No movie selected"){
                    $emptyAmount++;
                }
                
                //Only if there are movies to vote and the user has not
                //voted jet the movies to vote on will appear.
                if($row["movieTitle"] != "No movie selected"){ 
                    //Inserts a movie that you can vote on into the container ?>
                    <div class="movie-containers" id="<?php echo $row["movieTitle"]; ?>">
                        <img src="<?php echo $row["coverFilePath"]; ?>" class="movie-covers" id="<?php echo $row["movieTitle"]; ?>">
                    </div>      
        <?php   }
                $idEnd++;
            } ?>
            </div>  
        <?php    
            //If there are no movies to vote on the this message will appear. 
            if($emptyAmount == 4){
                echo "<script> var votePoll = false; </script>";
            }
            else
                echo "<script> var votePoll = true; </script>";
        // Free result set
        unset($result);
    } else{ 
           echo "Database error DB-EMPTY.";
    }
} catch(PDOException $e){
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}