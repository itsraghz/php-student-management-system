USE SMS;

CREATE TABLE TblUser
(
  Id int primary key auto_increment not null,
  UserId VARCHAR(50) UNIQUE NOT NULL,
  Password VARCHAR(50) NOT NULL
);

CREATE TABLE TblStudent
(
  Id int primary key auto_increment not null,
  RegnNo VARCHAR(50) UNIQUE NOT NULL,
  Name VARCHAR(20) NOT NULL,
  DOB DATE NOT NULL,
  Gender CHAR(1) NOT NULL,
  Course VARCHAR(50) NOT NULL,
  FathersName VARCHAR(50),
  MothersName VARCHAR(50),
  Email VARCHAR(100),
  Mobile VARCHAR(10),
  Address VARCHAR(1000),
  CONSTRAINT fk_User
    FOREIGN KEY (RegnNo)
        REFERENCES TblUser(UserId)
);
