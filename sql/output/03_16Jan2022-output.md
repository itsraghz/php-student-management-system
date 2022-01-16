# 16 Jan 2022 Saturday

## Changes

* DB Design Change - Add Year, AadhaarCard in the TblStudent

## Output

```sql
MariaDB [sms]> drop table TblUser;
ERROR 1451 (23000): Cannot delete or update a parent row: a foreign key constraint fails
MariaDB [sms]> drop table TblStudent;
Query OK, 0 rows affected (0.02 sec)

MariaDB [sms]> drop table TblUser;
Query OK, 0 rows affected (0.00 sec)

MariaDB [sms]> CREATE TABLE TblUser
    -> (
    ->   Id int primary key auto_increment not null,
    ->   UserId VARCHAR(50) UNIQUE NOT NULL,
    ->   Password VARCHAR(50) NOT NULL
    -> );
Query OK, 0 rows affected (0.36 sec)

MariaDB [sms]> CREATE TABLE TblStudent
    -> (
    ->   Id int primary key auto_increment not null,
    ->   RegnNo VARCHAR(50) UNIQUE NOT NULL,
    ->   Name VARCHAR(20) NOT NULL,
    ->   DOB DATE NOT NULL,
    ->   Gender CHAR(1) NOT NULL,
    ->   Department VARCHAR(50) NOT NULL,
    ->   Year INT NOT NULL,
    ->   AadhaarNo VARCHAR(12),
    ->   FathersName VARCHAR(50),
    ->   MothersName VARCHAR(50),
    ->   Email VARCHAR(100),
    ->   Mobile VARCHAR(10),
    ->   Address VARCHAR(1000),
    ->   CONSTRAINT fk_User
    ->     FOREIGN KEY (RegnNo)
    ->         REFERENCES TblUser(UserId)
    -> );
Query OK, 0 rows affected (0.03 sec)

MariaDB [sms]> INSERT INTO TblUser (UserId, Password) VALUES ("S0001", "S0001");
Query OK, 1 row affected (0.00 sec)

MariaDB [sms]> INSERT INTO TblUser (UserId, Password) VALUES ("S0002", "S0002");
Query OK, 1 row affected (0.00 sec)

MariaDB [sms]> show tables;
+---------------+
| Tables_in_sms |
+---------------+
| tblstudent    |
| tbluser       |
+---------------+
2 rows in set (0.00 sec)

MariaDB [sms]> desc tbluser;
+----------+-------------+------+-----+---------+----------------+
| Field    | Type        | Null | Key | Default | Extra          |
+----------+-------------+------+-----+---------+----------------+
| Id       | int(11)     | NO   | PRI | NULL    | auto_increment |
| UserId   | varchar(50) | NO   | UNI | NULL    |                |
| Password | varchar(50) | NO   |     | NULL    |                |
+----------+-------------+------+-----+---------+----------------+
3 rows in set (0.00 sec)

MariaDB [sms]> desc tblstudent;
+-------------+---------------+------+-----+---------+----------------+
| Field       | Type          | Null | Key | Default | Extra          |
+-------------+---------------+------+-----+---------+----------------+
| Id          | int(11)       | NO   | PRI | NULL    | auto_increment |
| RegnNo      | varchar(50)   | NO   | UNI | NULL    |                |
| Name        | varchar(20)   | NO   |     | NULL    |                |
| DOB         | date          | NO   |     | NULL    |                |
| Gender      | char(1)       | NO   |     | NULL    |                |
| Department  | varchar(50)   | NO   |     | NULL    |                |
| Year        | int(11)       | NO   |     | NULL    |                |
| AadhaarNo   | varchar(12)   | YES  |     | NULL    |                |
| FathersName | varchar(50)   | YES  |     | NULL    |                |
| MothersName | varchar(50)   | YES  |     | NULL    |                |
| Email       | varchar(100)  | YES  |     | NULL    |                |
| Mobile      | varchar(10)   | YES  |     | NULL    |                |
| Address     | varchar(1000) | YES  |     | NULL    |                |
+-------------+---------------+------+-----+---------+----------------+
13 rows in set (0.02 sec)

MariaDB [sms]> select * from tbluser;
+----+--------------+--------------+
| Id | UserId       | Password     |
+----+--------------+--------------+
|  1 | S0001        | S0001        |
|  2 | S0002        | S0002        |
|  3 | 912518106005 | 912518106005 |
|  4 | 912518106002 | 912518106002 |
+----+--------------+--------------+
4 rows in set (0.00 sec)

MariaDB [sms]> INSERT INTO TblStudent (RegnNo, Name, DOB, Gender, Department, Year, AadhaarNo, FathersName, MothersName, Email, Mobile, Address)
    -> VALUES ('S0001', 'Ganesh Kumar', '2000-01-01', 'M', 'B.Tech (CSE)', 1, '123456789012', 'Shiva', 'Parvathi', 'lordganesha@heaven.com', '1234567890', 'Ganesha, No 1, Temple Street, Heaven');
Query OK, 1 row affected (0.00 sec)

MariaDB [sms]> INSERT INTO TblStudent (RegnNo, Name, DOB, Gender, Department, Year, AadhaarNo, FathersName, MothersName, Email, Mobile, Address)
    -> VALUES ('S0002', 'Shanmugan', '2000-01-10', 'M', 'B.Tech (IT)', 2, '234567890123', 'Shiva', 'Parvathi', 'lordmuruga@heaven.com', '2345678901', 'Shanmugan, No 1, Temple Street, Heaven');
Query OK, 1 row affected (0.00 sec)


MariaDB [sms]> select * from tblstudent;
+----+--------------+--------------------+------------+--------+--------------+------+--------------+----------------+-------------+----------------------------+------------+--------------------------------------------------------------------------+
| Id | RegnNo       | Name               | DOB        | Gender | Department   | Year | AadhaarNo    | FathersName    | MothersName | Email
    | Mobile     | Address                                                                  |
+----+--------------+--------------------+------------+--------+--------------+------+--------------+----------------+-------------+----------------------------+------------+--------------------------------------------------------------------------+
|  1 | S0001        | Ganesh Kumar       | 2000-01-01 | M      | B.Tech (CSE) |    1 | 123456789012 | Shiva          | Parvathi    | lordganesha@heaven.com     | 1234567890 | Ganesha, No 1, Temple Street, Heaven                                     |
|  2 | S0002        | Shanmugan          | 2000-01-10 | M      | B.Tech (IT)  |    2 | 234567890123 | Shiva          | Parvathi    | lordmuruga@heaven.com      | 2345678901 | Shanmugan, No 1, Temple Street, Heaven                                   |
+----+--------------+--------------------+------------+--------+--------------+------+--------------+----------------+-------------+----------------------------+------------+--------------------------------------------------------------------------+
4 rows in set (0.00 sec)

MariaDB [sms]>
```
