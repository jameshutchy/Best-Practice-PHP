-- INSERT DATA AGORA TRADING
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

-- AGORA USER -- need to hash passwords!!!!!!!!!!******
INSERT INTO agorauser (username, firstName, lastName,  userPassword, address, city, contactNumber, userRole, email, businessID)
VALUES   ("Rachel123","Rachel","Young","password","","","","Admin","",1),
  ("Uma24","Uma","Christian","password","","","","Admin","",2),
  ("Cooper56","Cooper","Mcdowell","password","","","","Admin","",3),
  ("Curran69","Curran","Thomas","password","","","","Admin","",4),
  ("Fred16","Fredericka","Atkins","password","","","","Admin","",5),
  ("Daryl57","Daryl","Barrera","password","Ap #803-797 Neque Avenue","Wanaka","(365) 366-3826","seller","maecenas.libero@google.net",1),
  ("Colorado32","Colorado","Boyle","password","Ap #220-5493 Montes, Rd.","Kapiti","(859) 101-5102","buyer","molestie.orci@icloud.ca",2),
  ("Nicholas58","Nicholas","Tucker","password","Ap #433-3388 Euismod Ave","Matamata","(528) 896-8042","seller","mattis.semper.dui@yahoo.edu",3),
  ("Emi90","Emi","Vance","password","Ap #440-1198 Enim St.","Balclutha","(486) 771-5619","seller","aliquet.nec@icloud.ca",4),
  ("Raja123","Raja","Klein","password","672-969 Sed Av.","Waitara","(810) 892-9482","buyer","aliquet@protonmail.net",4);