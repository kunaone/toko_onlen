-- create database first
CREATE DATABASE IF NOT EXISTS loginsys;

-- after create database or just select the database
USE loginsys;

-- Create user levels
CREATE TABLE user_lvl (
    id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(50) NOT NULL
) ENGINE=InnoDB;

-- create table users
CREATE TABLE users(
	id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	fullname varchar(80) NOT NULL,
	email varchar(80) NOT NULL UNIQUE,
	username varchar(79) NOT NULL UNIQUE,
	password varchar(100) NOT NULL,
	img text,
	lvl_id int(11),
	CONSTRAINT fk_level
	FOREIGN KEY (lvl_id)
	REFERENCES user_lvl(id)

)ENGINE=InnoDB;