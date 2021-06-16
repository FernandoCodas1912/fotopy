#
# TABLE STRUCTURE FOR: apertura_cierre_caja
#

DROP TABLE IF EXISTS `apertura_cierre_caja`;

CREATE TABLE `apertura_cierre_caja` (
  `id_aperturacierrecaja` int(11) NOT NULL AUTO_INCREMENT,
  `monto_apertura` decimal(10,0) DEFAULT NULL,
  `f_apertura` datetime DEFAULT NULL,
  `montocierre` decimal(10,0) DEFAULT NULL,
  `f_cierre` datetime DEFAULT NULL,
  `estado_caja` int(1) DEFAULT NULL,
  `id_caja` int(11) DEFAULT NULL,
  `id_cajero` varchar(50) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_aperturacierrecaja`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

INSERT INTO `apertura_cierre_caja` (`id_aperturacierrecaja`, `monto_apertura`, `f_apertura`, `montocierre`, `f_cierre`, `estado_caja`, `id_caja`, `id_cajero`, `id_usuario`) VALUES (14, '1', '2020-02-29 12:55:52', NULL, NULL, 1, 1, 'superadmin', NULL);


#
# TABLE STRUCTURE FOR: caja
#

DROP TABLE IF EXISTS `caja`;

CREATE TABLE `caja` (
  `id_caja` int(11) NOT NULL AUTO_INCREMENT,
  `totalpagar` decimal(10,0) DEFAULT NULL,
  `montototal` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`id_caja`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: categoria
#

DROP TABLE IF EXISTS `categoria`;

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(200) DEFAULT NULL,
  `estado` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_categoria`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

INSERT INTO `categoria` (`id_categoria`, `descripcion`, `estado`) VALUES (1, 'SESION ESTUDIO', 3);
INSERT INTO `categoria` (`id_categoria`, `descripcion`, `estado`) VALUES (2, 'SESION EXTERIOR', 1);
INSERT INTO `categoria` (`id_categoria`, `descripcion`, `estado`) VALUES (3, 'PRESUPUESTO PARA SESIONES DE FOTOS BODAS', 1);
INSERT INTO `categoria` (`id_categoria`, `descripcion`, `estado`) VALUES (4, 'PRESUPUESTO PARA SESIONES DE FOTOS 15 AñOS', 1);
INSERT INTO `categoria` (`id_categoria`, `descripcion`, `estado`) VALUES (5, 'COBERTURA DE LA FIESTA 15 AñOS', 1);
INSERT INTO `categoria` (`id_categoria`, `descripcion`, `estado`) VALUES (6, 'COBERTURA DE LA FIESTA BODAS', 1);
INSERT INTO `categoria` (`id_categoria`, `descripcion`, `estado`) VALUES (7, 'COBERTURA VIP DE LA FIESTA 15 AñOS', 1);
INSERT INTO `categoria` (`id_categoria`, `descripcion`, `estado`) VALUES (8, 'COBERTURA VIP DE LA FIESTA BODAS', 1);


#
# TABLE STRUCTURE FOR: ciudad
#

DROP TABLE IF EXISTS `ciudad`;

CREATE TABLE `ciudad` (
  `id_ciudad` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL COMMENT '1=activo, 2=inactivo',
  `cod` varchar(11) NOT NULL,
  PRIMARY KEY (`id_ciudad`)
) ENGINE=MyISAM AUTO_INCREMENT=269406 DEFAULT CHARSET=utf8;

INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (9670, 'ASUNCIÓN', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (10341, 'FERNANDO DE LA MORA', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (11536, 'OBLIGADO', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (12291, 'ENCARNACIÓN', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (13358, 'SAN LORENZO', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (14723, 'CIUDAD DEL ESTE', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (14724, 'LOMA PLATA', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (14725, 'HERNANDARIAS', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (102544, 'LUQUE', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (102545, 'CAPITÁN MIRANDA', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (102546, 'PILAR', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (102547, 'PRESIDENTE FRANCO', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (102548, 'SANTA RITA', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (102549, 'LOS CEDRALES', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (102887, 'LAMBARÉ', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (104479, 'HOHENAU', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (104694, 'CAPIATÁ', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (107004, 'CAAGUAZÚ', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (115005, 'EUSEBIO AYALA', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (115083, 'PIRIBEBUY', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (121918, 'NUEVA COLOMBIA', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (128160, 'VILLARRICA', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (128161, 'CORONEL OVIEDO', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (140580, 'VILLA ELISA', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (140581, 'SAN ANTONIO', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (148854, 'CAAZAPÁ', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (148855, 'BELLA VISTA', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (148856, 'NEMBY', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (148857, 'CAACUPÉ', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (148858, 'CONCEPCIÓN', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (148859, 'LIMPIO', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (148860, 'ITÁ', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (148861, 'YPANE', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (148865, 'MARIANO ROQUE ALONSO', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (149248, 'SALTO DEL GUAIRÁ', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (149311, 'PEDRO JUAN CABALLERO', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (149312, 'VILLA HAYES', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (153873, 'ALBERDI', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (157143, 'AREGUÁ', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (160430, 'NARANJAL', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (160559, 'QUIINDY', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (162947, 'CARMEN DEL PARANÁ', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (166367, 'YPACARAI', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (166368, 'EDELIRA', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (166544, 'CORONEL BOGADO', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (168369, 'FILADELFIA', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (174546, 'ALTOS', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (177961, 'PUERTO ELSA', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (179538, 'SAN ESTANISLAO', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (179586, 'VILLETA', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (181010, 'ASSETADERO', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (185206, 'FRAM', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (187260, 'CAMBYRETÁ', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (187308, 'CAPITÁN MEZA', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (189558, 'SAN BERNARDINO', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (189559, 'PARAGUARÍ', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (191798, 'ITAUGUÁ', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (194235, 'TOBATÍ', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (197437, 'GUARAMBARÉ', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (197485, 'CARAPEGUÁ', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (200410, 'LA PAZ', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (211304, 'YATAITY', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (212060, 'SANTA ROSA', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (217517, 'SAN JOSÉ DE LOS ARROYOS', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (219571, 'INDEPENDENCIA', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (223241, 'SAN ALBERTO', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (226479, 'PIRAPO', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (228672, 'BENJAMÍN ACEVAL', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (233362, 'ACAHAY', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (234219, 'ROSARIO', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (235469, 'YUTY', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (244393, 'NATALIO', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (248689, 'LOMA GRANDE', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (256555, 'EMBOSCADA', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (265499, 'COLONIA INDEPENDENCIA', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (268809, 'VILLA SAN FRANCISCO', 1, 'PY');
INSERT INTO `ciudad` (`id_ciudad`, `descripcion`, `estado`, `cod`) VALUES (269405, 'YHÚ', 1, 'PY');


#
# TABLE STRUCTURE FOR: cliente
#

DROP TABLE IF EXISTS `cliente`;

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `razonsocial` varchar(200) DEFAULT NULL,
  `nrodocumento` varchar(50) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `telefono` int(10) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `id_ciudad` int(11) DEFAULT NULL,
  `id_pais` int(11) DEFAULT NULL,
  `estado` int(1) DEFAULT NULL,
  `date_add` datetime DEFAULT NULL,
  `date_mod` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_cliente`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

INSERT INTO `cliente` (`id_cliente`, `razonsocial`, `nrodocumento`, `direccion`, `telefono`, `email`, `id_ciudad`, `id_pais`, `estado`, `date_add`, `date_mod`) VALUES (1, 'PRBA CLIENTE', '32423', 'DAT', 2342, 'a@a.com', 9670, 172, 1, '2018-08-21 09:38:09', '2019-10-26 15:55:45');
INSERT INTO `cliente` (`id_cliente`, `razonsocial`, `nrodocumento`, `direccion`, `telefono`, `email`, `id_ciudad`, `id_pais`, `estado`, `date_add`, `date_mod`) VALUES (2, 'FULANO DE TAL', '243423423', 'SIN DATOS', 2432, '', 9670, 172, 1, NULL, '2019-10-26 15:55:48');
INSERT INTO `cliente` (`id_cliente`, `razonsocial`, `nrodocumento`, `direccion`, `telefono`, `email`, `id_ciudad`, `id_pais`, `estado`, `date_add`, `date_mod`) VALUES (5, 'ARNOLD', '23423', 'SIN DIRECCION', 234, '', 9670, 156, 3, '2018-08-21 10:51:53', '2019-10-26 16:03:20');
INSERT INTO `cliente` (`id_cliente`, `razonsocial`, `nrodocumento`, `direccion`, `telefono`, `email`, `id_ciudad`, `id_pais`, `estado`, `date_add`, `date_mod`) VALUES (6, '345345', '2342323454', 'SIN DATOS', 2147483647, 'qqqweq@a.com', 9670, 173, 3, '2019-06-08 13:15:33', '2019-10-26 16:03:17');
INSERT INTO `cliente` (`id_cliente`, `razonsocial`, `nrodocumento`, `direccion`, `telefono`, `email`, `id_ciudad`, `id_pais`, `estado`, `date_add`, `date_mod`) VALUES (7, 'FSFS', '22', 'A@A.COM', 24, 'a@a.com', 12291, 6, 3, '2019-10-26 16:02:52', '2019-10-26 16:03:14');


#
# TABLE STRUCTURE FOR: comprobantes
#

DROP TABLE IF EXISTS `comprobantes`;

CREATE TABLE `comprobantes` (
  `id_comprobante` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL,
  `serie_comprobante` varchar(50) NOT NULL,
  `ultimo_nro` varchar(50) NOT NULL,
  `estado_comprobante` int(1) NOT NULL,
  PRIMARY KEY (`id_comprobante`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO `comprobantes` (`id_comprobante`, `descripcion`, `serie_comprobante`, `ultimo_nro`, `estado_comprobante`) VALUES (1, 'FACTURA', '001-001', '0000005', 1);
INSERT INTO `comprobantes` (`id_comprobante`, `descripcion`, `serie_comprobante`, `ultimo_nro`, `estado_comprobante`) VALUES (2, 'TICKET', '001-002', '0000002', 1);
INSERT INTO `comprobantes` (`id_comprobante`, `descripcion`, `serie_comprobante`, `ultimo_nro`, `estado_comprobante`) VALUES (3, 'BOLETA', '001-003', '0', 1);
INSERT INTO `comprobantes` (`id_comprobante`, `descripcion`, `serie_comprobante`, `ultimo_nro`, `estado_comprobante`) VALUES (4, 'PRESUPUESTO', '001-001', '0', 1);


#
# TABLE STRUCTURE FOR: detalle_venta
#

DROP TABLE IF EXISTS `detalle_venta`;

CREATE TABLE `detalle_venta` (
  `id_detalle_venta` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `descuento` int(11) NOT NULL,
  `importe` int(11) NOT NULL,
  `estado` int(1) NOT NULL,
  PRIMARY KEY (`id_detalle_venta`)
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;

INSERT INTO `detalle_venta` (`id_detalle_venta`, `id_producto`, `id_venta`, `cantidad`, `precio`, `descuento`, `importe`, `estado`) VALUES (41, 1, 10, 1, 9000, 0, 9000, 3);
INSERT INTO `detalle_venta` (`id_detalle_venta`, `id_producto`, `id_venta`, `cantidad`, `precio`, `descuento`, `importe`, `estado`) VALUES (42, 1, 11, 4, 9000, 0, 36000, 1);
INSERT INTO `detalle_venta` (`id_detalle_venta`, `id_producto`, `id_venta`, `cantidad`, `precio`, `descuento`, `importe`, `estado`) VALUES (43, 2, 12, 1, 8000, 0, 8000, 1);
INSERT INTO `detalle_venta` (`id_detalle_venta`, `id_producto`, `id_venta`, `cantidad`, `precio`, `descuento`, `importe`, `estado`) VALUES (44, 1, 13, 2, 9000, 0, 18000, 1);
INSERT INTO `detalle_venta` (`id_detalle_venta`, `id_producto`, `id_venta`, `cantidad`, `precio`, `descuento`, `importe`, `estado`) VALUES (45, 1, 14, 2, 9000, 0, 18000, 1);
INSERT INTO `detalle_venta` (`id_detalle_venta`, `id_producto`, `id_venta`, `cantidad`, `precio`, `descuento`, `importe`, `estado`) VALUES (46, 2, 15, 1, 8000, 0, 8000, 1);
INSERT INTO `detalle_venta` (`id_detalle_venta`, `id_producto`, `id_venta`, `cantidad`, `precio`, `descuento`, `importe`, `estado`) VALUES (47, 1, 17, 0, 9000, 0, 9000, 1);
INSERT INTO `detalle_venta` (`id_detalle_venta`, `id_producto`, `id_venta`, `cantidad`, `precio`, `descuento`, `importe`, `estado`) VALUES (48, 1, 19, 1, 9000, 0, 9000, 1);
INSERT INTO `detalle_venta` (`id_detalle_venta`, `id_producto`, `id_venta`, `cantidad`, `precio`, `descuento`, `importe`, `estado`) VALUES (49, 5, 20, 1, 544, 0, 544, 1);
INSERT INTO `detalle_venta` (`id_detalle_venta`, `id_producto`, `id_venta`, `cantidad`, `precio`, `descuento`, `importe`, `estado`) VALUES (50, 5, 21, 1, 544, 0, 544, 1);
INSERT INTO `detalle_venta` (`id_detalle_venta`, `id_producto`, `id_venta`, `cantidad`, `precio`, `descuento`, `importe`, `estado`) VALUES (51, 4, 22, 1, 4323, 0, 4323, 1);
INSERT INTO `detalle_venta` (`id_detalle_venta`, `id_producto`, `id_venta`, `cantidad`, `precio`, `descuento`, `importe`, `estado`) VALUES (52, 2, 23, 13, 8000, 0, 104000, 1);
INSERT INTO `detalle_venta` (`id_detalle_venta`, `id_producto`, `id_venta`, `cantidad`, `precio`, `descuento`, `importe`, `estado`) VALUES (53, 5, 23, 3, 544, 0, 1632, 1);
INSERT INTO `detalle_venta` (`id_detalle_venta`, `id_producto`, `id_venta`, `cantidad`, `precio`, `descuento`, `importe`, `estado`) VALUES (54, 1, 24, 13, 9000, 0, 117000, 1);
INSERT INTO `detalle_venta` (`id_detalle_venta`, `id_producto`, `id_venta`, `cantidad`, `precio`, `descuento`, `importe`, `estado`) VALUES (55, 4, 24, 12, 4323, 0, 51876, 1);
INSERT INTO `detalle_venta` (`id_detalle_venta`, `id_producto`, `id_venta`, `cantidad`, `precio`, `descuento`, `importe`, `estado`) VALUES (56, 6, 24, 13, 5000, 0, 65000, 1);
INSERT INTO `detalle_venta` (`id_detalle_venta`, `id_producto`, `id_venta`, `cantidad`, `precio`, `descuento`, `importe`, `estado`) VALUES (57, 1, 25, 13, 9000, 0, 117000, 1);
INSERT INTO `detalle_venta` (`id_detalle_venta`, `id_producto`, `id_venta`, `cantidad`, `precio`, `descuento`, `importe`, `estado`) VALUES (58, 6, 25, 1, 5000, 0, 5000, 1);
INSERT INTO `detalle_venta` (`id_detalle_venta`, `id_producto`, `id_venta`, `cantidad`, `precio`, `descuento`, `importe`, `estado`) VALUES (59, 8, 25, 1, 0, 0, 0, 1);
INSERT INTO `detalle_venta` (`id_detalle_venta`, `id_producto`, `id_venta`, `cantidad`, `precio`, `descuento`, `importe`, `estado`) VALUES (60, 3, 25, 1, 342343433, 0, 342343433, 1);
INSERT INTO `detalle_venta` (`id_detalle_venta`, `id_producto`, `id_venta`, `cantidad`, `precio`, `descuento`, `importe`, `estado`) VALUES (61, 1, 26, 1, 500000, 0, 500000, 1);
INSERT INTO `detalle_venta` (`id_detalle_venta`, `id_producto`, `id_venta`, `cantidad`, `precio`, `descuento`, `importe`, `estado`) VALUES (62, 5, 30, 1, 500000, 0, 500000, 1);
INSERT INTO `detalle_venta` (`id_detalle_venta`, `id_producto`, `id_venta`, `cantidad`, `precio`, `descuento`, `importe`, `estado`) VALUES (63, 1, 31, 1, 500000, 0, 500000, 1);
INSERT INTO `detalle_venta` (`id_detalle_venta`, `id_producto`, `id_venta`, `cantidad`, `precio`, `descuento`, `importe`, `estado`) VALUES (64, 1, 32, 1, 500000, 0, 500000, 1);
INSERT INTO `detalle_venta` (`id_detalle_venta`, `id_producto`, `id_venta`, `cantidad`, `precio`, `descuento`, `importe`, `estado`) VALUES (65, 3, 32, 1, 300000, 0, 300000, 1);
INSERT INTO `detalle_venta` (`id_detalle_venta`, `id_producto`, `id_venta`, `cantidad`, `precio`, `descuento`, `importe`, `estado`) VALUES (66, 1, 33, 1, 500000, 0, 500000, 1);
INSERT INTO `detalle_venta` (`id_detalle_venta`, `id_producto`, `id_venta`, `cantidad`, `precio`, `descuento`, `importe`, `estado`) VALUES (67, 2, 34, 1, 500000, 0, 500000, 1);
INSERT INTO `detalle_venta` (`id_detalle_venta`, `id_producto`, `id_venta`, `cantidad`, `precio`, `descuento`, `importe`, `estado`) VALUES (68, 1, 35, 1, 500000, 0, 500000, 1);
INSERT INTO `detalle_venta` (`id_detalle_venta`, `id_producto`, `id_venta`, `cantidad`, `precio`, `descuento`, `importe`, `estado`) VALUES (69, 7, 35, 1, 15000, 0, 15000, 1);
INSERT INTO `detalle_venta` (`id_detalle_venta`, `id_producto`, `id_venta`, `cantidad`, `precio`, `descuento`, `importe`, `estado`) VALUES (70, 9, 36, 1, 1100000, 0, 1100000, 1);
INSERT INTO `detalle_venta` (`id_detalle_venta`, `id_producto`, `id_venta`, `cantidad`, `precio`, `descuento`, `importe`, `estado`) VALUES (71, 9, 37, 1, 1100000, 0, 1100000, 1);


#
# TABLE STRUCTURE FOR: empleado
#

DROP TABLE IF EXISTS `empleado`;

CREATE TABLE `empleado` (
  `id_empleado` int(11) NOT NULL AUTO_INCREMENT,
  `nomape` varchar(200) DEFAULT NULL,
  `nrodocumento` varchar(50) DEFAULT NULL,
  `cargo` varchar(200) DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `salario` int(11) DEFAULT NULL,
  `id_ciudad` int(11) DEFAULT NULL,
  `estado` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_empleado`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO `empleado` (`id_empleado`, `nomape`, `nrodocumento`, `cargo`, `telefono`, `email`, `salario`, `id_ciudad`, `estado`) VALUES (1, 'FERNANDO CODAS', '3532633', 'Asesor de TIC', 295123, 'codasf@gmail.com', 5000000, 9670, 1);
INSERT INTO `empleado` (`id_empleado`, `nomape`, `nrodocumento`, `cargo`, `telefono`, `email`, `salario`, `id_ciudad`, `estado`) VALUES (2, 'SARA ZAMPHIROPOLOS', '4595262', 'Asesora de TIC', 981874569, 'saritazr@gmail.com', 5000000, 9670, 1);
INSERT INTO `empleado` (`id_empleado`, `nomape`, `nrodocumento`, `cargo`, `telefono`, `email`, `salario`, `id_ciudad`, `estado`) VALUES (5, 'MODIFICADO  AHORA', '1112', NULL, 222, 'a@a.com', NULL, 128160, 1);


#
# TABLE STRUCTURE FOR: empresa
#

DROP TABLE IF EXISTS `empresa`;

CREATE TABLE `empresa` (
  `id_empresa` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `slogan` varchar(100) DEFAULT NULL,
  `nrodocumento` varchar(50) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `telefono` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `sitioweb` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_empresa`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `empresa` (`id_empresa`, `nombre`, `slogan`, `nrodocumento`, `direccion`, `telefono`, `email`, `sitioweb`) VALUES (1, 'FOTO', 'En el corazón de tus recuerdos\r\n', '2539699-3', 'Misiones N° 2005 casi Mateo Estigarribia ', ' +595 981 9491957', 'foto@foto.com.py', 'https://www.foto.com.py/');


#
# TABLE STRUCTURE FOR: formapago
#

DROP TABLE IF EXISTS `formapago`;

CREATE TABLE `formapago` (
  `id_formapago` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) DEFAULT NULL,
  `estado` int(1) DEFAULT NULL COMMENT '1=activo, 2=inactivo',
  PRIMARY KEY (`id_formapago`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `formapago` (`id_formapago`, `descripcion`, `estado`) VALUES (1, 'Efectivo', 1);
INSERT INTO `formapago` (`id_formapago`, `descripcion`, `estado`) VALUES (2, 'Cheque', 1);
INSERT INTO `formapago` (`id_formapago`, `descripcion`, `estado`) VALUES (3, 'Anticipo', 1);


#
# TABLE STRUCTURE FOR: galeria
#

DROP TABLE IF EXISTS `galeria`;

CREATE TABLE `galeria` (
  `id_galeria` int(11) NOT NULL AUTO_INCREMENT,
  `detallegaleria` varchar(150) DEFAULT NULL,
  `fk_id_cliente` int(11) DEFAULT NULL,
  `fk_id_producto` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_galeria`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: paises
#

DROP TABLE IF EXISTS `paises`;

CREATE TABLE `paises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iso` char(2) DEFAULT NULL,
  `nombre` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=241 DEFAULT CHARSET=latin1;

INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (1, 'AF', 'Afganistán');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (2, 'AX', 'Islas Gland');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (3, 'AL', 'Albania');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (4, 'DE', 'Alemania');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (5, 'AD', 'Andorra');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (6, 'AO', 'Angola');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (7, 'AI', 'Anguilla');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (8, 'AQ', 'Antártida');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (9, 'AG', 'Antigua y Barbuda');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (10, 'AN', 'Antillas Holandesas');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (11, 'SA', 'Arabia Saudí');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (12, 'DZ', 'Argelia');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (13, 'AR', 'Argentina');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (14, 'AM', 'Armenia');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (15, 'AW', 'Aruba');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (16, 'AU', 'Australia');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (17, 'AT', 'Austria');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (18, 'AZ', 'Azerbaiyán');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (19, 'BS', 'Bahamas');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (20, 'BH', 'Bahréin');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (21, 'BD', 'Bangladesh');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (22, 'BB', 'Barbados');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (23, 'BY', 'Bielorrusia');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (24, 'BE', 'Bélgica');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (25, 'BZ', 'Belice');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (26, 'BJ', 'Benin');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (27, 'BM', 'Bermudas');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (28, 'BT', 'Bhután');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (29, 'BO', 'Bolivia');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (30, 'BA', 'Bosnia y Herzegovina');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (31, 'BW', 'Botsuana');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (32, 'BV', 'Isla Bouvet');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (33, 'BR', 'Brasil');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (34, 'BN', 'Brunéi');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (35, 'BG', 'Bulgaria');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (36, 'BF', 'Burkina Faso');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (37, 'BI', 'Burundi');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (38, 'CV', 'Cabo Verde');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (39, 'KY', 'Islas Caimán');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (40, 'KH', 'Camboya');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (41, 'CM', 'Camerún');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (42, 'CA', 'Canadá');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (43, 'CF', 'República Centroafricana');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (44, 'TD', 'Chad');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (45, 'CZ', 'República Checa');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (46, 'CL', 'Chile');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (47, 'CN', 'China');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (48, 'CY', 'Chipre');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (49, 'CX', 'Isla de Navidad');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (50, 'VA', 'Ciudad del Vaticano');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (51, 'CC', 'Islas Cocos');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (52, 'CO', 'Colombia');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (53, 'KM', 'Comoras');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (54, 'CD', 'República Democrática del Congo');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (55, 'CG', 'Congo');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (56, 'CK', 'Islas Cook');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (57, 'KP', 'Corea del Norte');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (58, 'KR', 'Corea del Sur');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (59, 'CI', 'Costa de Marfil');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (60, 'CR', 'Costa Rica');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (61, 'HR', 'Croacia');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (62, 'CU', 'Cuba');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (63, 'DK', 'Dinamarca');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (64, 'DM', 'Dominica');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (65, 'DO', 'República Dominicana');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (66, 'EC', 'Ecuador');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (67, 'EG', 'Egipto');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (68, 'SV', 'El Salvador');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (69, 'AE', 'Emiratos Árabes Unidos');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (70, 'ER', 'Eritrea');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (71, 'SK', 'Eslovaquia');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (72, 'SI', 'Eslovenia');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (73, 'ES', 'España');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (74, 'UM', 'Islas ultramarinas de Estados Unidos');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (75, 'US', 'Estados Unidos');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (76, 'EE', 'Estonia');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (77, 'ET', 'Etiopía');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (78, 'FO', 'Islas Feroe');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (79, 'PH', 'Filipinas');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (80, 'FI', 'Finlandia');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (81, 'FJ', 'Fiyi');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (82, 'FR', 'Francia');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (83, 'GA', 'Gabón');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (84, 'GM', 'Gambia');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (85, 'GE', 'Georgia');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (86, 'GS', 'Islas Georgias del Sur y Sandwich del Sur');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (87, 'GH', 'Ghana');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (88, 'GI', 'Gibraltar');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (89, 'GD', 'Granada');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (90, 'GR', 'Grecia');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (91, 'GL', 'Groenlandia');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (92, 'GP', 'Guadalupe');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (93, 'GU', 'Guam');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (94, 'GT', 'Guatemala');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (95, 'GF', 'Guayana Francesa');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (96, 'GN', 'Guinea');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (97, 'GQ', 'Guinea Ecuatorial');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (98, 'GW', 'Guinea-Bissau');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (99, 'GY', 'Guyana');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (100, 'HT', 'Haití');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (101, 'HM', 'Islas Heard y McDonald');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (102, 'HN', 'Honduras');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (103, 'HK', 'Hong Kong');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (104, 'HU', 'Hungría');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (105, 'IN', 'India');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (106, 'ID', 'Indonesia');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (107, 'IR', 'Irán');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (108, 'IQ', 'Iraq');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (109, 'IE', 'Irlanda');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (110, 'IS', 'Islandia');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (111, 'IL', 'Israel');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (112, 'IT', 'Italia');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (113, 'JM', 'Jamaica');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (114, 'JP', 'Japón');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (115, 'JO', 'Jordania');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (116, 'KZ', 'Kazajstán');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (117, 'KE', 'Kenia');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (118, 'KG', 'Kirguistán');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (119, 'KI', 'Kiribati');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (120, 'KW', 'Kuwait');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (121, 'LA', 'Laos');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (122, 'LS', 'Lesotho');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (123, 'LV', 'Letonia');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (124, 'LB', 'Líbano');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (125, 'LR', 'Liberia');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (126, 'LY', 'Libia');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (127, 'LI', 'Liechtenstein');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (128, 'LT', 'Lituania');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (129, 'LU', 'Luxemburgo');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (130, 'MO', 'Macao');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (131, 'MK', 'ARY Macedonia');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (132, 'MG', 'Madagascar');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (133, 'MY', 'Malasia');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (134, 'MW', 'Malawi');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (135, 'MV', 'Maldivas');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (136, 'ML', 'Malí');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (137, 'MT', 'Malta');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (138, 'FK', 'Islas Malvinas');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (139, 'MP', 'Islas Marianas del Norte');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (140, 'MA', 'Marruecos');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (141, 'MH', 'Islas Marshall');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (142, 'MQ', 'Martinica');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (143, 'MU', 'Mauricio');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (144, 'MR', 'Mauritania');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (145, 'YT', 'Mayotte');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (146, 'MX', 'México');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (147, 'FM', 'Micronesia');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (148, 'MD', 'Moldavia');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (149, 'MC', 'Mónaco');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (150, 'MN', 'Mongolia');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (151, 'MS', 'Montserrat');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (152, 'MZ', 'Mozambique');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (153, 'MM', 'Myanmar');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (154, 'NA', 'Namibia');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (155, 'NR', 'Nauru');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (156, 'NP', 'Nepal');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (157, 'NI', 'Nicaragua');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (158, 'NE', 'Níger');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (159, 'NG', 'Nigeria');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (160, 'NU', 'Niue');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (161, 'NF', 'Isla Norfolk');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (162, 'NO', 'Noruega');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (163, 'NC', 'Nueva Caledonia');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (164, 'NZ', 'Nueva Zelanda');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (165, 'OM', 'Omán');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (166, 'NL', 'Países Bajos');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (167, 'PK', 'Pakistán');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (168, 'PW', 'Palau');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (169, 'PS', 'Palestina');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (170, 'PA', 'Panamá');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (171, 'PG', 'Papúa Nueva Guinea');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (172, 'PY', 'Paraguay');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (173, 'PE', 'Perú');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (174, 'PN', 'Islas Pitcairn');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (175, 'PF', 'Polinesia Francesa');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (176, 'PL', 'Polonia');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (177, 'PT', 'Portugal');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (178, 'PR', 'Puerto Rico');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (179, 'QA', 'Qatar');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (180, 'GB', 'Reino Unido');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (181, 'RE', 'Reunión');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (182, 'RW', 'Ruanda');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (183, 'RO', 'Rumania');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (184, 'RU', 'Rusia');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (185, 'EH', 'Sahara Occidental');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (186, 'SB', 'Islas Salomón');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (187, 'WS', 'Samoa');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (188, 'AS', 'Samoa Americana');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (189, 'KN', 'San Cristóbal y Nevis');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (190, 'SM', 'San Marino');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (191, 'PM', 'San Pedro y Miquelón');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (192, 'VC', 'San Vicente y las Granadinas');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (193, 'SH', 'Santa Helena');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (194, 'LC', 'Santa Lucía');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (195, 'ST', 'Santo Tomé y Príncipe');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (196, 'SN', 'Senegal');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (197, 'CS', 'Serbia y Montenegro');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (198, 'SC', 'Seychelles');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (199, 'SL', 'Sierra Leona');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (200, 'SG', 'Singapur');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (201, 'SY', 'Siria');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (202, 'SO', 'Somalia');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (203, 'LK', 'Sri Lanka');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (204, 'SZ', 'Suazilandia');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (205, 'ZA', 'Sudáfrica');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (206, 'SD', 'Sudán');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (207, 'SE', 'Suecia');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (208, 'CH', 'Suiza');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (209, 'SR', 'Surinam');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (210, 'SJ', 'Svalbard y Jan Mayen');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (211, 'TH', 'Tailandia');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (212, 'TW', 'Taiwán');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (213, 'TZ', 'Tanzania');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (214, 'TJ', 'Tayikistán');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (215, 'IO', 'Territorio Británico del Océano Índico');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (216, 'TF', 'Territorios Australes Franceses');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (217, 'TL', 'Timor Oriental');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (218, 'TG', 'Togo');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (219, 'TK', 'Tokelau');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (220, 'TO', 'Tonga');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (221, 'TT', 'Trinidad y Tobago');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (222, 'TN', 'Túnez');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (223, 'TC', 'Islas Turcas y Caicos');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (224, 'TM', 'Turkmenistán');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (225, 'TR', 'Turquía');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (226, 'TV', 'Tuvalu');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (227, 'UA', 'Ucrania');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (228, 'UG', 'Uganda');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (229, 'UY', 'Uruguay');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (230, 'UZ', 'Uzbekistán');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (231, 'VU', 'Vanuatu');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (232, 'VE', 'Venezuela');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (233, 'VN', 'Vietnam');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (234, 'VG', 'Islas Vírgenes Británicas');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (235, 'VI', 'Islas Vírgenes de los Estados Unidos');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (236, 'WF', 'Wallis y Futuna');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (237, 'YE', 'Yemen');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (238, 'DJ', 'Yibuti');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (239, 'ZM', 'Zambia');
INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES (240, 'ZW', 'Zimbabue');


#
# TABLE STRUCTURE FOR: permisos
#

DROP TABLE IF EXISTS `permisos`;

CREATE TABLE `permisos` (
  `id_permiso` int(11) NOT NULL AUTO_INCREMENT,
  `servicios` int(11) DEFAULT NULL COMMENT '1-leer,borrar,modifar. 2- solo leer, 3, leer y modificar',
  `reservas` int(11) DEFAULT NULL,
  `cobranzas` int(11) DEFAULT NULL,
  `mantenimientos` int(11) DEFAULT NULL,
  `ventas` int(11) DEFAULT NULL,
  `usuarios` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_permiso`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `permisos` (`id_permiso`, `servicios`, `reservas`, `cobranzas`, `mantenimientos`, `ventas`, `usuarios`) VALUES (1, 1, 1, 1, 1, 1, 1);


#
# TABLE STRUCTURE FOR: personatrainning
#

DROP TABLE IF EXISTS `personatrainning`;

CREATE TABLE `personatrainning` (
  `idpersona` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) DEFAULT NULL,
  `appaterno` varchar(30) DEFAULT NULL,
  `ampaterno` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `dni` char(1) DEFAULT NULL,
  `personatrainningcol` datetime DEFAULT NULL,
  PRIMARY KEY (`idpersona`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: presupuesto
#

DROP TABLE IF EXISTS `presupuesto`;

CREATE TABLE `presupuesto` (
  `id_presupuesto` int(11) NOT NULL AUTO_INCREMENT,
  `estado_presupuesto` varchar(20) DEFAULT NULL,
  `observaciones_presupuesto` varchar(150) DEFAULT NULL,
  `fk_id_contrato` int(11) DEFAULT NULL,
  `fk_id_reserva` int(11) DEFAULT NULL,
  `fk_id_trabajoadicional` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_presupuesto`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: producto_servicio
#

DROP TABLE IF EXISTS `producto_servicio`;

CREATE TABLE `producto_servicio` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) DEFAULT NULL,
  `codigobarra` int(11) DEFAULT NULL,
  `descripcion` varchar(150) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `precio_compra` int(11) DEFAULT NULL,
  `precio_venta` int(11) DEFAULT NULL,
  `estado` int(1) DEFAULT NULL,
  `impuesto` int(2) DEFAULT '0',
  PRIMARY KEY (`id_producto`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

INSERT INTO `producto_servicio` (`id_producto`, `id_categoria`, `codigobarra`, `descripcion`, `stock`, `precio_compra`, `precio_venta`, `estado`, `impuesto`) VALUES (1, 3, 23423, 'PHOTOBOOK 30X45 DE SESIóN', -4, 0, 500000, 1, 10);
INSERT INTO `producto_servicio` (`id_producto`, `id_categoria`, `codigobarra`, `descripcion`, `stock`, `precio_compra`, `precio_venta`, `estado`, `impuesto`) VALUES (2, 3, 33123, 'Cuadro Grande', 0, 0, 500000, 1, 10);
INSERT INTO `producto_servicio` (`id_producto`, `id_categoria`, `codigobarra`, `descripcion`, `stock`, `precio_compra`, `precio_venta`, `estado`, `impuesto`) VALUES (3, 3, 2342, 'Banner 90x120', 0, 0, 300000, 1, 10);
INSERT INTO `producto_servicio` (`id_producto`, `id_categoria`, `codigobarra`, `descripcion`, `stock`, `precio_compra`, `precio_venta`, `estado`, `impuesto`) VALUES (4, 3, 12341312, 'Tomas con Drone de Sesión', 1, 0, 300000, 1, 10);
INSERT INTO `producto_servicio` (`id_producto`, `id_categoria`, `codigobarra`, `descripcion`, `stock`, `precio_compra`, `precio_venta`, `estado`, `impuesto`) VALUES (5, 3, 123123, 'Tomas con Drone en Evento', 0, 0, 500000, 1, 10);
INSERT INTO `producto_servicio` (`id_producto`, `id_categoria`, `codigobarra`, `descripcion`, `stock`, `precio_compra`, `precio_venta`, `estado`, `impuesto`) VALUES (6, 3, 23423, 'Producción Vídeo BackStage', 1, 0, 700000, 1, 10);
INSERT INTO `producto_servicio` (`id_producto`, `id_categoria`, `codigobarra`, `descripcion`, `stock`, `precio_compra`, `precio_venta`, `estado`, `impuesto`) VALUES (7, 3, 112312, 'Fotos Adicionales en Álbum de Fiesta', 0, 0, 15000, 1, 10);
INSERT INTO `producto_servicio` (`id_producto`, `id_categoria`, `codigobarra`, `descripcion`, `stock`, `precio_compra`, `precio_venta`, `estado`, `impuesto`) VALUES (8, 4, 2112, 'Maquillaje de rorromakeup Rodrigo Arevalos', 1, 0, 500000, 1, 10);
INSERT INTO `producto_servicio` (`id_producto`, `id_categoria`, `codigobarra`, `descripcion`, `stock`, `precio_compra`, `precio_venta`, `estado`, `impuesto`) VALUES (9, 4, 12121, 'Cabina Tipo Totem 2 horas copias ilimitadas', -1, 0, 1100000, 1, 10);
INSERT INTO `producto_servicio` (`id_producto`, `id_categoria`, `codigobarra`, `descripcion`, `stock`, `precio_compra`, `precio_venta`, `estado`, `impuesto`) VALUES (10, 4, 213121, 'Cabina Tipo Espejo una hora y media copias ilimitadas', 1, 0, 1500000, 1, 10);
INSERT INTO `producto_servicio` (`id_producto`, `id_categoria`, `codigobarra`, `descripcion`, `stock`, `precio_compra`, `precio_venta`, `estado`, `impuesto`) VALUES (11, 4, 21212, '**Cabina Tipo Espejo 3 horas copias ilimitadas', 1, 0, 2200000, 1, 10);
INSERT INTO `producto_servicio` (`id_producto`, `id_categoria`, `codigobarra`, `descripcion`, `stock`, `precio_compra`, `precio_venta`, `estado`, `impuesto`) VALUES (12, 4, 2147483647, '*Discoteca Evento Pequeño', 1, 0, 600000, 1, 10);
INSERT INTO `producto_servicio` (`id_producto`, `id_categoria`, `codigobarra`, `descripcion`, `stock`, `precio_compra`, `precio_venta`, `estado`, `impuesto`) VALUES (13, 4, 121222, '*Discoteca Evento Grande', 1, 0, 2000000, 1, 10);
INSERT INTO `producto_servicio` (`id_producto`, `id_categoria`, `codigobarra`, `descripcion`, `stock`, `precio_compra`, `precio_venta`, `estado`, `impuesto`) VALUES (14, 4, 99878, 'Video Trailler', 1, 0, 350000, 1, 10);
INSERT INTO `producto_servicio` (`id_producto`, `id_categoria`, `codigobarra`, `descripcion`, `stock`, `precio_compra`, `precio_venta`, `estado`, `impuesto`) VALUES (15, 4, 5454253, 'Express - se proyecta la misma noche del evento', 1, 0, 1000000, 1, 10);
INSERT INTO `producto_servicio` (`id_producto`, `id_categoria`, `codigobarra`, `descripcion`, `stock`, `precio_compra`, `precio_venta`, `estado`, `impuesto`) VALUES (16, 2, 21212, 'Fotógrafo Estilos Espontaneas', 1, 0, 600000, 1, 10);
INSERT INTO `producto_servicio` (`id_producto`, `id_categoria`, `codigobarra`, `descripcion`, `stock`, `precio_compra`, `precio_venta`, `estado`, `impuesto`) VALUES (17, 2, 443313, 'Filmación Full HD en una cámara más iluminación', 1, 0, 1000000, 1, 10);
INSERT INTO `producto_servicio` (`id_producto`, `id_categoria`, `codigobarra`, `descripcion`, `stock`, `precio_compra`, `precio_venta`, `estado`, `impuesto`) VALUES (18, 3, 995934, 'Filmación Sencilla Full HD', 1, 0, 600000, 1, 10);
INSERT INTO `producto_servicio` (`id_producto`, `id_categoria`, `codigobarra`, `descripcion`, `stock`, `precio_compra`, `precio_venta`, `estado`, `impuesto`) VALUES (19, 2, 2323242, 'PRODUCCIÓN VIP (Producción Fotográfica, Maquillaje Premium con Pestañas 3D, Un vestido (Opcional), Cuadro Grande, Video BackStage de la Producción, To', 1, 0, 3800000, 1, 10);
INSERT INTO `producto_servicio` (`id_producto`, `id_categoria`, `codigobarra`, `descripcion`, `stock`, `precio_compra`, `precio_venta`, `estado`, `impuesto`) VALUES (20, 2, 4231231, 'Opción 1 (Producción Fotográfica, Maquillaje, Video BackStage)', 1, 0, 1800000, 1, 10);
INSERT INTO `producto_servicio` (`id_producto`, `id_categoria`, `codigobarra`, `descripcion`, `stock`, `precio_compra`, `precio_venta`, `estado`, `impuesto`) VALUES (21, 2, 99998888, 'Opción 2 (Producción Producción Fotográfica, Maquillaje, Video BackStage, PhotoBook, Tomas con Drone, Historia de Vida)', 1, 0, 2900000, 1, 10);
INSERT INTO `producto_servicio` (`id_producto`, `id_categoria`, `codigobarra`, `descripcion`, `stock`, `precio_compra`, `precio_venta`, `estado`, `impuesto`) VALUES (22, 1, 776363, 'Plan Plata (Cobertura fotográfica del evento, Personal de iluminación, Filmación Full HD, Álbum 25x50 con 90 fotos)', 1, 0, 2900000, 1, 10);
INSERT INTO `producto_servicio` (`id_producto`, `id_categoria`, `codigobarra`, `descripcion`, `stock`, `precio_compra`, `precio_venta`, `estado`, `impuesto`) VALUES (23, 1, 443434, 'Plan Oro (Cobertura fotográfica del evento, Personal de iluminación, Filmación Full HD, Álbum 30x60 con 120 fotos)', 1, 0, 3700000, 1, 10);
INSERT INTO `producto_servicio` (`id_producto`, `id_categoria`, `codigobarra`, `descripcion`, `stock`, `precio_compra`, `precio_venta`, `estado`, `impuesto`) VALUES (24, 1, 667478, 'Plan Fiesta VIP (Cobertura fotográfica a Doble Cámara, Personal de iluminación, Filmación Full HD a Doble Cámara, Álbum 30x60 con 150 fotos, Caja o Ma', 1, 0, 5200000, 1, 10);
INSERT INTO `producto_servicio` (`id_producto`, `id_categoria`, `codigobarra`, `descripcion`, `stock`, `precio_compra`, `precio_venta`, `estado`, `impuesto`) VALUES (25, 2, 43323, 'EcoPlan Fiesta 1 (Fotografía de la Fiesta, Álbum 30x45 con 50 fotos)', 1, 0, 700000, 1, 10);
INSERT INTO `producto_servicio` (`id_producto`, `id_categoria`, `codigobarra`, `descripcion`, `stock`, `precio_compra`, `precio_venta`, `estado`, `impuesto`) VALUES (26, 1, 434232, 'EcoPlan Fiesta 2 (Fotografía de la Fiesta,Video de la Fiesta , Álbum 30x45 con 50 fotos)', 1, 0, 1300000, 1, 10);
INSERT INTO `producto_servicio` (`id_producto`, `id_categoria`, `codigobarra`, `descripcion`, `stock`, `precio_compra`, `precio_venta`, `estado`, `impuesto`) VALUES (27, 1, 312321, 'EcoPlan Fiesta 3 + Mini Sesión (Mini Sesion de 60 minutos + Banner 90x120cm, Fotografía de la Fiesta,Video de la Fiesta, Álbum 30x50 con 80 fotos)', 1, 0, 1800000, 1, 10);
INSERT INTO `producto_servicio` (`id_producto`, `id_categoria`, `codigobarra`, `descripcion`, `stock`, `precio_compra`, `precio_venta`, `estado`, `impuesto`) VALUES (28, 3, 877182, 'EcoPlan Fiesta 4 + Sesión (Sesion de Fotos, Video BackStage de la Sesión, Cuadro 40x60 de la Sesión, Fotografía de la Fiesta,Video de la Fiesta Full H', 1, 0, 2600000, 1, 10);
INSERT INTO `producto_servicio` (`id_producto`, `id_categoria`, `codigobarra`, `descripcion`, `stock`, `precio_compra`, `precio_venta`, `estado`, `impuesto`) VALUES (29, 2, 1134324, '31231', 40, 412413, 4124, 1, 10);


#
# TABLE STRUCTURE FOR: proveedor
#

DROP TABLE IF EXISTS `proveedor`;

CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL AUTO_INCREMENT,
  `nrodocumento` int(11) NOT NULL DEFAULT '0',
  `razonsocial` varchar(100) DEFAULT NULL,
  `telefono` int(10) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `id_ciudad` int(11) DEFAULT NULL,
  `estado` int(1) DEFAULT NULL,
  `date_add` datetime DEFAULT NULL,
  `date_mod` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_proveedor`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO `proveedor` (`id_proveedor`, `nrodocumento`, `razonsocial`, `telefono`, `email`, `direccion`, `id_ciudad`, `estado`, `date_add`, `date_mod`) VALUES (1, 2341, 'PRUEBA PROV', 234234, 'a@a.com', 'DIR PROV11', 1, 1, '2018-08-21 11:49:39', '2018-08-22 21:22:45');
INSERT INTO `proveedor` (`id_proveedor`, `nrodocumento`, `razonsocial`, `telefono`, `email`, `direccion`, `id_ciudad`, `estado`, `date_add`, `date_mod`) VALUES (2, 2147483647, 'FSDSDF2342', 2147483647, 'a@q.com', 'SDFG', 1, 1, '2018-08-21 11:49:41', '2018-08-21 17:04:11');
INSERT INTO `proveedor` (`id_proveedor`, `nrodocumento`, `razonsocial`, `telefono`, `email`, `direccion`, `id_ciudad`, `estado`, `date_add`, `date_mod`) VALUES (3, 23432, 'PROV1', 234523, '', 'SIN DATOS', 2, 1, '2018-08-21 12:01:00', NULL);
INSERT INTO `proveedor` (`id_proveedor`, `nrodocumento`, `razonsocial`, `telefono`, `email`, `direccion`, `id_ciudad`, `estado`, `date_add`, `date_mod`) VALUES (4, 234, '234234', 234, '', '23423', 1, 1, '2018-08-21 12:02:02', NULL);


#
# TABLE STRUCTURE FOR: reservas
#

DROP TABLE IF EXISTS `reservas`;

CREATE TABLE `reservas` (
  `id_reserva` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) NOT NULL,
  `fecha_evento` date NOT NULL,
  `hora_evento` time NOT NULL,
  `lugar_evento` varchar(120) NOT NULL,
  `estado` int(1) NOT NULL,
  PRIMARY KEY (`id_reserva`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO `reservas` (`id_reserva`, `id_producto`, `fecha_evento`, `hora_evento`, `lugar_evento`, `estado`) VALUES (1, 0, '2019-03-30', '07:00:00', 'CARMELITAS CENTER ASUNCION', 1);
INSERT INTO `reservas` (`id_reserva`, `id_producto`, `fecha_evento`, `hora_evento`, `lugar_evento`, `estado`) VALUES (2, 11, '2019-12-30', '01:30:00', 'SALON DE EVENTOS DEL BOTANICO', 1);
INSERT INTO `reservas` (`id_reserva`, `id_producto`, `fecha_evento`, `hora_evento`, `lugar_evento`, `estado`) VALUES (3, 15, '2019-12-26', '03:15:00', 'CUMPLE DE CALE EN SAMBER', 1);
INSERT INTO `reservas` (`id_reserva`, `id_producto`, `fecha_evento`, `hora_evento`, `lugar_evento`, `estado`) VALUES (4, 3, '2019-03-23', '01:15:00', 'ASDAS', 1);
INSERT INTO `reservas` (`id_reserva`, `id_producto`, `fecha_evento`, `hora_evento`, `lugar_evento`, `estado`) VALUES (5, 4, '2019-03-30', '10:30:00', 'evento de prueba', 1);


#
# TABLE STRUCTURE FOR: tipo_evento
#

DROP TABLE IF EXISTS `tipo_evento`;

CREATE TABLE `tipo_evento` (
  `id_tipoevento` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_tipoevento` varchar(50) DEFAULT NULL,
  `detalletipoevento` varchar(150) DEFAULT NULL,
  `montominimoreserva_tipoevento` int(1) DEFAULT NULL,
  `estado_tipoevento` int(1) DEFAULT NULL COMMENT '1=activo, 2=inactivo',
  PRIMARY KEY (`id_tipoevento`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `tipo_evento` (`id_tipoevento`, `descripcion_tipoevento`, `detalletipoevento`, `montominimoreserva_tipoevento`, `estado_tipoevento`) VALUES (1, 'Boda', 'Casamientos', 500000, 1);
INSERT INTO `tipo_evento` (`id_tipoevento`, `descripcion_tipoevento`, `detalletipoevento`, `montominimoreserva_tipoevento`, `estado_tipoevento`) VALUES (2, '15 años', 'Cumpleaños', 250000, 1);


#
# TABLE STRUCTURE FOR: tipo_usuario
#

DROP TABLE IF EXISTS `tipo_usuario`;

CREATE TABLE `tipo_usuario` (
  `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(200) DEFAULT NULL,
  `id_permiso` int(11) DEFAULT NULL,
  `estado` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_usuario`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `tipo_usuario` (`id_tipo_usuario`, `descripcion`, `id_permiso`, `estado`) VALUES (1, 'superadmin', 1, 1);
INSERT INTO `tipo_usuario` (`id_tipo_usuario`, `descripcion`, `id_permiso`, `estado`) VALUES (2, 'admin', 3, 1);
INSERT INTO `tipo_usuario` (`id_tipo_usuario`, `descripcion`, `id_permiso`, `estado`) VALUES (3, 'funcionario', 2, 1);


#
# TABLE STRUCTURE FOR: usuario
#

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `id_empleado` varchar(50) DEFAULT NULL,
  `id_tipo_usuario` int(1) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `date_add` datetime DEFAULT NULL,
  `date_mod` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `estado` int(1) NOT NULL COMMENT '1=activo, 2=inactivo',
  PRIMARY KEY (`id_usuario`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `usuario` (`id_usuario`, `id_empleado`, `id_tipo_usuario`, `username`, `password`, `date_add`, `date_mod`, `estado`) VALUES (1, '1', 1, 'superadmin', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2018-07-21 10:05:29', '2019-10-26 16:13:28', 1);
INSERT INTO `usuario` (`id_usuario`, `id_empleado`, `id_tipo_usuario`, `username`, `password`, `date_add`, `date_mod`, `estado`) VALUES (2, '2', 2, 'admin', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '2018-08-22 16:02:52', '2019-10-26 16:13:32', 1);


#
# TABLE STRUCTURE FOR: venta
#

DROP TABLE IF EXISTS `venta`;

CREATE TABLE `venta` (
  `id_venta` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `seriecomprobante` varchar(20) NOT NULL,
  `nrocomprobante` varchar(20) NOT NULL,
  `tipocomprobante` int(1) NOT NULL COMMENT '1= factura, 2= ticket, 3=boleta, 4= presupuesto',
  `total` int(11) NOT NULL,
  `id_formapago` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `date_add` datetime NOT NULL,
  `date_mod` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `estado` int(11) NOT NULL,
  `tipoventa` int(1) NOT NULL,
  PRIMARY KEY (`id_venta`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

INSERT INTO `venta` (`id_venta`, `id_cliente`, `fecha`, `seriecomprobante`, `nrocomprobante`, `tipocomprobante`, `total`, `id_formapago`, `id_usuario`, `date_add`, `date_mod`, `estado`, `tipoventa`) VALUES (31, 1, '2019-10-26', '001-002', '0000001', 2, 500000, 1, 1, '0000-00-00 00:00:00', '2019-10-26 16:03:40', 1, 2);
INSERT INTO `venta` (`id_venta`, `id_cliente`, `fecha`, `seriecomprobante`, `nrocomprobante`, `tipocomprobante`, `total`, `id_formapago`, `id_usuario`, `date_add`, `date_mod`, `estado`, `tipoventa`) VALUES (32, 5, '2019-11-04', '001-001', '0000002', 1, 800000, 1, 1, '0000-00-00 00:00:00', '2019-11-04 03:27:40', 1, 2);
INSERT INTO `venta` (`id_venta`, `id_cliente`, `fecha`, `seriecomprobante`, `nrocomprobante`, `tipocomprobante`, `total`, `id_formapago`, `id_usuario`, `date_add`, `date_mod`, `estado`, `tipoventa`) VALUES (33, 1, '2019-11-09', '001-001', '0000003', 1, 500000, 1, 1, '0000-00-00 00:00:00', '2019-11-09 07:53:08', 1, 2);
INSERT INTO `venta` (`id_venta`, `id_cliente`, `fecha`, `seriecomprobante`, `nrocomprobante`, `tipocomprobante`, `total`, `id_formapago`, `id_usuario`, `date_add`, `date_mod`, `estado`, `tipoventa`) VALUES (34, 1, '2019-11-09', '001-001', '0000004', 1, 500000, 1, 1, '0000-00-00 00:00:00', '2019-11-09 08:41:44', 1, 2);
INSERT INTO `venta` (`id_venta`, `id_cliente`, `fecha`, `seriecomprobante`, `nrocomprobante`, `tipocomprobante`, `total`, `id_formapago`, `id_usuario`, `date_add`, `date_mod`, `estado`, `tipoventa`) VALUES (35, 5, '2019-11-09', '001-001', '0000005', 1, 515000, 1, 1, '0000-00-00 00:00:00', '2019-11-09 13:33:27', 1, 2);
INSERT INTO `venta` (`id_venta`, `id_cliente`, `fecha`, `seriecomprobante`, `nrocomprobante`, `tipocomprobante`, `total`, `id_formapago`, `id_usuario`, `date_add`, `date_mod`, `estado`, `tipoventa`) VALUES (36, 6, '2019-11-09', '001-002', '0000002', 2, 1100000, 1, 1, '0000-00-00 00:00:00', '2019-11-09 13:37:48', 1, 2);
INSERT INTO `venta` (`id_venta`, `id_cliente`, `fecha`, `seriecomprobante`, `nrocomprobante`, `tipocomprobante`, `total`, `id_formapago`, `id_usuario`, `date_add`, `date_mod`, `estado`, `tipoventa`) VALUES (37, 6, '2019-11-09', '001-002', '0000002', 2, 1100000, 1, 1, '0000-00-00 00:00:00', '2019-11-09 13:37:53', 1, 2);


