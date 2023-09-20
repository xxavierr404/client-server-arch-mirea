DROP DATABASE IF EXISTS appDB;
CREATE DATABASE appDB;
CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY 'password';
GRANT SELECT,UPDATE,INSERT ON appDB.* TO 'user'@'%';
FLUSH PRIVILEGES;

USE appDB;
CREATE TABLE IF NOT EXISTS students (
  id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(20) NOT NULL,
  surname VARCHAR(40) NOT NULL,
  PRIMARY KEY (id)
);

INSERT INTO students (name, surname) VALUES
('Victor', 'Vasiliev'),
('Kira', 'Podshivalova'),
('Arseny', 'Bazhenov'),
('Anastasia', 'Avdeeva'),
('Alla', 'Alekperova');