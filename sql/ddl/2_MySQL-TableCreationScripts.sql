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

SELECT "..... Table [TblDepartment] created successfully!....." AS "DEBUG_MSG" FROM DUAL;

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

SELECT "..... Table [TblUser] created successfully!....." AS "DEBUG_MSG" FROM DUAL;

-- Query to get the CREATE TABLE Syntax/Statement of the particular table
SHOW CREATE TABLE TblUser;

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

SELECT "..... Table [TblRole] created successfully!....." AS "DEBUG_MSG" FROM DUAL;

CREATE TABLE TblUserRole
(
  Id int primary key auto_increment not null,
  UserId INT NOT NULL COMMENT 'The Id of the User',
  RoleId INT NOT NULL COMMENT 'The Id of the Role',
  -- PRIMARY KEY (UserId , RoleId),
  UNIQUE INDEX (UserId, RoleId),
  CONSTRAINT fk_UserRole_UserId
    FOREIGN KEY (UserId)
        REFERENCES TblUser(Id),
        -- ON UPDATE RESTRICT
        -- ON DELETE CASCADE,
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

SELECT "..... Table [TblUserRole] created successfully!....." AS "DEBUG_MSG" FROM DUAL;

CREATE TABLE TblStudent
(
  Id int primary key auto_increment not null,
  UserId INT NOT NULL COMMENT 'The Id of the User',
  RegnNo VARCHAR(15) UNIQUE NOT NULL,
  Name VARCHAR(50) NOT NULL,
  DOB DATE NOT NULL,
  Gender CHAR(1) NOT NULL,
  Department VARCHAR(50) NOT NULL,
  Year INT NOT NULL,
  AadhaarNo VARCHAR(12),
  FathersName VARCHAR(50) NOT NULL,
  MothersName VARCHAR(50) NOT NULL,
  Email VARCHAR(100) NOT NULL,
  Mobile VARCHAR(10) NOT NULL,
  Address VARCHAR(1000) NOT NULL,
  CONSTRAINT fk_TblStudent_UserId
    FOREIGN KEY (UserId)
        REFERENCES TblUser(Id),
        -- ON UPDATE RESTRICT
        -- ON DELETE RESTRICT
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
