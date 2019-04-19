<?php 
include_once "conn.php";

//Gets the email of the account the user is logged in with. 
$email = $_SESSION["email"];

//Checks if the user has voted or not.
try{
    $sql = "SELECT * FROM movie_votes WHERE email='$email'";

    foreach ($pdo->query($sql) as $row) {
        $vote = $row["movieTitle"];
    }

    //Checks if the user has not voted jet.
    if($vote == "NULL"){
        echo "You have not voted jet click on a movie to vote.";
    }   
    else{
        //Writes out which movie the user has voted on.   
        echo "You voted for " .$vote. "<br>";

        //Gets the file path to the cover off the movie which the  
        //user has voted on and inserts an img into the container.
        try{
            $sql = "SELECT * FROM movies WHERE movieTitle='$vote'";

            foreach ($pdo->query($sql) as $row) {
                 $movieCover = $row["coverFilePath"];
            }   ?>

            <img src="<?php echo  $movieCover; ?>" onclick="window.location.href = 'load-movie-or-series.php?page=movies&selectedObject=<?php echo $vote;?>'"/>

<?php   } catch(PDOException $e){
            die("ERROR: Could not able to execute $sql. " . $e->getMessage());
        }
    }  
} catch(PDOException $e){
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}


// Attempt select query execution
try{
    $sql = "SELECT * FROM movies_of_the_week";   
    $result = $pdo->query($sql);
    
    if($result->rowCount() > 0){ 


            //A div which can contain the movies to vote on,the movie a user 
            //has votet on or a message that there are no movies to vote on. ?>
            <div class="movies-to-vote">
            <?php
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
                    if($row["movieTitle"] != "No movie selected" && $vote == "NULL"){ 
                        //Inserts a movie that you can vote on into the container ?>
                        <div class="movie-containers" id="<?php echo $row["movieTitle"]; ?>">
                            <img src="<?php echo $row["coverFilePath"]; ?>" class="movie-covers" id="<?php echo $row["movieTitle"]; ?>">
                            <img src="" class="voted-img" id="<?php echo $row["movieTitle"]; ?>-voted">
                        </div>      
            <?php   }
                    $idEnd++;
                }  
                //If there are no movies to vote on the this message will appear. 
                if($emptyAmount == 4)
                   echo "There is no vote poll for the movies of the week.";
            ?>
     </div>
         <?php
        // Free result set
        unset($result);
    } else{ 
           echo "Database error DB-EMPTY.";
    }
} catch(PDOException $e){
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}