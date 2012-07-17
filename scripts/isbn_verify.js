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

//TODO: Abstract ISBN verification.

/**
Verifies an ISBN10 string. Assume that the argument
is exactly 10 characters (including check char) and is
already stripped of dash and whitespace characters.

TODO: Document here how ISBN10 is checked.

@param isbn10
  ISBN10 string.
*/
function verifyISBN10(isbn10){
	var isbnLength = 10;
	
	if(isbn10.length != isbnLength){
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

/**
Verifies an ISBN13 string. Assume that the argument has already
been stripped clean of non-ISBN-related characters.
*/
function verifyISBN13(isbn13){
	var isbnLength = 13;
	
	if(isbn13.length != isbnLength){
		return false;
	}
	
	var checkDigit = parseInt(isbn13.charAt(isbnLength - 1));
	var limit = isbnLength - 1;
	var sumRunner = 0;
	
	for(var i = 0; i < limit; i++){
		var multiplier;
		
		if((i % 2) == 0){
			multiplier = 1;
		} else{
			multiplier = 3;
		}
		
		sumRunner += multiplier * parseInt(isbn13.charAt(i));
	}
	
	var checkDigitCalc = (10 - (sumRunner % 10)) % 10;
	
	return checkDigitCalc == checkDigit;
}
