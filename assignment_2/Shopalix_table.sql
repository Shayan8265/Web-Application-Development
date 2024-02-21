
CREATE TABLE User (
    UserID INTEGER PRIMARY KEY,
    UserType TEXT NOT NULL CHECK(UserType IN ('Customer', 'ExpressCustomer')),
    Email TEXT,
    PaymentInfo TEXT,
    OrdersDate DATE,
    Name TEXT,
    PhoneNumber TEXT,
    Address TEXT,
);

CREATE TABLE Customer (
    CustomerID INTEGER PRIMARY KEY,
    UserID INTEGER,
    FOREIGN KEY (UserID) REFERENCES User(UserID)
);

CREATE TABLE ExpressCustomer (
    CustomerID INTEGER PRIMARY KEY,
    UserID INTEGER,
    FOREIGN KEY (UserID) REFERENCES User(UserID)
);

CREATE TABLE Article (
    ArticleID INTEGER PRIMARY KEY,
    Type TEXT NOT NULL CHECK(Type IN ('Perishables', 'NonPerishables'))
);

CREATE TABLE Perishables (
    ArticleID INTEGER PRIMARY KEY,
    ArticleName TEXT,
    ExpiryDate DATE,
    FOREIGN KEY (ArticleID) REFERENCES Article(ArticleID)
);

CREATE TABLE NonPerishables (
    ArticleID INTEGER PRIMARY KEY,
    ArticleName TEXT,
    FOREIGN KEY (ArticleID) REFERENCES Article(ArticleID)
);

CREATE TABLE Orders (
    OrdersID INTEGER PRIMARY KEY,
    Price DECIMAL(10, 2),
    Articles TEXT
);

CREATE TABLE Packaging (
    PackageID INTEGER PRIMARY KEY,
    Type TEXT NOT NULL CHECK(Type IN ('StandardPackage', 'ExpressPackage')),
    ShipmentLabel TEXT,
    BillOfLoading INTEGER
);

CREATE TABLE StandardPackage (
    PackageID INTEGER PRIMARY KEY,
    DeliveryTime INTEGER,
    FOREIGN KEY (PackageID) REFERENCES Packaging(PackageID)
);

CREATE TABLE ExpressPackage (
    PackageID INTEGER PRIMARY KEY,
    DeliveryTime INTEGER,
    FOREIGN KEY (PackageID) REFERENCES Packaging(PackageID)
);

CREATE TABLE ShipmentDepartment (
    BillOfLoading INTEGER PRIMARY KEY,
    OrdersID INTEGER,
    Address TEXT,
    ETA DATE,
    ThirdPartyLogistics TEXT,
    FOREIGN KEY (OrdersID) REFERENCES Orders(OrdersID)
);

