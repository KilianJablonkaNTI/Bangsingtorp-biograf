$(document).ready(function() {
	
	//A function that checks if a vote poll has bin created.
	function doesPollExist()
	{	
		var doesPollExist = 0;

		for(i = 0; i < 4; i++)
		{
			if($("#movie-title"+i).text() != "" && $("#movie-title"+i).text() != "No movie selected")
			{
				doesPollExist++;

				//Checks all the check-boxes which the 
				//value of one of the movies of the week
				$(".selectCheckbox").each(function() {
				  if($(this).val() == $("#movie-title"+ i).text())
				  	$(this).prop("checked", true);
				});


			}	
		}

		if(doesPollExist == 4)
		{
			return true;		
		}
		else
			return false;
	}

	var existsPoll = doesPollExist();
	var edited = false;
	
	if(existsPoll == true)
	{
		//A variable that contains the amount of movies selected.
		var selectedAmount = 4;
		var edit = true;
		$("#creatPollButton").html("Update vote poll");
	}
	else
	{
		//A variable that contains the amount of movies selected.
		var selectedAmount = 0;
		var edit = false;
	}

	//If the admin selects a movie form the movie tabel the following code will be executed.
	$(".selectCheckbox").click(function() {
		//Gets the id of the check-box the admin clicked on.
		var id = $(this).attr("id");

		//Checks if the check-box already was checked, and if it was checked.
		if(!$("#"+id).is(":checked"))
		{	 
			//Gets the title of the movie which the admin unchecked.
			var movieTitle = $("#" + id).val();

			for(i = 0; i < 4; i++)
			{	
				//Checks if the title of the unchecked movie is the same as the  current element of
				// the loop and if it resets its value and the amount of selected movies drops by one.
				if(movieTitle == $("#movie-title" + i).text())
				{
					$("#movie-title" + i).text("No movie selected");	
					selectedAmount--;		
				}
			}
		}
		else
		{	
			//Checks if the amount of movies selected is less than 4.
			if(selectedAmount < 4)
			{	
				//Gets the title of the movie which the admin unchecked.
				var movieTitle = $("#" + id).val();

				//Checks if the element has the start value and if it 
				//changes it to the movie that the admin selected
				if($("#movie-title0").text() == "No movie selected")
				{
					$("#movie-title0").text(movieTitle);	
					selectedAmount++;	
				}
				//--||--
				else if($("#movie-title1").text() == "No movie selected")
				{
					$("#movie-title1").text(movieTitle);		
					selectedAmount++;
				}
				//--||--
				else if($("#movie-title2").text() == "No movie selected")
				{
					$("#movie-title2").text(movieTitle);		
					selectedAmount++;
				}
				//--||--
				else if($("#movie-title3").text() == "No movie selected")
				{
					$("#movie-title3").text(movieTitle);		
					selectedAmount++;
				}	
			}
			//If there are already 4 movies selected the following code will be executed. 
			else
			{		
				//Alerts a message.
				alert("There are already four movies selected.");
				//Unchecks the checkbox which the admin clicked on.
				$("#" + id).prop("checked", false);
			}
			
		}
	});


	$(".unset-button").click(function() {
		if(selectedAmount > 0){
			//Gets the id off the button which was clicked. 
			var id = $(this).attr("id");
			//Gets the end of the id.
			var idEnd = id.charAt(id.length-1);

			$(".selectCheckbox").each( function() {
			  if($(this).val()== $("#movie-title"+ idEnd).text())
			    this.checked = !this.checked;
			});

			//Set the value of the movie the admin wants to unset to the start value.
			$("#movie-title"+ idEnd).html("No movie selected");
			//Sets the cover image to the start one.
			$("#img-VMC" + idEnd).attr("src", "images/no-image-selected.jpg");

			existsPoll = false;
			selectedAmount--;
		}
	});


	//A function that makes the movie cover which the admin has selected 
	//appear above the file selector. 
    function readURL(input, id) {

        if (input.files && input.files[0]) {

            var reader = new FileReader();

            reader.onload = function (e) {
                $("#img-" + id).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    //Calls the function above if the admin selects a file to upload.  
    $(".img-upload").change(function(){
    	var id = $(this).attr("id");
        readURL(this, id);
    });



    $("#creatPollButton").click(function() {
    	if(selectedAmount == 4 && existsPoll == false)
    	{	
    		var form_data = new FormData();

    		//Inserts all the values into a form. 
    		/*
    		for(i = 0; i < 4; i++)
    		{
    			var coverFilePath = $("#VMC"+i).prop("files")[0];
    			alert(coverFilePath);
    			form_data.append("movieTitle"+i, $("#movie-title"+i).text());
    			form_data.append(coverFilePath);
    			alert($("#movie-title"+i).text());

    		} */

    		var cover0 = $("#VMC0").prop("files")[0];
    		var cover1 = $("#VMC1").prop("files")[0];
    		var cover2 = $("#VMC2").prop("files")[0];
    		var cover3 = $("#VMC3").prop("files")[0];

    		form_data.append("movieTitle0", $("#movie-title0").text());
    		form_data.append("movieTitle1", $("#movie-title1").text());
    		form_data.append("movieTitle2", $("#movie-title2").text());
    		form_data.append("movieTitle3", $("#movie-title3").text());

    		form_data.append("movieCover0", cover0);
    		form_data.append("movieCover1", cover1);
    		form_data.append("movieCover2", cover2);
    		form_data.append("movieCover3", cover3);

    		//Makes a ajax call for the file "insertUser.php" and inserts the user.         
    		$.ajax({
    		    url: "add-vote-poll.php",  
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
    				}
    				else
    					alert(php_script_response);
    		    }
    		});
  	  	}
  	  	else if(existsPoll == true){
  	  		alert("A poll already exists and you have not made any changes.");
  	  	}
  	  	else
  	  	{
  	  		alert("You have not selected four movies!");
  	  	} 
    });

    
    $("#deletePollButton").click(function() {
    	alert("Click");
    	if(existsPoll == true){
    		//Calls the php document which deletes the movies of the week.
    		$.get("delete-vote-poll.php", function(data) {
    			$(".content-container").html(data);
    		});
    		$("#selectCheckbox").prop("checked", false);
    		selectedAmount = 0;
    		existsPoll = false;


			alert(existsPoll);
			alert(selectedAmount);
    	}
    	else{
    		alert("There is no poll to delete.");
    	}
    });
	

});