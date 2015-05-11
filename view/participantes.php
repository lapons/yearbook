<?php
require_once '../dao/ParticipantesDAO.php';
require_once '../dao/CidadesDAO.php';
require_once './funcoes.php';

iniciaSessao();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8" lang="pt-br">
        <link type="text/css" rel="stylesheet" href="../css/estilo.css" />
        <title>Yearbook - Desenvolvimento de Aplicações WEB</title>
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
    <body>
        <div class="container-fluid">
            <?php
            require_once './layout/header.php';
            require_once './layout/menu.php';

            $participantes = $_SESSION['participantes'];
            $cidades = $_SESSION['cidades'];
            ?>


            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <form action="funcoes.php?acao=pesquisa" method="post" id="form-pesquisa" role="form">
                        <div class="row">
                            <div class="form-group col-md-8">
                                <label for="email" class="sr-only">Pesquisar</label>
                                <input type="text" id="txt-pesquisa" name="txt-pesquisa" class="form-control" placeholder="nome" />
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary" id="btn-pesquisar">Pesquisar</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-md-6 col-md-offset-3">
                    <div class="row">
                        <div class="col-md-12">
                            <ul id="lista-alunos" class="list-group">
                                <?php
                                if (count($participantes) == 0) { // não achou nenhum participante com o nome pesquisado
                                    echo "Nenhum registro encontrado.";
                                } else {
                                    for ($i = 0; $i < count($participantes); $i++) {
                                        ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <figure>
                                                                <a href="pagina-pessoal.php?participante=<?php echo $participantes[$i]->getLogin(); ?>">
                                                                    <img alt="<?php echo $participantes[$i]->getNomeCompleto(); ?>" id="foto-participante-pesquisa" src="../img/fotos/<?php echo $participantes[$i]->getArquivoFoto(); ?>" />
                                                                </a>
                                                            </figure>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <dl>
                                                                <dt class="titulo-informacoes-pesquisa">Nome</dt>
                                                                <dd class=""><a href="pagina-pessoal.php?participante=<?php echo $participantes[$i]->getLogin(); ?>" id="nome-pesquisa"><?php echo $participantes[$i]->getNomeCompleto(); ?></a></dd>
                                                                <dt class="titulo-informacoes-pesquisa">Cidade</dt>
                                                                <dd class="">
                                                                    <?php
                                                                    echo $cidades[$i][0]->getNomeCidade();
                                                                    ?></dd>
                                                            </dl>
                                                        </div>
                                                    </div>
                                                </li>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>