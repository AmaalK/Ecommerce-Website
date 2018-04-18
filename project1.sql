CREATE TABLE Usern
(
  UserID INT(9) NOT NULL AUTO_INCREMENT,
  FirstName VARCHAR(20) NOT NULL ,
  LastName VARCHAR(20) NOT NULL,
  Email VARCHAR(50) NOT NULL,
  Password VARCHAR(255) NOT NULL,
  Username VARCHAR(15) NOT NULL,
  Country VARCHAR(20) NOT NULL,
  City VARCHAR(20) NOT NULL,
  PhoneNo VARCHAR(20) NOT NULL,
  PRIMARY KEY(UserID),
  UNIQUE(Email),
  UNIQUE(PhoneNo),
  UNIQUE(Username)
);

CREATE TABLE Product
(
  ProductID INT(9) NOT NULL AUTO_INCREMENT,
  ProductName VARCHAR(20) NOT NULL,
  PRIMARY KEY(ProductID)
);

CREATE TABLE BillingInformation
(
  CreditCardName VARCHAR(50) NOT NULL,
  CreditCardNo INT(12) NOT NULL,
  CreditCardPin INT(4) NOT NULL,
  ExpDate DATE NOT NULL,
  PRIMARY KEY(CreditCardNo)
  );

CREATE TABLE Seller
(
  SellerID INT(9) NOT NULL AUTO_INCREMENT,
  UserID INT(9) NOT NULL,
  Email VARCHAR(50) NOT NULL,
  PhoneNo VARCHAR(20) NOT NULL,
  PRIMARY KEY(SellerID),
  FOREIGN KEY(UserID) REFERENCES Usern(UserID),
  FOREIGN KEY(Email) REFERENCES Usern(Email),
  FOREIGN KEY(PhoneNo) REFERENCES Usern(PhoneNo)
);

CREATE TABLE Store
(
  StoreID INT(9) NOT NULL AUTO_INCREMENT,
  SellerID INT(9) NOT NULL,
  StoreName VARCHAR(20) NOT NULL,
  PRIMARY KEY(StoreID),
  FOREIGN KEY(SellerID) REFERENCES Seller(SellerID)

);

CREATE TABLE Category
(
  StoreID INT(9) NOT NULL,
  SellerID INT(9) NOT NULL,
  CategoryID INT(9) NOT NULL,
  CategoryName VARCHAR(20) NOT NULL,
  PRIMARY KEY (CategoryID),
  FOREIGN KEY (StoreID) REFERENCES Store(StoreID),
  FOREIGN KEY (SellerID) REFERENCES Seller(SellerID)

);

CREATE TABLE Buyer
(
  BuyerID INT(9) NOT NULL AUTO_INCREMENT,
  CreditCardNo INT(12) NOT NULL,
  UserID INT(9) NOT NULL,
  Email VARCHAR(50) NOT NULL,
  PhoneNo VARCHAR(20) NOT NULL,
  PRIMARY KEY(BuyerID),
  FOREIGN KEY(CreditCardNo) REFERENCES BillingInformation(CreditCardNo),
  FOREIGN KEY(UserID) REFERENCES Usern(UserID),
  FOREIGN KEY(Email) REFERENCES Usern(Email),
  FOREIGN KEY(PhoneNo) REFERENCES Usern(PhoneNo)
);

CREATE TABLE Product_Item
(
  ProductID INT(9) NOT NULL,
  StoreID INT(9) NOT NULL,
  CategoryID INT(9) NOT NULL,
  Price INT(9) NOT NULL,
  In_Stock INT(9) NOT NULL,
  Description_Item VARCHAR(255) NOT NULL,
  PRIMARY KEY (ProductID, StoreID),
  FOREIGN KEY (ProductID) REFERENCES Product(ProductID),
  FOREIGN KEY (StoreID) REFERENCES Store(StoreID),
  FOREIGN KEY (CategoryID) REFERENCES Category(CategoryID)
);

CREATE TABLE Orderr
(
  OrderID INT(9) NOT NULL AUTO_INCREMENT,
  OrderDate DATE NOT NULL,
  Cost INT(9) NOT NULL,
  BuyerID INT(9) NOT NULL,
  PRIMARY KEY(OrderID),
  FOREIGN KEY(BuyerID) REFERENCES Buyer(BuyerID)
);

CREATE TABLE Cart
(
  CartID INT(9) NOT NULL AUTO_INCREMENT,
  BuyerID INT(9) NOT NULL,
  PRIMARY KEY(CartID),
  FOREIGN KEY (BuyerID) REFERENCES Buyer(BuyerID)
);

CREATE TABLE Cart_Product
(
  Quantity INT(9) NOT NULL,
  ProductID INT(9) NOT NULL,
  CartID INT(9) NOT NULL,
  PRIMARY KEY (ProductID, CartID),
  FOREIGN KEY (ProductID) REFERENCES Product(ProductID),
  FOREIGN KEY (CartID) REFERENCES Cart(CartID)
);

CREATE TABLE Order_Product
(
  Quantity INT(9) NOT NULL,
  OrderID INT(9) NOT NULL,
  ProductID INT(9) NOT NULL,
  StoreID INT(9) NOT NULL,
  PRIMARY KEY (OrderID, ProductID, StoreID),
  FOREIGN KEY (OrderID) REFERENCES Orderr(OrderID),
  FOREIGN KEY (ProductID, StoreID) REFERENCES Product_Item(ProductID, StoreID)
);

