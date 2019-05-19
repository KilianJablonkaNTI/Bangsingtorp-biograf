$(document).ready(function() {

	//Sets the poll-title and hides the help-text link.
	if(votePoll == false){
		$("#poll-title").html("No movies this week");
		$("#vote-text").html("There is no vote poll.");
	}
	else{
		$("#poll-title").html("Vote poll of the week");
		$("#vote-text").html("Click on a movie to vote.");	
	}

	$(".movie-containers").click(function() {
		var id = $(this).attr("id");

		$.post("upload-vote.php", {movieTitle: id}, function(data) {
			$(".left-container").html(data);
		});
	});

});