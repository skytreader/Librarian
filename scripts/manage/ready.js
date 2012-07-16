$.validator.addMethod("isbn", function(value, element, param){
	return verifyISBN10(stripExtraneous(value));
}, "Invalid ISBN input.");

/*
Just check if it is 
*/
$.validator.addMethod("year", function(value, element, param){
	return /^\d{4}$/.test(value);
}, "Please enter a valid year.");

$(document).ready(function(){
	$("#detailsForm").validate({
		rules:{
			isbn:{
				isbn: true
			},
			year:{
				year: true
			}
		}
	});
	
	$("[name='add']").click(function(){
		$("#detailsForm").valid();
	});
	
})
