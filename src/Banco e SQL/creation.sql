-- MySQL Workbench Synchronization
-- Generated: 2022-12-06 14:59
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: ticao

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

ALTER SCHEMA `bdhotel`  DEFAULT COLLATE utf8_bin ;

ALTER TABLE `bdhotel`.`localizacao_hotel` 
DROP FOREIGN KEY `fk_localizacao_hotel_hotel1`;

ALTER TABLE `bdhotel`.`hotel` 
DROP FOREIGN KEY `fk_hotel_usuario1`;

ALTER TABLE `bdhotel`.`dependente` 
DROP FOREIGN KEY `fk_dependente_usuario1`;

ALTER TABLE `bdhotel`.`reserva` 
DROP FOREIGN KEY `fk_reserva_hotel1`,
DROP FOREIGN KEY `fk_reserva_usuario1`;

ALTER TABLE `bdhotel`.`quarto` 
DROP FOREIGN KEY `fk_quarto_hotel1`;

ALTER TABLE `bdhotel`.`cupom` 
DROP FOREIGN KEY `fk_cupom_usuario1`;

ALTER TABLE `bdhotel`.`feriado` 
DROP FOREIGN KEY `fk_feriado_usuario1`;

ALTER TABLE `bdhotel`.`usuario` 
DROP FOREIGN KEY `fk_usuario_login1`;

ALTER TABLE `bdhotel`.`reserva_cupom` 
DROP FOREIGN KEY `fk_reserva_cupom_cupom1`;

ALTER TABLE `bdhotel`.`localizacao_hotel` 
COLLATE = utf8_bin ,
CHANGE COLUMN `local_hotel` `local_hotel` VARCHAR(45) NOT NULL ;

ALTER TABLE `bdhotel`.`hotel` 
COLLATE = utf8_bin ,
CHANGE COLUMN `nome` `nome` VARCHAR(45) NULL DEFAULT NULL ,
CHANGE COLUMN `cpf_administrador` `cpf_administrador` BIGINT(11) NOT NULL ;

ALTER TABLE `bdhotel`.`dependente` 
COLLATE = utf8_bin ,
CHANGE COLUMN `primeiro_nome` `primeiro_nome` VARCHAR(45) NULL DEFAULT NULL ,
CHANGE COLUMN `sobrenome` `sobrenome` VARCHAR(45) NULL DEFAULT NULL ,
CHANGE COLUMN `usuario_cpf` `usuario_cpf` BIGINT(11) NOT NULL ;

ALTER TABLE `bdhotel`.`reserva` 
COLLATE = utf8_bin ,
CHANGE COLUMN `usuario_cpf` `usuario_cpf` BIGINT(11) NOT NULL ,
CHANGE COLUMN `estado` `estado` SET('valido', 'hospedado', 'cancelado') NULL DEFAULT NULL ;

ALTER TABLE `bdhotel`.`quarto` 
COLLATE = utf8_bin ,
CHANGE COLUMN `descricao` `descricao` VARCHAR(45) NULL DEFAULT NULL ,
CHANGE COLUMN `tipo` `tipo` VARCHAR(45) NULL DEFAULT NULL ;

ALTER TABLE `bdhotel`.`cupom` 
COLLATE = utf8_bin ,
CHANGE COLUMN `status` `status` VARCHAR(45) NULL DEFAULT NULL ,
CHANGE COLUMN `usuario_cpf` `usuario_cpf` BIGINT(11) NOT NULL ;

ALTER TABLE `bdhotel`.`feriado` 
COLLATE = utf8_bin ,
CHANGE COLUMN `nome` `nome` VARCHAR(45) NULL DEFAULT NULL ,
CHANGE COLUMN `usuario_cpf_admin` `usuario_cpf_admin` BIGINT(11) NOT NULL ;

ALTER TABLE `bdhotel`.`usuario` 
COLLATE = utf8_bin ,
CHANGE COLUMN `cpf` `cpf` BIGINT(11) NOT NULL ,
CHANGE COLUMN `login_login` `login_login` VARCHAR(45) NOT NULL ,
CHANGE COLUMN `primeiro_nome` `primeiro_nome` VARCHAR(45) NULL DEFAULT NULL ,
CHANGE COLUMN `sobrenome` `sobrenome` VARCHAR(45) NULL DEFAULT NULL ,
CHANGE COLUMN `telefone` `telefone` BIGINT(11) NULL DEFAULT NULL ,
CHANGE COLUMN `email` `email` VARCHAR(45) NULL DEFAULT NULL ,
CHANGE COLUMN `endereco` `endereco` VARCHAR(45) NULL DEFAULT NULL ;

ALTER TABLE `bdhotel`.`reserva_cupom` 
COLLATE = utf8_bin ;

ALTER TABLE `bdhotel`.`login` 
COLLATE = utf8_bin ,
CHANGE COLUMN `login` `login` VARCHAR(45) NOT NULL ,
CHANGE COLUMN `senha` `senha` VARCHAR(45) NULL DEFAULT NULL ;

ALTER TABLE `bdhotel`.`localizacao_hotel` 
ADD CONSTRAINT `fk_localizacao_hotel_hotel1`
  FOREIGN KEY (`hotel_cod_hotel`)
  REFERENCES `bdhotel`.`hotel` (`cod_hotel`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `bdhotel`.`hotel` 
ADD CONSTRAINT `fk_hotel_usuario1`
  FOREIGN KEY (`cpf_administrador`)
  REFERENCES `bdhotel`.`usuario` (`cpf`)
  ON DELETE CASCADE
  ON UPDATE NO ACTION;

ALTER TABLE `bdhotel`.`dependente` 
ADD CONSTRAINT `fk_dependente_usuario1`
  FOREIGN KEY (`usuario_cpf`)
  REFERENCES `bdhotel`.`usuario` (`cpf`)
  ON DELETE CASCADE
  ON UPDATE NO ACTION;

ALTER TABLE `bdhotel`.`reserva` 
ADD CONSTRAINT `fk_reserva_hotel1`
  FOREIGN KEY (`hotel_cod_hotel`)
  REFERENCES `bdhotel`.`hotel` (`cod_hotel`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_reserva_usuario1`
  FOREIGN KEY (`usuario_cpf`)
  REFERENCES `bdhotel`.`usuario` (`cpf`)
  ON DELETE CASCADE
  ON UPDATE NO ACTION;

ALTER TABLE `bdhotel`.`quarto` 
ADD CONSTRAINT `fk_quarto_hotel1`
  FOREIGN KEY (`hotel_cod_hotel`)
  REFERENCES `bdhotel`.`hotel` (`cod_hotel`)
  ON DELETE CASCADE
  ON UPDATE NO ACTION;

ALTER TABLE `bdhotel`.`cupom` 
ADD CONSTRAINT `fk_cupom_usuario1`
  FOREIGN KEY (`usuario_cpf`)
  REFERENCES `bdhotel`.`usuario` (`cpf`)
  ON DELETE CASCADE
  ON UPDATE NO ACTION;

ALTER TABLE `bdhotel`.`feriado` 
ADD CONSTRAINT `fk_feriado_usuario1`
  FOREIGN KEY (`usuario_cpf_admin`)
  REFERENCES `bdhotel`.`usuario` (`cpf`)
  ON DELETE CASCADE
  ON UPDATE NO ACTION;

ALTER TABLE `bdhotel`.`usuario` 
ADD CONSTRAINT `fk_usuario_login1`
  FOREIGN KEY (`login_login`)
  REFERENCES `bdhotel`.`login` (`login`)
  ON DELETE CASCADE
  ON UPDATE NO ACTION;

ALTER TABLE `bdhotel`.`reserva_cupom` 
DROP FOREIGN KEY `fk_reserva_cupom_reserva1`;

ALTER TABLE `bdhotel`.`reserva_cupom` ADD CONSTRAINT `fk_reserva_cupom_reserva1`
  FOREIGN KEY (`reserva_cod_reserva`)
  REFERENCES `bdhotel`.`reserva` (`cod_reserva`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_reserva_cupom_cupom1`
  FOREIGN KEY (`cupom_cod_cupom`)
  REFERENCES `bdhotel`.`cupom` (`cod_cupom`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


USE `bdhotel`;
DROP procedure IF EXISTS `bdhotel`.`DiariaCupom`;

DELIMITER $$

USE `bdhotel`$$
CREATE DEFINER = CURRENT_USER TRIGGER `bdhotel`.`reserva_BEFORE_INSERT` BEFORE INSERT ON `reserva` FOR EACH ROW
BEGIN
SELECT * FROM Reserva as R,  Feriado as f 
	  WHERE f.data_inicial BETWEEN R.data_inicial AND R.data_final;
END$$

USE `bdhotel`$$
DROP TRIGGER IF EXISTS `bdhotel`.`reserva_AFTER_UPDATE` $$

USE `bdhotel`$$
CREATE DEFINER = CURRENT_USER TRIGGER `bdhotel`.`reserva_AFTER_UPDATE` AFTER UPDATE ON `reserva` FOR EACH ROW
BEGIN
IF NEW.estado = 'hospedado' THEN
	call DiariaCupom(07104322671);
END IF;
END$$


DELIMITER ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
