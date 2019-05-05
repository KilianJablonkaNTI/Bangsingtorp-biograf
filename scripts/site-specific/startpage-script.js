$(document).ready(function(){

	//Sets the poll-title and hides the help-text link.
	if(votePoll == false){
		$("#poll-title").html("No movies this week");
		$("#vote-text").html("There is no vote poll.");
		$("#to-vote-btn").hide();
	}
});