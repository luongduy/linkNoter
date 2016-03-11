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
	$("#tagTextbox").val("");
}

function clearSaveLinkForm() {
	$("#addTextbox").val("");
	$("#tagTextbox").val("");
	$("#tags").val("");
	$("#labelDiv").empty();
}

function saveLink() {
	// submit the form
	var url = $("#addTextbox").val();
	if (validateURL(url)) {
		$("#saveLinkForm").submit();	
	} else {
		$("#addTextbox").focus();
		$("#addTextbox").notify("Invalid URL", {
				position: "top left",
				className: "error"
			});
		console.log("invalid url");
	}
	
}

function validateURL(textval) {
    var urlregex = /^(https?|ftp):\/\/([a-zA-Z0-9.-]+(:[a-zA-Z0-9.&%$-]+)*@)*((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9][0-9]?)(\.(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9]?[0-9])){3}|([a-zA-Z0-9-]+\.)*[a-zA-Z0-9-]+\.(com|edu|gov|int|mil|net|org|biz|arpa|info|name|pro|aero|coop|museum|[a-zA-Z]{2}))(:[0-9]+)*(\/($|[a-zA-Z0-9.,?'\\+&%$#=~_-]+))*$/;
    return urlregex.test(textval);
}
