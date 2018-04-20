#----	Création de la base de données Green'Tech -----

DROP DATABASE IF EXISTS greentech;

CREATE DATABASE greentech;

USE greentech;
#----- Création des tables -----

DROP TABLE IF EXISTS company;

CREATE TABLE company(
	IdCompany int,
	SIREN VARCHAR(20) NOT NULL,
	RaisonSocial VARCHAR(20),
	Tel VARCHAR(10),
	Mail VARCHAR(50),
	web VARCHAR(50),
	Description VARCHAR(255),
	Latitude DECIMAL(9,6),
	Longitude DECIMAL(9,6),
	Address VARCHAR(255),
	Constraint PK_Company PRIMARY KEY(IdCompany)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS categorie;

CREATE TABLE categorie(
	IdCatego int,
	Title VARCHAR(100),
	Description VARCHAR(255),
	Constraint PK_Catego PRIMARY KEY(IdCatego)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS commentaire;

CREATE TABLE commentaire(
	IdComm int,
	Note int,
	Commentaires VARCHAR(255),
	Constraint PK_Comm PRIMARY KEY(IdComm)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS company_catego;

CREATE TABLE company_catego(
  Catego int,
  Company int,
  CONSTRAINT FK_catego FOREIGN KEY (Catego) REFERENCES categorie(IdCatego),
  CONSTRAINT FK_company FOREIGN KEY (Company) REFERENCES company(IdCompany)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS company_commentaire;

CREATE TABLE company_commentaire(
  Comment int,
  CompanyId int,
  CONSTRAINT FK_comm FOREIGN KEY (Comment) REFERENCES commentaire(IdComm),
  CONSTRAINT FK_companyCom FOREIGN KEY (CompanyId) REFERENCES company(IdCompany)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `company` (`IdCompany`, `SIREN`, `RaisonSocial`, `Tel`, `Mail`, `web`, `Description`, `Latitude`, `Longitude`, `Address`) VALUES
(1, '5834846541', 'La Plume du Phoenix', '0613449556', 'mickael.carpene@gmail.com', 'www.laplumeduphoenix.com', 'Création de Sites Web', '50.373893', '3.554130', '68 rue Paul Vaillant Couturier, 59880 Saint-Saulve');

INSERT INTO `company` (`IdCompany`, `SIREN`, `RaisonSocial`, `Tel`, `Mail`, `web`, `Description`, `Latitude`, `Longitude`, `Address`) VALUES
(2, '123456789', 'Aux halles fruitiers', '0614586541', 'mickael.carpene@gmail.com', 'www.hallesfruitiers.com', 'Primeur proposant des fruits et légumes de saisons locaux!!', '50.3729715', '3.555430', '54 Rue Paul Vaillant Couturier, 59880 Saint-Saulve');

INSERT  INTO `company` (`IdCompany`, `SIREN`, `RaisonSocial`, `Tel`, `Mail`, `web`, `Description`, `Latitude`, `Longitude`, `Address`) VALUES
(3, '865 164 889','Arras Fruits', '0345894510', 'mickael.carpene@gmail.com', 'www.kiouiarras.com', 'Primeur proposant des fruits et légumes de saisons locaux!!', '50.2846207', '2.7736121', '18 Rue d Achicourt, 62000 Arras');
