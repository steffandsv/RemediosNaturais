CREATE TABLE IF NOT EXISTS `categorias` (
	`id` int(11) NOT NULL AUTO_INCREMENT ,
	`titulo` varchar(360) NOT NULL ,
	`imagem` longtext NOT NULL ,
	`descricao` tinytext NOT NULL ,
	PRIMARY KEY (`id`)
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


CREATE TABLE IF NOT EXISTS `remedios` (
	`id` int(11) NOT NULL AUTO_INCREMENT ,
	`titulo` varchar(360) NOT NULL ,
	`texto` text NOT NULL ,
	`imagem` longtext NOT NULL ,
	`categorias` tinytext NOT NULL ,
	`contribuidor` varchar(360) NOT NULL ,
	`resumo` tinytext NOT NULL ,
	PRIMARY KEY (`id`)
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


