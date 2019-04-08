<?php 

include_once "conn.php";

// Attempt select query execution
try{
    $sql = "SELECT * FROM movies_of_the_week";   
    $result = $pdo->query($sql);
    
    if($result->rowCount() > 0){ 
            $idEnd = 0;
            /*A php while loop in which all the existing movies 
                in the database are insertet into the table.*/
            while($row = $result->fetch()){ 

                if($row["movieTitle"] != ""){
                    ${"movie" . $idEnd} = $row["movieTitle"];
                }
                else {
                    ${"movie" . $idEnd} = "NULL";   
                } 
                $idEnd++;   
            }

        // Free result set
        unset($result);
    } else{ 
           echo "Database error DB-EMPTY.";
    }
} catch(PDOException $e){
   die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}

// Attempt select query execution
try{
    $sql = "SELECT * FROM movie_votes";   
    $result = $pdo->query($sql);
    
    if($result->rowCount() > 0){ 
            $movie0Votes = 0;
            $movie1Votes = 0;
            $movie2Votes = 0;
            $movie3Votes = 0;

            /*A php while loop in which all the existing movies 
                in the database are insertet into the table.*/
            while($row = $result->fetch()){ 

                if($row["movieTitle"] == $movie0){
                    $movie0Votes++;
                }
                else if($row["movieTitle"] == $movie1){
                    $movie1Votes++;
                }
                else if($row["movieTitle"] == $movie2){
                    $movie2Votes++;
                }
                else if($row["movieTitle"] == $movie3){
                    $movie3Votes++;
                }
            }
        // Free result set
        unset($result);

        echo $movie0 . ": " . $movie0Votes . "<br>";
        echo $movie1 . ": " . $movie1Votes . "<br>";
        echo $movie2 . ": " . $movie2Votes . "<br>";
        echo $movie3 . ": " . $movie3Votes . "<br>";
    } else{
        echo "No records matching your query were found.";
    }
} catch(PDOException $e){
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}

unset($pdo);