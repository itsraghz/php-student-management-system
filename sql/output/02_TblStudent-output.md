# Table Student Creation

## Simple Table - to start with

```sql
MariaDB [sms]> CREATE TABLE TblStudent
    -> (
    ->   Id int primary key auto_increment not null,
    ->   UserId VARCHAR(50) UNIQUE NOT NULL,
    ->   Name VARCHAR(20) NOT NULL,
    ->   RegnNo VARCHAR(20) NOT NULL,
    ->   CONSTRAINT fk_User
    ->     FOREIGN KEY (UserId)
    ->         REFERENCES TblUser(UserId)
    -> );
Query OK, 0 rows affected (0.01 sec)

MariaDB [sms]> show tables;
+---------------+
| Tables_in_sms |
+---------------+
| tblstudent    |
| tbluser       |
+---------------+
2 rows in set (0.00 sec)

MariaDB [sms]> desc tblstudent;
+--------+-------------+------+-----+---------+----------------+
| Field  | Type        | Null | Key | Default | Extra          |
+--------+-------------+------+-----+---------+----------------+
| Id     | int(11)     | NO   | PRI | NULL    | auto_increment |
| UserId | varchar(50) | NO   | UNI | NULL    |                |
| Name   | varchar(20) | NO   |     | NULL    |                |
| RegnNo | varchar(20) | NO   |     | NULL    |                |
+--------+-------------+------+-----+---------+----------------+
4 rows in set (0.01 sec)

MariaDB [sms]>
```

### Insert Data - Simple Table to start with

```sql
MariaDB [sms]> INSERT INTO TblStudent (UserId, Name, RegnNo) VALUES ('S0001', 'Ganesh Kumar', '2022CSE01');
Query OK, 1 row affected (0.00 sec)

MariaDB [sms]> INSERT INTO TblStudent (UserId, Name, RegnNo) VALUES ('S001', 'Ganesh Kumar', '2022CSE01');
ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`sms`.`tblstudent`, CONSTRAINT `fk_User` FOREIGN KEY (`UserId`) REFERENCES `tbluser` (`UserId`))
MariaDB [sms]> INSERT INTO TblStudent (UserId, Name, RegnNo) VALUES ('S0002', 'Shanmugan', '2022CSE02');
Query OK, 1 row affected (0.00 sec)

MariaDB [sms]> select * from tbluser;
+----+--------+----------+
| Id | UserId | Password |
+----+--------+----------+
|  1 | S0001  | S0001    |
|  2 | S0002  | S0002    |
|  3 | S0003  | S0003    |
+----+--------+----------+
3 rows in set (0.00 sec)

MariaDB [sms]> select * from tblstudent;
+----+--------+--------------+-----------+
| Id | UserId | Name         | RegnNo    |
+----+--------+--------------+-----------+
|  1 | S0001  | Ganesh Kumar | 2022CSE01 |
|  2 | S0002  | Shanmugan    | 2022CSE02 |
+----+--------+--------------+-----------+
2 rows in set (0.00 sec)
```

## Detailed Table for Student

```sql
MariaDB [sms]> drop table tblstudent;
Query OK, 0 rows affected (0.00 sec)

MariaDB [sms]> CREATE TABLE TblStudent
    -> (
    ->   Id int primary key auto_increment not null,
    ->   RegnNo VARCHAR(50) UNIQUE NOT NULL,
    ->   Name VARCHAR(20) NOT NULL,
    ->   DOB DATE NOT NULL,
    ->   Gender CHAR(1) NOT NULL,
    ->   Course VARCHAR(50) NOT NULL,
    ->   FathersName VARCHAR(50),
    ->   MothersName VARCHAR(50),
    ->   Email VARCHAR(100),
    ->   Mobile VARCHAR(10),
    ->   Address VARCHAR(1000),
    ->   CONSTRAINT fk_User
    ->     FOREIGN KEY (RegnNo)
    ->         REFERENCES TblUser(UserId)
    -> );
Query OK, 0 rows affected (0.10 sec)

MariaDB [sms]> show tables;
+---------------+
| Tables_in_sms |
+---------------+
| tblstudent    |
| tbluser       |
+---------------+
2 rows in set (0.00 sec)

MariaDB [sms]> desc tblstudent;
+-------------+---------------+------+-----+---------+----------------+
| Field       | Type          | Null | Key | Default | Extra          |
+-------------+---------------+------+-----+---------+----------------+
| Id          | int(11)       | NO   | PRI | NULL    | auto_increment |
| RegnNo      | varchar(50)   | NO   | UNI | NULL    |                |
| Name        | varchar(20)   | NO   |     | NULL    |                |
| DOB         | date          | NO   |     | NULL    |                |
| Gender      | char(1)       | NO   |     | NULL    |                |
| Course      | varchar(50)   | NO   |     | NULL    |                |
| FathersName | varchar(50)   | YES  |     | NULL    |                |
| MothersName | varchar(50)   | YES  |     | NULL    |                |
| Email       | varchar(100)  | YES  |     | NULL    |                |
| Mobile      | varchar(10)   | YES  |     | NULL    |                |
| Address     | varchar(1000) | YES  |     | NULL    |                |
+-------------+---------------+------+-----+---------+----------------+
11 rows in set (0.01 sec)

MariaDB [sms]>
```

### Sample Data - detailed

```sql
MariaDB [sms]> INSERT INTO TblStudent (RegnNo, Name, DOB, Gender, Course, FathersName, MothersName, Email, Mobile, Address)
    -> VALUES ('S0001', 'Ganesh Kumar', '2000-01-01', 'M', 'B.Tech (CSE)', 'Shiva', 'Parvathi', 'lordganesha@heaven.com', '1234567890', 'Ganesha, No 1, Temple Street, Heaven');
Query OK, 1 row affected (0.01 sec)

MariaDB [sms]> INSERT INTO TblStudent (RegnNo, Name, DOB, Gender, Course, FathersName, MothersName, Email, Mobile, Address)
    -> VALUES ('S0002', 'Shanmugan', '2000-01-10', 'M', 'B.Tech (IT)', 'Shiva', 'Parvathi', 'lordmuruga@heaven.com', '2345678901', 'Shanmugan, No 1, Temple Street, Heaven');
Query OK, 1 row affected (0.01 sec)

MariaDB [sms]> select * from tblstudent;
+----+--------+--------------+------------+--------+--------------+-------------+-------------+------------------------+------------+----------------------------------------+
| Id | RegnNo | Name         | DOB        | Gender | Course       | FathersName | MothersName | Email                  | Mobile     | Address
                 |
+----+--------+--------------+------------+--------+--------------+-------------+-------------+------------------------+------------+----------------------------------------+
|  1 | S0001  | Ganesh Kumar | 2000-01-01 | M      | B.Tech (CSE) | Shiva       | Parvathi    | lordganesha@heaven.com | 1234567890 | Ganesha, No 1, Temple Street, Heaven   |
|  2 | S0002  | Shanmugan    | 2000-01-10 | M      | B.Tech (IT)  | Shiva       | Parvathi    | lordmuruga@heaven.com  | 2345678901 | Shanmugan, No 1, Temple Street, Heaven |
+----+--------+--------------+------------+--------+--------------+-------------+-------------+------------------------+------------+----------------------------------------+
2 rows in set (0.00 sec)

MariaDB [sms]>
```
