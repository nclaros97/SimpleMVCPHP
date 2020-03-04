CREATE TABLE `lista_colores` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `codigoColor` varchar(45) DEFAULT NULL,
  `descripcionColor` varchar(128) DEFAULT NULL,
  `usosColor` varchar(2028) DEFAULT NULL,
  `estadoColor` char(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigoColor_UNIQUE` (`codigoColor`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;