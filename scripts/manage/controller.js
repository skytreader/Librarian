/**
Functions in controller.js deal with the elements in the page. Other scripts will rely
on the functions in controler.js . If the view ever changes, you should only rework
the functions in ui.js for everything to work again.

(In other words, functions in this file directly "control" the elements in the page
where this script appears.)
*/

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
