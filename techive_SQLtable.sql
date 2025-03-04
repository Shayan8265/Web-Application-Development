/*Customer is the supertype entity of the Buyer and Seller subtypes, 
each with an appropriate foreign key constraint to maintain referential integrity.
Electronics serves as the supertype for HouseholdElectronics and ConsumerElectronics
to ensure the categorization of products. Order is extended to Pickup and Delivery 
subtypes for flexibility in the order fulfillment options. The relationship tables 
are Buys and Sells, each connecting buyers and sellers to products to 
ensure proper transactions.*/



CREATE TABLE Customer (
    CustomerID INT PRIMARY KEY,
    Name VARCHAR(255) NOT NULL,
    Email VARCHAR(255) UNIQUE NOT NULL,
    PhoneNumber VARCHAR(20),
    Address TEXT
);

CREATE TABLE Buyer (
    BuyerID INT PRIMARY KEY,
    Username VARCHAR(255) UNIQUE NOT NULL,
    Password VARCHAR(255) NOT NULL,
    CustomerID INT,
    FOREIGN KEY (CustomerID) REFERENCES Customer(CustomerID) ON DELETE CASCADE
);

CREATE TABLE Seller (
    SellerID INT PRIMARY KEY,
    Username VARCHAR(255) UNIQUE NOT NULL,
    Password VARCHAR(255) NOT NULL,
    CustomerID INT,
    FOREIGN KEY (CustomerID) REFERENCES Customer(CustomerID) ON DELETE CASCADE
);

CREATE TABLE Electronics (
    ProductID INT PRIMARY KEY,
    ProductName VARCHAR(255) NOT NULL,
    Brand VARCHAR(255),
    Price DECIMAL(10, 2) CHECK (Price > 0)
);

CREATE TABLE HouseholdElectronics (
    ProductID INT PRIMARY KEY,
    PowerConsumption VARCHAR(50),
    Dimensions VARCHAR(50),
    FOREIGN KEY (ProductID) REFERENCES Electronics(ProductID) ON DELETE CASCADE
);

CREATE TABLE ConsumerElectronics (
    ProductID INT PRIMARY KEY,
    OperatingSystems VARCHAR(255),
    Storage VARCHAR(50),
    Colour VARCHAR(50),
    FOREIGN KEY (ProductID) REFERENCES Electronics(ProductID) ON DELETE CASCADE
);

CREATE TABLE `Order` (
    OrderID INT PRIMARY KEY,
    OrderDate DATE NOT NULL,
    OrderStatus VARCHAR(50) CHECK (OrderStatus IN ('Pending', 'Completed', 'Cancelled')),
    BuyerID INT,
    FOREIGN KEY (BuyerID) REFERENCES Buyer(BuyerID) ON DELETE CASCADE
);

CREATE TABLE Pickup (
    OrderID INT PRIMARY KEY,
    Date DATE,
    Time TIME,
    Location VARCHAR(255) NOT NULL,
    FOREIGN KEY (OrderID) REFERENCES `Order`(OrderID) ON DELETE CASCADE
);

CREATE TABLE Delivery (
    OrderID INT PRIMARY KEY,
    DeliveryAddress TEXT NOT NULL,
    DeliveryDate DATE,
    TrackingID VARCHAR(255),
    DeliveryFee DECIMAL(10, 2) CHECK (DeliveryFee >= 0),
    FOREIGN KEY (OrderID) REFERENCES `Order`(OrderID) ON DELETE CASCADE
);

CREATE TABLE Buys (
    BuyerID INT,
    ProductID INT,
    PRIMARY KEY (BuyerID, ProductID),
    FOREIGN KEY (BuyerID) REFERENCES Buyer(BuyerID) ON DELETE CASCADE,
    FOREIGN KEY (ProductID) REFERENCES Electronics(ProductID) ON DELETE CASCADE
);

CREATE TABLE Sells (
    SellerID INT,
    ProductID INT,
    PRIMARY KEY (SellerID, ProductID),
    FOREIGN KEY (SellerID) REFERENCES Seller(SellerID) ON DELETE CASCADE,
    FOREIGN KEY (ProductID) REFERENCES Electronics(ProductID) ON DELETE CASCADE
);

CREATE TABLE Users (
    UserID INT PRIMARY KEY AUTO_INCREMENT,
    Username VARCHAR(255) UNIQUE NOT NULL,
    Password VARCHAR(255) NOT NULL
);