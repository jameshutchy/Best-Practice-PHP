/* BCDE224 - Best Practices PHP
Assignment 2 - Agora Trading
MySQl Version 8.0
*/
-- PROCEDURES
USE agoratrading;

-- SEARCH PROCEDURE BUYER
DROP PROCEDURE IF EXISTS sp_searchListingBuyer;
DELIMITER //
CREATE PROCEDURE sp_searchListingBuyer(IN theBusinessID INT, IN word VARCHAR(20))
BEGIN
	SELECT l.itemID, l.itemName, l.photo, l.price, l.hashtag, l.listingDate, l.sellerID,
    l.itemDescription, l.contactNumber, l.sellerName
	FROM (
		SELECT itemID, itemName, itemDescription, 
        photo, price, listingDate, li.sellerID, hashTag, contactNumber, CONCAT(firstName, ' ', lastName) AS sellerName
		FROM listing li
		INNER JOIN agorauser a ON li.sellerID = a.userID
		WHERE itemName LIKE CONCAT('%', word, '%') 
		OR hashtag LIKE CONCAT('%', word, '%') 
		OR itemDescription LIKE CONCAT('%', word, '%') 
	) as l
	INNER JOIN (
		SELECT userID FROM agorauser 
		WHERE businessID = theBusinessID AND userRole = 'seller'
	) AS b
	WHERE l.sellerID != b.userID;
END;
//
select * from agorauser;
select * from listing;
call sp_searchListingBuyer(1, '');

-- SEARCH PROCEDURE SELLER
DROP PROCEDURE IF EXISTS sp_searchListingSeller;
DELIMITER //
CREATE PROCEDURE sp_searchListingSeller(IN theSeller INT, IN word VARCHAR(20))
BEGIN
SELECT itemID, itemName, itemDescription, 
        photo, price, listingDate, l.sellerID, hashTag, contactNumber, CONCAT(firstName, ' ', lastName) AS sellerName
	FROM listing l
    INNER JOIN agorauser a ON l.sellerID = a.userID
	WHERE (itemName LIKE CONCAT('%', word, '%') 
	OR hashtag LIKE CONCAT('%', word, '%') 
	OR itemDescription LIKE CONCAT('%', word, '%')) 
    AND l.sellerID = theSeller;
END;
//
call sp_searchListingSeller(6, '');

-- FOR SEARCH PROCEDURE BUSINESS ADMIN 
DROP PROCEDURE IF EXISTS sp_searchListingAdmin;
DELIMITER //
CREATE PROCEDURE sp_searchListingAdmin(IN theBusinessID INT, IN word VARCHAR(20))
BEGIN
	SELECT l.itemID, l.itemName, l.photo, l.price, l.hashtag, l.listingDate, l.sellerID,
    l.itemDescription, l.contactNumber, l.sellerName
	FROM (
		SELECT itemID, itemName, itemDescription, 
        photo, price, listingDate, li.sellerID, hashTag, contactNumber, CONCAT(firstName, ' ', lastName) AS sellerName
		FROM listing li
		INNER JOIN agorauser a ON li.sellerID = a.userID
		WHERE itemName LIKE CONCAT('%', word, '%') 
		OR hashtag LIKE CONCAT('%', word, '%') 
		OR itemDescription LIKE CONCAT('%', word, '%') 
	) as l
	INNER JOIN (
		SELECT userID FROM agorauser 
		WHERE businessID = theBusinessID AND userRole = 'seller'
	) AS b
	WHERE l.sellerID = b.userID;
END;
//
call sp_searchListingAdmin(1, '');

-- lOAD SINGLE LISTING PROCEDURE
DROP PROCEDURE IF EXISTS sp_loadListing;
DELIMITER //
CREATE PROCEDURE sp_loadListing(IN id INT)
BEGIN
	SELECT itemID, itemName, itemDescription, 
        photo, price, listingDate, sellerID, hashTag, contactNumber, 
        CONCAT(firstName, ' ', lastName) AS sellerName
	FROM listing l
	INNER  JOIN agoraUser a on a.userID=l.sellerID
	WHERE itemID = id;
END;
//
-- LOAD ALL LISTINGS PROCEUDRE
DROP PROCEDURE IF EXISTS sp_loadAllListing;
DELIMITER //
CREATE PROCEDURE sp_loadAllListing()
BEGIN
	SELECT itemID, itemName, itemDescription, 
        photo, price, listingDate, sellerID, hashTag, contactNumber, 
        CONCAT(firstName, ' ', lastName) AS sellerName
	FROM listing l
	INNER  JOIN agoraUser a on a.userID=l.sellerID;
END;
//
select * from listing;
-- handle login 
DROP PROCEDURE IF EXISTS sp_login;
DELIMITER //
CREATE PROCEDURE sp_login(IN theUsername VARCHAR(50))
BEGIN
	SELECT userpassword
	FROM agorauser where username = theUsername;
END;
//
call sp_login('buyer3');
select* from agorauser;

-- PURCHASE ITEM PROCEDURE 
DROP PROCEDURE IF EXISTS sp_purchaseItem;
DELIMITER //
CREATE PROCEDURE sp_purchaseItem(IN theBuyerID INT, IN listingID INT)
BEGIN
	DECLARE itemPrice DECIMAL(10,2);
    DECLARE iName VARCHAR(70);
    SELECT price, itemName into itemPrice, iName FROM listing WHERE itemID = listingID;
	INSERT INTO purchase(purchaseDate, buyerID, price, itemName, itemID)
    VALUES(now(), theBuyerID, itemPrice, iName, listingID);
END;
//
select * from purchase;

DROP PROCEDURE IF EXISTS sp_editListing;
DELIMITER //
CREATE PROCEDURE sp_editListing(
IN theID INT, IN theName VARCHAR(70), IN theDescription TEXT, 
IN thePhoto VARCHAR(70), IN thePrice DECIMAL(10,2), IN tag VARCHAR(80))
BEGIN
    UPDATE listing
    SET itemName = theName, itemDescription = theDescription, photo = thePhoto, 
    price = thePrice, hashTag = tag where itemID = theID;
END;
//
call sp_editListing(10, 'oranges', 'some description', 'oranges.jpg', 5, '#test');