-- Reference: https://www.mysqltutorial.org/php-mysql-blob/

USE test;

CREATE TABLE files (
    id   INT           AUTO_INCREMENT PRIMARY KEY,
    mime VARCHAR (255) NOT NULL,
    data BLOB          NOT NULL
);
