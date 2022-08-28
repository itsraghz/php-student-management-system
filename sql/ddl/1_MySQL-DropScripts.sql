-- ==========================================================================================
--                     SQL Scripts for the DDL - Drop Tables, Database
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
-- MySQL Drop Scripts

-- SELECT "==========================================================" AS '';
SELECT "            1. Drop Scripts          " AS "SCRIPT File Name" FROM DUAL;
-- SELECT "==========================================================" AS '';

USE SMS;

-- Drop the table in the reverse order of dependency

DROP TABLE IF EXISTS SMS.TblFee;
DROP TABLE IF EXISTS SMS.TblFeeMaster;
DROP TABLE IF EXISTS SMS.TblStudent;
DROP TABLE IF EXISTS SMS.TblUserRole;
DROP TABLE IF EXISTS SMS.TblRole;
DROP TABLE IF EXISTS SMS.TblUser;
DROP TABLE IF EXISTS SMS.TblDepartment;
DROP TABLE IF EXISTS SMS.TblAdmission;

-- \! echo "... All the tables are dropped from the Database [SMS] ....";
SELECT  "... All the tables are dropped from the Database [SMS] ...." AS "DEBUG_MSG" FROM DUAL;

-- Drop the table at last
DROP DATABASE IF EXISTS SMS;

-- \! echo "... Successfully dropped the Database [SMS] ....";
SELECT "... Successfully dropped the Database [SMS] ...." AS "DEBUG_MSG" FROM DUAL;

-- Drop the User
DROP USER 'SMS_USER'@'localhost';

-- \! echo "... Successfully dropped the User [SMS_USER] ....";
SELECT "... Successfully dropped the User [SMS_USER] ...." AS "DEBUG_MSG" FROM DUAL;
