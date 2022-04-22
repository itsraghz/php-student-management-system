@ECHO OFF
REM command to run the MySQL Parent script
REM
REM The script should be run by a different user who can create a database (SMS)
REM and a new user (SMS_USER). Hence this should NOT be run by the same user 'raghs'.
REM
REM The order of execution goes as follows.
REM   1. Table Creation in order - inside the 'ddl' folder - same folder
REM   2. Insertion Script for the sample values (if needed) = in the 'dml' folder , a sibling folder
REM

REM does not work now, but it was working earlier
REM mysql -u"<userName>" -p"<password>" --table < ParentScript.sql

mysql -u"<userName>" -p"<password>" --table < ..\ddl\1_MySQL-DropScripts.sql
mysql -u"<userName>" -p"<password>" --table < ..\ddl\2_MySQL-TableCreationScripts.sql
mysql -u"<userName>" -p"<password>" --table < ..\ddl\3_MySQL-UserCreation-and-Grant-Scripts.sql
mysql -u"<userName>" -p"<password>" --table < ..\ddl\4_verify_user.sql

REM mysql -u"<userName>" -p"<password>" --table < ..\dml\1_MySQL-InsertScripts-sample.sql
mysql -u"<userName>" -p"<password>" --table < ..\dml\1_MySQL-InsertScripts.sql
