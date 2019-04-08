$(document).ready(function() {

	$(".movie-containers").click(function() {
		var id = $(this).attr("id");

		alert(id);
		$("#" + id + "-voted").attr("src", "images/icons/baseline-check-24px.svg");

		$.post("upload-vote.php", {movieTitle: id}, function(data) {
			alert(data);
		});
	});

});