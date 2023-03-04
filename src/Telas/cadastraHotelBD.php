<?php
session_start();
include('conexao.php');

if(empty($_POST['nomehotel']) || empty($_POST['localhotel'])|| empty($_POST['cpf_admin'])) {
	header('Location: cadastraHotel.php');
	exit();
}

$nomehotel = mysqli_real_escape_string($conexao, $_POST['nomehotel']);
$localhotel = mysqli_real_escape_string($conexao, $_POST['localhotel']);
$cpf_admin = mysqli_real_escape_string($conexao, $_POST['cpf_admin']);
if(strlen($cpf_admin) != 11)
{
	$_SESSION['erro_cpf'] = true;
	header('Location: cadastraHotel.php');
	exit();
}

$query = "insert into hotel (nome, cpf_administrador)
	values ('{$nomehotel}', '{$cpf_admin}')";

$result = mysqli_query($conexao, $query);

$queryCodigo = "select cod_hotel from hotel where nome='{$nomehotel}'";
$resultadoCodigo = mysqli_query($conexao, $queryCodigo);
$fetch = mysqli_fetch_row($resultadoCodigo);
$query2 = "insert into localizacao_hotel (hotel_cod_hotel, local_hotel) 
values ('{$fetch[0]}', '{$localhotel}')"; 

$result2 = mysqli_query($conexao, $query2);

if($result=='' || $result2==''){
	$_SESSION['erro_BD'] = true;
	header('Location: cadastraHotel.php');
	exit();
}

#echo "<html>'{$result}'</html>"; //Usado para verificar o conteudo da variavel result

#$row = mysqli_num_rows($result);

if($result == 1 && $result2 == 1) {
	$_SESSION['correto'] = true;
	header('Location: cadastraHotel.php');
	exit();
} else {
	$_SESSION['erro_BD'] = true;
	header('Location: cadastrahotel.php');
	exit();
}
?>