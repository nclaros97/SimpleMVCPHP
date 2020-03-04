use demoalgorith;
CREATE TABLE `parqueos` (
  `parqueoid` bigint(10) NOT NULL AUTO_INCREMENT,
  `parqueoest` character(3) DEFAULT NULL,
  `parqueolot` varchar(75) DEFAULT NULL,
  `parqueotip` char(3) DEFAULT NULL,
  PRIMARY KEY (`parqueoid`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;