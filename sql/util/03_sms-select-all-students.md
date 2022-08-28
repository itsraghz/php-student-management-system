# Select all students


## Query

```sql
SELECT
  a.Id, a.UserId, a.RegnNo, a.Name, a.Gender, a.year
FROM
  Tblstudent a, TblUserRole b, TblRole c
WHERE
  a.UserId=b.UserId
  and c.Name='Student'
ORDER BY  
  a.Id asc;
```
## Output

```sql
MariaDB [sms]> select a.Id, a.UserId, a.RegnNo, a.Name, a.Gender, a.year from tblstudent a, tbluserrole b, tblrole c where a.UserId=b.UserId and c.Name='Student' order by a.Id asc;
+----+--------+--------------+--------------------+--------+------+
| Id | UserId | RegnNo       | Name               | Gender | year |
+----+--------+--------------+--------------------+--------+------+
|  1 |      8 | 912518106005 | Karpagathendral. I | F      |    4 |
|  2 |      9 | 912518106007 | Karuppaye A        | F      |    4 |
|  3 |     10 | 912518106018 | C. Vidhya          | F      |    4 |
|  4 |     11 | 912518106010 | Manimegalai C      | F      |    4 |
+----+--------+--------------+--------------------+--------+------+
4 rows in set (0.00 sec)

MariaDB [sms]>
```
