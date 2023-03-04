<?php
session_start();
include('conexao.php');

if(empty($_POST['valor']) || empty($_POST['status']) || empty($_POST['cpf_admin'])) {
	header('Location: cadastraCupom.php');
	exit();
}

$valor = mysqli_real_escape_string($conexao, $_POST['valor']);
$status = mysqli_real_escape_string($conexao, $_POST['status']);
$cpf_admin = mysqli_real_escape_string ($conexao, $_POST['cpf_admin']);
if(strlen($cpf_admin) != 11)
{
	$_SESSION['erro_cpf'] = true;
	header('Location: cadastraHotel.php');
	exit();
}

$query = "insert into cupom (status, valor_desconto, usuario_cpf)
	values ('{$status}','{$valor}','{$cpf_admin}')";

$result = mysqli_query($conexao, $query);

if($result==''){
	$_SESSION['erro_BD'] = true;
	header('Location: cadastraCupom.php');
	exit();
}

#echo "<html>'{$result}'</html>"; //Usado para verificar o conteudo da variavel result

#$row = mysqli_num_rows($result);

if($result == 1) {
	$_SESSION['correto'] = true;
	header('Location: cadastraCupom.php');
	exit();
} else {
	$_SESSION['erro_BD'] = true;
	header('Location: cadastraCupom.php');
	exit();
}
?>