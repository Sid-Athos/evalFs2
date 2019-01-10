SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+01:00";

DROP DATABASE `appsEval`;
CREATE DATABASE `appsEval`;
USE `appsEval`;


DROP TABLE IF EXISTS `CATEGORYS`;
CREATE TABLE IF NOT EXISTS `CATEGORYS` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


ALTER TABLE `CATEGORYS` ADD CONSTRAINT UNIQUE(`name`);
--
-- Déchargement des données de la table `CATEGORYS`
--
--
-- Structure de la table `USERS`
--




DROP TABLE IF EXISTS `ORIGINS`;
CREATE TABLE IF NOT EXISTS `ORIGINS` (
  `ID` TINYINT(1) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

INSERT INTO `ORIGINS` (`ID`, `name`) VALUES
(1, 'Humain'),
(2, 'Animal'),
(4, 'Végétal'),
(5, 'Cailloux et assimilé');

DROP TABLE IF EXISTS `BACKGROUNDS`;
CREATE TABLE IF NOT EXISTS `BACKGROUNDS` (
  `ID` TINYINT(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `backPath` varchar(150) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

INSERT INTO `BACKGROUNDS` (`ID`, `name`,`backPath`) VALUES
(1,'Glance Default','V/_template/assets/img/header.jpg'),
(2,'Anime Wallpaper','V/_template/assets/img/anime.jpg');


INSERT INTO `CATEGORYS` (`ID`, `name`) VALUES
(1, 'Urgence'),
(2, 'Consultation suivie'),
(3, 'Première consultation');


DROP TABLE IF EXISTS `USERS`;
CREATE TABLE IF NOT EXISTS `USERS` (
  `ID` INT(11) NOT NULL UNIQUE AUTO_INCREMENT,
  `pseudo` varchar(45) NOT NULL,
  `mail` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `avPath` varchar(255) DEFAULT "",
  `lastCo` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `backgroundID` TINYINT(4) NOT NULL DEFAULT 1,
  `font` TINYINT(1) NOT NULL DEFAULT 0,
  `alive` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`ID`) 
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
ALTER TABLE `USERS` ADD CONSTRAINT UNIQUE(`mail`);
ALTER TABLE `USERS` ADD CONSTRAINT UNIQUE(`phone`);

ALTER TABLE `users`
ADD CONSTRAINT FOREIGN KEY (`backgroundID`)
  REFERENCES BACKGROUNDS(`ID`)
  ON UPDATE CASCADE
  ON DELETE RESTRICT;

DROP TABLE IF EXISTS `OWNERS`;
CREATE TABLE IF NOT EXISTS `OWNERS` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) UNIQUE NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `address` varchar(150) NOT NULL,
  `postCode` varchar(150) NOT NULL,
  `city` varchar(45) NOT NULL,
  `phone` varchar(13) UNIQUE NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `SEX`;
CREATE TABLE IF NOT EXISTS `SEX` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `SEX` ADD CONSTRAINT UNIQUE(`name`);

INSERT INTO `SEX` (`ID`, `name`) VALUES
(1, 'Non-Binaire'),
(2, 'Hermaphrodite'),
(4, 'Mâle'),
(5, 'Femelle'),
(6, 'Non défini'),
(3, 'Vanille');



DROP TABLE IF EXISTS `PATIENTS`;
CREATE TABLE IF NOT EXISTS `PATIENTS` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `patientName` varchar(20) NOT NULL DEFAULT 'Unknown',
  `breed` varchar(25) DEFAULT 'human',
  `sexID` INT(11) NOT NULL,
  `originID` tinyint(1) NOT NULL DEFAULT 1,
  `birthDate` date DEFAULT NULL,
  `lifeStyle` longtext,
  `food` longtext,
  `avpath` varchar(155),
  PRIMARY KEY (`ID`),
  CONSTRAINT FK_patients_sex FOREIGN KEY (`sexID`)
  REFERENCES SEX(`ID`)
  ON UPDATE CASCADE
  ON DELETE RESTRICT,
  CONSTRAINT FK_patients_origin FOREIGN KEY (`originID`)
  REFERENCES ORIGINS(`ID`)
  ON UPDATE CASCADE
  ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `APPOINTMENTS`;
CREATE TABLE IF NOT EXISTS `APPOINTMENTS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `place` varchar(250) NOT NULL DEFAULT 'Aucun endroit défini',
  `notes` varchar(1500) NOT NULL,
  `appDay` DATE NOT NULL,
  `startTime` TIME NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  /** `totalActivity` TIME NOT NULL DEFAULT CURRENT_TIMESTAMP(), */
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `CONSULTATIONS`;
CREATE TABLE IF NOT EXISTS `CONSULTATIONS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `reason` varchar(45) NOT NULL,
  `food` varchar(45) NOT NULL DEFAULT "Non renseigné",
  `mindState` varchar(45) NOT NULL DEFAULT "En forme wallah, c'est dans sa tête",
  `phyState` varchar(45) NOT NULL DEFAULT "Bon là par contre...",
  `temper` varchar(50) NOT NULL DEFAULT "Tempura",
  `notes` varchar(1500) NOT NULL DEFAULT "Aucune note",
  `weight` VARCHAR(50) NOT NULL, 
  `recommandations` varchar(1500) NOT NULL,
  `appointmentID` INT(11) NOT NULL DEFAULT 1,
  `consDate` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  /** `totalActivity` TIME NOT NULL DEFAULT CURRENT_TIMESTAMP(), */
  PRIMARY KEY (`ID`),
  CONSTRAINT FK_cons_appointmentID FOREIGN KEY (`appointmentID`)
  REFERENCES APPOINTMENTS(`ID`)
  ON UPDATE CASCADE
  ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `OWNER_HAS_PATIENTS`;
CREATE TABLE IF NOT EXISTS `clients_has_patients` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `ownerID` INT(11) NOT NULL,
  `patientID` INT(11) NOT NULL,
  PRIMARY KEY (`ID`),
  CONSTRAINT FK_ownhaspat_ownerID FOREIGN KEY (`ownerID`)
  REFERENCES OWNERS(`ID`)
  ON UPDATE CASCADE
  ON DELETE RESTRICT,
  CONSTRAINT FK_ownhaspat_patientID FOREIGN KEY (`patientID`)
  REFERENCES PATIENTS(`ID`)
  ON UPDATE CASCADE
  ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `USER_HAS_APPS`;
CREATE TABLE IF NOT EXISTS `USER_HAS_APPS` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `userID` INT(11) NOT NULL,
  `appointmentID` INT(11) NOT NULL,
  PRIMARY KEY (`ID`),
  CONSTRAINT FK_ushasapp_userID FOREIGN KEY (`userID`)
  REFERENCES USERS(`ID`)
  ON UPDATE CASCADE
  ON DELETE RESTRICT,
  CONSTRAINT FK_ushasapp_patientID FOREIGN KEY (`appointmentID`)
  REFERENCES APPOINTMENTS(`ID`)
  ON UPDATE CASCADE
  ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `SCHEDULES`;
CREATE TABLE IF NOT EXISTS `SCHEDULES` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `fromTime` time  NOT NULL,
  `toTime` time NOT NULL,
  `workingDay` SET('Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche') NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `USER_HAS_SCHEDULE`;
CREATE TABLE IF NOT EXISTS `USER_HAS_SCHEDULE` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `userID` INT(11) NOT NULL,
  `scheduleID` INT(11) NOT NULL,
  PRIMARY KEY(`ID`),
  CONSTRAINT FK_ushassche_ownerID FOREIGN KEY (`userID`)
  REFERENCES USERS(`ID`)
  ON UPDATE CASCADE
  ON DELETE RESTRICT,
  CONSTRAINT FK_ushassche_scheduleID FOREIGN KEY (`scheduleID`)
  REFERENCES SCHEDULES(`ID`)
  ON UPDATE CASCADE
  ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `PATIENT_HAS_APPOINTMENTS`;
CREATE TABLE IF NOT EXISTS `PATIENT_HAS_APPOINTMENTS` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `patientID` INT(11) NOT NULL,
  `appointmentID` INT(11) NOT NULL,
  PRIMARY KEY (`ID`),
  CONSTRAINT FOREIGN KEY (`patientID`)
  REFERENCES PATIENTS(`ID`)
  ON UPDATE CASCADE
  ON DELETE RESTRICT,
  CONSTRAINT FOREIGN KEY (`appointmentID`)
  REFERENCES APPOINTMENTS(`ID`)
  ON UPDATE CASCADE
  ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------


DROP TABLE IF EXISTS `SPECS`;
CREATE TABLE IF NOT EXISTS `SPECS` (
  `ID` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


INSERT INTO `SPECS` (`ID`, `name`) VALUES
(1, 'Souffrologie'),
(2, 'Rebouteux'),
(4, 'Yogi'),
(5, 'Charlatan'),
(6, 'Ylang Ylang'),
(3, 'Osthéopathe');

DROP TABLE IF EXISTS `SPECCED_IN`;
CREATE TABLE IF NOT EXISTS `SPECCED_IN` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `specID` tinyint(4) NOT NULL,
  PRIMARY KEY (`ID`),
  CONSTRAINT FOREIGN KEY (`userID`)
  REFERENCES USERS(`ID`)
  ON UPDATE CASCADE
  ON DELETE RESTRICT,
  CONSTRAINT FOREIGN KEY (`specID`)
  REFERENCES SPECS(`ID`)
  ON UPDATE CASCADE
  ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `HOLIDAYS`;
CREATE TABLE IF NOT EXISTS `HOLIDAYS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `startsAt` DATETIME NOT NULL,
  `endsAt` datetime  NULL,
  `userID` INT(11) NOT NULL,
  PRIMARY KEY (`ID`),
  CONSTRAINT FK_holin_ownerID FOREIGN KEY (`userID`)
  REFERENCES USERS(`ID`)
  ON UPDATE CASCADE
  ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `ZONES`;
CREATE TABLE IF NOT EXISTS `ZONES` (
  `ID` TINYINT(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `zonePath` varchar(145) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;




INSERT INTO `USERS` (`ID`, `pseudo`, `mail`, `password`, `phone`) VALUES
(1, 'Athos', 'sa.bennaceur@gmail.com', 'cd98bf0202ef07e38e87f6bd9445e5e7331e2c78', '0612121212'),
(2, 'Sidou', 'sa.benn90@gmail.com', 'cd98bf0202ef07e38e87f6bd9445e5e7331e2c78', '0610101010');
INSERT INTO `SCHEDULES` (`ID`, `fromTime`, `toTime`, `workingDay`) VALUES (NULL, '08:00:00', '20:00:00', 'Mardi');
INSERT INTO `USER_HAS_SCHEDULE` (`ID`, `userID`, `scheduleID`) VALUES (NULL, '1', '1');
INSERT INTO `HOLIDAYS` (`ID`, `startsAt`, `endsAt`, `userID`) VALUES (NULL, '2019-01-18 00:00:00', '2019-01-29 00:00:00', '1');
INSERT INTO `ZONES` (`ID`, `name`, `zonePath`) VALUES
(1, 'Tête', 'V/Parts/head.png'),
(2, 'Épaules', 'V/Parts/epaules.jfif'),
(3, 'Cage thoracique', 'V/Parts/thoracique.jfif'),
(4, 'Abdomen', 'V/Parts/abdomen.jfif'),
(5, 'Bras', 'V/Parts/bras.jfif'),
(6, 'Bassin', 'V/Parts/bassin.jfif'),
(7, 'Jambes', 'V/Parts/jambes.jfif'),
(8, 'Pieds', 'V/Parts/pieds.jfif');


INSERT INTO `PATIENTS` (`ID`, `patientName`, `breed`, `sexID`, `originID`, `birthDate`, `lifeStyle`, `food`, `avpath`) VALUES
(1, 'Horseman Bojack', 'Cheval', 4, 2, '2000-02-10', 'Casanier', 'Foin', NULL);
INSERT INTO `OWNERS` (`ID`, `email`, `lastName`, `firstName`, `address`, `postCode`, `city`, `phone`) VALUES
(1, 'sa.benn@lol.lol', 'Corinne', 'Thomas', '101 rue des acuqevilles', '95215', '95215', '0606060606');

INSERT INTO `APPOINTMENTS` (`ID`, `name`, `place`, `notes`, `appDay`, `startTime`, `status`) VALUES
(1, 'test nature', 'Aucune note défini!', '', '2019-01-15', '16:30:00', 1);
INSERT INTO `USER_HAS_APPS` (`ID`, `userID`, `appointmentID`) VALUES
(1, 1, 1);
INSERT INTO `PATIENT_HAS_APPOINTMENTS` (`ID`, `patientID`, `appointmentID`) VALUES
(1, 1, 1);
INSERT INTO `CLIENTS_HAS_PATIENTS` (`ID`, `ownerID`, `patientID`) VALUES
(1, 1, 1);
INSERT INTO `CONSULTATIONS` (`ID`, `reason`, `food`, `mindState`, `phyState`, `temper`, `notes`, `weight`, `recommandations`, `appointmentID`, `consDate`) VALUES
(1, 'test1', 'Non renseigné', 'En forme wallah', 'Bon là par contre...', 'Tempura', 'Aucune note', '145,5', 'dqsdq', 1, '2019-01-09 22:36:57');

DROP TABLE IF EXISTS `ZONE_HANDLED`;
CREATE TABLE IF NOT EXISTS `ZONE_HANDLED` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `zoneID` TINYINT(4) NOT NULL,
  `consultationID` INT(11) NOT NULL,
  PRIMARY KEY (`ID`),
  CONSTRAINT FOREIGN KEY (`zoneID`)
  REFERENCES ZONES(`ID`)
  ON UPDATE CASCADE
  ON DELETE RESTRICT,
  CONSTRAINT FOREIGN KEY (`consultationID`)
  REFERENCES CONSULTATIONS(`ID`)
  ON UPDATE CASCADE
  ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `ZONE_HANDLED` (`ID`, `zoneID`, `consultationID`) VALUES
(1, 6, 1),
(2, 8, 1);

DROP TABLE IF EXISTS `BELONGS`;
CREATE TABLE IF NOT EXISTS `BELONGS` (
  `ID` TINYINT(1) NOT NULL AUTO_INCREMENT,
  `appointmentID` INT(11) NOT NULL,
  `categoryID` INT(11) NOT NULL,
  PRIMARY KEY (`ID`),
  CONSTRAINT FK_belongs_appID FOREIGN KEY (`appointmentID`)
  REFERENCES APPOINTMENTS(`ID`)
  ON UPDATE CASCADE
  ON DELETE RESTRICT,
  CONSTRAINT FK_belongs_cat FOREIGN KEY (`categoryID`)
  REFERENCES CATEGORYS(`ID`)
  ON UPDATE CASCADE
  ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

INSERT INTO `BELONGS` (`ID`,`appointmentID`, `categoryID`) VALUES
(1,1,1);
--
-- Déchargement des données de la table `USERS`
--



