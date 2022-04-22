#!/bin/sh

# -----------------------------------------------------------
# A Script to move the contens from the Development directory
# to the Checkin directory for the GitHub Repository
#
# The script also takes care of the sensitive contents either
# by swapping it with the sample values, or removing it where
# necesary. 
#
# =========================================
#             VERSION HISTORY 
# =========================================
# 1. V 1.0 - 22 Apr 2022 - Initial Version
# 
# 
# -----------------------------------------------------------

## ------------------------------------------------------------------------
# Command to copy this shell script to the project development directory
## ------------------------------------------------------------------------
# cp cmdToCheckInToGitHub.sh /c/raghs/prfsnl/github-repos/web-dev-projects/01_student-mgmt-project/00-web-project/

## -------------------------------------------------------------------
## Step 1 - Change to the development directory
## -------------------------------------------------------------------
BASE_DIR=/c/raghs/prfsnl/github-repos/php-student-management-system

echo "BASE_DIR :: [${BASE_DIR}]"

cd ${BASE_DIR}

## -------------------------------------------------------------------
## Step 2 - Copy the contents of the directory to here
## -------------------------------------------------------------------
cp -r ../web-dev-projects/01_student-mgmt-project/00-web-project/* .


## -------------------------------------------------------------------
## Step 3 - Remove the confidential directory (as it contains the students 
## details including their profile pics, requirements in Image formats)
## -------------------------------------------------------------------
#rm -rf ${BASE_DIR}/confidential
rm -rf confidential
#echo "Successfully removed the directory - ${BASE_DIR}/confidential"

## -------------------------------------------------------------------
## Step 4- Swap the DB Connection
## -------------------------------------------------------------------
#rm -rf ${BASE_DIR}/db/connection.php
rm -rf db/connection.php
echo "[SUCCESS] Removedthe file - ${BASE_DIR}/db/connection.php"

#mv ${BASE_DIR}/db/connection0.php  ${BASE_DIR}/db/connection.php
mv db/connection0.php  db/connection.php
echo "[SUCCESS] Moved the file -> ${BASE_DIR}/db/connection0.php to ${BASE_DIR}/db/connection.php"

[ -f ${BASE_DIR}/db/connection.php ] && echo "[SUCCESS] DB connection file exists in ${BASE_DIR}/db/connection.php" || echo "!! [ERROR] !! -- DB connection db/connection.php file does not exist"
[ -f ${BASE_DIR}/db/connection0.php ] && echo "!! [ERROR] !! - DB connection file exists in ${BASE_DIR}/db/connection0.php" || echo "[SUCCESS] DB connection db/connection0.php file does not exist"

## -------------------------------------------------------------------
## Step 5 - Swap the DDL statements
## -------------------------------------------------------------------
# rm -rf ${BASE_DIR}/sql/ddl/consoleOutput/output_ParentScript.md
rm -rf sql/ddl/consoleOutput/output_ParentScript.md
echo "[SUCCESS] Removed the file -> ${BASE_DIR}/sql/ddl/consoleOutput/output_ParentScript.md"

# mv ${BASE_DIR}/sql/ddl/consoleOutput/output_ParentScript-sample.md  ${BASE_DIR}/sql/ddl/consoleOutput/output_ParentScript.md
mv sql/ddl/consoleOutput/output_ParentScript-sample.md  sql/ddl/consoleOutput/output_ParentScript.md
echo "[SUCCESS] Moved the file -> ${BASE_DIR}/sql/ddl/consoleOutput/output_ParentScript-sample.md to ${BASE_DIR}/sql/ddl/consoleOutput/output_ParentScript.md"

#rm -rf ${BASE_DIR}/sql/ddl/cmdToRunParentSQL.bat
rm -rf sql/ddl/cmdToRunParentSQL.bat
echo "[SUCCESS] Removed the file -> ${BASE_DIR}/sql/ddl/cmdToRunParentSQL.bat"
#rm -rf ${BASE_DIR}/sql/ddl/cmdToRunParentSQL.sh
rm -rf sql/ddl/cmdToRunParentSQL.sh
echo "[SUCCESS] Removed the file -> ${BASE_DIR}/sql/ddl/cmdToRunParentSQL.sh"

# mv ${BASE_DIR}/sql/ddl/cmdToRunParentSQL0.bat ${BASE_DIR}/sql/ddl/cmdToRunParentSQL.bat
mv sql/ddl/cmdToRunParentSQL0.bat sql/ddl/cmdToRunParentSQL.bat
echo "[SUCCESS] Moved the file -> ${BASE_DIR}/sql/ddl/cmdToRunParentSQL0.bat to ${BASE_DIR}/sql/ddl/cmdToRunParentSQL.bat"

# mv ${BASE_DIR}/sql/ddl/cmdToRunParentSQL0.sh ${BASE_DIR}/sql/ddl/cmdToRunParentSQL.sh
mv sql/ddl/cmdToRunParentSQL0.sh sql/ddl/cmdToRunParentSQL.sh
echo "[SUCCESS] Moved the file -> ${BASE_DIR}/sql/ddl/cmdToRunParentSQL0.sh to ${BASE_DIR}/sql/ddl/cmdToRunParentSQL.sh"

# [ -f ${BASE_DIR}/sql/ddl/cmdToRunParentSQL.bat ] && echo "[SUCCESS] The file ${BASE_DIR}/sql/ddl/cmdToRunParentSQL.bat is present" || echo "!! [ERROR] !! -- The file ${BASE_DIR}/sql/ddl/cmdToRunParentSQL.bat is NOT present"
[ -f sql/ddl/cmdToRunParentSQL.bat ] && echo "[SUCCESS] The file ${BASE_DIR}/sql/ddl/cmdToRunParentSQL.bat is present" || echo "!! [ERROR] !! -- The file ${BASE_DIR}/sql/ddl/cmdToRunParentSQL.bat is NOT present"

# [ -f ${BASE_DIR}/sql/ddl/cmdToRunParentSQL.sh ] && echo "[SUCCESS] The file ${BASE_DIR}/sql/ddl/cmdToRunParentSQL.sh is present" || echo "!! [ERROR] !! -- The file ${BASE_DIR}/sql/ddl/cmdToRunParentSQL.sh is NOT present"
[ -f sql/ddl/cmdToRunParentSQL.sh ] && echo "[SUCCESS] The file ${BASE_DIR}/sql/ddl/cmdToRunParentSQL.sh is present" || echo "!! [ERROR] !! -- The file ${BASE_DIR}/sql/ddl/cmdToRunParentSQL.sh is NOT present"

# [ -f ${BASE_DIR}/sql/ddl/cmdToRunParentSQL0.bat ] && echo "!! [ERROR] !! -- The file ${BASE_DIR}/sql/ddl/cmdToRunParentSQL0.bat is present" || echo "[SUCCESS] The file ${BASE_DIR}/sql/ddl/cmdToRunParentSQL0.bat is NOT present"
[ -f sql/ddl/cmdToRunParentSQL0.bat ] && echo "!! [ERROR] !! -- The file ${BASE_DIR}/sql/ddl/cmdToRunParentSQL0.bat is present" || echo "[SUCCESS] The file ${BASE_DIR}/sql/ddl/cmdToRunParentSQL0.bat is NOT present"

# [ -f ${BASE_DIR}/sql/ddl/cmdToRunParentSQL0.sh ] && echo "!! [ERROR] !! - The file ${BASE_DIR}/sql/ddl/cmdToRunParentSQL0.sh is present" || echo "[SUCCESS] The file ${BASE_DIR}/sql/ddl/cmdToRunParentSQL0.sh is NOT present"
[ -f sql/ddl/cmdToRunParentSQL0.sh ] && echo "!! [ERROR] !! - The file ${BASE_DIR}/sql/ddl/cmdToRunParentSQL0.sh is present" || echo "[SUCCESS] The file ${BASE_DIR}/sql/ddl/cmdToRunParentSQL0.sh is NOT present"

## -------------------------------------------------------------------
## Step 6 - Swap the DML statements
## -------------------------------------------------------------------
# rm -rf ${BASE_DIR}/sql/dml/1_MySQL-InsertScripts.sql
rm -rf sql/dml/1_MySQL-InsertScripts.sql
echo "[SUCCESS] Removed the file -> ${BASE_DIR}/sql/dml/1_MySQL-InsertScripts.sql"

# mv ${BASE_DIR}/sql/dml/1_MySQL-InsertScripts-sample.sqlt ${BASE_DIR}/sql/dml/1_MySQL-InsertScripts.sql
mv sql/dml/1_MySQL-InsertScripts-sample.sql sql/dml/1_MySQL-InsertScripts.sql
echo "[SUCCESS] Moved the file -> ${BASE_DIR}/sql/dml/1_MySQL-InsertScripts-sample.sql to ${BASE_DIR}/sql/dml/1_MySQL-InsertScripts.sql"

## -------------------------------------------------------------------
## Issue the Git Status
## -------------------------------------------------------------------
git status

