# Table User Creation with Database and Sample Data

```sql
C:\installedSoft\xampp\mysql\bin>mysql -u raghs -p
Enter password: *************
Welcome to the MariaDB monitor.  Commands end with ; or \g.
Your MariaDB connection id is 625
Server version: 10.1.13-MariaDB mariadb.org binary distribution

Copyright (c) 2000, 2016, Oracle, MariaDB Corporation Ab and others.

Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.

MariaDB [(none)]> create database sms;
Query OK, 1 row affected (0.00 sec)

MariaDB [(none)]> use sms;
Database changed
MariaDB [sms]> CREATE TABLE TblUser
    -> (
    ->   Id int primary key auto_increment not null,
    ->   UserId VARCHAR(50) UNIQUE NOT NULL,
    ->   Password VARCHAR(50) NOT NULL
    -> );
Query OK, 0 rows affected (0.02 sec)

MariaDB [sms]> show tables;
+---------------+
| Tables_in_sms |
+---------------+
| tbluser       |
+---------------+
1 row in set (0.00 sec)

MariaDB [sms]> desc tbluser;
+----------+-------------+------+-----+---------+----------------+
| Field    | Type        | Null | Key | Default | Extra          |
+----------+-------------+------+-----+---------+----------------+
| Id       | int(11)     | NO   | PRI | NULL    | auto_increment |
| UserId   | varchar(50) | NO   | UNI | NULL    |                |
| Password | varchar(50) | NO   |     | NULL    |                |
+----------+-------------+------+-----+---------+----------------+
3 rows in set (0.02 sec)

MariaDB [sms]> desc TblUser;
+----------+-------------+------+-----+---------+----------------+
| Field    | Type        | Null | Key | Default | Extra          |
+----------+-------------+------+-----+---------+----------------+
| Id       | int(11)     | NO   | PRI | NULL    | auto_increment |
| UserId   | varchar(50) | NO   | UNI | NULL    |                |
| Password | varchar(50) | NO   |     | NULL    |                |
+----------+-------------+------+-----+---------+----------------+
3 rows in set (0.00 sec)

MariaDB [sms]> INSERT INTO TblUser (UserId, Password) VALUES ("S0002", "S0002");
Query OK, 1 row affected (0.00 sec)

MariaDB [sms]> INSERT INTO TblUser (UserId, Password) VALUES ("S0003", "S0003");
Query OK, 1 row affected (0.01 sec)

MariaDB [sms]> INSERT INTO TblUser (UserId, Password) VALUES ("S0003", "S0003");
ERROR 1062 (23000): Duplicate entry 'S0003' for key 'UserId'
MariaDB [sms]> select * from TblUser;
+----+--------+----------+
| Id | UserId | Password |
+----+--------+----------+
|  1 | S0001  | S0001    |
|  2 | S0002  | S0002    |
|  3 | S0003  | S0003    |
+----+--------+----------+
3 rows in set (0.00 sec)

MariaDB [sms]>
```
