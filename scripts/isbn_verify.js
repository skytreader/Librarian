/**
Functions to verify correctness of ISBN codes.

See http://en.wikipedia.org/wiki/International_Standard_Book_Number#Check_digits
for more details on how to verify ISBN codes.

All inputs assume that it has been stripped of any extraneous
characters like dashes or whitespace.
*/

/**
Strips the input string of dashes and/or whitespace.
*/
function stripExtraneous(isbnInput){
	return isbnInput.replace(/[\s-]/g, "")
}

/**
Verifies an ISBN10 string. Assume that the argument
is exactly 10 characters (including check char) and is
already stripped of dash and whitespace characters.

TODO: Document here how ISBN10 is checked.

@param isbn10
  ISBN10 string.
*/
function verifyISBN10(isbn10){
	var isbnLength = 10 //TODO: Must enforce this!
	
	if(isbn10.length > isbnLength){
		return false;
	}
	
	var checkChar = isbn10.charAt(isbnLength - 1)
	var checkDigit = checkChar == 'X' ? 10 : parseInt(checkChar)
	var runningSum = 0
	
	for(var weight = 10; weight >= 2; weight--){
		runningSum += parseInt(isbn10.charAt(10 - weight)) * weight
	}
	
	return ((runningSum % 11) + checkDigit) == 11
}
