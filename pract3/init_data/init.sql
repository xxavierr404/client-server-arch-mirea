DROP DATABASE IF EXISTS appDB;
CREATE DATABASE appDB;
CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY 'password';
GRANT SELECT,UPDATE,INSERT,DELETE ON appDB.* TO 'user'@'%';
FLUSH PRIVILEGES;

USE appDB;
CREATE TABLE IF NOT EXISTS learn_groups (
  id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(15) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS students (
  id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(20) NOT NULL,
  surname VARCHAR(40) NOT NULL,
  group_id INT(11) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (group_id) REFERENCES learn_groups (id)
);

INSERT INTO learn_groups (name) VALUES
  ('IKBO-01-21'),
  ('IKBO-03-21');

INSERT INTO students (name, surname, group_id) VALUES
  ('Victor', 'Vasiliev', 1),
  ('Arseny', 'Bazhenov', 1),
  ('Egor', 'Slesarenko', 2);