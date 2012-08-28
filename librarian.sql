CREATE TABLE IF NOT EXISTS librarians(
	librarianid INTEGER AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(50) UNIQUE NOT NULL,
	password VARCHAR(255) NOT NULL,
	canread BOOLEAN NOT NULL,
	canwrite BOOLEAN NOT NULL,
	canexec BOOLEAN NOT NULL,
	lastupdate TIMESTAMP NOT NULL,
	lastupdateby INTEGER NOT NULL
) ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS books(
	isbn VARCHAR(13) PRIMARY KEY,
	title VARCHAR(255) NOT NULL,
	lastupdate TIMESTAMP NOT NULL,
	lastupdateby INTEGER NOT NULL,
	FOREIGN KEY (lastupdateby) REFERENCES librarians (librarianid)
) ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS publishers(
	publisherid INTEGER PRIMARY KEY AUTO_INCREMENT,
	publishername VARCHAR(255) UNIQUE NOT NULL,
	lastupdate TIMESTAMP NOT NULL,
	lastupdateby INTEGER NOT NULL,
	FOREIGN KEY (lastupdateby) REFERENCES librarians (librarianid)
) ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS published(
	isbn VARCHAR(13) NOT NULL,
	publisherid INTEGER NOT NULL,
	year INTEGER NOT NULL,
	lastupdate TIMESTAMP NOT NULL,
	lastupdateby INTEGER NOT NULL,
	FOREIGN KEY (lastupdateby) REFERENCES librarians (librarianid),
	FOREIGN KEY (isbn) REFERENCES books (isbn),
	FOREIGN KEY (publisherid) REFERENCES publishers (publisherid),
	PRIMARY KEY (isbn, publisherid)
) ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS printers(
	printerid INTEGER PRIMARY KEY AUTO_INCREMENT,
	printername VARCHAR(255) UNIQUE NOT NULL,
	lastupdate TIMESTAMP NOT NULL,
	lastupdateby INTEGER NOT NULL,
	FOREIGN KEY (lastupdateby) REFERENCES librarians (librarianid)
) ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS printed(
	isbn VARCHAR(13),
	printerid INTEGER,
	lastupdate TIMESTAMP NOT NULL,
	lastupdateby INTEGER NOT NULL,
	FOREIGN KEY (lastupdateby) REFERENCES librarians (librarianid),
	FOREIGN KEY (isbn) REFERENCES books (isbn),
	FOREIGN KEY (printerid) REFERENCES printers (printerid),
	PRIMARY KEY (isbn, printerid)
) ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS bookpersons(
	personid INTEGER PRIMARY KEY AUTO_INCREMENT,
	lastname VARCHAR(255) NOT NULL,
	firstname VARCHAR(255) NOT NULL,
	lastupdate TIMESTAMP NOT NULL,
	lastupdateby INTEGER NOT NULL,
	FOREIGN KEY (lastupdateby) REFERENCES librarians (librarianid),
	CONSTRAINT uniqueNames UNIQUE (lastname, firstname)
) ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS authored(
	isbn VARCHAR(13),
	personid INTEGER,
	lastupdate TIMESTAMP NOT NULL,
	lastupdateby INTEGER NOT NULL,
	FOREIGN KEY (lastupdateby) REFERENCES librarians (librarianid),
	FOREIGN KEY (isbn) REFERENCES books (isbn),
	FOREIGN KEY (personid) REFERENCES bookpersons (personid),
	PRIMARY KEY (isbn, personid)
) ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS edited(
	isbn VARCHAR(13),
	personid INTEGER,
	lastupdate TIMESTAMP NOT NULL,
	lastupdateby INTEGER NOT NULL,
	FOREIGN KEY (lastupdateby) REFERENCES librarians (librarianid),
	FOREIGN KEY (isbn) REFERENCES books (isbn),
	FOREIGN KEY (personid) REFERENCES bookpersons (personid),
	PRIMARY KEY (isbn, personid)
) ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS translated(
	isbn VARCHAR(13),
	personid INTEGER,
	lastupdate TIMESTAMP NOT NULL,
	lastupdateby INTEGER NOT NULL,
	FOREIGN KEY (lastupdateby) REFERENCES librarians (librarianid),
	FOREIGN KEY (isbn) REFERENCES books (isbn),
	FOREIGN KEY (personid) REFERENCES bookpersons (personid),
	PRIMARY KEY (isbn, personid)
) ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS illustrated(
	isbn VARCHAR(13),
	personid INTEGER,
	lastupdate TIMESTAMP NOT NULL,
	lastupdateby INTEGER NOT NULL,
	FOREIGN KEY (lastupdateby) REFERENCES librarians (librarianid),
	FOREIGN KEY (isbn) REFERENCES books (isbn),
	FOREIGN KEY (personid) REFERENCES bookpersons (personid),
	PRIMARY KEY (isbn, personid)
) ENGINE = INNODB;

/**
Is this table ever going into any use?
*/
CREATE TABLE IF NOT EXISTS pseudonyms(
	personid INTEGER,
	isbn VARCHAR(13),
	pseudolast VARCHAR(255) NOT NULL,
	pseudofirst VARCHAR(255) NOT NULL,
	lastupdate TIMESTAMP NOT NULL,
	lastupdateby INTEGER NOT NULL,
	FOREIGN KEY (lastupdateby) REFERENCES librarians (librarianid),
	FOREIGN KEY (personid) REFERENCES bookpersons (personid),
	FOREIGN KEY (isbn) REFERENCES books (isbn),
	PRIMARY KEY (personid, isbn)
) ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS genres(
	genreid INTEGER PRIMARY KEY AUTO_INCREMENT,
	genrename VARCHAR(20),
	lastupdate TIMESTAMP NOT NULL,
	lastupdateby INTEGER NOT NULL,
	FOREIGN KEY (lastupdateby) REFERENCES librarians (librarianid)
) ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS bookgenres(
	genreid INTEGER,
	isbn VARCHAR(13),
	lastupdate TIMESTAMP NOT NULL,
	lastupdateby INTEGER NOT NULL,
	FOREIGN KEY (lastupdateby) REFERENCES librarians (librarianid),
	FOREIGN KEY (genreid) REFERENCES genres (genreid),
	FOREIGN KEY (isbn) REFERENCES books (isbn),
	PRIMARY KEY (genreid, isbn)
) ENGINE = INNODB;

/**
This will act like a hash map of setting values.
*/
CREATE TABLE IF NOT EXISTS appsettings(
	settingcode VARCHAR(50) PRIMARY KEY,
	classes VARCHAR(255),
	settingstring VARCHAR(100) NOT NULL,
	description VARCHAR(255),
	settingvalue VARCHAR(255),
	lastupdate TIMESTAMP NOT NULL,
	lastupdateby INTEGER NOT NULL,
	FOREIGN KEY (lastupdateby) REFERENCES librarians (librarianid)
) ENGINE = INNODB;
