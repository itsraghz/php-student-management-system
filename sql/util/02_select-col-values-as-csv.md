# Query to retrieve the particular data of all rows as a CSV in MySQL

## Query

```sql
-- Add as many columns as you want
select group_concat(Id),group_concat(Type) from TblFeeMaster;
```

> Note: This will be handy and looking legible for the master tables where we
are expected to have a handful of data, and this comma separated values will
be a quick reference in a single line.

## Output

```sql
MariaDB [sms]> select group_concat(Id),group_concat(Type) from TblFeeMaster;
+-------------------+-----------------------------------------------------------------+
| group_concat(Id)  | group_concat(Type)                                              |
+-------------------+-----------------------------------------------------------------+
| 1,5,3,7,4,8,9,6,2 | Administration,Book,Exam,Hostel,Lab,Mess,Misc,Transport,Tuition |
+-------------------+-----------------------------------------------------------------+
1 row in set (0.01 sec)

MariaDB [sms]>
```
> Remarks: Looks like the order of columns is distorted, as the data is presented in
the ascending order of the `Type` column (A to Z). Need to check!
