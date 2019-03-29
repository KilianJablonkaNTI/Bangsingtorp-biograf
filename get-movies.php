<?php
include_once "conn.php";

// Attempt select query execution
try{
    $sql = "SELECT * FROM movies";   
    $result = $pdo->query($sql);
    
    if($result->rowCount() > 0){ 

            // Creates the upper part of the table where the 
            // users that are in the database whil be shown. ?>
        <table id="movieTable">        
            <tr class="movies-info">
                <th></th>
                <th>Title</th>
                <th>Release date</th>
                <th>Description</th>
                <th>Cover</th>          
            </tr>

            <?php
            $checkboxEnd = 0;
            /*A php while loop in which all the existing movies 
                in the database are insertet into the table.*/
            while($row = $result->fetch()){ 
            
            //Inserts a movie that exists in the database into the table ?>
            <tr class="movies">
                <td><input type="checkbox" class="deleteCheckbox" id="selectMovie<?php echo $checkboxEnd; ?>" value="<?php echo $row["movieTitle"]; ?>">
                <td class="sortByTitle"><?php echo $row["movieTitle"]; ?></td>
                <td><?php echo $row["releaseDate"]; ?></td>
                <td><?php echo $row["movieDescription"]; ?></td>
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