<?php
session_start();
include('conexao.php');

if(empty($_POST['numero']) || empty($_POST['descricao'])||empty($_POST['tipo'])||empty($_POST['status'])||empty($_POST['hotel_cod_hotel'])) {
	header('Location: cadastraQuarto.php');
	exit();
}

$numero = mysqli_real_escape_string($conexao, $_POST['numero']);
$descricao = mysqli_real_escape_string($conexao, $_POST['descricao']);
$tipo = mysqli_real_escape_string($conexao, $_POST['tipo']);
/* if(strlen($cpf) != 11)
{
	$_SESSION['erro_cpf'] = true;
	header('Location: cadastraUsuario.php');
	exit();
} */
$status = mysqli_real_escape_string ($conexao, $_POST['status']);
$hotel_cod_hotel = mysqli_real_escape_string($conexao, $_POST['hotel_cod_hotel']);

$query = "insert into quarto (numero, descricao, tipo, status, hotel_cod_hotel)
values('{$numero}','{$descricao}','{$tipo}','{$status}','{$hotel_cod_hotel}')";

$result = mysqli_query($conexao, $query);

//echo "<html>'{$result}'</html>"; //Usado para verificar o conteudo da variavel result

if($result==''){
	$_SESSION['erro_BD'] = true;
	header('Location: cadastraQuarto.php');
	exit();
}

#$row = mysqli_num_rows($result);

if($result == 1) {
	$_SESSION['correto'] = true;
	header('Location: cadastraQuarto.php');
	exit();
} else {
	$_SESSION['erro_BD'] = true;
	header('Location: cadastraQuarto.php');
	exit();
}