1 - SELECT `ProductName`, `QuantityPerUnit` FROM `products` WHERE `Discontinued` != 0 OR `Discontinued` IS NULL;
2 - SELECT `ProductID`,`ProductName` FROM `products` WHERE `Discontinued` != 0 OR `Discontinued` IS NULL;
3 - SELECT `ProductName`, `UnitPrice` FROM `products` WHERE `Discontinued` != 0 OR `Discontinued` IS NULL ORDER BY `UnitPrice` DESC;
4 - SELECT `ProductName`, `UnitPrice` FROM `products` WHERE `UnitPrice` > (SELECT AVG(`UnitPrice`) FROM `products`);
5 - SELECT `ProductID`, `ProductName`, `UnitPrice` FROM `products` WHERE `UnitPrice` < 20 AND (`Discontinued` != 0 OR `Discontinued` IS NULL);
6 - SELECT `ProductID`, `UnitsOnOrder`, `UnitsInStock` FROM `products` WHERE `UnitsInStock` < `UnitsOnOrder` AND (`Discontinued` != 0 OR `Discontinued` IS NULL);