-- MySQL Workbench Synchronization
-- Generated: 2022-12-03 20:07
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
CHANGE COLUMN `estado` `estado` VARCHAR(45) NULL DEFAULT NULL ;

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
CHANGE COLUMN `login` `login` VARCHAR(8) NULL DEFAULT NULL ,
CHANGE COLUMN `senha` `senha` VARCHAR(45) NULL DEFAULT NULL ,
CHANGE COLUMN `primeiro_nome` `primeiro_nome` VARCHAR(45) NULL DEFAULT NULL ,
CHANGE COLUMN `sobrenome` `sobrenome` VARCHAR(45) NULL DEFAULT NULL ,
CHANGE COLUMN `telefone` `telefone` BIGINT(11) NULL DEFAULT NULL ,
CHANGE COLUMN `email` `email` VARCHAR(45) NULL DEFAULT NULL ,
CHANGE COLUMN `endereco` `endereco` VARCHAR(45) NULL DEFAULT NULL ,
CHANGE COLUMN `cnpj` `cnpj` BIGINT(14) NULL DEFAULT NULL ;

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
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `bdhotel`.`dependente` 
ADD CONSTRAINT `fk_dependente_usuario1`
  FOREIGN KEY (`usuario_cpf`)
  REFERENCES `bdhotel`.`usuario` (`cpf`)
  ON DELETE NO ACTION
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
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `bdhotel`.`quarto` 
ADD CONSTRAINT `fk_quarto_hotel1`
  FOREIGN KEY (`hotel_cod_hotel`)
  REFERENCES `bdhotel`.`hotel` (`cod_hotel`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `bdhotel`.`cupom` 
ADD CONSTRAINT `fk_cupom_usuario1`
  FOREIGN KEY (`usuario_cpf`)
  REFERENCES `bdhotel`.`usuario` (`cpf`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `bdhotel`.`feriado` 
ADD CONSTRAINT `fk_feriado_usuario1`
  FOREIGN KEY (`usuario_cpf_admin`)
  REFERENCES `bdhotel`.`usuario` (`cpf`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


#
#
#VALIDACAO DO DATABASE E DAS TABELAS
#
#


show databases;
use bdhotel;
show tables;

#
# TABELA USUARIO
#
# Descricao das informacoes da tabela USUARIO
desc usuario;
# Selecao de todos os usuario
select * from usuario;
#Exclusao de usuario esoecificado pelo cpf
delete from usuario where cpf=3;
# Insercao de Usuario
insert into usuario (cpf, login, senha, primeiro_nome, sobrenome, telefone, email, endereco, data_nascimento, cnpj, diarias, tipo_administrador, tipo_cliente) 
	values(03,'ticaomg', 'ticaomg','Patrick','Leandro', 33999057030, 'ticaomg@gmail.com', 'Av. Augusto de lima, 249 -BH', '1984-08-21',55555555555555,20,'1','1');
 # teste de consistencia de inserção de dados no banco com null.
insert into usuario() values ();
#Seleciona os usuarios administradores
select * from usuario where tipo_administrador=1;
# Seleciona os usuarios do tipo clientes
select * from usuario where tipo_cliente=1;
# Seleciona os usuarios do tipo clientes e administrador
select * from usuario where tipo_administrador=1 and tipo_cliente=1;
# Atualizacao de informações de usuário.    
update usuario set primeiro_nome = 'Fabiana', sobrenome='Cerqueira' where usuario.cpf=2;

#
# TABELA CUPOM
#
# Descricao das informacoes da tabela CUPOM
desc cupom;
#Seleciona todos os cupons
select * from cupom;
# Insere um cupom na tabela
insert into cupom (cod_cupom, status, valor_desconto, usuario_cpf) values (04,'Usado',10,11111111111);
insert into cupom (cod_cupom, status, valor_desconto, usuario_cpf) values (03,'valido',10,22222222222);
# relatorio de quantos cupons já foram distribuidos.alter
select count(cod_cupom) from cupom; 
#relatorio de quantos usuário distintos possui cupons registrados.
select count(distinct(usuario_cpf)) from cupom; 
#Seleciona quantos cupons validos existe cadastrados
select count(cod_cupom) from cupom where status='valido';
#Seleciona quantos cupons validos existe cadastrados e agrupados por usuarios
select usuario_cpf as cpf, count(cod_cupom) as quantidade from cupom where status='valido'
	group by usuario_cpf;
#Seleciona a quantidade de cupom de descontos por usuario
select u.primeiro_nome, u.sobrenome,u.cpf,count(cod_cupom) from usuario as u inner join cupom on usuario.cpf=cupom.usuario_cpf
	group by (u.cpf);
# Quantos usuarios possui cupons validos
select primeiro_nome, sobrenome,cpf,count(cod_cupom) from usuario as u inner join cupom on usuario.cpf=cupom.usuario_cpf where cupom.status = 'valido'
	group by (u.cpf);
# Quantos usuarios possui cupons Usados
select primeiro_nome, sobrenome,cpf,count(cod_cupom) from usuario as u inner join cupom on usuario.cpf=cupom.usuario_cpf where cupom.status = 'usado'
	group by (u.cpf);
# Selecionar os Cupons de um usuario especifico
select cod_cupom, valor_desconto from cupom where status='valido' and usuario_cpf=11111111111;
#
#
# TABELA DEPENDENTE
#
# Descricao das informacoes da tabela DEPEDENTE
desc dependente;
# Seleciona todos os dependentes
select * from dependente;
# Inserir dependente na tabela
insert into dependente (primeiro_nome, sobrenome, data_nascimento, usuario_cpf) 
	values('sujeito', 'estranho','2022-08-21',1111111111);
# Quantos dependentes estão cadastrados
select count(cpf_usuario) from dependente;
# Quantos dependentes estão cadastrados por cpf
select count(cpf_usuario) from dependente
	group by usuario_cpf;
#Seleciona os dependentes de um usuario especifico
select * from dependente where usuario_cpf='3';

#
#
# TABELA FERIADO
#
# Descricao das informacoes da tabela FERIADO
desc feriado;
# Seleciona todos os feriados
select * from feriado;
# Insercao de um feriado na tabela
insert into feriado (cod_feriado, data_inicial, data_final, nome, usuario_cpf_admin)
	values (02, '2022-12-02', '2022-12-02', 'O bom', 11111111111);
#Todos os feriados cadastrados pelo administrador de cpf especifico.
select * from feriado where usuario_cpf = 3; 
# Quantos feriados foram cadastrados pelo administrador de cpf XXX
select count(cod_feriado) from feriado where usuario_cpf = 3; 

#
#
# TABELA LOCALIZACAO HOTEL
#
# Descricao das informacoes da tabela LOCALIZACAO HOTEL
desc localizacao_hotel;
# Seleciona todos as localizacoes de hotel 
select * from localizacao_hotel;
# Insere  uma localizacao na tabela LOCALIZACAO HOTEL
insert into localizacao_hotel (hotel_cod_hotel, local_hotel) values (100,'Sao Joao del Rei');

select * from localizacao_hotel;
delete from localizacao_hotel where hotel_cod_hotel = 100;

#
#
# TABELA HOTEL
#
# Descricao das informacoes da tabela HOTEL
desc hotel;
# Seleciona todos os hoteis cadastrados na tabela
select * from hotel;
#delete hotel
delete from hotel where cod_hotel=100;
# Insere um hotel na tabela.
insert into hotel (cod_hotel, nome, cpf_administrador)
	values (2, 'Kasa', 00000000000);
# Seleciona hotel pelo codigo
select * from hotel where cod_hotel='1';

#
#
# TABELA QUARTO
#
# Descricao das informacoes da tabela QUARTO
desc quarto;
# Seleciona todos os quartos
select * from quarto;
# Insere um quarto na tabela

insert into quarto (numero, descricao, tipo, status, hotel_cod_hotel) values (01,'quarto casal com banheiro','standard',1,5);
insert into quarto (numero, descricao, tipo, status, hotel_cod_hotel) values (02,'quarto solteiro com banheiro','standard',1,5);
insert into quarto (numero, descricao, tipo, status, hotel_cod_hotel) values (03,'quarto casal com banheiro','luxo',1,5);
insert into quarto (numero, descricao, tipo, status, hotel_cod_hotel) values (04,'quarto casal com banheiro','luxo',0,5);
# SEleciona todos os quartos reservados. 
select * from quarto where status=1; 
# Apresenta quantos quartos estão reservados. 
select count(numero) from quarto where status=1; 
# Seleciona quantos quartos existe em um hotel
select count(numero) from quarto where hotel_cod_hotel='3';
# Quantos quartos estão reservados por hotel
#Falta fazer a interacao entre as tabelas hotel e quarto
select count(numero), hotel_cod_hotel from quarto where status = 1
	group by hotel_cod_hotel;
# Quantos quartos estão reservados para um determinado hotel
select count(numero) from quarto where status = 1 and hotel_cod_hotel='3';

#
#
# TABELA RESERVA
#
# Descricao das informacoes da tabela RESERVA
desc reserva;
# Seleciona todas as reservas da tabela
select * from reserva;
# Insere uma reserva na tabela
insert into reserva (cod_reserva, usuario_cpf, hotel_cod_hotel, data_inicial, data_final, valor_desconto, valor_total, estado, feriado)
	values (07104322671, 5, '2022-10-12', '2022-10-15', 30, 70,'reservado', 0);
# Seleciona as reservas realizadas pelo usuário
select cod_reserva as codigo, hotel_cod_hotel as hotel, data_inicial, data_final, valor_desconto, valor_total
	from reserva where usuario_cpf=07104322671;


    select * from usuario;
    
    SELECT cpf from usuario where login = "ticaomg";

#Inserir cupom na tabela
insert into cupom (status, valor_desconto, usuario_cpf) values ('usado',10,07104322671);
select * from cupom;

#selecao de cupons validos por usuario autenticado
SELECT cod_cupom, valor_desconto FROM cupom WHERE status='valido' and usuario_cpf=(SELECT cpf from usuario where login = '');

select count(cod_cupom) from cupom where status='valido';


select * from hotel;
select * from quarto;
    
select cod_hotel, count(numero) from hotel, quarto where cod_hotel='Plaza' and tipo='standard' and status='livre';


select * from login;
insert into login (login, senha) values ('teste','teste');

select tipo_administrador from usuario join login on login=login where login = 'ticaomg' and tipo_administrador = 1;

select * from quarto;
select * from hotel;
select * from reserva;
select * from feriado;
select * from dependente;
select * from cupom;
select * from usuario;
select * from login;

delete from usuario where cpf = 07104322671;
delete from usuario where cpf = 07104322671;







# Stored Procedures

DELIMITER $$
CREATE PROCEDURE DiariaCupom (in usuario_cpf bigint(11))
BEGIN
insert into cupom (status, valor_desconto, usuario_cpf) 
values ('valido',10,usuario_cpf);
UPDATE Usuario 
SET diarias =0
WHERE cpf=usuario_cpf;
END$$
DELIMITER ;

call DiariaCupom(99999999999);







# Trigger

CREATE DEFINER = CURRENT_USER TRIGGER `bdhotel`.`reserva_BEFORE_INSERT` 
BEFORE INSERT ON `reserva` FOR EACH ROW
BEGIN
SELECT * FROM Reserva as R,  Feriado as f 
	  WHERE f.data_inicial BETWEEN R.data_inicial AND R.data_final
END;

CREATE DEFINER = CURRENT_USER TRIGGER `bdhotel`.`reserva_AFTER_UPDATE` 
AFTER UPDATE ON `reserva` FOR EACH ROW
BEGIN
IF NEW.estado = 'hospedado' THEN
	call DiariaCupom(99999999999)
END IF
END;






UPDATE Usuario 
SET diarias = 20
WHERE cpf='07104322671';

UPDATE Reserva 
SET estado = 'hospedado'
WHERE usuario_cpf='07104322671';

select * from reserva;
select * from usuario;


CREATE ASSERTION limitecuponsferiado CHECK
	( SELECT * FROM Reserva as R,  Feriado as f, 
	  WHERE data_inicial BETWEEN data_inicial - data_inicial);
  
 CREATE Assertion limiteCuponsFeriado CHECK (
	
     
SELECT  FROM 

WHERE Data_Pub BETWEEN '20040517' AND '20110517';

#########################################################
#########################################################
#########################################################


DELIMITER $$
CREATE PROCEDURE DiariaCupom (in usuario_cpf bigint(11))
BEGIN
insert into cupom (status, valor_desconto, usuario_cpf) values ('valido',10,usuario_cpf);
UPDATE Usuario 
SET diarias =0
WHERE cpf=usuario_cpf;
END$$
DELIMITER ;

############################
###########################
###########################



-- Receita total
SELECT SUM(R.valor_total) AS Receita_total
FROM reserva as R;

-- Receita total de cada hotel
SELECT H.nome, SUM(R.valor_total) AS Receita
FROM reserva as R INNER JOIN hotel AS H On R.hotel_cod_hotel = H.cod_hotel
ORDER By H.nome ASC;

-- Receita total "perdida" em descontos
SELECT SUM(((R.valor_total * 100) / (100 - valor_desconto)) - R.valor_total) AS Desconto
FROM reserva as R INNER JOIN hotel AS H On R.hotel_cod_hotel = H.cod_hotel
ORDER By H.nome ASC;

-- Total de diárias "em uso" ou reservadas (por hotel)
SELECT H.nome, COUNT(R.cod_reserva)
FROM reserva as R INNER JOIN hotel as H ON R.hotel_cod_hotel = H.cod_hotel
WHERE R.estado = 'Hospedado' OR R.estado = 'Reservado'
GROUP By H.nome
ORDER By H.nome ASC;

-- 5 datas mais atrativas (Entrada - Todos)
SELECT R.data_inicial, COUNT(R.data_inicial) As All_Occurrences
FROM reserva as R
GROUP BY R.data_inicial
ORDER BY All_Occurrences DESC
LIMIT 5;

-- 3 datas mais atrativas (Entrada -  Cada hotel)
SELECT R.data_inicial, COUNT(R.data_inicial) As Occurrences
FROM reserva as R INNER JOIN hotel as H ON R.hotel_cod_hotel = H.cod_hotel
GROUP BY H.nome
ORDER BY Occurrences DESC
LIMIT 3;

-- Total de diárias (REVER)
SELECT H.nome, SUM(U.diarias)
FROM (hotel AS H INNER JOIN reserva AS R ON H.cod_hotel = R.hotel_cod_hotel) INNER JOIN usuario AS U ON R.usuario_cpf = U.cpf
GROUP By H.cod_hotel
ORDER By H.nome ASC;

-- Total de diárias para cada cliente (REVER)
SELECT usuario.primeiro_nome, U.email, SUM(U.diarias) AS Total_diarias, H.nome, L.local_Hotel
FROM ((localizacao_hotel AS L INNER JOIN hotel as H ON L.hotel_cod_hotel = H.cod_hotel) INNER JOIN reserva as R ON R.hotel_cod_hotel = H.cod_hotel) Inner JOIN Usuario AS U ON R.usuario_cpf = U.cpf
GROUP BY H.cod_hotel
ORDER BY H.nome ASC;

-- Total de reservas canceladas
SELECT COUNT(R.estado) as Cancelled_Reserves
FROM reserva AS R
WHERE R.estado = 'Cancelado';

-- Total de reservas canceladas (por hotel)
SELECT H.nome, COUNT(R.estado) as Cancelled_Reserves_
FROM reserva AS R INNER JOIN hotel As H On R.hotel_cod_hotel = H.cod_hotel
WHERE R.estado = 'Cancelado'
GROUP By H.cod_hotel
ORDER BY H.nome ASC;

-- Total de clientes (por hotel)
SELECT H.nome, L.local_hotel, COUNT(U.cpf) as Total_clients
FROM ((hotel As H INNER JOIN localizacao_hotel as L ON L.hotel_cod_hotel = cod_hotel) INNER JOIN reserva AS R On R.hotel_cod_hotel = H.cod_hotel) INNER JOIN usuario AS U ON R.usuario_cpf = U.cpf
GROUP By H.nome
ORDER BY H.nome ASC;
select * from Reserva

-- Informações sobre reservas entre determinadas datas especificadas pelo cliente
SELECT R.data_inicial, R.data_final, R.valor_total AS Valor_pago
FROM reserva as R
WHERE (R.data_inicial BETWEEN <variable_data_x> AND <variable_data_y>) AND R.usuario_cpf = <variable_cpf>;

CREATE TRIGGER diarias
	AFTER UPDATE
	ON usuario
FOR EACH ROW WHEN diarias % 20 = 0
cupons += (diarias/20);

select * from login;
delete from login where login='rangel';
delete from usuario where cpf='07104322671';
select * from usuario;
delete from cupom;
delete from cupom where cod_cupom = 10;
select * from cupom;

select diarias from usuario where login_login='hergos'>=20;

select diarias from usuario where cpf='07104322671';


(select diarias from usuario where cpf='07104322671');
UPDATE Usuario 
SET diarias = 20
WHERE cpf='07104322671';

UPDATE Reserva 
SET estado = 'hospedado'
WHERE usuario_cpf='07104322671';
select * from reserva;
select * from usuario;

UPDATE Usuario 
SET tipo_administrador = 1
WHERE cpf='99999999999';

 select diarias from usuario where cpf='07104322671';
 
 select tipo_administrador from usuario join login on login_login=login where login_login = 'elias' and usuario.tipo_administrador = 1;