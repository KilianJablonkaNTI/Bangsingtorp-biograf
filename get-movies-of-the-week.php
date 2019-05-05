<?php 

include_once "conn.php";

// Attempt select query execution
try{
    $sql = "SELECT * FROM movies_of_the_week";   
    $result = $pdo->query($sql);
    
    if($result->rowCount() > 0){ ?>
  			
    	<div class="selected-movies">
            <div class="selected-movies-container">
            <?php
            $idEnd = 0;
            /*A php while loop in which all the existing movies 
                in the database are insertet into the table.*/
            while($row = $result->fetch()){
                    //Inserts a movie that exists in the database into the table ?>
                    <div class="movie-containers" id="movie<?php echo $idEnd; ?>">
                        <img src="<?php echo $row["coverFilePath"]; ?>" class="movie-covers" id="img-VMC<?php echo $idEnd; ?>">
                        <br><input type="file" class="img-upload" id="VMC<?php echo $idEnd; ?>">
                        <p id="movie-title<?php echo $idEnd; ?>"><?php echo $row["movieTitle"]; ?></p>
                        <button class="unset-button" id="unset<?php echo $idEnd; ?>"><img src="images/icons/baseline-close-24px.svg"></button>
                    </div>

            <?php   $idEnd++;
            }
        ?>
        </div>
        
        <div class="button-container">
            <button type="button" id="createPollButton" class="edit-poll-buttons">Create vote poll</button>
            <span class="success-holders" id="add-Suc"></span><span class="error-holders" id="add-Err"></span><br><br>
            <button type="button" id="deletePollButton" class="edit-poll-buttons">Delete vote poll</button>
            <span class="error-holders" id="delete-Err"></span><span class="success-holders" id="delete-Suc"></span>
        </div>
         
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

// Attempt select query execution
try{
    $sql = "SELECT * FROM movies";   
    $result = $pdo->query($sql);
    
    if($result->rowCount() > 0){ 

            // Creates the upper part of the table where the 
            // users that are in the database whil be shown. ?>
	<div class="movie-table-container">            
        <table id="table-to-sort">    
            <thead>
                <tr class="movies-info">
                    <th></th>
                    <th>Title</th>
                    <th>Release date</th>
                    <th>Description</th>       
                </tr>
            </thead>    
            <tbody class="tbody-overflow">
               <?php
               $checkboxEnd = 0;
               /*A php while loop in which all the existing movies 
                   in the database are insertet into the table.*/
               while($row = $result->fetch()){ 
               
               //Inserts a movie that exists in the database into the table ?>
               <tr class="movies">
                   <td><input type="checkbox" class="selectCheckbox" id="selectMovie<?php echo $checkboxEnd; ?>" value="<?php echo $row["movieTitle"]; ?>">
                   <td class="sortByTitle movie-title"><?php echo $row["movieTitle"]; ?></td>
                   <td class="release-date"><?php echo $row["releaseDate"]; ?></td>
                   <td class="description-filed"><?php echo $row["movieDescription"]; ?></td>
               </tr>
           <?php 
               $checkboxEnd++;

               }?> 
            </tbody>

        </table><br>
        <div class="error-holders" id="select-err-msg"></div>
    </div>
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