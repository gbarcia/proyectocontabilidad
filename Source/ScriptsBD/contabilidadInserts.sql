SET AUTOCOMMIT=0;
USE  `contabilidadGrupo2`;

INSERT INTO `CLIENTE` (`rif`, `nombre`) VALUES ('J-30877383-2', 'ABI COMPUTER CA');
INSERT INTO `CLIENTE` (`rif`, `nombre`) VALUES ('J-30667580-9', 'COMPU PARTS SA');
COMMIT;

INSERT INTO `PRODUCTO` (`id`, `nombre`, `costo_unitario`) VALUES (1, 'MOUSE OPTICO', 80);
INSERT INTO `PRODUCTO` (`id`, `nombre`, `costo_unitario`) VALUES (2, 'MOUSE LASER', 100);
COMMIT;

INSERT INTO `VENTA` (`id`, `CLIENTE_rif`, `PRODUCTO_id`, `fecha`, `costo_unitario`, `cantidad`) VALUES (1, 'J-30877383-2', 1, '2009-01-15', 80, 50);
INSERT INTO `VENTA` (`id`, `CLIENTE_rif`, `PRODUCTO_id`, `fecha`, `costo_unitario`, `cantidad`) VALUES (2, 'J-30877383-5', 2, '2009-01-20', 100, 30);
COMMIT;

INSERT INTO `PROVEEDOR` (`rif`, `nombre`) VALUES ('J-3466793-1', 'HP');
INSERT INTO `PROVEEDOR` (`rif`, `nombre`) VALUES ('J-1248931-5', 'EPSON');
COMMIT;

INSERT INTO `COMPRA` (`id`, `PRODUCTO_id`, `PROVEEDOR_rif`, `fecha`, `costo_unitario`, `cantidad`) VALUES (1, 1, 'J-3466793-1', '2009-01-01', 16, 200);
INSERT INTO `COMPRA` (`id`, `PRODUCTO_id`, `PROVEEDOR_rif`, `fecha`, `costo_unitario`, `cantidad`) VALUES (2, 2, 'J-1248931-5', '2009-01-10', 150, 100);
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

INSERT INTO `ASIENTO` (`num`, `fecha`) VALUES (1, '2009-01-01');
INSERT INTO `ASIENTO` (`num`, `fecha`) VALUES (2, '2009-01-01');
INSERT INTO `ASIENTO` (`num`, `fecha`) VALUES (3, '2009-01-01');
INSERT INTO `ASIENTO` (`num`, `fecha`) VALUES (4, '2009-01-10');
INSERT INTO `ASIENTO` (`num`, `fecha`) VALUES (5, '2009-01-15');
INSERT INTO `ASIENTO` (`num`, `fecha`) VALUES (6, '2009-01-20');
COMMIT;

INSERT INTO `REGISTRO` (`ASIENTO_num`, `CUENTA_num`, `debe`, `haber`, `VENTA_id`, `VENTA_CLIENTE_rif`, `VENTA_PRODUCTO_id`, `COMPRA_id`, `COMPRA_PRODUCTO_id`, `COMPRA_PROVEEDOR_rif`, `tipo`)
VALUES (1, 1, 1000000, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `REGISTRO` (`ASIENTO_num`, `CUENTA_num`, `debe`, `haber`, `VENTA_id`, `VENTA_CLIENTE_rif`, `VENTA_PRODUCTO_id`, `COMPRA_id`, `COMPRA_PRODUCTO_id`, `COMPRA_PROVEEDOR_rif`, `tipo`)
VALUES (1, 6, 0, 1000000, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `REGISTRO` (`ASIENTO_num`, `CUENTA_num`, `debe`, `haber`, `VENTA_id`, `VENTA_CLIENTE_rif`, `VENTA_PRODUCTO_id`, `COMPRA_id`, `COMPRA_PRODUCTO_id`, `COMPRA_PROVEEDOR_rif`, `tipo`)
VALUES (2, 1, 0, 200000, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `REGISTRO` (`ASIENTO_num`, `CUENTA_num`, `debe`, `haber`, `VENTA_id`, `VENTA_CLIENTE_rif`, `VENTA_PRODUCTO_id`, `COMPRA_id`, `COMPRA_PRODUCTO_id`, `COMPRA_PROVEEDOR_rif`, `tipo`)
VALUES (2, 2, 200000, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `REGISTRO` (`ASIENTO_num`, `CUENTA_num`, `debe`, `haber`, `VENTA_id`, `VENTA_CLIENTE_rif`, `VENTA_PRODUCTO_id`, `COMPRA_id`, `COMPRA_PRODUCTO_id`, `COMPRA_PROVEEDOR_rif`, `tipo`)
VALUES (3, 1, 0, 3200, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `REGISTRO` (`ASIENTO_num`, `CUENTA_num`, `debe`, `haber`, `VENTA_id`, `VENTA_CLIENTE_rif`, `VENTA_PRODUCTO_id`, `COMPRA_id`, `COMPRA_PRODUCTO_id`, `COMPRA_PROVEEDOR_rif`, `tipo`)
VALUES (3,12 , 3200, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `REGISTRO` (`ASIENTO_num`, `CUENTA_num`, `debe`, `haber`, `VENTA_id`, `VENTA_CLIENTE_rif`, `VENTA_PRODUCTO_id`, `COMPRA_id`, `COMPRA_PRODUCTO_id`, `COMPRA_PROVEEDOR_rif`, `tipo`)
VALUES (4, 1, 0, 15000, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `REGISTRO` (`ASIENTO_num`, `CUENTA_num`, `debe`, `haber`, `VENTA_id`, `VENTA_CLIENTE_rif`, `VENTA_PRODUCTO_id`, `COMPRA_id`, `COMPRA_PRODUCTO_id`, `COMPRA_PROVEEDOR_rif`, `tipo`)
VALUES (4, 13, 15000, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `REGISTRO` (`ASIENTO_num`, `CUENTA_num`, `debe`, `haber`, `VENTA_id`, `VENTA_CLIENTE_rif`, `VENTA_PRODUCTO_id`, `COMPRA_id`, `COMPRA_PRODUCTO_id`, `COMPRA_PROVEEDOR_rif`, `tipo`)
VALUES (5, 1, 400, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `REGISTRO` (`ASIENTO_num`, `CUENTA_num`, `debe`, `haber`, `VENTA_id`, `VENTA_CLIENTE_rif`, `VENTA_PRODUCTO_id`, `COMPRA_id`, `COMPRA_PRODUCTO_id`, `COMPRA_PROVEEDOR_rif`, `tipo`)
VALUES (5, 10, 0, 400, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `REGISTRO` (`ASIENTO_num`, `CUENTA_num`, `debe`, `haber`, `VENTA_id`, `VENTA_CLIENTE_rif`, `VENTA_PRODUCTO_id`, `COMPRA_id`, `COMPRA_PRODUCTO_id`, `COMPRA_PROVEEDOR_rif`, `tipo`)
VALUES (6, 1, 300, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `REGISTRO` (`ASIENTO_num`, `CUENTA_num`, `debe`, `haber`, `VENTA_id`, `VENTA_CLIENTE_rif`, `VENTA_PRODUCTO_id`, `COMPRA_id`, `COMPRA_PRODUCTO_id`, `COMPRA_PROVEEDOR_rif`, `tipo`)
VALUES (6, 11, 0, 300, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
COMMIT;
