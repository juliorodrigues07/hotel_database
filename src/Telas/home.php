<?php
//include('verificaLogin.php');
session_start();
include('conexao.php');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema Gerenciador de Hotéis</title>
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
                            <?php if(isset($_SESSION['administrador'])):?>
                               
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
                                <a class="button is-primary" href='relatorio.php'>
                                    <strong>Relatórios</strong>
                                </a>
                                <a class="button is-primary" href='logout.php'>
                                    <strong>Sair</strong>
                                </a>
                            <?php else: ?>
                                
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
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <div class="hero-body">
            <div class="container">
                <div style="background-color:#00d1b2; margin-top: -20px; margin-bottom: 30px; padding: 10px">
                    <h3 class="title has-text-black">Sistema Gerenciador de Hotéis</h3>
                </div>

                <?php
                    $imagens = ['https://images.pexels.com/photos/258154/pexels-photo-258154.jpeg',
                    'https://images.pexels.com/photos/262048/pexels-photo-262048.jpeg',
                    'https://images.pexels.com/photos/271624/pexels-photo-271624.jpeg',
                    'https://images.pexels.com/photos/164595/pexels-photo-164595.jpeg'];
                    $valorOferta =[100,200,300,400];

                    $query = "select * from hotel";
                    $result = mysqli_query($conexao, $query);
                    $contador = 0;
                    while ($fetch = mysqli_fetch_array($result)) { ?>
                        <div class="box" style="width:550px; <?php if ($contador % 2 == 0) echo 'display:inline-block';
                        else echo 'float:right' ?>">
                            <img src=<?php echo $imagens[$contador] ?> width="200px" style="float:right"></img>
                            <h3 class="title has-text-black">Hotel <?php echo $fetch[1] ?></h3>
                            <p class="has-text-black">Código do hotel: <?php echo $fetch[0] ?></p>
                            <p class="has-text-black">Quartos a partir de R$<?php echo $valorOferta[$contador] ?> para hoje </p>
                            <div class="buttons" style="margin-top: 30px">
                                <a class="button is-primary" href='cadastraReserva.php' type="submit">
                                    <strong>Fazer reserva</strong>
                                </a>
                            </div>
                            <div style="clear: right"></div>
                        </div>
                    <?php
                        $contador++;
                        if ($contador == 4) $contador = 0;
                    }?>
            </div>
        </div>
    </section>
</body>

</html>