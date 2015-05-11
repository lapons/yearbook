<?php
require_once 'funcoes.php';
iniciaSessao();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
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
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#estado').change(function () {
                    $('#cidade').load('listaCidades.php?estado=' + $('#estado').val());
                });
            });
        </script>
    </head>
    <body>
        <div class="container-fluid">
            <?php
            include_once '../dao/EstadosDAO.php';
            include_once '../dao/CidadesDAO.php';
            include_once '../model/Cidades.php';
            require_once '../dao/ParticipantesDAO.php';

            // Pesquisa dos participantes cadastrados
            $participantesDAO = new ParticipantesDAO();
            $participantes = $participantesDAO->pesqOrdemAlfabetica();

            // Inclusão do header na página
            require_once 'layout/header.php';

            // Inclusão do menu
            require_once 'layout/menu.php';

            $estadoDAO = new EstadosDAO();
            $cidadeDAO = new CidadesDAO();
            $estados = $estadoDAO->getAllOrdemAlfabetica();
            ?>

            <?php if (!isset($_SESSION['login'])) { // verificação de login ?>
                <div class="row">
                    <div class="col-lg-5">
                        <figure class="pessoa">
                            <a href="#"><img alt="participantes" class="foto" src="../img/fotos/amigos.png" /></a>
                        </figure>
                    </div>
                    <div class="col-lg-6"  id="cadastro-home">
                        <h2 class="titulo-padrao">Faça parte da nossa turma!</h2>
                        <h1 class="titulo-padrao">Cadastre-se</h1>
                        <form method="POST" action="funcoes.php?acao=cadastro" id="form-cadastro" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="label-cadastro">Login</label>
                                <input type="text" name="login" required class="form-control" placeholder="Login">
                            </div>
                            <div class="form-group">
                                <label for="label-cadastro">Senha</label>
                                <input type="password" name="senha" required class="form-control" placeholder="Senha">
                            </div>
                            <div class="form-group">
                                <label for="label-cadastro">Foto</label>
                                <input type="file" name="arquivoFoto" required>
                                <p class="help-block">Insira uma foto de resolução xxx/xxx</p>
                            </div>
                            <div class="form-group">
                                <label for="label-cadastro">Nome Completo</label>
                                <input type="text" name="nomeCompleto" required class="form-control" placeholder="Nome Completo"/>
                            </div>
                            <div class="form-group">
                                <label for="label-cadastro">Estado</label>
                                <select name="estado" id="estado" required class="form-control">
                                    <option value=""></option>
                                    <?php foreach ($estados as $estado) { ?>
                                        <option value="<?php echo $estado->getIdEstado(); ?>"><?php echo $estado->getNomeEstado(); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group" id="cidade"></div>
                            <div class="form-group">
                                <label for="label-cadastro">E-mail</label>
                                <input type="email" name="email" required class="form-control" placeholder="E-mail"/>
                            </div>
                            <div class="form-group">
                                <label for="label-cadastro">Descrição</label>
                                <textarea name="descricao" required class="form-control" placeholder="Descrição" ></textarea>
                            </div>
                            <input type="submit" value="Cadastrar" class="btn btn-success" />
                        </form>
                    </div>
                </div>
                <?php
                // Inclusão do footer na página
                require_once 'layout/footer.php';
                ?>

                <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
                <!-- Include all compiled plugins (below), or include individual files as needed -->
                <script src="../js/bootstrap.min.js"></script>

            <?php } else { // fim if de verificação de login ?>
                <h1 class="titulo-padrao">Bem vindo ao yearbook.</h1>
                <div class="row">
                    <div class="col-lg-12">
                        <figure class="pessoa">
                            <a href="#"><img alt="participantes" class="foto" src="../img/fotos/amigos.png" /></a>
                        </figure>
                    </div>
                </div>
            <?php } ?>
        </div>
    </body>
</html>