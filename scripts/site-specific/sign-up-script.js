$(document).ready(function(){

	$("#close-suc-msg").hide();

	$("#close-suc-msg").click(function() {
		$("#register-success").html("");
		$("#close-suc-msg").hide();		
	});

	$("#register-button").click(function() {
		var username = $("#username-field").val();
		var email = $("#email-field").val();
		var password = $("#password-field").val();
		var cpassword = $("#confirm-password-field").val();

		//Inserts all the values into a form. 
		var form_data = new FormData();                  
		form_data.append("username", username);	
		form_data.append("email", email);
		form_data.append("password", password);
		form_data.append("cpassword", cpassword);

		//Makes a ajax call for the file "register-user.php" and inserts the user.         
		$.ajax({
		    url: "register-user.php",  
		    dataType: "text",  
		    cache: false,
		    contentType: false,
		    processData: false,
		    data: form_data,                         
		    type: "post",
		    success: function(php_script_response){
				if(php_script_response == "Done") {
					$(".error-holders").html("");

					$("#register-success").html("Account successfully register.");
					$("#close-suc-msg").show();
				}
				else{
					//Getting the string with the error messages.
					var errorMessages = php_script_response;
					
					//Getting postistions.
					var msgLength = errorMessages.length;
					var emailErr = errorMessages.search("eErr");
					var nameErr = errorMessages.search("nErr");
					var passErr = errorMessages.search("pErr");
					var cpassErr = errorMessages.search("cErr");

					//Getting the error messages.
					var emailErrMsg = errorMessages.substring((emailErr + 5), (nameErr - 1));
					var nameErrMsg = errorMessages.substring((nameErr + 5), (passErr - 1));
					var passErrMsg = errorMessages.substring((passErr + 5), (cpassErr -1));
					var cpassErrMsg = errorMessages.substring((cpassErr + 5), (msgLength));

					//Dispalying the error messages.
					$("#username-Err").html(nameErrMsg);
					$("#email-Err").html(emailErrMsg);
					$("#password-Err").html(passErrMsg);
					$("#cpassword-Err").html(cpassErrMsg);
				}
					
		    }
		});
	});

});