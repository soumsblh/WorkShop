#----	Création de la base de données Green'Tech -----

DROP DATABASE IF EXISTS greentech;

CREATE DATABASE greentech;

USE greentech;
#----- Création des tables -----

DROP TABLE IF EXISTS users;


CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `siren` varchar(255) NOT NULL,
  `RaisonSocial` VARCHAR(20),
  `username` varchar(100) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Latitude` DECIMAL(9,6),
  `Longitude` DECIMAL(9,6),
  `Tel` VARCHAR(10),
  `role` varchar(150) NOT NULL,
  `web` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token_forget` varchar(250) NOT NULL,
  `date_forget` datetime NOT NULL,
  `image` varchar(255) NOT NULL,
  `comments` varchar(255) NOT NULL,
	Constraint PK_Company PRIMARY KEY(id)
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
	Constraint PK_Comm PRIMARY KEY(IdComm),
	CONSTRAINT FK_users FOREIGN KEY (IdComm) REFERENCES users(comments)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS company_catego;

CREATE TABLE company_catego(
  Catego int,
  users int,
  CONSTRAINT FK_catego FOREIGN KEY (Catego) REFERENCES categorie(IdCatego),
  CONSTRAINT FK_users FOREIGN KEY (users) REFERENCES users(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;



INSERT INTO `users` (`id`, `SIREN`, `RaisonSocial`, `username`, `adresse`,`Description`, `Latitude`, `Longitude`,`Tel`, `role`, `web`, `email`,`password`,`token_forget`,`date_forget`) VALUES
(, '5834846541', 'La Plume du Phoenix', 'plume','60 rue des plume','marécher bio ', '50.373893', '3.554130','0616808675','pros','www.laplumeduphoenix.com','mickael.carpene@gmail.com', '$2y$10$OscyPzEqWpvUpVEBukBz..Ofno0lgR8xStxRJpDhmrlwSlQ2UHMz.', '', '0000-00-00 00:00:00');
INSERT INTO `users` (`id`, `SIREN`, `RaisonSocial`, `username`, `adresse`,`Description`, `Latitude`, `Longitude`,`Tel`, `role`, `web`, `email`,`password`,`token_forget`,`date_forget`) VALUES
(, '5834846541', 'La Dinde en vogue', 'dinde','90 rue des Dinde','Dindon bio ', '40.373893', '6.554130','0616808675','pros','www.laplumeduphoenix.com','mickael.carpene@gmail.com', '$2y$10$OscyPzEqWpvUpVEBukBz..Ofno0lgR8xStxRJpDhmrlwSlQ2UHMz.', '', '0000-00-00 00:00:00');
INSERT INTO `users` (`id`, `SIREN`, `RaisonSocial`, `username`, `adresse`,`Description`, `Latitude`, `Longitude`,`Tel`, `role`, `web`, `email`,`password`,`token_forget`,`date_forget`) VALUES
(, '5834846541', 'recycle express', 'express','20 rue des poubelles','reclycle bio ', '20.373893', '7.554130','0616808675','pros','www.laplumeduphoenix.com','mickael.carpene@gmail.com', '$2y$10$OscyPzEqWpvUpVEBukBz..Ofno0lgR8xStxRJpDhmrlwSlQ2UHMz.', '', '0000-00-00 00:00:00');
INSERT INTO `users` (`username`,`role`,`email`,`password`,`token_forget`,`date_forget`,`comments`) VALUES
('commentateur','comments','mickael.carpene@gmail.com', '$2y$10$OscyPzEqWpvUpVEBukBz..Ofno0lgR8xStxRJpDhmrlwSlQ2UHMz.', '', '0000-00-00 00:00:00','voici un commentaire');
INSERT INTO `users` (`username`,`role`,`email`,`password`,`token_forget`,`date_forget`,`comments`) VALUES
('commentateur','comments','mickael.carpene@gmail.com', '$2y$10$OscyPzEqWpvUpVEBukBz..Ofno0lgR8xStxRJpDhmrlwSlQ2UHMz.', '', '0000-00-00 00:00:00','voici un 2 commentaire');