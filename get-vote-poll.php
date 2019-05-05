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
        echo "<h1 id='poll-title'></h1>";
        echo "<p id='vote-text'></p>";

       include_once "load-movies-to-vote.php";
    }   
    else{
        echo "<h1>Your vote</h1>";
        //Writes out which movie the user has voted on.   
        echo "<p>You voted for " .$vote. ".</p><br>";

        //Gets the file path to the cover off the movie which the  
        //user has voted on and inserts an img into the container.
        try{
            $sql = "SELECT * FROM movies_of_the_week WHERE movieTitle='$vote'";

            foreach ($pdo->query($sql) as $row) {
                 $movieCover = $row["coverFilePath"];
            }   ?>

            <img class="movie-covers voted-movie" src="<?php echo  $movieCover; ?>" onclick="window.location.href = 'load-movie-or-series.php?page=movies&selectedObject=<?php echo $vote;?>'"/>

<?php   } catch(PDOException $e){
            die("ERROR: Could not able to execute $sql. " . $e->getMessage());
        }
    }  
} catch(PDOException $e){
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}

