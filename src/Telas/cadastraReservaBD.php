<?php
session_start();
include('conexao.php');

if(empty($_POST['usuario_cpf'])||empty($_POST['hotel_cod_hotel'])||empty($_POST['data_inicial'])||empty($_POST['data_final'])||empty($_POST['valor_desconto'])||empty($_POST['valor_total'])) {
	header('Location: cadastraReserva.php');
	exit();
}

$hotel_cod_hotel = mysqli_real_escape_string($conexao, $_POST['hotel_cod_hotel']);
$usuario_cpf = mysqli_real_escape_string($conexao, $_POST['usuario_cpf']);
if(strlen($usuario_cpf) != 11)
{
	$_SESSION['erro_cpf'] = true;
	header('Location: cadastraUsuario.php');
	exit();
}
$data_inicial = mysqli_real_escape_string ($conexao, $_POST['data_inicial']);
$data_final = mysqli_real_escape_string($conexao, $_POST['data_final']);
$valor_desconto = mysqli_real_escape_string ($conexao, $_POST['valor_desconto']);
$valor_total = mysqli_real_escape_string($conexao, $_POST['valor_total']);
//$estado = mysqli_real_escape_string($conexao, $_POST['estado']);
$feriado = mysqli_real_escape_string($conexao, $_POST['feriado']);

#$query = "select login from usuario where login = '{$usuario}' and senha = md5('{$senha}')";
#$query = "select login from usuario where login = '{$usuario}' and senha ='{$senha}'";


if ($feriado != null) {
	$query = "insert into reserva (usuario_cpf, hotel_cod_hotel, data_inicial, data_final, valor_desconto, valor_total, estado, feriado)
	values('{$usuario_cpf}','{$hotel_cod_hotel}','{$data_inicial}','{$data_final}','{$valor_desconto}','{$valor_total}','Reservado','{$feriado}')";
}
else {$query = "insert into reserva (usuario_cpf, hotel_cod_hotel, data_inicial, data_final, valor_desconto, valor_total, estado)
	values('{$usuario_cpf}','{$hotel_cod_hotel}','{$data_inicial}','{$data_final}','{$valor_desconto}','{$valor_total}','Reservado')";
}

$result = mysqli_query($conexao, $query);

//echo "<html>'{$result}'</html>"; //Usado para verificar o conteudo da variavel result

if($result==''){
	$_SESSION['erro_BD'] = true;
	header('Location: CadastraReserva.php');
	exit();
}

#$row = mysqli_num_rows($result);

if($result == 1) {
	$_SESSION['correto'] = true;
	header('Location: cadastraReserva.php');
	exit();
} else {
	$_SESSION['erro_BD'] = true;
	header('Location: cadastraReserva.php');
	exit();
}