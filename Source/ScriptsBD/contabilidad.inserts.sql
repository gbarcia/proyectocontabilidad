SET AUTOCOMMIT=0;
USE  `contabilidad`;

INSERT INTO `CLIENTE` (`rif`, `nombre`) VALUES ('J-30877383-2', 'ABI COMPUTER CA');
INSERT INTO `CLIENTE` (`rif`, `nombre`) VALUES ('J-30667580-9', 'COMPU PARTS SA');
COMMIT;

INSERT INTO `PRODUCTO` (`id`, `nombre`, `costo_unitario`) VALUES (1, 'MOUSE OPTICO', 30);
INSERT INTO `PRODUCTO` (`id`, `nombre`, `costo_unitario`) VALUES (2, 'MOUSE LASER', 50);
INSERT INTO `PRODUCTO` (`id`, `nombre`, `costo_unitario`) VALUES (3, 'CPU AMD', 300);
INSERT INTO `PRODUCTO` (`id`, `nombre`, `costo_unitario`) VALUES (4, 'CPU INTEL', 350);
COMMIT;

INSERT INTO `VENTA` (`id`, `CLIENTE_rif`, `PRODUCTO_id`, `fecha`, `costo_unitario`, `cantidad`) VALUES (1, 'J-30877383-2', 1, '2009-01-15', 80, 50);
INSERT INTO `VENTA` (`id`, `CLIENTE_rif`, `PRODUCTO_id`, `fecha`, `costo_unitario`, `cantidad`) VALUES (2, 'J-30877383-2', 2, '2009-01-20', 500, 30);
INSERT INTO `VENTA` (`id`, `CLIENTE_rif`, `PRODUCTO_id`, `fecha`, `costo_unitario`, `cantidad`) VALUES (3, 'J-30667580-9', 3, '2009-01-25', 580, 20);
INSERT INTO `VENTA` (`id`, `CLIENTE_rif`, `PRODUCTO_id`, `fecha`, `costo_unitario`, `cantidad`) VALUES (4, 'J-30667580-9', 4, '2009-01-29', 400, 300);
COMMIT;

INSERT INTO `PROVEEDOR` (`rif`, `nombre`) VALUES ('J-3466793-1', 'HP');
INSERT INTO `PROVEEDOR` (`rif`, `nombre`) VALUES ('J-1248931-5', 'EPSON');
COMMIT;

INSERT INTO `COMPRA` (`id`, `PRODUCTO_id`, `PROVEEDOR_rif`, `fecha`, `costo_unitario`, `cantidad`) VALUES (1, 1, 'J-3466793-1', '2009-01-01', 16, 200);
INSERT INTO `COMPRA` (`id`, `PRODUCTO_id`, `PROVEEDOR_rif`, `fecha`, `costo_unitario`, `cantidad`) VALUES (2, 3, 'J-1248931-5', '2009-01-10', 150, 100);
COMMIT;

INSERT INTO `CUENTA` (`num`, `tipo`, `nombre`, `descripcion`) VALUES (1, 'A', 'BANCO', 'CUENTA DE BANCO');
INSERT INTO `CUENTA` (`num`, `tipo`, `nombre`, `descripcion`) VALUES (2, 'A', 'MOBILIARIO', '');
INSERT INTO `CUENTA` (`num`, `tipo`, `nombre`, `descripcion`) VALUES (3, 'A', 'DEP ACUM MOB', '');
INSERT INTO `CUENTA` (`num`, `tipo`, `nombre`, `descripcion`) VALUES (4, 'A', 'INVENTARIO P1', '');
INSERT INTO `CUENTA` (`num`, `tipo`, `nombre`, `descripcion`) VALUES (5, 'A', 'INVENTARIO P2', '');
INSERT INTO `CUENTA` (`num`, `tipo`, `nombre`, `descripcion`) VALUES (6, 'P', 'CAPITAL', '');
INSERT INTO `CUENTA` (`num`, `tipo`, `nombre`, `descripcion`) VALUES (7, 'P', 'PRESTAMO PP', '');
INSERT INTO `CUENTA` (`num`, `tipo`, `nombre`, `descripcion`) VALUES (8, 'P', 'GANANCIAS Y PERDIDAS', '');
INSERT INTO `CUENTA` (`num`, `tipo`, `nombre`, `descripcion`) VALUES (9, 'P', 'UND', '');
INSERT INTO `CUENTA` (`num`, `tipo`, `nombre`, `descripcion`) VALUES (10, 'I', 'VENTA P1', '');
INSERT INTO `CUENTA` (`num`, `tipo`, `nombre`, `descripcion`) VALUES (11, 'I', 'VENTA P2', '');
INSERT INTO `CUENTA` (`num`, `tipo`, `nombre`, `descripcion`) VALUES (12, 'E', 'COMPRA P1', '');
INSERT INTO `CUENTA` (`num`, `tipo`, `nombre`, `descripcion`) VALUES (13, 'E', 'COMPRA P2', '');
INSERT INTO `CUENTA` (`num`, `tipo`, `nombre`, `descripcion`) VALUES (14, 'E', 'COSTO VENTA P1', '');
INSERT INTO `CUENTA` (`num`, `tipo`, `nombre`, `descripcion`) VALUES (15 , 'E', 'COSTO VENTA P2', '');
INSERT INTO `CUENTA` (`num`, `tipo`, `nombre`, `descripcion`) VALUES (16, 'E', 'SUELDOS Y SALARIOS', '');
COMMIT;