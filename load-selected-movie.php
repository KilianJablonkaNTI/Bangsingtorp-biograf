<?php

include_once "conn.php";

$movieToLoad = $_POST["movieToLoad"];

$sql = "SELECT movieTitle, releaseDate, movieDescription, coverFilePath FROM movies WHERE $movieToLoad"; 
$result = $pdo->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Movie Title: " . $row["movieTitle"]. " - Release date: " . $row["releaseDate"]. " - Movie Description:" . $row["movieDescription"]. "Cover File Path:" .$row["coverFilePath"]. "<br>";
    }
} else {
    echo "0 results";
}

/*

Fel på $movieToLoad och SELECT delen. 

$movieToLoad får inget värde.

*/