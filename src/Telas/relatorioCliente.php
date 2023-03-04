<?php
include('verificaLogin.php');
include('conexao.php');
?>

<!DOCTYPE html>
<html>
    
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SGH - Cadastra Usuário</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="css/bulma.min.css" />
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>

<body>
    <section>
    </section>
    <section class="hero is-success is-fullheight">
        <nav class="navbar has-text-grey" role="navigation" aria-label="main navigation">
            <div id="navbarBasicExample" class="navbar-menu">
                <div class="navbar-start">
                    <div class="navbar-item">
                        <div class="buttons">
                            <a class="button is-primary" href='home.php'>
                                <strong>Home</strong>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="navbar-end">
                    <div class="navbar-item">
                        <div class="buttons">
                            <a class="button is-primary" href='perfilUsuario.php'>
                                <strong>Perfil do usuário</strong>
                            </a>
                            <a class="button is-primary" href='relatorioCliente.php'>
                                <strong>Relatórios</strong>
                            </a>
                            <a class="button is-primary" href='cadastraReserva.php'>
                                <strong>Cadastrar reserva</strong>
                            </a>
                            <a class="button is-primary" href='cadastraDependente.php'>
                                <strong>Cadastrar dependente</strong>
                            </a>
                            <a class="button is-primary" href='logout.php'>
                                <strong>Sair</strong>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <div class="hero-body">
            <div class="container">
            <div class="column is-6 is-offset-3">        
                    <h2 class="title has-text-black">Relatório</h2>
                    <div class="box">
                        <!-- <h3 class="title has-text-black">Cupons utilizados</h3> -->
                        <?php
                            $usuario=$_SESSION['usuario'];
                            // cria a instrução SQL que vai selecionar os dados
                            $query = sprintf("SELECT R.data_inicial, COUNT(R.data_inicial) As Occurrences
                            FROM reserva as R INNER JOIN hotel as H ON R.hotel_cod_hotel = H.cod_hotel
                            GROUP BY H.nome
                            ORDER BY Occurrences DESC
                            LIMIT 3;");
                            //$query = sprintf("SELECT cod_cupom, valor_desconto FROM cupom WHERE status='valido'");
                            // executa a query
                            //$dados = mysqli_query($conexao,$query) or die(mysqli_error());
                            if ($dados = mysqli_query($conexao, $query)){
                                echo "<p> Datas mais atrativas</p><br>";
                                echo "<p> Data Inicial | Ocorrencia</p><br>";
                                while ($linha = mysqli_fetch_assoc($dados)) {
                                    //printf ("%s (%s)\n", $linha["cod_cupom"], $row["valor_desconto"]);
                                    echo "<p>". $linha['data_inicial'] . "  |  ". $linha['Occurrences'] ."</p>";
                                }
                                mysqli_free_result($dados);
                            }
                            //$dados = $mysqli -> query($query);
                            // transforma os dados em um array
                            // $linha = mysqli_fetch_assoc($dados);
                            //$linha = $dados -> fetch_assoc();
                            // calcula quantos dados retornaram
                            //$total = mysqli_num_rows($dados);
                            // se o número de resultados for maior que zero, mostra os dados
                            //if($total > 0) {
                                // inicia o loop que vai mostrar todos os dados
                                //do {
                                    
                                    $usuario=$_SESSION['usuario'];
                                    // cria a instrução SQL que vai selecionar os dados
                                    $query = sprintf("SELECT H.nome, SUM(U.diarias)
                                    FROM (hotel AS H INNER JOIN reserva AS R ON H.cod_hotel = R.hotel_cod_hotel) INNER JOIN usuario AS U ON R.usuario_cpf = U.cpf
                                    GROUP By H.cod_hotel
                                    ORDER By H.nome ASC;");
                                    //$query = sprintf("SELECT cod_cupom, valor_desconto FROM cupom WHERE status='valido'");
                                    // executa a query
                                    //$dados = mysqli_query($conexao,$query) or die(mysqli_error());
                                    if ($dados = mysqli_query($conexao, $query)){
                                        echo "<p> Total de Diarias para cada Hotel</p><br>";
                                        echo "<p> Nome Hotel | Diarias</p><br>";
                                        while ($linha = mysqli_fetch_assoc($dados)) {
                                            //printf ("%s (%s)\n", $linha["cod_cupom"], $row["valor_desconto"]);
                                            echo "<p>". $linha['nome'] . "  |  ". $linha['SUM(U.diarias)'] ."</p>";
                                        }
                                        mysqli_free_result($dados);
                                    }



                        echo "<h3 class=\"title has-text-black\" style=\"margin-top:50px\">Reservas realizadas</h3>";
                            $query = "SELECT cod_reserva as codigo, hotel_cod_hotel as hotel, data_inicial, data_final, valor_desconto, valor_total 
                                from reserva where usuario_cpf=(SELECT cpf from usuario where login_login = '$usuario')";
                            if ($dados = mysqli_query($conexao, $query)){
                                echo "<p>Código | Hotel | Nome do Hotel | Cidade | Data inicial | Data final | Valor do desconto (%) | Valor total</p><br>";
                                while ($linha = mysqli_fetch_assoc($dados)) {
                                    $queryNome = "SELECT nome from hotel where cod_hotel='{$linha['hotel']}'";
                                    $nomeHotel = mysqli_query($conexao, $queryNome);
                                    $nomeHotel = mysqli_fetch_row($nomeHotel)[0];
                                    $queryLocal = "SELECT local_hotel from localizacao_hotel where hotel_cod_hotel='{$linha['hotel']}'";;
                                    $localizacao = mysqli_query($conexao, $queryLocal);
                                    $localizacao = mysqli_fetch_row($localizacao)[0];
                                    echo "<p>". $linha['codigo'] . "  |  ". $linha['hotel'] . "  |  ". $nomeHotel . "  |  ". $localizacao . "  |  ". $linha['data_inicial'] . "  |  ". $linha['data_final'] . "  |  ". $linha['valor_desconto'] . "  |  ". $linha['valor_total'] ."</p>";
                                }
                                mysqli_free_result($dados);
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>