<?php
session_start();
include('conexao.php');

if(empty($_POST['primeiro_nome']) || empty($_POST['sobrenome'])||empty($_POST['data_nascimento'])||empty($_POST['usuario_cpf'])) {
	header('Location: cadastraDependente.php');
	exit();
}

$primeiro_nome = mysqli_real_escape_string($conexao, $_POST['primeiro_nome']);
$sobrenome = mysqli_real_escape_string($conexao, $_POST['sobrenome']);
$data_nascimento = mysqli_real_escape_string($conexao, $_POST['data_nascimento']);
$usuario_cpf = mysqli_real_escape_string ($conexao, $_POST['usuario_cpf']);
if(strlen($usuario_cpf) != 11)
{
	$_SESSION['erro_cpf'] = true;
	header('Location: cadastraDependente.php');
	exit();
}


$query = "insert into dependente (primeiro_nome, sobrenome, data_nascimento, usuario_cpf) 
	values('{$primeiro_nome}','{$sobrenome}','{$data_nascimento}','{$usuario_cpf}')";

$result = mysqli_query($conexao, $query);

// echo "<html>'{$result}'</html>"; //Usado para verificar o conteudo da variavel result

if($result==''){
	$_SESSION['erro_BD'] = true;
	header('Location: cadastraDependente.php');
	exit();
}

#$row = mysqli_num_rows($result);

if($result == 1) {
	$_SESSION['correto'] = true;
	header('Location: cadastraDependente.php');
	exit();
} else {
	$_SESSION['erro_BD'] = true;
	header('Location: cadastraDependente.php');
	exit();
}