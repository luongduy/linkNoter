$(document).ready(function() {
	// prevent drowdown-menu from dissapearing when it is clicked 
	$('.dropdown-menu').click(function(e) {
    	e.stopPropagation();
	});
	// reset saveLinkFrom
	$(".dropdown-toggle").click(function(e){
        clearSaveLinkForm();
    });
	// adding click event to addTagButton
	$("#addTagButton").click(function (e) {
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
	if (newTag != "") {
		tags = tags + newTag + ",";
		var tagLabel = $("<label> </label>").attr("class", "label label-info tagLabel").text(newTag);
		$("#labelDiv").append(tagLabel);
	}
	$("#tags").val(tags);
}

function clearSaveLinkForm() {
	$("#addTextbox").val("");
	$("#tagTextbox").val("");
	$("#tags").val("");
	$("#labelDiv").empty();
}

function saveLink() {
	// submit the form
	$("#saveLinkForm").submit();
}

