$(document).ready(function(){ 


	$("#add-series-button").click(function() {
		var seriesTitle = $("#seriesTitle").val();
		var releaseDate = $("#releaseDate").val();
		var seriesDescription = $("#seriesDescription").val();

		//Inserts all the values into a form. 
		var form_data = new FormData();                  
		form_data.append("seriesTitle", seriesTitle);	
		form_data.append("releaseDate", releaseDate);
		form_data.append("seriesDescription", seriesDescription);

		//Makes a ajax call for the file "insertUser.php" and inserts the user.         
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
					alert("Done!");

				else
					alert("Fail!");
					alert(php_script_response);
		    }
		});
	});

});