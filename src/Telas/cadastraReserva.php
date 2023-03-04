<?php
session_start();
include ('conexao.php');
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
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">
                    <h3 class="title has-text-black">Cadastro de reserva</h3>
                    <?php if(isset($_SESSION['erro_BD'])): ?>
                        <div class="notification is-danger">
                            <p>ERRO: Reserva não foi inserida no banco de dados. Favor entrar em contato com o administrador do sistema.</p>
                        </div>
                    <?php endif;
                        unset($_SESSION['erro_BD']); ?>
                    <?php if(isset($_SESSION['erro_cpf'])): ?>
                        <div class="notification is-danger">
                            <p>ERRO: Reserva não inserida no banco de dados. Favor verificar o número do CPF.</p>
                        </div>
                    <?php endif;
                        unset($_SESSION['erro_cpf']); ?>
                    <?php if(isset($_SESSION['correto'])): ?>
                        <div class="notification is-success">
                            <p>Reserva inserida no banco de dados corretamente.</p>
                        </div>
                    <?php endif;
                        unset($_SESSION['correto']); ?>

                    <div class="box">
                    <?php 
                        $usuario=$_SESSION['usuario'];
                        // cria a instrução SQL que vai selecionar os dados
                        $query = sprintf("SELECT cod_cupom, valor_desconto FROM cupom WHERE status='usado' and usuario_cpf=(SELECT cpf from usuario where login_login = '$usuario')");
                        //$query = sprintf("SELECT cod_cupom, valor_desconto FROM cupom WHERE status='valido'");
                        // executa a query
                        //$dados = mysqli_query($conexao,$query) or die(mysqli_error());
                        if ($dados = mysqli_query($conexao, $query)){
                            echo "<p>Código do cupom | Valor do desconto (%)</p>";
                            while ($linha = mysqli_fetch_assoc($dados)) {
                                //printf ("%s (%s)\n", $linha["cod_cupom"], $row["valor_desconto"]);
                                echo "<p>". $linha['cod_cupom'] . "  |  ". $linha['valor_desconto'] ."</p>";
                            }
                            echo "<br>";
                            mysqli_free_result($dados);
                        } ?>

                        <form action="cadastraReservaBD.php" method="post">
                            <div class="field">
                                <p>Código do hotel<input type="text" class="input is-large" name="hotel_cod_hotel" autofocus=""/></p>
                            </div>
                            <div class="field">
                                <p>CPF<input type="text" class="input is-large" name="usuario_cpf" autofocus=""/></p>
                            </div>
                            <div class="field">
                                <p>Data inicial<input type="text" class="input is-large" name="data_inicial" autofocus=""/></p>
                            </div>
                            <div class="field">
                                <p>Data final<input type="text" class="input is-large" name="data_final" autofocus=""/></p>
                            </div>
                            <div class="field">
                                <p>Valor do desconto<input type="text" class="input is-large" name="valor_desconto" autofocus=""/></p>
                            </div>
                            <div class="field">
                                <p>Valor total<input type="text" class="input is-large" name="valor_total" autofocus=""/></p>
                            </div>
                            <!-- <div class="field">
                                <p>Estado<input type="text" class="input is-large" name="estado" autofocus=""/></p>
                            </div> -->
                            <!-- <div class="field">
                                <p>Feriado<input type="text" class="input is-large" name="feriado" autofocus=""/></p>
                            </div> -->
                            <div class="field" style="margin-top:20px">
                                <input type="submit" class="button is-block is-primary is-large is-fullwidth"/>
                            </div>
                        </form>
                            <!-- VERIFICACOES -->
                            <?php 
                            if($row2 == 1) {
                                $_SESSION['administrador'] = true;
                                $_SESSION['usuario'] = $login;
                                header('Location: home.php');
                                exit();
                            }
                            
                            
                            
                            
                            ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>