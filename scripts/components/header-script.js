$(document).ready(function(){ 

	if(signedInAs == "not-in")
	{
		$(".start-header").show();
		$(".user-header").hide();
		$(".admin-header").hide();
	}

	else if(signedInAs == "user")
	{
		$(".start-header").hide();
		$(".user-header").show();
		$(".admin-header").hide();
	}

	else if(signedInAs == "admin")
	{
		$(".start-header").hide();
		$(".user-header").hide();
		$(".admin-header").show();
	}

});