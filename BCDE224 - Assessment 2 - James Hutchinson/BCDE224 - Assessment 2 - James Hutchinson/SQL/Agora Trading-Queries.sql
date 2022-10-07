/* BCDE224 - Best Practices PHP
Assignment 2 - Agora Trading
MySQl Version 8.0
*/
-- QUERIES
USE agoratrading;
-- INSERT/UPDATE QUERY
START TRANSACTION;
INSERT INTO orderline (quantity, price, itemID, purchaseID ) VALUES ( 30, 3.39, 1, 2 );
UPDATE listing SET inStock = ( inStock - 30 ) WHERE itemID = 1;
COMMIT;
SELECT * FROM listing;

-- SIMPLE QUERY
SELECT l.itemName, l.photo, l.price, l.inStock,  c.category, l.listingDate
FROM listing l
INNER JOIN itemcategory c on c.categoryID=l.categoryID
WHERE l.itemID = 1;

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

-- SEARCH QUERY -- not sure what is better to handle this in sql or php?
DROP PROCEDURE IF EXISTS sp_searchListings;
DELIMITER //
CREATE PROCEDURE sp_searchListings(IN theBusinessID INT , IN theSellerID INT , IN word VARCHAR(20))
BEGIN
		IF theSellerID IS NULL AND theBusinessID IS NULL
			THEN CALL sp_searchListingBuyer(searchWord);
		ELSE IF theSellerID IS NOT NULL
			THEN CALL sp_searchListingSeller(theSellerID, searchWord);
		ELSE IF theBusinessID IS NOT NULL
			THEN CALL sp_searchListingAdmin(theBusinessID, searchWord);
		END IF;
        END IF;
        END IF; 
END; 
//
CALL sp_searchListings(NULL, 8, 'a');
SELECT * FROM listing;

-- SEARCH QUERY BUYER
DROP PROCEDURE IF EXISTS sp_searchListingBuyer;
DELIMITER //
CREATE PROCEDURE sp_searchListingBuyer(IN word VARCHAR(20))
BEGIN
	SELECT l.itemName, l.photo, l.price, l.inStock,  c.category, l.listingDate
	FROM listing l
	LEFT JOIN itemcategory c on c.categoryID=l.categoryID
	WHERE l.itemName LIKE CONCAT('%', word, '%') 
	OR c.category LIKE CONCAT('%', word, '%') 
	OR l.itemDescription LIKE CONCAT('%', word, '%');
END;
//
-- SEARCH QUERY SELLER
DROP PROCEDURE IF EXISTS sp_searchListingSeller;
DELIMITER //
CREATE PROCEDURE sp_searchListingSeller(IN theSeller INT, IN word VARCHAR(20))
BEGIN
	SELECT l.itemName, l.photo, l.price, l.inStock,  c.category, l.listingDate
	FROM listing l
	LEFT JOIN itemcategory c on c.categoryID=l.categoryID
	WHERE (l.itemName LIKE CONCAT('%', word, '%') 
	OR c.category LIKE CONCAT('%', word, '%') 
	OR l.itemDescription LIKE CONCAT('%', word, '%')) 
    AND l.sellerID = theSeller;
END;
//
-- FOR SEARCH QUERY BUSINESS ADMIN 
DROP PROCEDURE IF EXISTS sp_searchListingAdmin;
DELIMITER //
CREATE PROCEDURE sp_searchListingAdmin(IN theBusinessID INT, IN word VARCHAR(20))
BEGIN
	SELECT li.itemName, li.photo, li.price, li.inStock, li.category, li.listingDate
	FROM (
		SELECT l.itemName, l.sellerID, l.photo, l.price, l.inStock,  c.category, l.listingDate
		FROM listing l
		LEFT JOIN itemcategory c on c.categoryID=l.categoryID
		WHERE l.itemName LIKE CONCAT('%', word, '%') 
		OR c.category LIKE CONCAT('%', word, '%') 
		OR l.itemDescription LIKE CONCAT('%', word, '%') 
	) as li 
	INNER JOIN (
		SELECT userID FROM agorauser 
		WHERE businessID = theBusinessID AND userRole = 'seller'
	) AS b
	WHERE li.sellerID = b.userID;
END;
//
