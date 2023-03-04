-- Receita total
SELECT SUM(valor_total) AS Receita_total
FROM reserva
WHERE (data_inicial BETWEEN <variable_data_x> AND <variable_data_y>) AND estado <> 'Cancelado';

-- Receita total de cada franquia de hotel
SELECT H.nome, SUM(R.valor_total) AS Receita
FROM reserva as R INNER JOIN hotel AS H On R.hotel_cod_hotel = H.cod_hotel
WHERE (R.data_inicial BETWEEN <variable_data_x> AND <variable_data_y>) AND R.estado <> 'Cancelado';
GROUP BY H.nome
ORDER By H.nome ASC;

-- Receita total "perdida" em descontos
SELECT H.nome, SUM(((R.valor_total * 100) / (100 - valor_desconto)) - R.valor_total) AS Desconto
FROM reserva as R INNER JOIN hotel AS H On R.hotel_cod_hotel = H.cod_hotel
WHERE (R.data_inicial BETWEEN <variable_data_x> AND <variable_data_y>) AND R.estado <> 'Cancelado';
GROUP BY H.nome
ORDER By H.nome ASC;

-- Total de reservas "em uso" ou reservadas (por franquia de hotel)
SELECT H.nome, COUNT(R.cod_reserva) AS Pending
FROM reserva as R INNER JOIN hotel as H ON R.hotel_cod_hotel = H.cod_hotel
WHERE (R.estado = 'Hospedado' OR R.estado = 'Reservado') AND (R.data_inicial BETWEEN <variable_data_x> AND <variable_data_y>)
GROUP By H.nome
ORDER By H.nome ASC;

-- 5 datas mais atrativas (Entrada - Todos)
SELECT data_inicial, COUNT(data_inicial) As Occurrences
FROM reserva
GROUP BY data_inicial
ORDER BY Occurrences DESC
LIMIT 5;

-- 3 datas mais atrativas (Entrada -  Cada hotel)
SELECT R.data_inicial, COUNT(R.data_inicial) As Occurrences
FROM reserva as R INNER JOIN hotel as H ON R.hotel_cod_hotel = H.cod_hotel
GROUP BY H.nome
ORDER BY Occurrences DESC
LIMIT 3;

-- Total de diárias
SELECT H.nome, SUM(U.diarias) AS Total_diarias
FROM (hotel AS H INNER JOIN reserva AS R ON H.cod_hotel = R.hotel_cod_hotel) INNER JOIN usuario AS U ON R.usuario_cpf = U.cpf
GROUP By H.cod_hotel
ORDER By H.nome ASC;

-- Total de diárias para cada cliente
SELECT U.primeiro_nome, U.sobrenome,  U.email, SUM(U.diarias) AS Total_diarias, H.nome, L.local_hotel
FROM ((localizacao_hotel AS L INNER JOIN hotel as H ON L.hotel_cod_hotel = H.cod_hotel) INNER JOIN reserva as R ON R.hotel_cod_hotel = H.cod_hotel) Inner JOIN Usuario AS U ON R.usuario_cpf = <variable_cpf>
GROUP BY H.nome, L.local_hotel
ORDER BY H.nome ASC;

-- Total de reservas canceladas
SELECT COUNT(estado) as Cancelled_Reserves
FROM reserva
WHERE estado = 'Cancelado' AND (data_inicial BETWEEN <variable_data_x> AND <variable_data_y>);

-- Total de reservas canceladas (por hotel)
SELECT H.nome, COUNT(R.estado) as Cancelled_Reserves_
FROM reserva AS R INNER JOIN hotel As H On R.hotel_cod_hotel = H.cod_hotel
WHERE R.estado = 'Cancelado' AND (R.data_inicial BETWEEN <variable_data_x> AND <variable_data_y>)
GROUP By H.nome
ORDER BY H.nome ASC;

-- Total de clientes (por hotel)
SELECT H.nome, L.local_hotel, COUNT(U.cpf) as Total_clients
FROM ((hotel As H INNER JOIN localizacao_hotel as L ON L.hotel_cod_hotel = cod_hotel) INNER JOIN reserva AS R On R.hotel_cod_hotel = H.cod_hotel) INNER JOIN usuario AS U ON R.usuario_cpf = U.cpf
GROUP By H.nome
ORDER BY H.nome ASC;

-- Informações sobre reservas entre determinadas datas especificadas pelo cliente
SELECT data_inicial, data_final, valor_total AS Valor_pago
FROM reserva
WHERE (data_inicial BETWEEN <variable_data_x> AND <variable_data_y>) AND usuario_cpf = <variable_cpf>

-- Retorna o tipo de quarto mais reservado em cada hotel
SELECT H.nome, L.local_hotel, Q.tipo, COUNT(R.tipo) As Occurrences
FROM ((quarto as Q INNER JOIN hotel as H on Q.hotel_cod_hotel = H.cod_hotel) INNER JOIN locacalizacao_hotel as L ON L.hotel_cod_hotel = H.cod_hotel) INNER JOIN reserva as R On R.hotel_cod_hotel = H.cod_hotel
GROUP BY H.nome, L.local_hotel
ORDER BY Occurrences DESC
LIMIT 1;

-- Retorna a proporção de quantos usuários cadastrados moram fora de MG
SELECT (100 - ((SELECT COUNT(cpf) FROM usuario WHERE endereco LIKE '%Minas Gerais%') / (SELECT COUNT(cpf) FROM usuario)) * 100) AS Residem_fora;

