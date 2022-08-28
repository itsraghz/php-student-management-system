-- ==========================================================================================
--                      SQL Scripts for the DML - Sample Values
-- ==========================================================================================
--
-- Version History
-- ---------------
--
-- ------------------------------------------------------------------------------------------
-- | Date        |  Author   |      Description                                             |
-- ------------------------------------------------------------------------------------------
-- | 20-Apr-2022 | Raghavan  |  Initial Version                                             |
-- |             |           |                                                              |
-- |             |           |                                                              |
-- ==========================================================================================
--
-- SELECT "==========================================================" AS '';
SELECT "            1. Insert Scripts          " AS "DEBUG_MSG" FROM DUAL;
-- SELECT "==========================================================" AS '';

USE SMS;

-- =============================================================
--   INSERT DATA into TblDepartment
-- =============================================================
INSERT INTO TblDepartment
	(Name, shortName)
VALUES
	("Electronics & Communications Engineering", "B.E (ECE)"),
	("Electrical & Electronics Engineering", "B.E (EEE"),
	("Computer Science Engineering", "B.E (CSE"),
	("Mechanical Engineering", "B.E (Mech"),
	("Civil Engineering", "B.E (Civil");

--
SELECT "... Successfully inserted the sample values into the table [TblDepartment]  ...." AS "DEBUG_MSG" FROM DUAL;
--
-- =============================================================
--   INSERT DATA into TblUser
-- =============================================================
INSERT INTO TblUser
  (UserId, Password)
VALUES
  ("Admin", "Admin"),
  ("Accounts", "Accounts"),
  ("hod.ece", "hod.ece"),
  ("hod.eee", "hod.eee"),
  ("hod.cse", "hod.cse"),
  ("hod.mech", "hod.mech"),
  ("hod.civil", "hod.civil"),
  ("2018-BE-ECE-123", "2018-BE-ECE-123"),
  ("2018-BE-ECE-124", "2018-BE-ECE-124"),
  ("2018-BE-ECE-125", "2018-BE-ECE-125"),
  ("2018-BE-ECE-126", "2018-BE-ECE-126");

--
SELECT "... Successfully inserted the sample values into the table [TblUser]  ...." AS "DEBUG_MSG" FROM DUAL;
--

-- =============================================================
--   INSERT DATA into TblRole
-- =============================================================

INSERT INTO TblRole
  (Name, Description)
VALUES
  ('Admin', "An Administrative User will have all privileges in the System"),
  ('Accounts', "An Accounts User with an exclusive access to the Finances"),
  ('Staff', "A Staff User having a few additional privileges"),
  ('Student', "A Student User with very less privileges");
--
SELECT "... Successfully inserted the sample values into the table [TblRole]  ...." AS "DEBUG_MSG" FROM DUAL;
--
-- =============================================================
--   INSERT DATA into TblUserRole
-- =============================================================
INSERT INTO TblUserRole
  (UserId, RoleId)
VALUES
  (1, 1), -- Admin, Admin
  (2, 2), -- Accounts, Accounts
  (3, 3), -- hod.ece, Staff
  (3, 2), -- hod.ece, Accounts
  (4, 3), -- hod.eee, Staff
  (5, 3), -- hod.cse, Staff
  (6, 3), -- hod.mech, Staff
  (7, 3), -- hod.civil, Staff
  (8, 4), -- Student
  (9, 4), -- Student
  (10, 4), -- Student
  (11, 4); -- Student
--
--
SELECT "... Successfully inserted the sample values into the table [TblUserRole]  ...." AS "DEBUG_MSG" FROM DUAL;
--
-- =============================================================
--   INSERT DATA into TblReligion
-- =============================================================

INSERT INTO TblReligion
  (Name)
VALUES
  ("Hindu"),
	("Muslim"),
	("Christian"),
	("Jain"),
	("Sikh");
--
SELECT "... Successfully inserted the sample values into the table [TblReligion]  ...." AS "DEBUG_MSG" FROM DUAL;
--
--
-- =============================================================
--   INSERT DATA into TblCommunity
-- =============================================================

INSERT INTO TblCommunity
  (Name)
VALUES
  ("Chettiyar"),
	("Mudlaiyar"),
	("Nadar"),
	("Thevar"),
	("Vallambar"),
	("Ambalam");
--
SELECT "... Successfully inserted the sample values into the table [TblCommunity]  ...." AS "DEBUG_MSG" FROM DUAL;
--
-- =============================================================
--   INSERT DATA into TblStudent
-- =============================================================
INSERT INTO TblStudent
  (UserId, RegnNo, Name, DOB, Gender, DeptId, Year, AadhaarNo, FathersName, MothersName, ReligionId, CommunityId, Email, Mobile, Address)
VALUES
  (8, '2018-BE-ECE-123', 'Ram', '2001-01-06', 'M', 1, 4, '1234567890', 'Shanmugam', 'Parvathi', 1, 1, 'user1@example.com', '123456789', 'Flat 2B, Prime Rose Apartments, Karaikudi'),
  (9, '2018-BE-ECE-124', 'Raja', '2001-06-28', 'M', 1, 4, '2345678901', 'Manickam', 'Muthazhagu', 1, 2, 'user2@example.com', '234567891', "224, Indra Nagar, Madurai"),
  (10, '2018-BE-ECE-125', 'Priya', '2001-03-30', 'F', 1, 4, '3456789012','Vijayakumar','Muthuselvi', 1, 3, 'user3@example.com','345678912',"#12, Sivan Sannadhi, Karaikudi"),
  (11, '2018-BE-ECE-126', 'Gayathri', '2001-04-17', 'F', 1, 4, '3456789012', 'Kamaraj','Chellammal', 1, 4, 'user4@example.com','456789123',"5, Pillaiyar Kovil Street, Yembal, Pudukkottai District");
--
SELECT * from TblDepartment;

SELECT * from TblUser;

SELECT * FROM TblRole;

SELECT * FROM TblUserRole;
--
select
  a.id, a.userid, c.roleid, b.name, b.description
from
  TblUser a, TblRole b, TblUserRole c
where
  a.id=c.userid
  and b.id=c.roleid;
--
select
  a.userid, b.name
from
  TblUser a, TblRole b, TblUserRole c
where
  a.id=c.userid
  and b.id=c.roleid
-- group by
  -- a.userid, c.roleid
order by
  a.id;
--
SELECT * FROM TblStudent;
