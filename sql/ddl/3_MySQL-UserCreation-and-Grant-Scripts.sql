-- ==========================================================================================
--                     SQL Scripts for the DDL - User Creation and Grants
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
-- MySQL Scripts to create the User and Grant access rights

-- 1. Create a normal (standard) DB User for all the regular operations
--    If needed, later we can create a different user for the Administrative functionalities, Reporting etc.,

-- SELECT "======================================================================" AS '';
SELECT "          3. User Creation and Grant Scripts                          " AS "DEBUG_MSG" FROM DUAL;
-- SELECT "======================================================================" AS '';


/*
If this error comes-- Error#1396 - Operation CREATE USER failed for 'SMS_USER'@'localhost'
Solution:
drop user 'QB_USER'@'localhost';
flush privileges;
*/
CREATE USER 'SMS_USER'@'localhost' IDENTIFIED BY 'SMSUser123%';

SELECT " ...... User ['SMS_USER'@'localhost'] created successfully.... " AS "DEBUG_MSG" FROM DUAL;

-- Verify the user entry in the User table
/*SELECT * FROM mysql.user WHERE USER='SMS_USER';

SELECT " ...... User ['SMS_USER'@'localhost'] details are verified in the [MYSQL.USER] table .... " AS '';
*/

-- SELECT "              " AS '';

--\. 4_verify_user.sql
SELECT HOST, USER, PASSWORD FROM MYSQL.USER where USER='SMS_USER';

-- SELECT "                " AS '';

-- 2. Grant the privileges to SMS Database with all access
-- To use GRANT, you must have the GRANT OPTION privilege, and you must have the privileges that you are granting.
-- Ensure you have logged in with such a user, or execute this script with such an user.
-- GRANT ALL ON SMS.* TO 'SMS_USER'@'localhost';
GRANT ALL ON *.* TO 'SMS_USER'@'localhost';

SELECT " ... Permissions granted to the user [SMS_USER] on the database [SMS].... " AS "DEBUG_MSG" FROM DUAL;

-- SELECT "                             " AS '';

-- 3. Verify the grants to the user
SHOW GRANTS FOR 'SMS_USER'@'localhost';
SHOW GRANTS FOR 'raghs'@'localhost';
