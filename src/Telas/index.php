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
            <div class="container">
                <div style="background-color:#00d1b2; margin-top: -20px; margin-bottom: 20px; padding: 10px">
                    <h3 class="title has-text-black">Sistema Gerenciador de Hotéis</h3>
                </div>
                <div class="box">
                    <h3 class="title has-text-black">Ofertas</h3>
                    <p class="has-text-black">Temos ofertas imperdíveis! Cupons de desconto cumulativos para você aproveitar!</p>
                </div>
                <div class="box">
                    <h3 class="title has-text-black">Uma grande variedade de hotéis, para você escolher do seu gosto!</h3>
                    <img src="https://images.pexels.com/photos/258154/pexels-photo-258154.jpeg" width="400px" style="float:right; margin-right:50px"></img>
                    <div class="column" style="width:550px">
                        <p class="has-text-black">Quartos standard, master ou deluxe, com preços que cabem no seu bolso.</p>
                        <p class="has-text-black" style="margin-top: 20px">Nosso sistema gerencia diversos hotéis espalhados por todo o Brasil. Temos vagas mesmo para você que deseja se hospedar nas datas mais atrativas!</p>
                        <p class="has-text-black" style="margin-top: 20px">Cadastre-se ou faça login e venha se hospedar em nossos hotéis!</p>
                        <div class="buttons" style="margin-top: 30px; justify-content:center">
                            <a class="button is-primary" href='cadastraUsuario.php'>
                                <strong>Cadastre-se</strong>
                            </a>
                            <a class="button is-primary" href='login.php'>
                                <strong>Fazer login</strong>
                            </a>
                        </div>
                    </div>
                    <div style="clear: right"></div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>