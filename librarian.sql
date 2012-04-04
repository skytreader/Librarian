CREATE TABLE IF NOT EXISTS books(
	isbn VARCHAR(13) PRIMARY KEY,
	title VARCHAR(255) NOT NULL,
	year INTEGER NOT NULL
) ENGINE = MYISAM;

CREATE TABLE IF NOT EXISTS publishers(
	publisherid INTEGER PRIMARY KEY AUTO_INCREMENT,
	publishername VARCHAR(255) NOT NULL
) ENGINE = MYISAM;

CREATE TABLE IF NOT EXISTS published(
	isbn VARCHAR(13),
	publisherid INTEGER,
	FOREIGN KEY (isbn) REFERENCES books,
	FOREIGN KEY (publisherid) REFERENCES publishers,
	PRIMARY KEY (isbn, publisherid)
) ENGINE = MYISAM;

CREATE TABLE IF NOT EXISTS printers(
	printerid INTEGER PRIMARY KEY AUTO_INCREMENT,
	printername VARCHAR(255) NOT NULL
) ENGINE = MYISAM;

CREATE TABLE IF NOT EXISTS printed(
	isbn VARCHAR(13),
	printerid INTEGER,
	FOREIGN KEY (isbn) REFERENCES books,
	FOREIGN KEY (printerid) REFERENCES printers,
	PRIMARY KEY (isbn, printerid)
) ENGINE = MYISAM;

CREATE TABLE IF NOT EXISTS bookpersons(
	personid INTEGER PRIMARY KEY AUTO_INCREMENT,
	lastname VARCHAR(255) NOT NULL,
	firstname VARCHAR(255) NOT NULL
) ENGINE = MYISAM;

CREATE TABLE IF NOT EXISTS authored(
	isbn VARCHAR(13),
	personid INTEGER,
	FOREIGN KEY (isbn) REFERENCES books,
	FOREIGN KEY (personid) REFERENCES bookpersons,
	PRIMARY KEY (isbn, personid)
) ENGINE = MYISAM;

CREATE TABLE IF NOT EXISTS edited(
	isbn VARCHAR(13),
	personid INTEGER,
	FOREIGN KEY (isbn) REFERENCES books,
	FOREIGN KEY (personid) REFERENCES bookpersons,
	PRIMARY KEY (isbn, personid)
) ENGINE = MYISAM;

CREATE TABLE IF NOT EXISTS translated(
	isbn VARCHAR(13),
	personid INTEGER,
	FOREIGN KEY (isbn) REFERENCES books,
	FOREIGN KEY (personid) REFERENCES bookpersons,
	PRIMARY KEY (isbn, personid)
) ENGINE = MYISAM;

CREATE TABLE IF NOT EXISTS illustrated(
	isbn VARCHAR(13),
	personid INTEGER,
	FOREIGN KEY (isbn) REFERENCES books,
	FOREIGN KEY (personid) REFERENCES bookpersons,
	PRIMARY KEY (isbn, personid)
) ENGINE = MYISAM;

CREATE TABLE IF NOT EXISTS pseudonyms(
	personid INTEGER,
	isbn VARCHAR(13),
	pseudolast VARCHAR(255) NOT NULL,
	pseudofirst VARCHAR(255) NOT NULL,
	FOREIGN KEY (personid) REFERENCES bookpersons,
	FOREIGN KEY (isbn) REFERENCES books,
	PRIMARY KEY (personid, isbn)
) ENGINE = MYISAM;

CREATE TABLE IF NOT EXISTS genres(
	genreid INTEGER PRIMARY KEY AUTO_INCREMENT,
	genrename VARCHAR(20)
) ENGINE = MYISAM;

CREATE TABLE IF NOT EXISTS bookgenres(
	genreid INTEGER,
	isbn VARCHAR(13),
	FOREIGN KEY (genreid) REFERENCES genres,
	FOREIGN KEY (isbn) REFERENCES books,
	PRIMARY KEY (genreid, isbn)
) ENGINE = MYISAM;

CREATE TABLE IF NOT EXISTS librarians(
	librarianid INTEGER AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(50) UNIQUE NOT NULL,
	password VARCHAR(255) NOT NULL
) ENGINE = MYISAM;
