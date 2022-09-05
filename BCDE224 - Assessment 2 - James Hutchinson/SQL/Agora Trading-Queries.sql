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

-- 


