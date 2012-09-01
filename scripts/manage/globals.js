/*
Will hold the jQuery object of table that lists the books to be added.
*/
var booklistTable;
/*
The table body of booklistTable .
*/
var booklistTableBody;

/*
Will hold the jQuery object of the form elements of the add form...

...And their indices, a.k.a the order in which they appear in the form.
*/
var isbn;
var title;
var genre;
var authors;
var illustrators;
var editors;
var translators;
var publisher;
var printer;
var year;

/**
An array holding the details that appears in a book spine.
*/
var spine;

/**
A JSON object specifying whether a line break is rendered after a particular entry
in variable spine. The properties are the ids of the elements in spine.
*/
var breakAfter = {
	"title":true,
	"authors":true,
	"illustrators":true,
	"translators":true,
	"editors":true,
	"publisher":false,
	"printer":true,
	"year": false
}

/*
Flag to determine whether any record has been added to the
table already. The value is true if there are yet records
added to the table.
*/
var isTableFresh = true;
