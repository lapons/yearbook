<!DOCTYPE html>
<html>
    <head lang="pt-br">
        <title>Yearbook - Desenvolvimento de Aplicações WEB</title>
        <meta charset="utf-8" lang="pt-br" />
        <link href="../css/estilo.css" type="text/css" rel="stylesheet" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body id="pagina-pessoal">
        <div class="container-fluid">
            <?php
            require_once './layout/header.php'; // inclui o header da página
            require_once './layout/menu.php'; // inclui o menu da página
            ?>
            <h1 class="titulo-padrao">Sobre o trabalho</h1>
            <p>Trabalho desenvolvido para apresentação da disciplina Desenvolvimento de Aplicações Web na Nuvem
                do curso de especialização em Desenvolvimento de Aplicações Web da Puc Minas.
            </p>
            <p>Projeto hospedado no github, poderá ser acessado neste link:
                <a href="https://github.com/lapons/yearbook" target="_blank">Projeto Github</a></p>
            <h2>Tecnologias utilizadas:</h2>
            <ul>
                <li>Linguagem de programação: PHP</li>
                <li>Banco de dados: MySql</li>
                <li>IDE de desenvolvimento: Netbeans</li>
                <li>Framework CSS: Bootstrap</li>
                <li>Linguagem de script: Javascript</li>
            </ul>
        </div>
    </body>
</html>