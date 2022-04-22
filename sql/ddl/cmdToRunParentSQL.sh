# command to run the MySQL Parent script
#
# The script should be run by a different user who can create a database (SMS)
# and a new user (SMS_USER). Hence this should NOT be run by the same user 'SMS_USER'.
#
# The order of execution goes as follows.
#   1. Table Creation in order - inside the 'ddl' folder - same folder
#   2. Insertion Script for the sample values (if needed) = in the 'dml' folder , a sibling folder
#
/opt/lampp/bin/mysql -u"<userName>" -p"<password>" < ParentScript.sql
/opt/lampp/bin/mysql -u"<userName>" -p"<password>" < ..\dml\1_MySQL-InsertScripts.sql
