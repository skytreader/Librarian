/**
Get the values in the textboxes and add them to the table.
*/
function addRecord(){
	if(window.isTableFresh){
		// "No records yet."
		var child = window.booklistTableBody.children[0];
		window.booklistTableBody.removeChild(child);
		window.isTableFresh = false;
	}
	var row = document.createElement("tr");
	$(row).addClass("booklist");
	var locISBN = window.isbn[0];
	var locGenre = window.genre[0];
	
	// Create the ISBN-Genre cell
	var cell = document.createElement("td");
	$(cell).addClass("booklist");
	cell.innerHTML += locISBN.value;
	cell.appendChild(createHiddenField(locISBN.id, locISBN.value));
	cell.appendChild(document.createElement("br"));
	cell.innerHTML += locGenre.value;
	cell.appendChild(createHiddenField(locGenre.id, locGenre.value));
	
	// Create the composite cell (a.k.a, the "spine")
	var compositeCell = document.createElement("td");
	$(compositeCell).addClass("booklist");
	compositeCell.innerHTML = renderSpine();
	
	// Add the hidden fields to the composite cell
	// At this point, window.spine is updated
	var limit = window.spine.length;
	
	for(var i = 0; i < limit; i++){
		compositeCell.appendChild(createHiddenField(window.spine[i][0].id, window.spine[i][0].value));
	}
	
	// Add the delete button
	var deleteButtonCell = document.createElement("td");
	$(deleteButtonCell).addClass("booklist");
	deleteButtonCell.appendChild(deleteButton());
	
	row.appendChild(cell);
	row.appendChild(compositeCell);
	row.appendChild(deleteButtonCell);
	window.booklistTableBody.appendChild(row);
}

/**
Renders the "spine" display of the book list. Takes data from global
variables directly.

@return The text formatted like a spine of a book.
*/
function renderSpine(){
	window.spine = [title, authors, illustrators, translators, editors, publisher, printer, year];
	var spineText = "";
	var limit = window.spine.length;
	
	for(var i = 0; i < limit; i++){
		var item = window.spine[i][0];
		var itemId = item.id;
		
		if(itemId != window.title[0].id && itemId != window.year[0].id && itemId != window.authors[0].id){
			var label = "<strong>";
			
			if(itemId == window.publisher[0].id || itemId == window.printer[0].id){
				label += itemId == window.publisher[0].id ? "Published by" : "Printed by";
			} else{
				label += itemId;
			}
			
			label += ":</strong> ";
			spineText += label;
		}
		
		spineText += item.value;
		spineText += window.breakAfter[itemId] ? "<br />" : "";
	}
	
	return spineText;
}

/**
Removes the row which holds the button which triggered
event e .

@param e
  The event object.
*/
function removeRow(e){
	//Get the button
	var button = e.target;
	//Get the cell
	var cell = button.parentNode;
	//Get the row
	var row = cell.parentNode;
	
	window.booklistTableBody.removeChild(row);
	
	// Check if table body became empty
	if(window.booklistTableBody.children.length == 0){
		var soleCell = document.createElement("td");
		soleCell.innerHTML = "No records yet.";
		window.booklistTableBody.appendChild(soleCell);
	}
}

/**
Generates the delete button to be added at the end
of every row record.
*/
function deleteButton(){
	var container = document.createElement("input");
	container.onclick = removeRow;
	container.type = "button";
	container.className = "btn infrequent";
	container.value = "X";
	
	return container;
}

/**
Creates a hidden input element with the given value.
*/
function createHiddenField(inputName, value){
	var inputObject = document.createElement("input");
	inputObject.type = "hidden";
	inputObject.name = inputName + "[]";
	inputObject.value = value;
	return inputObject;
}

/**
Clears the details form.
*/
function clear(){
	var fields = getDetailFormFields();
	var fieldLimit = fields.length;
	
	for(var i = 0; i < fieldLimit; i++){
		fields[i].value = "";
	}
}

/**
Returns all the form fields in the detailsForm as an array.
No order is guaranteed on the return array.
*/
function getDetailFormFields(){
	var fields = new Array();
	var blockDivs = $("#detailsForm").children(".block");
	var divLimit = blockDivs.length;
	
	for(var i = 0; i < divLimit; i++){
		var inputs = $(blockDivs[i]).children("input");
		var inputLimit = inputs.length;
		
		for(var j = 0; j < inputLimit; j++){
			fields.push(inputs[j]);
		}
	}
	
	return fields;
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
			isbn1:{
				isbn: true
			},
			year1:{
				year: true
			}
		}
	});
	
	$("[name='add']").click(function(){
		if($("#detailsForm").valid()){
			addRecord();
			clear();
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
