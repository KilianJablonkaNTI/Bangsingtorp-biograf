<?php 

include_once "conn.php";

// Attempt select query execution
try{
    $sql = "SELECT * FROM series";   
    $result = $pdo->query($sql);
    
    if($result->rowCount() > 0){ ?>
  

            <?php
            $checkboxEnd = 0;
            /*A php while loop in which all the existing series 
                in the database are insertet into the table.*/
            while($row = $result->fetch()){ 
            $specialTitle = str_replace(" ", "%", $row["seriesTitle"]);
            
            //Inserts a series that exists in the database into the table ?>

            <div class="containers" id="<?php echo $row["seriesTitle"];?>" onclick="window.location.href = 'load-movie-or-series.php?page=series&selectedObject=<?php echo $row["seriesTitle"];?>'">
            	<img src="<?php echo $row["coverFilePath"]; ?>" class="covers">
            	<h3><?php echo $row["seriesTitle"]; ?></h3>
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