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
	var locISBN = window.bookDetailsForm.isbn[0];
	var locGenre = window.bookDetailsForm.genre[0];
	
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

The global variables are expected to have the following attributes:
  spineDisplay
    A function returning a string. This string will be the one displayed
    on the "spine". Include line breaks (as <br> tags).

@return The text formatted like a spine of a book.
*/
function renderSpine(){
	window.spine = ["title", "authors", "illustrators", "translators", "editors", "publisher", "printer", "year"];
	var spineText = "";
	var limit = window.spine.length;
	
	for(var i = 0; i < limit; i++){
		spineText += window.bookDetailsForm[spine[i]].spineDisplay();
	}
	
	return spineText;
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
Returns a function that returns a by line, labeled with
argument _by_. The names displayed with the by line is
specified through argument _lineVal_.

@param by
@param lineVal
*/
function getLabeledByLine(by, lineVal){
	return function(){
		if(lineVal == ""){
			return "";
		} else{
			return "<strong>" + by + " by:</strong> " + lineVal;
		}
	}
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
	
	window.bookDetailsForm.isbn = $("#isbn", document.addbook);
	
	window.bookDetailsForm.title = $("#title", document.addbook);
	window.bookDetailsForm.title.spineDisplay = function(){return window.bookDetailsForm.title[0].value + "<br />";};
	
	window.bookDetailsForm.genre = $("#genre", document.addbook);
	
	window.bookDetailsForm.authors = $("#authors", document.addbook);
	// TODO Too many authors collapses to et. al.
	window.bookDetailsForm.authors.spineDisplay = function(){
		var authorsVal = window.bookDetailsForm.authors[0].value;
		
		if(authorsVal == ""){
			return "";
		} else{
			return authorsVal + "<br />";
		}
	};
	
	window.bookDetailsForm.illustrators = $("#illustrators", document.addbook);
	window.bookDetailsForm.illustrators.spineDisplay = getLabeledByLine("Illustrated",
	  window.bookDetailsForm.illustrators[0].value);
	
	window.bookDetailsForm.editors = $("#editors", document.addbook);
	window.bookDetailsForm.editors.spineDisplay = getLabeledByLine("Edited", window.bookDetailsForm.editors[0].value);
	
	window.bookDetailsForm.translators = $("#translators", document.addbook);
	window.bookDetailsForm.translators.spineDisplay = getLabeledByLine("Translated",
	  window.bookDetailsForm.translators[0].value);
	
	window.bookDetailsForm.publisher = $("#publisher", document.addbook);
	window.bookDetailsForm.publisher.spineDisplay = function(){
		var publisherVal = window.bookDetailsForm.publisher[0].value;
		return "<strong>Publisher:</strong> " + publisherVal + "<br />";
	}
	
	window.bookDetailsForm.printer = $("#printer", document.addbook);
	window.bookDetailsForm.printer.spineDisplay = function(){
		var printerVal = window.bookDetailsForm.printer[0].value;
		return "<strong>Printer:</strong> " + printerVal + "<br />";
	}
	
	window.bookDetailsForm.year = $("#year", document.addbook);
	window.bookDetailsForm.year.spineDisplay = function(){
		return window.bookDetailsForm.year[0].value;
	}
})
