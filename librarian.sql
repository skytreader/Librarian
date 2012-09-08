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
	year INTEGER NOT NULL,
	lastupdate TIMESTAMP NOT NULL,
	lastupdateby INTEGER NOT NULL,
	FOREIGN KEY (lastupdateby) REFERENCES librarians (librarianid)
) ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS bookcompanies(
	companyid INTEGER PRIMARY KEY AUTO_INCREMENT,
	companyname VARCHAR(255) UNIQUE NOT NULL,
	lastupdate TIMESTAMP NOT NULL,
	lastupdateby INTEGER NOT NULL,
	FOREIGN KEY (lastupdateby) REFERENCES librarians (librarianid)
) ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS imprints(
	mothercompany INTEGER,
	imprintcompany INTEGER,
	lastupdate TIMESTAMP NOT NULL,
	lastupdateby INTEGER NOT NULL,
	FOREIGN KEY (lastupdateby) REFERENCES librarians (librarianid),
	FOREIGN KEY (mothercompany) REFERENCES bookcompanies (companyid),
	FOREIGN KEY (imprintcompany) REFERENCES bookcompanies (companyid),
	PRIMARY KEY (mothercompany, imprintcompany)
) ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS leafmakers(
	isbn VARCHAR(13),
	companyid INTEGER,
	ispublisher BOOLEAN NOT NULL DEFAULT FALSE,
	isprinter BOOLEAN NOT NULL DEFAULT FALSE,
	lastupdate TIMESTAMP NOT NULL,
	lastupdateby INTEGER NOT NULL,
	FOREIGN KEY (lastupdateby) REFERENCES librarians (librarianid),
	FOREIGN KEY (isbn) REFERENCES books (isbn),
	FOREIGN KEY (companyid) REFERENCES bookcompanies (companyid),
	PRIMARY KEY (isbn, companyid)
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

CREATE TABLE IF NOT EXISTS roles(
	roleid INTEGER PRIMARY KEY AUTO_INCREMENT,
	rolename VARCHAR(255) UNIQUE NOT NULL,
	roledisplay VARCHAR(255) NOT NULL,
	lastupdate TIMESTAMP NOT NULL,
	lastupdateby INTEGER NOT NULL,
	FOREIGN KEY (lastupdateby) REFERENCES librarians (librarianid)
) ENGINE = INNODB;

CREATE TABLE IF NOT EXISTS bookparticipants(
	isbn VARCHAR(13),
	personid INTEGER,
	roleid INTEGER,
	lastupdate TIMESTAMP NOT NULL,
	lastupdateby INTEGER NOT NULL,
	FOREIGN KEY (lastupdateby) REFERENCES librarians (librarianid),
	FOREIGN KEY (isbn) REFERENCES books (isbn),
	FOREIGN KEY (personid) REFERENCES bookpersons (personid),
	FOREIGN KEY (roleid) REFERENCES roles (roleid),
	PRIMARY KEY (isbn, personid, roleid)
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
