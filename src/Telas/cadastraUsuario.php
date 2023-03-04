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
                            <a class="button is-primary" href='index.php'>
                                <strong>Home</strong>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="navbar-end">
                    <div class="navbar-item">
                        <div class="buttons">
                            <a class="button is-primary" href='cadastraUsuario.php'>
                                <strong>Cadastre-se</strong>
                            </a>
                            <a class="button is-primary" href='login.php'>
                                <strong>Fazer login</strong>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">
                    <h3 class="title has-text-black">Cadastrar-se</h3>
                    <?php if(isset($_SESSION['erro_BD'])): ?>
                        <div class="notification is-danger">
                            <p>ERRO: Usuário não foi inserido no banco de dados. Favor entrar em contato com o administrador do sistema.</p>
                        </div>
                    <?php endif;
                        unset($_SESSION['erro_BD']); ?>
                    <?php if(isset($_SESSION['erro_cpf'])): ?>
                        <div class="notification is-danger">
                            <p>ERRO: Usuário não inserido no banco de dados. Favor verificar o número do CPF.</p>
                        </div>
                    <?php endif;
                        unset($_SESSION['erro_cpf']); ?>
                    <?php if(isset($_SESSION['correto'])): ?>
                        <div class="notification is-success">
                            <p>Usuário inserido no banco de dados corretamente.</p>
                        </div>
                    <?php endif;
                        unset($_SESSION['correto']); ?>

                    <div class="box">
                        <form action="cadastraUsuarioBD.php" method="post">
                            <div class="field">
                                <p>Primeiro nome<input type="text" class="input is-large" name="pnome" autofocus=""/></p>
                            </div>
                            <div class="field">
                                <p>Sobrenome<input type="text" class="input is-large" name="sobrenome" autofocus=""/></p>
                            </div>
                            <div class="field">
                                <p>CPF<input type="text" class="input is-large" name="cpf" autofocus=""/></p>
                            </div>
                            <div class="field">
                                <p>Telefone<input type="text" class="input is-large" name="telefone" autofocus=""/></p>
                            </div>
                            <div class="field">
                                <p>E-mail<input type="text" class="input is-large" name="email" autofocus=""/></p>
                            </div>
                            <div class="field">
                                <p>Data de nascimento<input type="text" class="input is-large" name="datanasc" autofocus=""/></p>
                            </div>
                            <div class="field">
                                <p>Endereço<input type="text" class="input is-large" name="endereco" autofocus=""/></p>
                            </div>
                            <div class="field">
                                <p>Login<input type="text" class="input is-large" name="login" autofocus=""/></p>
                            </div>
                            <div class="field">
                                <p>Senha<input type="text" class="input is-large" name="senha" autofocus=""/></p>
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