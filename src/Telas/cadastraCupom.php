<?php
session_start();
?>

<!DOCTYPE html>
<html>
    
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SGH - Cadastro de Cupom</title>
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
                            <a class="button is-primary" href='cadastraCupom.php'>
                                <strong>Cadastrar cupom</strong>
                            </a>
                            <a class="button is-primary" href='cadastraHotel.php'>
                                <strong>Cadastrar hotel</strong>
                            </a>
                            <a class="button is-primary" href='cadastraQuarto.php'>
                                <strong>Cadastrar quarto</strong>
                            </a>
                            <a class="button is-primary" href='cadastraFeriado.php'>
                                <strong>Cadastrar feriado</strong>
                            </a>
                            <a class="button is-primary" href='home.php'>
                                <strong>Relatórios</strong>
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
                    <h3 class="title has-text-black">Cadastro de cupom</h3>
                    <?php if(isset($_SESSION['erro_BD'])): ?>
                        <div class="notification is-danger">
                            <p>ERRO: Registro não foi inserido no banco de dados. Favor entrar em contato com o administrador do sistema.</p>
                        </div>
                    <?php endif;
                        unset($_SESSION['erro_BD']); ?>
                    <?php if(isset($_SESSION['erro_cpf'])): ?>
                        <div class="notification is-danger">
                            <p>ERRO: Hotel não inserido no banco de dados. Favor verificar o número do CPF.</p>
                        </div>
                    <?php endif;
                        unset($_SESSION['erro_cpf']); ?>
                    <?php if(isset($_SESSION['correto'])): ?>
                        <div class="notification is-success">
                            <p>Cupom inserido no banco de dados corretamente.</p>
                        </div>
                    <?php endif;
                        unset($_SESSION['correto']); ?>

                    <div class="box">
                        <form action="cadastraCupomBD.php" method="post">
                            <div class="field">
                                <p>Valor do cupom<input type="text" class="input is-large" name="valor" autofocus=""/></p>
                            </div>
                            <div class="field">
                                <p>Status<input type="text" class="input is-large" name="status" autofocus=""/></p>
                            </div>
                            <div class="field">
                                <p>CPF do administrador<input type="text" class="input is-large" name="cpf_admin" autofocus=""/></p>
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