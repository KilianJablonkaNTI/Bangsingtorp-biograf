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
                <th>Title</th>
                <th>Release date</th>
                <th>Description</th>
                <th>Cover</th>          
            </tr>

            <?php
            $checkboxEnd = 0;
            /*A php while loop in which all the existing series 
                in the database are insertet into the table.*/
            while($row = $result->fetch()){ 
            
            //Inserts a series that exists in the database into the table ?>
            <tr class="series">
                <td><input type="checkbox" class="deleteCheckbox" id="selectseries<?php echo $checkboxEnd; ?>" value="<?php echo $row["seriesTitle"]; ?>">
                <td class="sortByTitle"><?php echo $row["seriesTitle"]; ?></td>
                <td><?php echo $row["releaseDate"]; ?></td>
                <td><?php echo $row["seriesDescription"]; ?></td>
                <td><img src="<?php echo $row["coverFilePath"]; ?>"></td>
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