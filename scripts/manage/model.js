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

The global variables are expected to have the following attributes:
  spineDisplay
    A function returning a string. This string will be the one displayed
    on the "spine". Include line breaks (as <br> tags).

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
			return "<em>" + by + " by:</em> " + lineVal;
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
	
	window.isbn = $("#isbn", document.addbook);
	
	window.title = $("#title", document.addbook);
	window.title.spineDisplay = function(){return window.title[0].value + "<br />";};
	
	window.genre = $("#genre", document.addbook);
	
	window.authors = $("#authors", document.addbook);
	// TODO Too many authors collapses to et. al.
	window.authors.spineDisplay = function(){
		var authorsVal = window.authors[0].value;
		
		if(authorsVal == ""){
			return "";
		} else{
			return authorsVal + "<br />";
		}
	};
	
	window.illustrators = $("#illustrators", document.addbook);
	window.illustrators.spineDisplay = getLabeledByLine("Illustrated",
	  window.illustrators[0].value);
	
	window.editors = $("#editors", document.addbook);
	window.editors.spineDisplay = getLabeledByLine("Edited", window.editors[0].value);
	
	window.translators = $("#translators", document.addbook);
	window.translators.spineDisplay = getLabeledByLine("Translated",
	  window.translators[0].value);
	
	window.publisher = $("#publisher", document.addbook);
	window.publisher.spineDisplay = function(){
		var publisherVal = window.publisher[0].value;
		return "Publisher: " + publisherVal + "<br />";
	}
	
	window.printer = $("#printer", document.addbook);
	window.printer.spineDisplay = function(){
		var printerVal = window.printer[0].value;
		return "Printer: " + printerVal + "<br />";
	}
	
	window.year = $("#year", document.addbook);
})
