-- Standard Customers
SELECT *
FROM User
WHERE CustomerType = 'Standard';

-- Express Customers
SELECT *
FROM User
WHERE CustomerType = 'Express';

-- Query to retrieve all perishable articles
SELECT A.ArticleID, A.Type, P.ArticleName, P.ExpiryDate
FROM Article AS A
JOIN Perishables AS P ON A.ArticleID = P.ArticleID;

-- Non-Perishables
SELECT A.ArticleID, A.Type, NP.ArticleName
FROM Article AS A
JOIN NonPerishables AS NP ON A.ArticleID = NP.ArticleID;

--EXPRESS PACKAGES
SELECT EP.*, SP.*, U.OrdersDate AS OrdersDate
FROM ExpressPackage AS EP
JOIN User AS U ON EP.PackageID = U.UserID
LEFT JOIN ShipmentDepartment AS SP ON EP.PackageID = SP.OrdersID;

--STANDARD PACKAGES
SELECT P.*, SP.*, U.OrdersDate AS OrdersDate
FROM StandardPackage AS P
JOIN User AS U ON P.PackageID = U.UserID
LEFT JOIN ShipmentDepartment AS SP ON EP.PackageID = SP.OrdersID;


--Query to Find the Average Delivery Time for Each Package Type
SELECT P.Type, AVG(SP.DeliveryTime) AS AverageDeliveryTime
FROM Packaging P
LEFT JOIN StandardPackage SP ON P.PackageID = SP.PackageID
LEFT JOIN ExpressPackage EP ON P.PackageID = EP.PackageID
GROUP BY P.Type
HAVING AverageDeliveryTime > 1;

--Total Price of Orders by each Customer Type
SELECT U.UserType, SUM(O.Price) AS TotalPrice
FROM User U
JOIN Customer C ON U.UserID = C.UserID
LEFT JOIN ExpressCustomer EC ON U.UserID = EC.UserID
JOIN Orders O ON U.UserID = O.OrdersID
GROUP BY U.UserType
HAVING TotalPrice > 500;


--This query calculates the total number of orders placed by each customer
SELECT U.Name AS CustomerName, AVG(LENGTH(O.Articles) - LENGTH(REPLACE(O.Articles, ',', '')) + 1) AS AvgArticlesOrdered
FROM User U
LEFT JOIN Orders O ON U.UserID = O.OrdersID
GROUP BY U.Name
ORDER BY AvgArticlesOrdered DESC;
