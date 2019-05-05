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

                if($row["movieTitle"] != "No movie selected"){
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

if($movie0 != "NULL" && $movie1 != "NULL" && $movie2 != "NULL" && $movie3 != "NULL"){
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
            ?>
            <h1>Votes</h1>  

            <table class="votes-table" id="table-to-sort">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Votes</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $movie0;?></td>
                        <td><?php echo $movie0Votes; ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $movie1;?></td>
                        <td><?php echo $movie1Votes; ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $movie2;?></td>
                        <td><?php echo $movie2Votes; ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $movie3;?></td>
                        <td><?php echo $movie3Votes; ?></td>
                    </tr>
                </tbody>
                
            </table>
    <?php  } else{
            echo "No records matching your query were found.";
        }
    } catch(PDOException $e){
        die("ERROR: Could not able to execute $sql. " . $e->getMessage());
    }

    unset($pdo);
}
else{
    echo "<h1>No votes</h1>";
    echo "<p>There are no votes because there is no vote poll...</p>";
}
