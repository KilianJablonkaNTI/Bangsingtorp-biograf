$(document).ready(function(){ 

function sortTable() {
	var table, rows, switching, i, x, y, shouldSwitch;
	table = document.getElementById("seriesTable");
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
	
	//Gets the table with the registerd series from the database
	// and inserts it into a div on the site. 
	$.get("get-series.php", function(data, status) {
		$(".series-table").html(data); 
		sortTable();
	});
	
	//Unsets the delete message.
	$("#delete-series-button").focusout(function() {
		$("#delete-message").html("");
	});

	$("#add-series-button").click(function() {
		var seriesTitle = $("#seriesTitle").val();
		var releaseDate = $("#releaseDate").val();
		var seriesDescription = $("#seriesDescription").val();
		var seriesCover = $("#seriesCover").prop("files")[0];

		//Inserts all the values into a form. 
		var form_data = new FormData();                  
		form_data.append("seriesTitle", seriesTitle);	
		form_data.append("releaseDate", releaseDate);
		form_data.append("seriesDescription", seriesDescription);
		form_data.append("seriesCover", seriesCover);

		//Makes a ajax call for the file "addseries.php" and inserts the series.         
		$.ajax({
		    url: "add-series.php",  
		    dataType: "text",  
		    cache: false,
		    contentType: false,
		    processData: false,
		    data: form_data,                         
		    type: "post",
		    success: function(php_script_response){
				if(php_script_response == "Done")
				{	
					$("#success-message").text("The series has bin inserted successfully.");

					//Reseting all fields.
					$(".data-elements").val("");
					//Reseting all the error messages
					$(".error-holders").html("");

					//Gets the table with the registerd series from the database
					// and inserts it into a div on the site. 
					$.get("get-series.php", function(data, status) {
						$(".series-table").html(data); 

						//Call to a function that sorts the table with the series in it. 
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


	$("#delete-series-button").click(function() {
		var seriesToDel = ",";
		var searchChange = 0;
	    $('input.deleteCheckbox[type=checkbox]').each(function () {
	        if (this.checked)
	        {
	            seriesToDel = seriesToDel + $(this).val() + ",";
	            searchChange++;
	        }        
	    });

	    if(searchChange == 0)
	    	$("#delete-message").html("There are no series selected to delete.");

	    else{
			//Inserts all the values into a form. 
			var form_data = new FormData();               
			form_data.append("movieOrSeries", "series");   
			form_data.append("toDelete", seriesToDel);
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
						$("#delete-message").html("The selected objects have bin deleted.");

						$.get("get-series.php", function(data, status) {
							$(".series-table").html(data); 

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