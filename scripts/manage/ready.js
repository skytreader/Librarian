/**
Get the values in the textboxes and add them to the table.
*/
function addRecord(){
	if(window.isTableFresh){
		// "No records yet."
		var child = window.booklistTableBody.children[1];
		window.booklistTableBody.removeChild(child);
		window.isTableFresh = false;
	}
	var row = document.createElement("tr");
	
	var bookDetails = document.addbook.getElementsByTagName("input");
	var limit = bookDetails.length - 1;
	
	for(var i = 0; i < limit; i++){
		var cell = document.createElement("td");
		cell.innerHTML = bookDetails[i].value;
		cell.appendChild(createHiddenField(bookDetails[i].id, bookDetails[i].value));
		row.appendChild(cell);
		bookDetails[i].value = "";
	}
	
	window.booklistTableBody.appendChild(row);
}

/**
Creates a hidden input element with the given value.
*/
function createHiddenField(inputName, value){
	var inputObject = document.createElement("input");
	inputObject.type = "hidden";
	inputObject.name = inputName;
	inputObject.value = value;
	return inputObject;
}

$.validator.addMethod("isbn", function(value, element, param){
	var stripped = stripExtraneous(value);
	return verifyISBN10(stripped) || verifyISBN13(stripped);
}, "Invalid ISBN input.");

/*
Just check if it is a 4-digit number.
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
		if($("#detailsForm").valid()){
			addRecord();
		}
	});
	
	window.booklistTable = $("#booklist", document.bookqueue);
	window.booklistTableBody = window.booklistTable[0].children[0];
	
	window.isbn = $("#isbn", document.addbook);
	window.title = $("#title", document.addbook);
	window.genre = $("#genre", document.addbook);
	window.authors = $("#authors", document.addbook);
	window.illustrators = $("#illustrators", document.addbook);
	window.editors = $("#editors", document.addbook);
	window.translators = $("#translators", document.addbook);
	window.publisher = $("#publisher", document.addbook);
	window.printer = $("#printer", document.addbook);
	window.year = $("#year", document.addbook);
})
