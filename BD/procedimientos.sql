/*Adicionar productos*/
DROP FUNCTION IF EXISTS adicionproducto;
DELIMITER //
CREATE FUNCTION adicionproducto( midescripcion VARCHAR(50),micantidad INT, mivalor_unitario INT)
RETURNS CHAR(230)
BEGIN 
 DECLARE v_mensaje CHAR(230);
 INSERT INTO Productos(Descripcion ,Cantidad, Valor_Unitario)
 VALUES(midescripcion,micantidad,mivalor_unitario);

 SET v_mensaje = concat('El producto ',midescripcion,' se ingreso con exito' ); 

 RETURN v_mensaje;
END;
//
DELIMITER ;

/*Adicionar ventas*/
DELIMITER //
CREATE FUNCTION adicionaventa(mifecha DATE, miproducto INT,micantidad INT,mivalor_unitario INT)
RETURNS CHAR(230)
BEGIN 
 DECLARE v_mensaje CHAR(230);
 INSERT INTO Ventas(Fecha, Producto, Cantidad, Valor_Unitario)
 VALUES(mifecha,miproducto,micantidad,mivalor_unitario);

 SET v_mensaje = concat('La venta ',Producto,' se ingreso con exito' ); 

 RETURN v_mensaje;
END;
//
DELIMITER ;

/*Adicionar compras*/
DROP FUNCTION adicioncompra;
DELIMITER //
CREATE FUNCTION adicioncompra(mifecha DATE, miproducto INT,micantidad INT,mivalor_unitario INT)
RETURNS CHAR(230)
BEGIN 
 DECLARE v_mensaje CHAR(230);
 INSERT INTO Compras(Fecha, Producto, Cantidad, Valor_Unitario)
 VALUES(mifecha,miproducto,micantidad,mivalor_unitario);

 SET v_mensaje = concat('La compra',miproducto,' se ingreso con exito' ); 

 RETURN v_mensaje;
END;
//
DELIMITER ;

/*Adicionar gastos*/
DROP FUNCTION adiciongasto;
DELIMITER //
CREATE FUNCTION adiciongasto(mifecha DATE, miproducto INT, midescripcion VARCHAR (100), mivalor_total INT)
RETURNS CHAR(230)
BEGIN 
 DECLARE v_mensaje CHAR(230);
 INSERT INTO Gastos(Fecha, Producto, Descripcion, Valor_Total)
 VALUES(mifecha,miproducto, midescripcion ,mivalor_Total);

 SET v_mensaje = concat('El gasto ',midescripcion  ,' se ingreso con exito' ); 

 RETURN v_mensaje;
END;
//
DELIMITER ;

/*Adicionar ventas*/
DROP FUNCTION adicionventa;
DELIMITER //
CREATE FUNCTION adicionventa(mifecha DATE, miproducto INT,micantidad INT,mivalor_unitario INT)
RETURNS CHAR(230)
BEGIN 
 DECLARE v_mensaje CHAR(230);
 INSERT INTO Ventas(Fecha, Producto, Cantidad, Valor_Unitario)
 VALUES(mifecha,miproducto,micantidad,mivalor_unitario);

 SET v_mensaje = concat('La venta ',miproducto,' se ingreso con exito' ); 

 RETURN v_mensaje;
END;
//
DELIMITER ;

/*sumar cantidad*/
DROP PROCEDURE IF EXISTS sumacant;
DELIMITER //
CREATE PROCEDURE sumacant(mes DATE, año DATE)
BEGIN 
 SELECT * FROM Produccion WHERE MONTH(Fecha) = mes AND YEAR(Fecha) = año
END;
//DELIMITER ;


Select adicionproducto('Tahiti',23,700,16100);
Select adicionproducto('Tahiti',6,700);
Select adicioncompra('2021/04/30',1,23,700);
Select adiciongasto('2021/05/07',2,'jarra-tabla-colador',9300);
Select adiciongasto('2021/05/08',2,'Papel Transparente',2000);
Select adicionventa('2021/05/02',2,5,2000);

/*Calcula precio compras*/
DROP TRIGGER IF EXISTS calcularprecio; 
DELIMITER //
CREATE TRIGGER calcularprecio BEFORE INSERT ON Compras
FOR EACH ROW
BEGIN
    SET NEW.Valor_Total = NEW.Cantidad * NEW.Valor_Unitario;
     
END;    
//
DELIMITER ;
/*Calcula precio ventas*/
DROP TRIGGER IF EXISTS calcularpreciov; 
DELIMITER //
CREATE TRIGGER calcularpreciov BEFORE INSERT ON Ventas
FOR EACH ROW
BEGIN
    SET NEW.Valor_Total = NEW.Cantidad * NEW.Valor_Unitario;
     
END;    
//
DELIMITER ;

DELIMITER //
CREATE TRIGGER nuevacantidad AFTER INSERT ON Compras
FOR EACH ROW
BEGIN
    DECLARE v_variacion INT; 
    DECLARE v_msj VARCHAR(255); 
    
    SET v_variacion = NEW.Cantidad;
    
   
     UPDATE Productos 
     SET Cantidad = Cantidad + v_variacion,
     WHERE Productos.Idproducto = NEW.Producto;
   
     
END;    
//
DELIMITER ;
