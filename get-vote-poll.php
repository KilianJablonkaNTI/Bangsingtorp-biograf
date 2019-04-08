<?php 

include_once "conn.php";

// Attempt select query execution
try{
    $sql = "SELECT * FROM movies_of_the_week";   
    $result = $pdo->query($sql);
    
    if($result->rowCount() > 0){ ?>
  			
    	<div class="movies-to-vote">
            <?php
            $idEnd = 0;
            /*A php while loop in which all the existing movies 
                in the database are insertet into the table.*/
            while($row = $result->fetch()){ 
            
            if($row["movieTitle"] != "")
            {
                //Inserts a movie that exists in the database into the table ?>
                <div class="movie-containers" id="<?php echo $row["movieTitle"]; ?>">
                    <img src="<?php echo $row["coverFilePath"]; ?>" class="movie-covers" id="<?php echo $row["movieTitle"]; ?>">
                    <img src="" class="voted-img" id="<?php echo $row["movieTitle"]; ?>-voted">
                </div>    
    <?php   }
            else 
            { ?>
                <div class="movie-containers" id="noMovie<?php echo $idEnd; ?>">
                    <img src="images/movies-of-the-week-covers/no-img-selected.jpg" class="movie-covers" id="img-VMC<?php echo $idEnd; ?>">
                    <h3 id="movie-title<?php echo $idEnd; ?>">No movie selected</h3>
                </div>  
    <?php   }
            $idEnd++;
         }?>
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