# Show All Columns of table in MySQL

## Query

```sql
show columns from tblfee;
```

## Output

```sql
MariaDB [sms]> show columns from tblfee;
+---------------+-------------+------+-----+-------------------+-----------------------------+
| Field         | Type        | Null | Key | Default           | Extra                       |
+---------------+-------------+------+-----+-------------------+-----------------------------+
| Id            | int(11)     | NO   | PRI | NULL              | auto_increment              |
| UserId        | int(11)     | NO   | MUL | NULL              |                             |
| Year          | int(11)     | NO   |     | NULL              |                             |
| FeeType       | int(11)     | NO   | MUL | NULL              |                             |
| Amount        | int(11)     | NO   |     | NULL              |                             |
| Remarks       | varchar(50) | YES  |     | NULL              |                             |
| IS_ACTIVE     | char(1)     | YES  |     | Y                 |                             |
| CREATED_DATE  | datetime    | YES  |     | CURRENT_TIMESTAMP |                             |
| CREATED_BY    | varchar(50) | YES  |     | SYSTEM            |                             |
| MODIFIED_DATE | datetime    | YES  |     | NULL              | on update CURRENT_TIMESTAMP |
| MODIFIED_BY   | varchar(50) | YES  |     | NULL              |                             |
+---------------+-------------+------+-----+-------------------+-----------------------------+
11 rows in set (0.01 sec)

MariaDB [sms]>
```
