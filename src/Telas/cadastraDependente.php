<?php
session_start();
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
                    <h3 class="title has-text-black">Cadastro de dependente</h3>
                    <?php if(isset($_SESSION['erro_BD'])): ?>
                        <div class="notification is-danger">
                            <p>ERRO: Dependente não foi inserido no banco de dados. Favor entrar em contato com o administrador do sistema.</p>
                        </div>
                    <?php endif;
                        unset($_SESSION['erro_BD']); ?>
                    <?php if(isset($_SESSION['erro_cpf'])): ?>
                        <div class="notification is-danger">
                            <p>ERRO: Dependente não inserido no banco de dados. Favor verificar o número do CPF.</p>
                        </div>
                    <?php endif;
                        unset($_SESSION['erro_cpf']); ?>
                    <?php if(isset($_SESSION['correto'])): ?>
                        <div class="notification is-success">
                            <p>Dependente inserido no banco de dados corretamente.</p>
                        </div>
                    <?php endif;
                        unset($_SESSION['correto']); ?>
                    
                    <div class="box">
                        <form action="cadastraDependenteBD.php" method="post">
                            <div class="field">
                                <p>Primeiro nome<input type="text" class="input is-large" name="primeiro_nome" autofocus=""/></p>
                            </div>
                            <div class="field">
                                <p>Sobrenome<input type="text" class="input is-large" name="sobrenome" autofocus=""/></p>
                            </div>
                            <div class="field">
                                <p>Data de nascimento<input type="text" class="input is-large" name="data_nascimento" autofocus=""/></p>
                            </div>
                            <div class="field">
                                <p>CPF do titular<input type="text" class="input is-large" name="usuario_cpf" autofocus=""/></p>
                            </div>
                            <div class="field" style="margin-top:20px">
                                <input type="submit" class="button is-block is-primary is-large is-fullwidth"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>