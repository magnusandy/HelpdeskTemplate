CREATE DATABASE helpdesk;

USE helpdesk;

--admin login password, might try hashing it if i get some time
CREATE TABLE password (
	password varchar(100) NOT NULL,
	PRIMARY KEY (password)
);

--all the information for tickets
CREATE TABLE tickets (
	id SERIAL NOT NULL,
	dateCreated DATETIME NOT NULL,
	dateUpdated DATETIME NOT NULL,
	requestor varchar(50) NOT NULL,
	requestType varchar(100) NOT NULL,
	deviceType varchar(100),
	description TEXT NOT NULL,
	priority varchar(10) NOT NULL,
	contactInfo varchar(100) NOT NULL,
	status varchar(50) NOT NULL,
	PRIMARY KEY (id)
);

--stores the email where you can be notified never got to this
CREATE TABLE email (
	email varchar(50) NOT NULL,
	PRIMARY KEY (email)
);

INSERT INTO PASSWORD (password)
 VALUES ("5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8"); --SHA256 Hash for "password"