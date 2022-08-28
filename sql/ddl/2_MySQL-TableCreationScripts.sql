-- ==========================================================================================
--                      SQL Scripts for the DDL - Create Tables
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

-- SELECT "======================================================================" AS '';
SELECT "          2. Table Creation and Grant Scripts         " AS "DEBUG_MSG" FROM DUAL;
-- SELECT "======================================================================" AS '';

CREATE DATABASE IF NOT EXISTS SMS
CHARACTER SET UTF8
COLLATE utf8_general_ci;

-- \! echo "..... Database [SMS] created successfully!....."
SELECT "..... Database [SMS] created successfully!....." AS "DEBUG_MSG" FROM DUAL;

USE SMS;

set global sql_mode = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- It will supress the need for default value of all Date Columns

SELECT ".....GLOBAL SQL_MODE SET..........." AS "DEBUG_MSG" FROM DUAL;
--
CREATE TABLE IF NOT EXISTS TblAdmission
(
	Id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
	Mode CHAR(1) UNIQUE NOT NULL COMMENT 'M-Management, C-Counselling etc.,',
	Remarks VARCHAR(50),
	IS_ACTIVE CHAR(1) DEFAULT 'Y' COMMENT 'To track whether or not an user is active',
	CREATED_DATE DATETIME DEFAULT CURRENT_TIMESTAMP,
	CREATED_BY VARCHAR(50) DEFAULT 'SYSTEM',
	MODIFIED_DATE DATETIME default '0000-00-00 00:00:00' ON UPDATE now(),
	MODIFIED_BY VARCHAR(50) DEFAULT NULL
)ENGINE=INNODB CHARACTER SET utf8 COLLATE utf8_general_ci;
--
SELECT "..... Table [TblAdmission] created successfully!....." AS "DEBUG_MSG" FROM DUAL;
--
SHOW CREATE TABLE TblAdmission;
--
CREATE TABLE IF NOT EXISTS TblDepartment
(
	Id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
	Name VARCHAR(50) UNIQUE NOT NULL,
	shortName VARCHAR(10) NOT NULL,
	IS_ACTIVE CHAR(1) DEFAULT 'Y' COMMENT 'To track whether or not an user is active',
	CREATED_DATE DATETIME DEFAULT CURRENT_TIMESTAMP,
	CREATED_BY VARCHAR(50) DEFAULT 'SYSTEM',
	MODIFIED_DATE DATETIME default '0000-00-00 00:00:00' ON UPDATE now(),
	MODIFIED_BY VARCHAR(50) DEFAULT NULL
)ENGINE=INNODB CHARACTER SET utf8 COLLATE utf8_general_ci;
--
SELECT "..... Table [TblDepartment] created successfully!....." AS "DEBUG_MSG" FROM DUAL;
--
SHOW CREATE TABLE TblDepartment;
--
CREATE TABLE TblUser
(
  Id int primary key auto_increment not null,
  UserId VARCHAR(50) UNIQUE NOT NULL,
  Password VARCHAR(50) NOT NULL,
  IS_ACTIVE CHAR(1) DEFAULT 'Y' COMMENT 'To track whether or not it is active',
  CREATED_DATE DATETIME DEFAULT CURRENT_TIMESTAMP,
  CREATED_BY VARCHAR(50) DEFAULT 'SYSTEM',
  MODIFIED_DATE DATETIME default NULL ON UPDATE now(),
  MODIFIED_BY VARCHAR(50) DEFAULT NULL
) ENGINE=INNODB CHARACTER SET utf8 COLLATE utf8_general_ci;
--
SELECT "..... Table [TblUser] created successfully!....." AS "DEBUG_MSG" FROM DUAL;
--
-- Query to get the CREATE TABLE Syntax/Statement of the particular table
SHOW CREATE TABLE TblUser;
--
CREATE TABLE TblRole
(
  Id int primary key auto_increment not null,
  Name VARCHAR(50) UNIQUE NOT NULL COMMENT 'The name of the Role',
  Description VARCHAR(100) NOT NULL COMMENT 'The Description of the Role',
  IS_ACTIVE CHAR(1) DEFAULT 'Y' COMMENT 'To track whether or not it is active',
  CREATED_DATE DATETIME DEFAULT CURRENT_TIMESTAMP,
  CREATED_BY VARCHAR(50) DEFAULT 'SYSTEM',
  MODIFIED_DATE DATETIME default NULL ON UPDATE now(),
  MODIFIED_BY VARCHAR(50) DEFAULT NULL
) ENGINE=INNODB CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Query to get the CREATE TABLE Syntax/Statement of the particular table
SHOW CREATE TABLE TblRole;
--
SELECT "..... Table [TblRole] created successfully!....." AS "DEBUG_MSG" FROM DUAL;
--
CREATE TABLE TblUserRole
(
  Id int primary key auto_increment not null,
  UserId INT NOT NULL COMMENT 'The Id of the User',
  RoleId INT NOT NULL COMMENT 'The Id of the Role',
  -- PRIMARY KEY (UserId , RoleId),
  UNIQUE INDEX (UserId, RoleId),
  CONSTRAINT fk_UserRole_UserId
    FOREIGN KEY (UserId)
        REFERENCES TblUser(Id)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
  CONSTRAINT fk_UserRole_RoleId
    FOREIGN KEY (RoleId)
        REFERENCES TblRole(Id),
        -- ON UPDATE RESTRICT
        -- ON DELETE CASCADE
  IS_ACTIVE CHAR(1) DEFAULT 'Y' COMMENT 'To track whether or not it is active',
  CREATED_DATE DATETIME DEFAULT CURRENT_TIMESTAMP,
  CREATED_BY VARCHAR(50) DEFAULT 'SYSTEM',
  MODIFIED_DATE DATETIME default NULL ON UPDATE now(),
  MODIFIED_BY VARCHAR(50) DEFAULT NULL
) ENGINE=INNODB CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Query to get the CREATE TABLE Syntax/Statement of the particular table
SHOW CREATE TABLE TblUserRole;
--
SELECT "..... Table [TblUserRole] created successfully!....." AS "DEBUG_MSG" FROM DUAL;
--
CREATE TABLE TblReligion
(
  Id int primary key auto_increment not null,
  Name VARCHAR(10) UNIQUE NOT NULL COMMENT 'The name of the Religion',
  Remarks VARCHAR(50) COMMENT 'The Remarks if any of the Religion',
  IS_ACTIVE CHAR(1) DEFAULT 'Y' COMMENT 'To track whether or not it is active',
  CREATED_DATE DATETIME DEFAULT CURRENT_TIMESTAMP,
  CREATED_BY VARCHAR(50) DEFAULT 'SYSTEM',
  MODIFIED_DATE DATETIME default NULL ON UPDATE now(),
  MODIFIED_BY VARCHAR(50) DEFAULT NULL
) ENGINE=INNODB CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Query to get the CREATE TABLE Syntax/Statement of the particular table
SHOW CREATE TABLE TblReligion;
--
SELECT "..... Table [TblReligion] created successfully!....." AS "DEBUG_MSG" FROM DUAL;
--
CREATE TABLE TblCommunity
(
  Id int primary key auto_increment not null,
  Name VARCHAR(20) UNIQUE NOT NULL COMMENT 'The name of the TblCommunity',
  Remarks VARCHAR(50) COMMENT 'The Remarks if any of the TblCommunity',
  IS_ACTIVE CHAR(1) DEFAULT 'Y' COMMENT 'To track whether or not it is active',
  CREATED_DATE DATETIME DEFAULT CURRENT_TIMESTAMP,
  CREATED_BY VARCHAR(50) DEFAULT 'SYSTEM',
  MODIFIED_DATE DATETIME default NULL ON UPDATE now(),
  MODIFIED_BY VARCHAR(50) DEFAULT NULL
) ENGINE=INNODB CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Query to get the CREATE TABLE Syntax/Statement of the particular table
SHOW CREATE TABLE TblCommunity;
--
SELECT "..... Table [TblCommunity] created successfully!....." AS "DEBUG_MSG" FROM DUAL;
--
--
CREATE TABLE TblStudent
(
  Id int primary key auto_increment not null,
  UserId INT NOT NULL COMMENT 'The Id of the User',
  RegnNo VARCHAR(15) UNIQUE NOT NULL,
	ModeId INT NOT NULL DEFAULT '1' COMMENT 'Mode of Admission referring to the TblAdmission',
  Name VARCHAR(50) NOT NULL,
  DOB DATE NOT NULL,
  Gender CHAR(1) NOT NULL,
  DeptId INT NOT NULL,
  Year INT NOT NULL,
  AadhaarNo VARCHAR(12),
  FathersName VARCHAR(50) NOT NULL,
  MothersName VARCHAR(50) NOT NULL,
	ReligionId INT NOT NULL DEFAULT 1,
	CommunityId INT COMMENT 'Optional Community under a specific Religion',
  Email VARCHAR(100) NOT NULL,
  Mobile VARCHAR(10) NOT NULL,
  Address VARCHAR(1000) NOT NULL,
  CONSTRAINT fk_TblStudent_UserId
    FOREIGN KEY (UserId)
        REFERENCES TblUser(Id)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
	CONSTRAINT fk_TblStudent_ModeId
    FOREIGN KEY (ModeId)
        REFERENCES TblAdmission(Id)
        -- ON UPDATE RESTRICT
         ON DELETE RESTRICT,
	CONSTRAINT fk_TblStudent_DeptId
    FOREIGN KEY (DeptId)
        REFERENCES TblDepartment(Id)
        -- ON UPDATE RESTRICT
         ON DELETE RESTRICT,
	 CONSTRAINT fk_TblStudent_ReligionId
     FOREIGN KEY (ReligionId)
         REFERENCES TblReligion(Id)
          ON UPDATE CASCADE
          ON DELETE RESTRICT,
	CONSTRAINT fk_TblStudent_CommunityId
    FOREIGN KEY (CommunityId)
        REFERENCES TblCommunity(Id)
         ON UPDATE CASCADE
         ON DELETE RESTRICT,
  IS_ACTIVE CHAR(1) DEFAULT 'Y' COMMENT 'To track whether or not it is active',
  CREATED_DATE DATETIME DEFAULT CURRENT_TIMESTAMP,
  CREATED_BY VARCHAR(50) DEFAULT 'SYSTEM',
  MODIFIED_DATE DATETIME default NULL ON UPDATE now(),
  MODIFIED_BY VARCHAR(50) DEFAULT NULL
) ENGINE=INNODB CHARACTER SET utf8 COLLATE utf8_general_ci;

SELECT "..... Table [TblStudent] created successfully!....." AS "DEBUG_MSG" FROM DUAL;
--

-- Query to get the CREATE TABLE Syntax/Statement of the particular table
SELECT "..... SHOW CREATE TABLE TblStudent ...... " AS "DEBUG_MSG" FROM DUAL;
--
SHOW CREATE TABLE TblStudent;
--
CREATE TABLE TblFeeType
(
	Id int primary key auto_increment not null,
	Type VARCHAR(20) NOT NULL UNIQUE COMMENT 'The Type of the Fee  - Admission, Tuition, lab, Transportation etc.,',
	Remarks VARCHAR(50),
	IS_ACTIVE CHAR(1) DEFAULT 'Y' COMMENT 'To track whether or not it is active',
  CREATED_DATE DATETIME DEFAULT CURRENT_TIMESTAMP,
  CREATED_BY VARCHAR(50) DEFAULT 'SYSTEM',
  MODIFIED_DATE DATETIME default NULL ON UPDATE now(),
  MODIFIED_BY VARCHAR(50) DEFAULT NULL
) ENGINE=INNODB CHARACTER SET utf8 COLLATE utf8_general_ci;

SELECT "..... Table [TblFeeType] created successfully!....." AS "DEBUG_MSG" FROM DUAL;
--

-- Query to get the CREATE TABLE Syntax/Statement of the particular table
SELECT "..... SHOW CREATE TABLE TblFeeType ...... " AS "DEBUG_MSG" FROM DUAL;
--
SHOW CREATE TABLE TblFeeType;
--
--
CREATE TABLE TblFeeMaster
(
	Id int primary key auto_increment not null,
	DeptId INT COMMENT 'Optional DepartmentId for which the fees is captured, if absent the fee is common for all Departments',
	Year VARCHAR(10) not null COMMENT 'Fees for the particular year - Ex 2021-22 OR 1,2,3,4 etc.,',
	Semester INT COMMENT 'Optional Semesterwise fees if applicable',
	FeeTypeId INT NOT NULL COMMENT 'The Type of the Fee  - Admission, Tuition, lab, Transportation etc.,',
	Amount INT NOT NULL COMMENT 'Actual fees for a particular type',
	Remarks VARCHAR(50),
	IS_ACTIVE CHAR(1) DEFAULT 'Y' COMMENT 'To track whether or not it is active',
  CREATED_DATE DATETIME DEFAULT CURRENT_TIMESTAMP,
  CREATED_BY VARCHAR(50) DEFAULT 'SYSTEM',
  MODIFIED_DATE DATETIME default NULL ON UPDATE now(),
  MODIFIED_BY VARCHAR(50) DEFAULT NULL
) ENGINE=INNODB CHARACTER SET utf8 COLLATE utf8_general_ci
	COMMENT 'A master table to hold all the different type of fees for each year';

SELECT "..... Table [TblFeeMaster] created successfully!....." AS "DEBUG_MSG" FROM DUAL;
--

-- Query to get the CREATE TABLE Syntax/Statement of the particular table
SELECT "..... SHOW CREATE TABLE TblFeeMaster ...... " AS "DEBUG_MSG" FROM DUAL;
--
SHOW CREATE TABLE TblFeeMaster;
--
CREATE TABLE TblFee
(
  Id int primary key auto_increment not null,
	UserId INT NOT NULL,
	Year INT NOT NULL,
  FeeTypeId INT NOT NULL,
	Amount INT NOT NULL Comment 'The actual fees paid for a student',
  Remarks VARCHAR(50),
	CONSTRAINT fk_TblFee_UserId
		FOREIGN KEY (UserId)
				REFERENCES TblUser(Id)
				ON UPDATE CASCADE
				ON DELETE CASCADE,
  CONSTRAINT fk_TblFee_FeeTypeId
    FOREIGN KEY (FeeTypeId)
        REFERENCES TblFeeType(Id),
        -- ON UPDATE RESTRICT
        -- ON DELETE RESTRICT,
  IS_ACTIVE CHAR(1) DEFAULT 'Y' COMMENT 'To track whether or not it is active',
  CREATED_DATE DATETIME DEFAULT CURRENT_TIMESTAMP,
  CREATED_BY VARCHAR(50) DEFAULT 'SYSTEM',
  MODIFIED_DATE DATETIME default NULL ON UPDATE now(),
  MODIFIED_BY VARCHAR(50) DEFAULT NULL
) ENGINE=INNODB CHARACTER SET utf8 COLLATE utf8_general_ci;

SELECT "..... Table [TblFee] created successfully!....." AS "DEBUG_MSG" FROM DUAL;
--

-- Query to get the CREATE TABLE Syntax/Statement of the particular table
SELECT "..... SHOW CREATE TABLE TblFee ...... " AS "DEBUG_MSG" FROM DUAL;
--
SHOW CREATE TABLE TblFee;

-- Query to get all the Schema named SMS
SELECT "Query to get all the Schema named SMS" AS "DEBUG_MSG" FROM DUAL;
--
select distinct
  table_catalog, table_schema, engine, version
from
  information_schema.tables
where
  table_schema='SMS';

-- Query to get all the tables in the schema SMS
SELECT "Query to get all the tables in the schema SMS" AS "DEBUG_MSG" FROM DUAL;
--
select distinct
  table_schema, engine, table_name, table_type, version, create_time, update_time, table_collation, index_length, auto_increment
from
  information_schema.tables
where
  table_schema='SMS';

-- Query to get all the constraints in the table of a particular Schema
SELECT
  TABLE_SCHEMA, TABLE_NAME, COLUMN_NAME, CONSTRAINT_NAME
FROM
  INFORMATION_SCHEMA.KEY_COLUMN_USAGE
WHERE
  REFERENCED_TABLE_SCHEMA IS NOT NULL
  AND TABLE_SCHEMA LIKE '%sms%';

-- SELECT * FROM INFORMATION_SCHEMA.INNODB_SYS_FOREIGN \G;
SELECT
  *
FROM
  INFORMATION_SCHEMA.INNODB_SYS_FOREIGN
WHERE
  ID like '%sms%';

-- SELECT * FROM INFORMATION_SCHEMA.INNODB_SYS_FOREIGN_COLS \G;
SELECT
  *
FROM
  INFORMATION_SCHEMA.INNODB_SYS_FOREIGN_COLS
WHERE
  ID like '%sms%';
--

-- Query to get all the columns names of a table in CSV format
-- Schema is dynamically obtained via DATABASE() function
SELECT
    CONCAT('\'',
            GROUP_CONCAT(column_name
                ORDER BY ordinal_position
                SEPARATOR '\', \''),
            '\'') AS columns
FROM
    information_schema.columns
WHERE
    table_schema = DATABASE()
        AND table_name = 'TblFee';
--
-- Query to get all the columns of a table using 'SHOW COLUMNS'
show columns from tblfee;
--
