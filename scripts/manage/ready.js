$(document).ready(function(){
	$("#detailsForm").validate();
	$("[name='add']").click(function(){
		console.log("click");
		$("#detailsForm").valid();
	});
})
