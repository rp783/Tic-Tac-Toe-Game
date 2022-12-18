-- Active: 1670523578315@@127.0.0.1@3306@ProjectDB
CREATE TABLE `Score_Table` (
  `ID` int AUTO_INCREMENT,
  `HighScore` int NOT NULL,
  `UserName` VARCHAR(64) NOT NULL,
  PRIMARY KEY(ID)
);