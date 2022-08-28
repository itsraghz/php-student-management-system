# SQL Query to get the data from TblStudent and other related tables

## Query

```sql
select a.Id, a.UserId, a.RegnNo, b.Remarks, a.Name, a.Gender, a.Email, a.Is_Active, a.CREATED_BY, a.CREATED_DATE from TblStudent a, TblAdmission b where a.ModeId=b.Id order by a.UserId asc;
```

## Output

```sql
MariaDB [sms]> select a.Id, a.UserId, a.RegnNo, b.Remarks, a.Name, a.Gender, a.Email, a.Is_Active, a.CREATED_BY, a.CREATED_DATE from TblStudent a, TblAdmission b where a.ModeId=b.Id order by a.UserId asc;
+----+--------+--------------+-------------+--------------------+--------+----------------------------+-----------+------------+---------------------+
| Id | UserId | RegnNo       | Remarks     | Name               | Gender | Email                      | Is_Active | CREATED_BY | CREATED_DATE        |
+----+--------+--------------+-------------+--------------------+--------+----------------------------+-----------+------------+---------------------+
|  1 |      8 | 912518106005 | Counselling | Karpagathendral. I | F      | Karpagathendral7@gmail.com | Y         | SYSTEM     | 2022-08-07 20:16:11 |
|  2 |      9 | 912518106007 | Counselling | Karuppaye A        | F      | muthalaguasha@gmail.com    | Y         | SYSTEM     | 2022-08-07 20:16:11 |
|  3 |     10 | 912518106018 | Counselling | C. Vidhya          | F      | Cvidhya1001@gmail.com      | Y         | SYSTEM     | 2022-08-07 20:16:11 |
|  4 |     11 | 912518106010 | Management  | Manimegalai C      | F      | cmanimegalai69@gmail.com   | Y         | SYSTEM     | 2022-08-07 20:16:11 |
+----+--------+--------------+-------------+--------------------+--------+----------------------------+-----------+------------+---------------------+
4 rows in set (0.00 sec)

MariaDB [sms]>
```
