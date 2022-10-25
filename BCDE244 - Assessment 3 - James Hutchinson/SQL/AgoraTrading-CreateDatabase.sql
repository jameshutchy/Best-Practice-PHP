/* BCDE224 - Best Practices PHP
Assignment 2 - Agora Trading
MySQl Version 8.0
*/
-- CREATE DATABASE 
DROP DATABASE IF EXISTS AgoraTrading;
CREATE DATABASE AgoraTrading;
USE AgoraTrading;

CREATE TABLE Business (
businessID INT AUTO_INCREMENT PRIMARY KEY,
businessName VARCHAR(70) NOT NULL,
registrationNumber VARCHAR(15) NOT NULL, 
bankNumber VARCHAR(50) NOT NULL,
logo VARCHAR(50) NULL,
hqAddress VARCHAR(50) NOT NULL,
hqCity VARCHAR(50) NOT NULL
)ENGINE=InnoDB;
SELECT * FROM business;

CREATE TABLE AgoraUser (
userID INT AUTO_INCREMENT PRIMARY KEY,
firstName VARCHAR(50) NULL,
lastName VARCHAR(50) NULL,
email VARCHAR(60) NULL,
username VARCHAR(50) NOT NULL,
userPassword VARCHAR(60) NOT NULL,
address VARCHAR(50) NULL,
city VARCHAR(50) NULL,
contactNumber VARCHAR(15) NULL,
userRole VARCHAR(20) NOT NULL,
businessID INT NULL,
FOREIGN KEY (businessID) REFERENCES Business(businessID)
)ENGINE=InnoDB;
SELECT * FROM agorauser;
-- update agorauser set username = 'admin' where userID = 11;

CREATE TABLE listing (
itemID INT AUTO_INCREMENT PRIMARY KEY,
itemName VARCHAR(70) NOT NULL,
itemDescription TEXT NOT NULL,
photo VARCHAR(70) NULL,
price DECIMAL(10,2) NOT NULL,
listingDate DATE NOT NULL,
sellerID INT NOT NULL,
hashTag VARCHAR(80) NULL,
FOREIGN KEY (sellerID) REFERENCES AgoraUser(userID)
)ENGINE=InnoDB;
SELECT * FROM listing;



CREATE TABLE Purchase (
purchaseID INT AUTO_INCREMENT PRIMARY KEY,
purchaseDate DATE NOT NULL,
buyerID INT NOT NULL,
price DECIMAL(10,2) NOT NULL,
itemName VARCHAR(70) NOT NULL,
itemID INT NOT NULL,
FOREIGN KEY (itemID) REFERENCES listing(itemID),
FOREIGN KEY (buyerID) REFERENCES AgoraUser(userID)
)ENGINE=InnoDB;
SELECT * FROM purchase;


