<?php
session_start();
include('conexao.php');

if(empty($_POST['data_inicial'])||empty($_POST['data_final'])||empty($_POST['nome'])||empty($_POST['cpf_admin'])) {
	header('Location: cadastraFeriado.php');
	exit();
}

$nome = mysqli_real_escape_string ($conexao, $_POST['nome']);
$data_inicial = mysqli_real_escape_string($conexao, $_POST['data_inicial']);
$data_final = mysqli_real_escape_string($conexao, $_POST['data_final']);
$cpf_admin = mysqli_real_escape_string($conexao, $_POST['cpf_admin']);
if(strlen($cpf_admin) != 11)
{
	$_SESSION['erro_cpf'] = true;
	header('Location: cadastraFeriado.php');
	exit();
}


$query = "insert into feriado (data_inicial, data_final, nome, usuario_cpf_admin)
	values('{$data_inicial}','{$data_final}','{$nome}','{$cpf_admin}')";

$result = mysqli_query($conexao, $query);

//echo "<html>'{$result}'</html>"; //Usado para verificar o conteudo da variavel result

if($result==''){
	$_SESSION['erro_BD'] = true;
	header('Location: cadastraFeriado.php');
	exit();
}

#$row = mysqli_num_rows($result);

if($result == 1) {
	$_SESSION['correto'] = true;
	header('Location: cadastraFeriado.php');
	exit();
} else {
	$_SESSION['erro_BD'] = true;
	header('Location: cadastraFeriado.php');
	exit();
}