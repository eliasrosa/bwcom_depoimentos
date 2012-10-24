-- <? defined('BW') or die("Acesso negado!"); ?>


--
ALTER TABLE `bw_versao` CHANGE `com_depoimentos_1` `com_depoimentos_2` INT NOT NULL;


--
ALTER TABLE `bw_depoimentos`  ADD `url_video` VARCHAR(255) NULL AFTER `empresa`;
ALTER TABLE `bw_depoimentos`  ADD `cidade` VARCHAR(255) NULL AFTER `url_video`;
ALTER TABLE `bw_depoimentos`  ADD `uf` VARCHAR(50) NULL AFTER `cidade`;
