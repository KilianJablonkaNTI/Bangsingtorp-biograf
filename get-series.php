<?php
include_once "conn.php";

// Attempt select query execution
try{
    $sql = "SELECT * FROM series";   
    $result = $pdo->query($sql);
    
    if($result->rowCount() > 0){ 

            // Creates the upper part of the table where the 
            // users that are in the database whil be shown. ?>
        <table id="seriesTable">        
            <tr class="series-info">
                <th></th>
                <th></th>
                <th>Title & release date</th>
                <th>Description</th>        
            </tr>

            <?php
            $checkboxEnd = 0;
            /*A php while loop in which all the existing series 
                in the database are insertet into the table.*/
            while($row = $result->fetch()){ 
            
            //Inserts a series that exists in the database into the table ?>
            <tr class="series">
                <td><input type="checkbox" class="deleteCheckbox" id="selectSeries<?php echo $checkboxEnd; ?>" value="<?php echo $row["seriesTitle"]; ?>">
                <td><img src="<?php echo $row["coverFilePath"]; ?>"></td>
                <td>
                    <h2 class="title sortByTitle"><?php echo $row["seriesTitle"]; ?></h2>
                    <p class="releaseDate"><?php echo $row["releaseDate"]; ?></p>
                </td>
                <td><?php echo $row["seriesDescription"]; ?></td>
            </tr>
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