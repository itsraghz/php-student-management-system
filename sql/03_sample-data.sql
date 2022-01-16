USE SMS;

-- 1. Sample Data for TblUser
INSERT INTO TblUser (UserId, Password) VALUES ("S0001", "S0001");
INSERT INTO TblUser (UserId, Password) VALUES ("S0002", "S0002");

--2. Sample Data for TblStudent - Simple

/*INSERT INTO TblStudent (UserId, Name, RegnNo) VALUES ('S0001', 'Ganesh Kumar', '2022CSE01');
INSERT INTO TblStudent (UserId, Name, RegnNo) VALUES ('S0002', 'Shanmugan', '2022CSE02'); */

--2. Sample Data for TblStudent - Detailed

INSERT INTO TblStudent (RegnNo, Name, DOB, Gender, Department, Year, AadhaarNo, FathersName, MothersName, Email, Mobile, Address)
VALUES ('S0001', 'Ganesh Kumar', '2000-01-01', 'M', 'B.Tech (CSE)', 1, '123456789012', 'Shiva', 'Parvathi', 'lordganesha@heaven.com', '1234567890', 'Ganesha, No 1, Temple Street, Heaven');
INSERT INTO TblStudent (RegnNo, Name, DOB, Gender, Department, Year, AadhaarNo, FathersName, MothersName, Email, Mobile, Address)
VALUES ('S0002', 'Shanmugan', '2000-01-10', 'M', 'B.Tech (IT)', 2, '234567890123', 'Shiva', 'Parvathi', 'lordmuruga@heaven.com', '2345678901', 'Shanmugan, No 1, Temple Street, Heaven');

