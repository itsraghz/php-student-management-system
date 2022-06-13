# php-student-management-system
A PHP based web application to track the Student Management Application

```sh
cd C:\installedSoft\xampp\htdocs\sms
C:\installedSoft\xampp\htdocs\sms>rm -rf *
C:\installedSoft\xampp\htdocs\sms>cp -r \raghs\prfsnl\github-repos\web-dev-projects\01_student-mgmt-project\00-web-project\* .
C:\installedSoft\xampp\htdocs\sms>cp confidential\data\pics\* data\pics
C:\installedSoft\xampp\htdocs\sms>ls -ltrh data\pics
```

> A new try made on 17 Apr 2022 to test it in a higher version of XAMPP installed on D Drive,
and the project in C drive was renamed from `sms` to `bkup-2-17Apr2022-SMS-FKError`.

> Note: Ultimately the error was a Foreign key constraint thrown only on TblStudent with the UserId not being located,
and it was resolved after I removed the quotes surrounding the parameter names and values in the prepared statement.
I got a clue when  I tested the application in the higher version of XAMPP where it gave a different error that parameter
count does not match, which was even more confusing as all the parameters passed were in order.

```sh
cd D:\installedSoft\xampp-8.1.4\htdocs\sms
D:\installedSoft\xampp-8.1.4\htdocs\sms>cp -r c:\raghs\prfsnl\github-repos\web-dev-projects\01_student-mgmt-project\bkup-2-17Apr2022-SMS-FKError\* .
```

# Learnings

* https://stackoverflow.com/questions/47139800/how-to-fix-fatal-error-maximum-execution-time-of-30-seconds-exceeded
* https://stackoverflow.com/questions/15666893/log4php-file-size-error / https://stackoverflow.com/a/18789378/1001242

# User Guide

* Photo should be ONLY in '.jpg' format.
