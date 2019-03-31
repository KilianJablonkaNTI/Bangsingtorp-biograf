<?php 

include_once "conn.php";

// Attempt select query execution
try{
    $sql = "SELECT * FROM movies";   
    $result = $pdo->query($sql);
    
    if($result->rowCount() > 0){ ?>
  

            <?php
            $checkboxEnd = 0;
            /*A php while loop in which all the existing movies 
                in the database are insertet into the table.*/
            while($row = $result->fetch()){ 
            
            //Inserts a movie that exists in the database into the table ?>

            <div class="movie-containers" id="<?php echo $row["movieTitle"]; ?>">
            	<img src="<?php echo $row["coverFilePath"]; ?>" class="movie-covers">
            	<h3><?php echo $row["movieTitle"]; ?></h3>
            	<p>More info</p>
            </div>
        <?php 
            $checkboxEnd++;

         }?>
        </table>
         <?php
        // Free result set
        unset($result);
    } else{
        echo "No records matching your query were found.";
    }
} catch(PDOException $e){
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}

unset($pdo);