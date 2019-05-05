$(document).ready(function(){ 
	
	//Gets the table with the registerd movies from the database
	// and inserts it into a div on the site. 
	$.get("get-movies.php", function(data, status) {
		$(".movie-table").html(data); 
		
		//Calls a function which sorts the tabel with the movies.
		sortTable();
	});
	
	//Unsets the delete message.
	$("#delete-movie-button").focusout(function() {
		$("#delete-suc-msg").html("");
		$("#delete-err-msg").html("");
	});

	//Unset the success message.
	$("#add-movie-button").focusout(function() {
		$("#add-suc-msg").html("");
	});


	$("#add-movie-button").click(function() {
		var movieTitle = $("#movieTitle").val();
		var releaseDate = $("#releaseDate").val();
		var movieDescription = $("#movieDescription").val();
		var movieCover = $("#movieCover").prop("files")[0];

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
					//A message that appears if the movie was added succesfully.
					$("#add-suc-msg").text("The movie has bin inserted successfully.");
					
					//Reseting all fields.
					$(".data-elements").val("");
					//Reseting all the error messages
					$(".error-holders").html("");

					//Gets the table with the registerd movies from the database
					// and inserts it into a div on the site. 
					$.get("get-movies.php", function(data, status) {
						$(".movie-table").html(data); 

						//Call to a function that sorts the table with the movies in it. 
						sortTable();
					});
				}
				else{
					//Getting the string with the error messages.
					var errorMessages = php_script_response;

					//Getting positions.
					var msgLength = errorMessages.length;
					var titleErr = errorMessages.search("tErr");
					var dateErr = errorMessages.search("rErr");
					var descritptionErr = errorMessages.search("dErr");
					var imgErr = errorMessages.search("iErr");

					//Getting the error messages. 
					var titleErrMsg = errorMessages.substring((titleErr + 5), (dateErr - 1));
					var dateErrMsg = errorMessages.substring((dateErr + 5), (descritptionErr - 1));
					var descriptionErrMsg = errorMessages.substring((descritptionErr 	 + 5), (imgErr -1));
					var imgErrMsg = errorMessages.substring((imgErr + 5), (msgLength));

					//Displaying the error messages.
					$("#title-Err").html(titleErrMsg);
					$("#date-Err").html(dateErrMsg);
					$("#description-Err").html(descriptionErrMsg);
					$("#image-Err").html(imgErrMsg);
				}
		    }
		});
	});


	$("#delete-movie-button").click(function() {
		var moviesToDel = ",";
		var searchChange = 0;
	    $('input.deleteCheckbox[type=checkbox]').each(function () {
	        if (this.checked)
	        {
	            moviesToDel = moviesToDel + $(this).val() + ",";
	            searchChange++;
	        }        
	    });

	    if(searchChange == 0)
	    	$("#delete-err-msg").html("There are no movies selected to delete.");

	    else{
			//Inserts all the values into a form. 
			var form_data = new FormData();          
			form_data.append("movieOrSeries", "movie");        
			form_data.append("toDelete", moviesToDel);
			form_data.append("amountToDel", searchChange);

			//Makes a ajax call for the file "insertUser.php" and inserts the user.         
			$.ajax({
			    url: "delete-movie-or-series.php",  
			    dataType: "text",  
			    cache: false,
			    contentType: false,
			    processData: false,
			    data: form_data,                         
			    type: "post",
			    success: function(php_script_response){
					if(php_script_response == "success")
					{
						$("#delete-suc-msg").html("The selected objects have bin deleted.");

						//Getting the updated table.
						$.get("get-movies.php", function(data, status) {
							$(".movie-table").html(data); 

							//Calling the functions the sorts the table.
							sortTable();
						});

					}
					else
						alert(php_script_response);
			    }
			});
		}
	});
});