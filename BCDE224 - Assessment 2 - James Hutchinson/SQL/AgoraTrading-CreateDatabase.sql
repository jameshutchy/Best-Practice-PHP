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
bankNumber VARBINARY(500) NOT NULL,
contactNumber VARCHAR(15) NOT NULL,
email VARCHAR(60) NOT NULL,
logo LONGBLOB NULL,
hqAddress VARCHAR(50) NOT NULL,
hqCity VARCHAR(50) NOT NULL
)ENGINE=InnoDB;
SELECT * FROM business;

CREATE TABLE AgoraUser (
userID INT AUTO_INCREMENT PRIMARY KEY,
firstName VARBINARY(500) NULL,
lastName VARBINARY(500) NULL,
email VARCHAR(60) NULL,
username VARCHAR(50) NOT NULL,
userPassword VARBINARY(500) NOT NULL,
address VARCHAR(50) NULL,
city VARCHAR(50) NULL,
contactNumber VARCHAR(15) NULL,
userRole VARCHAR(20) NOT NULL,
businessID INT NULL,
FOREIGN KEY (businessID) REFERENCES Business(businessID)
)ENGINE=InnoDB;
SELECT * FROM agorauser;

CREATE TABLE ItemCategory (
categoryID INT AUTO_INCREMENT PRIMARY KEY,
category VARCHAR(50) NOT NULL
)ENGINE=InnoDB;
SELECT * FROM itemcategory;

CREATE TABLE listing (
itemID INT AUTO_INCREMENT PRIMARY KEY,
itemName VARCHAR(70) NOT NULL,
itemDescription TEXT NOT NULL,
photo LONGBLOB NULL,
price DECIMAL(10,2) NOT NULL,
inStock INT NOT NULL,
listingDate DATE NOT NULL,
sellerID INT NOT NULL,
categoryID INT NOT NULL,
FOREIGN KEY (sellerID) REFERENCES AgoraUser(userID),
FOREIGN KEY (categoryID) REFERENCES ItemCategory(categoryID)
)ENGINE=InnoDB;
SELECT * FROM listing;

CREATE TABLE Purchase (
purchaseID INT AUTO_INCREMENT PRIMARY KEY,
purchaseDate DATETIME NOT NULL,
buyerID INT NOT NULL,
FOREIGN KEY (buyerID) REFERENCES AgoraUser(userID)
)ENGINE=InnoDB;
SELECT * FROM purchase;

CREATE TABLE OrderLine (
orderlineID INT AUTO_INCREMENT PRIMARY KEY,
quantity INT NOT NULL,
price DECIMAL(10,2) NOT NULL,
itemID INT NOT NULL,
purchaseID INT NOT NULL,
FOREIGN KEY (itemID) REFERENCES listing(itemID),
FOREIGN KEY (purchaseID) REFERENCES Purchase(purchaseID)
)ENGINE=InnoDB;
SELECT * FROM orderline;

