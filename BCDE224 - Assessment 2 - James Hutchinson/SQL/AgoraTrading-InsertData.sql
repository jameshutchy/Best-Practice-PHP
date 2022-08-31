/* BCDE224 - Best Practices PHP
Assignment 2 - Agora Trading
MySQl Version 8.0
*/
-- INSERT DATA
USE agoratrading;
SET @encrypt_key = 'j3k4567ki678ki12lp0';

-- BUSINESS
INSERT INTO business (businessName, registrationNumber, bankNumber, contactNumber, email, logo, hqAddress, hqCity)
VALUES ("Vel Vulputate Eu PC","7417252019957",AES_ENCRYPT("3016 683784 27580",@encrypt_key),"(112) 818-1686","sem.mollis@protonmail.edu", LOAD_FILE('C:/ProgramData/MySQL/MySQL Server 8.0/Uploads/images/araLogo.png'),"978-4583 Euismod Rd.","Temuka"),
  ("In Ornare Corporation","3762807333139",AES_ENCRYPT("3008 918774 47344",@encrypt_key),"(820) 876-9127","neque@protonmail.org",LOAD_FILE('C:/ProgramData/MySQL/MySQL Server 8.0/Uploads/images/araLogo.png'), "2090 Dolor Road","Oamaru"),
  ("Lacus Nulla Industries","2450458603259",AES_ENCRYPT("4839 6894 1534 3893",@encrypt_key),"(583) 210-0258","ornare.lectus.justo@hotmail.couk",LOAD_FILE('C:/ProgramData/MySQL/MySQL Server 8.0/Uploads/images/araLogo.png'), "Ap #551-9049 Accumsan Av.","Blenheim"),
  ("Etiam Vestibulum Industries","2924339899400",AES_ENCRYPT("3778 862136 61879",@encrypt_key),"(352) 882-1476","accumsan.sed@protonmail.net",LOAD_FILE('C:/ProgramData/MySQL/MySQL Server 8.0/Uploads/images/araLogo.png'), "Ap #437-6175 Pede, Street","Feilding"),
  ("Placerat Inc.","8722239375111",AES_ENCRYPT("558773 476442 6255",@encrypt_key),"(402) 331-2025","phasellus.dolor@icloud.com",LOAD_FILE('C:/ProgramData/MySQL/MySQL Server 8.0/Uploads/images/araLogo.png'), "992-1201 Tristique Road","Invercargill");
SELECT * FROM business;
SELECT aes_decrypt(bankNumber, @encrypt_key) from business;

-- AGORA USER
INSERT INTO agorauser (username, firstName, lastName,  userPassword, address, city, contactNumber, userRole, email, businessID)
VALUES   ("Rachel123","","",SHA2("password1",256),"","","","Admin","",1),
  ("Uma24","","",SHA2("password2",256),"","","","Admin","",2),
  ("Cooper56","","",SHA2("password3",256),"","","","Admin","",3),
  ("Curran69","","",SHA2("password4",256),"","","","Admin","",4),
  ("Fred16","","",SHA2("password5",256),"","","","Admin","",5),
  ("Daryl57",AES_ENCRYPT("Daryl",@encrypt_key), AES_ENCRYPT("Barrera",@encrypt_key), SHA2("password6",256),"Ap #803-797 Neque Avenue","Wanaka","(365) 366-3826","seller","maecenas.libero@google.net",1),
  ("Colorado32",AES_ENCRYPT("Colorado",@encrypt_key), AES_ENCRYPT("Boyle",@encrypt_key), SHA2("password7",256),"Ap #220-5493 Montes, Rd.","Kapiti","(859) 101-5102","buyer","molestie.orci@icloud.ca",2),
  ("Nicholas58",AES_ENCRYPT("Nicholas",@encrypt_key), AES_ENCRYPT("Tucker",@encrypt_key), SHA2("password8",256),"Ap #433-3388 Euismod Ave","Matamata","(528) 896-8042","seller","mattis.semper.dui@yahoo.edu",3),
  ("Emi90",AES_ENCRYPT("Emi",@encrypt_key), AES_ENCRYPT("Vance",@encrypt_key), SHA2("password9",256),"Ap #440-1198 Enim St.","Balclutha","(486) 771-5619","seller","aliquet.nec@icloud.ca",4),
  ("Raja123",AES_ENCRYPT("Raja",@encrypt_key), AES_ENCRYPT("Klein",@encrypt_key), SHA2("password11",256),"672-969 Sed Av.","Waitara","(810) 892-9482","buyer","aliquet@protonmail.net",4);
SELECT * FROM agorauser;

-- ITEM CATEGORY
INSERT INTO itemcategory (category)
VALUES ("Fruit"), ("Vegetables"), ("Alcohol"), ("Meat"), ("Baking"), ("Dairy"), ("Preservatives"), ("Hardware"), ("Power tools"), ("Wood"),
("Garden supplies"), ("Lighting"), ("Clothing"), ("Plumbing"), ("Automotive");
SELECT * FROM itemcategory;

-- ITEM (sellers 6,8,9) 
INSERT INTO item (itemName, itemDescription, price, inStock, sellerID, categoryID, photo)
VALUES ("1kg apples", "Fresh royal gala apples from hawkes bay", 3.39, 250, 6, 1, LOAD_FILE('C:/ProgramData/MySQL/MySQL Server 8.0/Uploads/images/araLogo.png')),
		("1kg oranges", "Fresh naval oranges from hawkes bay", 2.69, 360, 6, 1, LOAD_FILE('C:/ProgramData/MySQL/MySQL Server 8.0/Uploads/images/araLogo.png')),
		("1kg parsnip", "Fresh parsnip from hawkes bay", 5.99, 180, 6, 2, LOAD_FILE('C:/ProgramData/MySQL/MySQL Server 8.0/Uploads/images/araLogo.png')),
		("brimstone tyre", "38.23 brimstone tyre high performance ", 74.99, 90, 8, 15, LOAD_FILE('C:/ProgramData/MySQL/MySQL Server 8.0/Uploads/images/araLogo.png')),
		("RB20DE", " new Import from japan RB20DE engine", 2349.00, 8, 8, 15, LOAD_FILE('C:/ProgramData/MySQL/MySQL Server 8.0/Uploads/images/araLogo.png')),
		("1kg Tasty Cheese", "Meadow fresh original tasty cheese", 23.00, 400, 9, 6, LOAD_FILE('C:/ProgramData/MySQL/MySQL Server 8.0/Uploads/images/araLogo.png')),
        ("1kg Shredded Parmesan", "1kg of the finest meadow fresh shredded parmesan cheese", 26.00, 120, 9,6, LOAD_FILE('C:/ProgramData/MySQL/MySQL Server 8.0/Uploads/images/araLogo.png')),
        ("Tray Blue Milk", "12 x 2L bottle blue top meadow fresh milk", 35.45, 200, 9, 6, LOAD_FILE('C:/ProgramData/MySQL/MySQL Server 8.0/Uploads/images/araLogo.png'));
 SELECT * FROM item; 
  
  -- PURCHASE (buyers 7,10)
  INSERT INTO purchase (purchaseDate, buyerID)
  VALUES ("2022-02-01", 7),("2022-02-13", 7), ("2022-02-13", 10), ("2022-02-16", 10), ("2022-02-17", 10), ("2022-02-20", 10), 
  ("2022-03-13", 7), ("2022-03,13", 10), ("2022-04-13", 10), ("2022-04-13", 7);
  SELECT * FROM purchase;
  
  -- ORDER LINE
  INSERT INTO orderline (price, quantity, itemID, purchaseID)
  VALUES (3.39, 20, 1, 1), (2.69, 30, 2, 1), (5.99, 15, 3, 1),
		(74.99, 4, 4, 3), (23.00, 2, 6, 2), (35.45, 1, 8, 4),
        (26.00, 1, 7, 5), (26.00, 1, 7, 6), (26.00, 1, 7, 7), 
        (26.00, 1, 7, 8), (26.00, 1, 7, 9), (26.00, 1, 7, 10), 
        (2200.00, 1, 5, 3), (3.39, 16, 1, 5), (26.00, 1, 7, 5);
  SELECT * FROM orderline;      