/* BCDE224 - Best Practices PHP
Assignment 2 - Agora Trading
MySQl Version 8.0
*/
-- INSERT DATA
USE agoratrading;
SET @encrypt_key = SHA2('j3k4567ki678ki12lp0', 256);
-- BUSINESS
INSERT INTO business (businessName, registrationNumber, bankNumber, logo, hqAddress, hqCity)
VALUES ("Vel Vulputate Eu PC","7417252019957","3016 683784 27580", 'araLogo.png',"978-4583 Euismod Rd.","Temuka"),
  ("In Ornare Corporation","3762807333139","3008 918774 47344", 'araLogo.png', "2090 Dolor Road","Oamaru"),
  ("Lacus Nulla Industries","2450458603259","4839 6894 1534 3893", 'araLogo.png', "Ap #551-9049 Accumsan Av.","Blenheim"),
  ("Etiam Vestibulum Industries","2924339899400","3778 862136 61879", 'araLogo.png', "Ap #437-6175 Pede, Street","Feilding"),
  ("Placerat Inc.","8722239375111","558773 476442 6255",'araLogo.png', "992-1201 Tristique Road","Invercargill");
SELECT * FROM business;

-- AGORA USER
INSERT INTO agorauser (username, firstName, lastName,  userPassword, address, city, contactNumber, userRole, email, businessID)
VALUES   ("Rachel123","","","password1","","","","Admin","",1),
  ("Uma24","","","password2","","","","Admin","",2),
  ("Cooper56","","","password3","","","","Admin","",3),
  ("Curran69","","","password4","","","","Admin","",4),
  ("Fred16","","","password5","","","","Admin","",5),
  ("Daryl57","Daryl", "Barrera", "password6","Ap #803-797 Neque Avenue","Wanaka","(365) 366-3826","seller","maecenas.libero@google.net",2),
  ("Colorado32","Colorado","Boyle", 
  "password7","Ap #220-5493 Montes, Rd.","Kapiti","(859) 101-5102","buyer","molestie.orci@icloud.ca",2),
  ("Nicholas58","Nicholas", "Tucker", 
  "password8","Ap #433-3388 Euismod Ave","Matamata","(528) 896-8042","seller","mattis.semper.dui@yahoo.edu",1),
  ("Emi90","Emi", "Vance", 
  "password9","Ap #440-1198 Enim St.","Balclutha","(486) 771-5619","seller","aliquet.nec@icloud.ca",4),
  ("Raja123","Raja", "Klein", 
  "password11","672-969 Sed Av.","Waitara","(810) 892-9482","buyer","aliquet@protonmail.net",4);
SELECT * FROM agorauser;
select userpassword from agorauser where username = 'Daryl57';

-- ITEM (sellers 6,8,9) 
INSERT INTO listing (itemName, itemDescription, price, listingDate, sellerID, hashTag, photo)
VALUES ("1kg apples", "Fresh royal gala apples from hawkes bay", 3.39,now(), 6, '#juicy','royal-gala.jpg'),
		("1kg oranges", "Fresh naval oranges from hawkes bay", 2.69, now(), 6, '#Juicy', 'kiwiFruit.jpg'),
		("1kg parsnip", "Fresh parsnip from hawkes bay", 5.99, now(), 6, '#Parsnip', 'kiwiFruit.jpg'),
		("brimstone tyre", "38.23 brimstone tyre high performance ", 74.99, now(), 8, '#goodTyres', 'kiwiFruit.jpg'),
		("RB20DE", " new Import from japan RB20DE engine", 2349.00, now(), 8, '#RB20DE', 'kiwiFruit.jpg'),
		("1kg Tasty Cheese", "Meadow fresh original tasty cheese", 23.00, now(), 9, '#Tasty', 'kiwiFruit.jpg'),
        ("1kg Shredded Parmesan", "1kg of the finest meadow fresh shredded parmesan cheese", 26.00, now(), 9,'#cheesy', 'kiwiFruit.jpg'),
        ("Tray Blue Milk", "12 x 2L bottle blue top meadow fresh milk", 35.45, now(), 9, '#Cows', 'kiwiFruit.jpg');
 SELECT * FROM listing; 
  
  -- PURCHASE (buyers 7,10)
  INSERT INTO purchase (purchaseDate, buyerID, price, itemID)
  VALUES ("2022-02-01", 7, 3.39, 1),("2022-02-13", 7, 3.39, 1), ("2022-02-13", 10,2.69, 2), ("2022-02-16", 10,2.69,2 ), ("2022-02-17", 10,74.99, 4), ("2022-02-20", 10, 2349.00, 5), 
  ("2022-03-13", 7, 23.00, 6), ("2022-03,13", 10, 23.00, 6), ("2022-04-13", 10, 26.00, 7), ("2022-04-13", 7, 35.45, 8);
  SELECT * FROM purchase;
  
	