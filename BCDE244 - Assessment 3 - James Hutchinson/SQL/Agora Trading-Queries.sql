/* BCDE224 - Best Practices PHP
Assignment 2 - Agora Trading
MySQl Version 8.0
*/
-- QUERIES
USE agoratrading;
-- COMPLEX QUERY -- create an invoice for items purchased
DROP PROCEDURE IF EXISTS purchase_invoice;
DELIMITER //
CREATE PROCEDURE purchase_invoice( IN pID INT)
BEGIN
	SELECT b.businessName, AES_DECRYPT(b.banknumber, @encrypt_key) AS 'bankNumber', b.contactNumber, b.email, b.logo,
	 l.sellerID, CONCAT(AES_DECRYPT(u.firstName, @encrypt_key), ' ', AES_DECRYPT(u.lastName, @encrypt_key)) AS 'sellerName', 
     l.itemName, o.price, o.quantity, p.purchaseDate, (o.price * o.quantity) AS 'total'
	 FROM purchase p
	 INNER JOIN orderline o ON o.purchaseID = p.purchaseID
	 INNER JOIN listing l ON l.itemID = o.itemID
     INNER JOIN agorauser u ON u.userID = l.sellerID
	 INNER JOIN business b ON u.businessID = b.businessID
	 WHERE p.purchaseID = pID
	 ORDER BY l.sellerID;
END; //
DELIMITER ;
SET @purchaseID = 5;
-- TEST TO CHECK HOW MANY ITEMS ARE ON ORDERLINE
SELECT * FROM ORDERLINE WHERE purchaseID = @purchaseID;
-- TEST THE STORED PROCEDURE
CALL purchase_invoice(@purchaseID);


-- SEARCH QUERY BUYER
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
call sp_searchListingBuyer(1, '');
-- SEARCH QUERY SELLER
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
-- FOR SEARCH QUERY BUSINESS ADMIN 
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
select* from agorauser;
