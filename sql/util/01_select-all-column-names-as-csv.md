# Query to retrieve all the column names of a Table in MySQL

## Query

```sql
SELECT
    CONCAT('\'',
            GROUP_CONCAT(column_name
                ORDER BY ordinal_position
                SEPARATOR '\', \''),
            '\'') AS columns
FROM
    information_schema.columns
WHERE
    table_schema = DATABASE()
        AND table_name = 'TblFee';
```

## Output

```sql
MariaDB [sms]> SELECT
    ->     CONCAT('\'',
    ->             GROUP_CONCAT(column_name
    ->                 ORDER BY ordinal_position
    ->                 SEPARATOR '\', \''),
    ->             '\'') AS columns
    -> FROM
    ->     information_schema.columns
    -> WHERE
    ->     table_schema = DATABASE()
    ->         AND table_name = 'TblFee';
+-----------------------------------------------------------------------------------------------------------------------------------+
| columns                                                                                                                           |
+-----------------------------------------------------------------------------------------------------------------------------------+
| 'Id', 'UserId', 'Year', 'FeeType', 'Amount', 'Remarks', 'IS_ACTIVE', 'CREATED_DATE', 'CREATED_BY', 'MODIFIED_DATE', 'MODIFIED_BY' |
+-----------------------------------------------------------------------------------------------------------------------------------+
1 row in set (0.01 sec)

MariaDB [sms]>
```
