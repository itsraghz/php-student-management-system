# Select data from `TblFee`

## Query

```sql
select Id, UserId, Year, FeeType, Amount, Remarks, Is_Active, Created_by, Created_date from TblFee;
```

```sql
select Id, UserId, Year, FeeType, Amount, Remarks, Is_Active, Created_by, Created_date from TblFee where UserId=8;
```

```sql
select a.Id, b.UserId, b.Name, a.Year, c.Type, a.Amount, a.Remarks, a.Is_Active, a.Created_by, a.Created_date from TblFee a, TblStudent B, TblFeeMaster C where a.FeeType=c.Id and a.UserId=b.UserId and a.is_active='Y' and a.is_active='Y' and a.UserId=8 order by a.UserId, a.Year,a.FeeType
```
> Note: IS_ACTIVE=Y is an important condition to consider ONLY the active records, in case any erreneous entries were marked inactive. 

```sql
select a.Id, b.UserId, b.Name, a.Year, c.Type, sum(a.amount) from TblFee a, TblStudent B, TblFeeMaster C where a.FeeType=c.Id and a.UserId=b.UserId and a.is_active='Y' and a.UserId=8 group by a.UserId, a.Year, c.Type order by a.UserId, a.Year, a.FeeType;
```

## Output

```sql
MariaDB [sms]> select Id, UserId, Year, FeeType, Amount, Remarks, Is_Active, Created_by, Created_date from TblFee;
MariaDB [sms]> select Id, UserId, Year, FeeType, Amount, Remarks, Is_Active, Created_by, Created_date from TblFee;
+----+--------+------+---------+--------+-------------------------------------------------+-----------+------------+---------------------+
| Id | UserId | Year | FeeType | Amount | Remarks                                         | Is_Active | Created_by | Created_date        |
+----+--------+------+---------+--------+-------------------------------------------------+-----------+------------+---------------------+
|  1 |      8 |    1 |       1 |  20000 | Admission Fee for the year 2018                 | Y         | SYSTEM     | 2022-08-07 18:27:32 |
|  2 |      8 |    1 |       2 |  25000 | Tuition Fee for the year 2018                   | Y         | SYSTEM     | 2022-08-07 18:27:32 |
|  3 |      8 |    1 |       3 |    800 | Exam Fee for the year 2018                      | Y         | SYSTEM     | 2022-08-07 18:27:32 |
|  4 |      8 |    1 |       4 |   1200 | Lab Fee for the year 2018                       | Y         | SYSTEM     | 2022-08-07 18:27:32 |
|  5 |      8 |    1 |       5 |    800 | Book Fee for the year 2018                      | Y         | SYSTEM     | 2022-08-07 18:27:32 |
|  6 |      9 |    1 |       1 |  20000 | Admission Fee for the year 2018                 | Y         | SYSTEM     | 2022-08-07 18:27:32 |
|  7 |      9 |    1 |       2 |  25000 | Tuition Fee for the year 2018                   | Y         | SYSTEM     | 2022-08-07 18:27:32 |
|  8 |      9 |    1 |       3 |    800 | Exam Fee for the year 2018                      | Y         | SYSTEM     | 2022-08-07 18:27:32 |
|  9 |      9 |    1 |       4 |   1200 | Lab Fee for the year 2018                       | Y         | SYSTEM     | 2022-08-07 18:27:32 |
| 10 |      9 |    1 |       5 |    800 | Book Fee for the year 2018                      | Y         | SYSTEM     | 2022-08-07 18:27:32 |
| 11 |      9 |    1 |       6 |   4000 | Transportation Fee for the year 2018            | Y         | SYSTEM     | 2022-08-07 18:27:32 |
| 12 |     10 |    1 |       1 |  20000 | Admission Fee for the year 2018                 | Y         | SYSTEM     | 2022-08-07 18:27:32 |
| 13 |     10 |    1 |       2 |  25000 | Tuition Fee for the year 2018                   | Y         | SYSTEM     | 2022-08-07 18:27:32 |
| 14 |     10 |    1 |       3 |    800 | Exam Fee for the year 2018                      | Y         | SYSTEM     | 2022-08-07 18:27:32 |
| 15 |     10 |    1 |       4 |   1200 | Lab Fee for the year 2018                       | Y         | SYSTEM     | 2022-08-07 18:27:32 |
| 16 |     10 |    1 |       5 |    800 | Book Fee for the year 2018                      | Y         | SYSTEM     | 2022-08-07 18:27:32 |
| 17 |     10 |    1 |       7 |  15000 | Hostel Fee for the year 2018                    | Y         | SYSTEM     | 2022-08-07 18:27:32 |
| 18 |     10 |    1 |       8 |  10000 | Mess Fee for the year 2018                      | Y         | SYSTEM     | 2022-08-07 18:27:32 |
| 19 |     11 |    1 |       1 |  10000 | Admission Fee for the year 2018 - Part I        | Y         | SYSTEM     | 2022-08-07 18:27:32 |
| 20 |     11 |    1 |       1 |  10000 | Admission Fee for the year 2018 - Part II       | Y         | SYSTEM     | 2022-08-07 18:27:32 |
| 21 |     11 |    1 |       2 |  10000 | Tuition Fee for the year 2018 - Part I          | Y         | SYSTEM     | 2022-08-07 18:27:32 |
| 22 |     11 |    1 |       2 |  10000 | Tuition Fee for the year 2018 - Part II         | Y         | SYSTEM     | 2022-08-07 18:27:32 |
| 23 |     11 |    1 |       2 |   5000 | Tuition Fee for the year 2018 - Part III        | Y         | SYSTEM     | 2022-08-07 18:27:32 |
| 24 |     11 |    1 |       3 |    800 | Exam Fee for the year 2018                      | Y         | SYSTEM     | 2022-08-07 18:27:32 |
| 25 |     11 |    1 |       4 |   1200 | Lab Fee for the year 2018                       | Y         | SYSTEM     | 2022-08-07 18:27:32 |
| 26 |     11 |    1 |       5 |    800 | Book Fee for the year 2018                      | Y         | SYSTEM     | 2022-08-07 18:27:32 |
| 27 |     11 |    1 |       6 |   2000 | Transportation Fee for the year 2018 - Part I   | Y         | SYSTEM     | 2022-08-07 18:27:32 |
| 28 |     11 |    1 |       6 |   2000 | Transportation Fee for the year 2018 - Part II  | Y         | SYSTEM     | 2022-08-07 18:27:32 |
| 29 |     11 |    1 |       6 |   2000 | Transportation Fee for the year 2018 - Part III | Y         | SYSTEM     | 2022-08-07 18:27:32 |
| 30 |     11 |    1 |       6 |   2000 | Transportation Fee for the year 2018 - Part IV  | Y         | SYSTEM     | 2022-08-07 18:27:32 |
+----+--------+------+---------+--------+-------------------------------------------------+-----------+------------+---------------------+
30 rows in set (0.00 sec)

MariaDB [sms]> select Id, UserId, Year, FeeType, Amount, Remarks, Is_Active, Created_by, Created_date from TblFee where UserId=8;
+----+--------+------+---------+--------+---------------------------------+-----------+------------+---------------------+
| Id | UserId | Year | FeeType | Amount | Remarks                         | Is_Active | Created_by | Created_date        |
+----+--------+------+---------+--------+---------------------------------+-----------+------------+---------------------+
|  1 |      8 |    1 |       1 |  20000 | Admission Fee for the year 2018 | Y         | SYSTEM     | 2022-08-07 17:32:34 |
|  2 |      8 |    1 |       2 |  25000 | Tuition Fee for the year 2018   | Y         | SYSTEM     | 2022-08-07 17:32:34 |
|  3 |      8 |    1 |       3 |    800 | Exam Fee for the year 2018      | Y         | SYSTEM     | 2022-08-07 17:32:34 |
|  4 |      8 |    1 |       4 |   1200 | Lab Fee for the year 2018       | Y         | SYSTEM     | 2022-08-07 17:32:34 |
|  5 |      8 |    1 |       5 |    800 | Book Fee for the year 2018      | Y         | SYSTEM     | 2022-08-07 17:32:34 |
+----+--------+------+---------+--------+---------------------------------+-----------+------------+---------------------+
5 rows in set (0.00 sec)

MariaDB [sms]> select a.Id, b.UserId, b.Name, a.Year, c.Type, a.Amount, a.Remarks, a.Is_Active, a.Created_by, a.Created_date from TblFee a, TblStudent B, TblFeeMaster C where a.FeeType=c.Id and a.UserId=b.UserId and a.is_active='Y' and a.UserId=8 order by a.UserId, a.Year,a.FeeType;
+----+--------+--------------------+------+----------------+--------+---------------------------------+-----------+------------+---------------------+
| Id | UserId | Name               | Year | Type           | Amount | Remarks                         | Is_Active | Created_by | Created_date        |
+----+--------+--------------------+------+----------------+--------+---------------------------------+-----------+------------+---------------------+
|  1 |      8 | Karpagathendral. I |    1 | Administration |  20000 | Admission Fee for the year 2018 | Y         | SYSTEM     | 2022-08-07 19:44:11 |
|  2 |      8 | Karpagathendral. I |    1 | Tuition        |  25000 | Tuition Fee for the year 2018   | Y         | SYSTEM     | 2022-08-07 19:44:11 |
|  3 |      8 | Karpagathendral. I |    1 | Exam           |    800 | Exam Fee for the year 2018      | Y         | SYSTEM     | 2022-08-07 19:44:11 |
|  4 |      8 | Karpagathendral. I |    1 | Lab            |   1200 | Lab Fee for the year 2018       | Y         | SYSTEM     | 2022-08-07 19:44:11 |
|  5 |      8 | Karpagathendral. I |    1 | Book           |    800 | Book Fee for the year 2018      | Y         | SYSTEM     | 2022-08-07 19:44:11 |
+----+--------+--------------------+------+----------------+--------+---------------------------------+-----------+------------+---------------------+
5 rows in set (0.00 sec)

MariaDB [sms]> select a.Id, b.UserId, b.Name, a.Year, c.Type, sum(a.amount) from TblFee a, TblStudent B, TblFeeMaster C where a.FeeType=c.Id and a.UserId=b.UserId and a.is_active='Y' and a.UserId=8 group by a.UserId, a.Year, c.Type order by a.UserId, a.Year, a.FeeType;
+----+--------+--------------------+------+----------------+---------------+
| Id | UserId | Name               | Year | Type           | sum(a.amount) |
+----+--------+--------------------+------+----------------+---------------+
|  1 |      8 | Karpagathendral. I |    1 | Administration |         20000 |
|  2 |      8 | Karpagathendral. I |    1 | Tuition        |         25000 |
|  3 |      8 | Karpagathendral. I |    1 | Exam           |           800 |
|  4 |      8 | Karpagathendral. I |    1 | Lab            |          1200 |
|  5 |      8 | Karpagathendral. I |    1 | Book           |           800 |
+----+--------+--------------------+------+----------------+---------------+
5 rows in set (0.01 sec)

MariaDB [sms]> select a.Id, b.UserId, b.Name, a.Year, c.Type, sum(a.amount) from TblFee a, TblStudent B, TblFeeMaster C where a.FeeType=c.Id and a.UserId=b.UserId and a.is_active='Y' and a.UserId=11 group by a.UserId, a.Year, c.Type order by a.UserId, a.Year, a.FeeType;
+----+--------+---------------+------+----------------+---------------+
| Id | UserId | Name          | Year | Type           | sum(a.amount) |
+----+--------+---------------+------+----------------+---------------+
| 19 |     11 | Manimegalai C |    1 | Administration |         20000 |
| 21 |     11 | Manimegalai C |    1 | Tuition        |         25000 |
| 24 |     11 | Manimegalai C |    1 | Exam           |           800 |
| 25 |     11 | Manimegalai C |    1 | Lab            |          1200 |
| 26 |     11 | Manimegalai C |    1 | Book           |           800 |
| 27 |     11 | Manimegalai C |    1 | Transport      |          8000 |
+----+--------+---------------+------+----------------+---------------+
6 rows in set (0.01 sec)

MariaDB [sms]>
```
