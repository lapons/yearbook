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
        <?php
        require_once './layout/header.php'; // inclui o header da página
        require_once './layout/menu.php'; // inclui o menu da página

        if (isset($_SESSION['login'])) { // verifica se está logado
            require_once '../dao/ParticipantesDAO.php';
            require_once '../dao/CidadesDAO.php';

            $loginParticipante = $_GET['participante'];
            $participanteDAO = new ParticipantesDAO();
            $cidadeDAO = new CidadesDAO();

            $participante = $participanteDAO->pesqPorLogin($loginParticipante);
            $cidade = $cidadeDAO->getPorId($participante[0]->getCidade());
            ?>
            <div class="row">
                <div class="col-md-12">
                    <section id="aluno">
                        <div class="row">
                            <div class="col-md-3">
                                <figure>
                                    <a href="#">
                                        <img alt="<?php echo $participante[0]->getNomeCompleto(); ?>" id="foto-pg-pessoal" src="../img/fotos/<?php echo $participante[0]->getArquivoFoto(); ?>" />
                                    </a>
                                </figure>
                            </div>
                            <div class="col-md-9">
                                <dl>
                                    <dt class="titulo-informacoes">Nome</dt>
                                    <dd class="texto-informacoes"><?php echo $participante[0]->getNomeCompleto(); ?></dd>
                                    <dt class="titulo-informacoes">Cidade</dt>
                                    <dd class="texto-informacoes"><?php echo $cidade[0]->getNomeCidade(); ?></dd>
                                    <dt class="titulo-informacoes">E-mail</dt>
                                    <dd class="texto-informacoes"><?php echo $participante[0]->getEmail(); ?></dd>
                                    <dt class="titulo-informacoes">Descrição</dt>
                                    <dd class="texto-informacoes"><?php echo $participante[0]->getDescricao(); ?></dd>
                                </dl>
                                <a href="funcoes.php?acao=pesquisa">
                                    <button class="btn btn-primary" type="button">Voltar</button>
                                </a>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <?php
        } else { // não está logado
            header('refresh: 0; url=cadastro.php'); // redireciono para a página de cadastro
        }
        ?>
    </body>
</html>