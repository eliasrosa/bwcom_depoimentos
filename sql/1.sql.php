-- <? defined('BW') or die("Acesso negado!"); ?>


-- 
ALTER TABLE `bw_versao` ADD `com_depoimentos_1` INT(1) NOT NULL;


--
CREATE TABLE `bw_depoimentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datahora` datetime NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cargo` varchar(255) NULL,
  `empresa` varchar(255) NULL,
  `resumo` longtext NULL,
  `depoimento` longtext NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
