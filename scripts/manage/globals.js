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

/*
^Put them in an array!
*/
//var bookDetails = [isbn, title, genre, authors, illustrators, editors, translators, publisher, printer, year];

/*
Flag to determine whether any record has been added to the
table already. The value is true if there are yet records
added to the table.
*/
var isTableFresh = true;
