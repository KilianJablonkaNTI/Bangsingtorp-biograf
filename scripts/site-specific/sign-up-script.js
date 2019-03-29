$(document).ready(function(){


	$("#register-button").click(function() {
		var username = $("#username-field").val();
		var email = $("#email-field").val();
		var password = $("#password-field").val();

		alert(username);
		alert(email);
		alert(password);
		//Inserts all the values into a form. 
		var form_data = new FormData();                  
		form_data.append("username", username);	
		form_data.append("email", email);
		form_data.append("password", password);

		//Makes a ajax call for the file "insertUser.php" and inserts the user.         
		$.ajax({
		    url: "register-user.php",  
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