<?php
session_start();
include('conexao.php');

if(empty($_POST['pnome']) || empty($_POST['sobrenome'])||empty($_POST['cpf'])||empty($_POST['telefone'])||empty($_POST['email'])||empty($_POST['endereco'])||empty($_POST['datanasc'])||empty($_POST['login'])||empty($_POST['senha'])) {
	header('Location: cadastraUsuario.php');
	exit();
}

$pnome = mysqli_real_escape_string($conexao, $_POST['pnome']);
$sobrenome = mysqli_real_escape_string($conexao, $_POST['sobrenome']);
$cpf = mysqli_real_escape_string($conexao, $_POST['cpf']);
if(strlen($cpf) != 11)
{
	$_SESSION['erro_cpf'] = true;
	header('Location: cadastraUsuario.php');
	exit();
}
$telefone = mysqli_real_escape_string ($conexao, $_POST['telefone']);
$email = mysqli_real_escape_string($conexao, $_POST['email']);
$endereco = mysqli_real_escape_string ($conexao, $_POST['endereco']);
$datanasc = mysqli_real_escape_string($conexao, $_POST['datanasc']);
$login = mysqli_real_escape_string($conexao, $_POST['login']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);

#$query = "select login from usuario where login = '{$usuario}' and senha = md5('{$senha}')";
#$query = "select login from usuario where login = '{$usuario}' and senha ='{$senha}'";

#Apresentar ao professor a dependencia de registrar primeiro os dados do login
# antes dos dados do usuario.
# Isto e necessario porque foi pedido os dados no mesmo formulario.

$queryLogin = "insert into login (login, senha)
	values('{$login}', '{$senha}')";
$result2 = mysqli_query($conexao, $queryLogin);

$query = "insert into usuario (cpf, login_login, primeiro_nome, sobrenome, telefone, email, endereco, data_nascimento, diarias, tipo_administrador, tipo_cliente) 
	values('{$cpf}','{$login}','{$pnome}','{$sobrenome}','{$telefone}','{$email}','{$endereco}','{$datanasc}','0','0','1')";
$result = mysqli_query($conexao, $query);



echo "<html>'{$result}'</html>"; //Usado para verificar o conteudo da variavel result

if($result=='' || $result2==''){
	$_SESSION['erro_BD'] = true;
	header('Location: cadastraUsuario.php');
	exit();
}

#$row = mysqli_num_rows($result);

if($result == 1 && $result2== 1) {
	$_SESSION['correto'] = true;
	header('Location: cadastraUsuario.php');
	exit();
} else {
	$_SESSION['erro_BD'] = true;
	header('Location: cadastraUsuario.php');
	exit();
}