<?php
session_start();
include('conexao.php');

if(empty($_POST['login']) || empty($_POST['senha'])) {
	header('Location: login.php');
	exit();
}

$login = mysqli_real_escape_string($conexao, $_POST['login']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);

#$query = "select login from usuario where login = '{$login}' and senha = md5('{$senha}')";
#$query = "select login from usuario where login = '{$login}' and senha ='{$senha}'";
$query = "select login from login where login = '{$login}' and senha ='{$senha}'";
$query2 = "select tipo_administrador from usuario join login on login_login=login where login_login = '{$login}' and tipo_administrador = 1";
//$query2 = "select tipo_administrador from usuario as u,login as l where l.login = '{$usuario}' and l.login=u.login and tipo_administrador = 1";

$result = mysqli_query($conexao, $query);
$result2 = mysqli_query($conexao, $query2);
#echo "<html>'{$result}'</html>";
#echo "<html>'{$result2}'</html>";

$row = mysqli_num_rows($result);
$row2 = mysqli_num_rows($result2);

if($row2 == 1) {
	$_SESSION['administrador'] = true;
	$_SESSION['usuario'] = $login;
	header('Location: home.php');
	exit();
}
if($row == 1) {
	$_SESSION['usuario'] = $login;
	header('Location: home.php');
	exit();
} else {
	$_SESSION['nao_autenticado'] = true;
	header('Location: login.php');
	exit();
}