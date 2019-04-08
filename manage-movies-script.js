$(document).ready(function(){ 

function sortTable() {
	var table, rows, switching, i, x, y, shouldSwitch;
	table = document.getElementById("movieTable");
	switching = true;
	/*Make a loop that will continue until
	no switching has been done:*/
	while (switching) {
	//start by saying: no switching is done:
	switching = false;
	rows = table.rows;
	/*Loop through all table rows (except the
	first, which contains table headers):*/
	for (i = 1; i < (rows.length - 1); i++) {
	  //start by saying there should be no switching:
	  shouldSwitch = false;
	  /*Get the two elements you want to compare,
	  one from current row and one from the next:*/
	  x = rows[i].getElementsByClassName("sortByTitle")[0];
	  y = rows[i + 1].getElementsByClassName("sortByTitle")[0];
	  //check if the two rows should switch place:
	  if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
	    //if so, mark as a switch and break the loop:
	    shouldSwitch = true;
	    break;
	  }
	}
	if (shouldSwitch) {
	  /*If a switch has been marked, make the switch
	  and mark that a switch has been done:*/
	  rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
	  switching = true;
	}
  }
}
	
	//Gets the table with the registerd movies from the database
	// and inserts it into a div on the site. 
	$.get("get-movies.php", function(data, status) {
		$(".movie-table").html(data); 
		sortTable();
	});
	
	$("#add-movie-button").click(function() {
		var movieTitle = $("#movieTitle").val();
		var releaseDate = $("#releaseDate").val();
		var movieDescription = $("#movieDescription").val();
		var movieCover = $("#movieCover").prop("files")[0];

		alert(movieCover);

		//Inserts all the values into a form. 
		var form_data = new FormData();                  
		form_data.append("movieTitle", movieTitle);	
		form_data.append("releaseDate", releaseDate);
		form_data.append("movieDescription", movieDescription);
		form_data.append("movieCover", movieCover);

		//Makes a ajax call for the file "addmovie.php" and inserts the movie.         
		$.ajax({
		    url: "add-movie.php",  
		    dataType: "text",  
		    cache: false,
		    contentType: false,
		    processData: false,
		    data: form_data,                         
		    type: "post",
		    success: function(php_script_response){
				if(php_script_response == "Done")
				{
					alert("Done!");

					//Gets the table with the registerd movies from the database
					// and inserts it into a div on the site. 
					$.get("get-movies.php", function(data, status) {
						$(".movie-table").html(data); 
					});

					//Call to a function that sorts the table with the movies in it. 
					sortTable();
				}
				else
					alert(php_script_response);
		    }
		});
	});


	$("#deleteMoviesButton").click(function() {

		var amountOfMovies = $(".deleteCheckbox").length;
		var moviesToDel = ",";
		var searchChange = 0;
	    $('input.deleteCheckbox[type=checkbox]').each(function () {
	        if (this.checked)
	        {
	            moviesToDel = moviesToDel + $(this).val() + ",";
	            searchChange++;
	        }        
	    });

		//Inserts all the values into a form. 
		var form_data = new FormData();                  
		form_data.append("moviesToDel", moviesToDel);
		form_data.append("amountToDel", searchChange);

		//Makes a ajax call for the file "insertUser.php" and inserts the user.         
		$.ajax({
		    url: "delete-movies.php",  
		    dataType: "text",  
		    cache: false,
		    contentType: false,
		    processData: false,
		    data: form_data,                         
		    type: "post",
		    success: function(php_script_response){
				if(php_script_response == "OK")
				{
					alert("Done!");

					$.get("get-movies.php", function(data, status) {
						$(".movie-table").html(data); 
					});
					sortTable();
				}
				else
					alert(php_script_response);
		    }
		});
	});
});