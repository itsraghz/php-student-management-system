@ECHO OFF

cls

SET PWD=%~dp0

@echo Started: %date% %time%

echo.
echo -----------------------------------------------------------------
echo 0. Current Working Directory is  :  %PWD%
echo -----------------------------------------------------------------
echo.

echo 1. Changing to the Directory C:\installedSoft\xampp\htdocs\sms
echo.
cd C:\installedSoft\xampp\htdocs\sms

echo.
echo --------------------------------------------
echo 2. Listing the directory contents to verify
echo --------------------------------------------
echo.
ls -ltr

echo.
echo -----------------------------------------
echo 3. Wiping off the folder contents
echo -----------------------------------------
echo.
rm -rf *

echo.
echo --------------------------------------------
echo 4. Listing the directory contents to verify
echo --------------------------------------------
echo.
ls -ltr

echo.
echo -----------------------------------------------------------------
echo 5. Do a recursive copy of all the contens of Dev Directory Server
echo -----------------------------------------------------------------
echo.
cp -r \raghs\prfsnl\github-repos\web-dev-projects\01_student-mgmt-project\00-web-project\* .

echo.
echo --------------------------------------------
echo 6. Listing the directory contents to verify
echo --------------------------------------------
echo.
ls -ltr

echo.
echo ------------------------------------------------------------------------
echo 7. Copying the profile pics from the confidential dir to the Server dir
echo ------------------------------------------------------------------------
echo.
cp confidential\data\pics\* data\pics

echo.
echo ------------------------------------------------------------------
echo 8. Verifying the contents of the data\pics directory of the Server
echo ------------------------------------------------------------------
echo.
ls -ltrh data\pics

echo.
echo ------------------------------------------
echo 9. Changing back to the original directory
echo ------------------------------------------
echo.
cd %PWD%

@echo Completed: %date% %time%
