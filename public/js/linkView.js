$(document).ready(function() {
	// prevent drowdown-menu from dissapearing when it is clicked 
	$('.dropdown-menu').click(function(e) {
    	e.stopPropagation();
	});
	// adding click event to addTagButton
	$("#addTagButton").click(function (e) {
		console.log("clicked");
		addTag();
	});
	// adding click event to the saveLinkButton
	$("#saveLinkButton").click(function(e) {
		saveLink();
	});
});

function addTag() {
	var tags = $("#tags").val();
	var newTag = $("#tagTextbox").val();
	console.log(newTag);
	if (newTag != "") {
		tags = tags + "," + newTag;
		var tagLabel = $("<label>").attr("class", "label label-info tagLabel").val(newTag);
		$("#labelDiv").append(tagLabel);
	}
	$("#tags").val(tags);
}

function saveLink() {
	var href = $("#addTextbox").val();
	var title = "testTitle";
	console.log(href);
	// adding title input to the form
	var titleInput = $("<input>")
               .attr("type", "hidden")
               .attr("name", "title").val(title);
	$('#saveLinkForm').append($(titleInput));
	// submit the form
	//$("#saveLinkForm").submit();
}