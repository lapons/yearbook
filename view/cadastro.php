<?php
require_once './funcoes.php';

iniciaSessao();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Página de cadastro</title>
        <meta charset="UTF-8">
        <link type="text/css" rel="stylesheet" href="../css/estilo.css"/>
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
            include_once './layout/header.php';
            include_once './layout/menu.php';

            $estadoDAO = new EstadosDAO();
            $cidadeDAO = new CidadesDAO();

            $estados = $estadoDAO->getAllOrdemAlfabetica();
            ?>
            <div class="row">

                <h1 class="titulo-padrao">Para ter acesso a todos os recursos do Yearbook cadastre-se.</h1>

                <form class="col-lg-5" method="POST" action="funcoes.php?acao=cadastro" id="form-cadastro-pg-login" enctype="multipart/form-data">
                    <h3 id="titulo-cadastro">AINDA NÃO SOU CADASTRADO</h3>

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

                <form class="col-lg-6" method="POST" action="funcoes.php?acao=login" id="form-login" enctype="multipart/form-data">
                    <h3 id="titulo-login">JÁ SOU CADASTRADO</h3>

                    <?php
                    if (isset($_SESSION['erro-login'])) {
                        if ($_SESSION['erro-login'] == 1) {
                            ?>
                            <p class="erro-login">Senha incorreta.</p>
                        <?php } else { ?>
                            <p class="erro-login">Usuário não existe.</p>
                            <?php
                        }
                    }
                    ?>
                    <div class="form-group">
                        <label for="label-cadastro">Login</label>
                        <input type="text" name="login" required class="form-control" placeholder="Login"/>
                    </div>
                    <div class="linha-form">
                        <label for="label-cadastro">Senha</label>
                        <input type="password" name="senha" required class="form-control" placeholder="Senha" />
                    </div>
                    <div class="linha-form" id="linha-lembrar-senha-cadastro">
                        <input type="checkbox" id="input-lembra-senha-cadastro" name="lembrar-senha" checked="checked"/>
                        <label for="label-lembrar-senha-cadastro">Lembrar senha</label>
                    </div>
                    <input type="submit" value="Entrar" class="btn btn-success" />
                </form>
            </div>
        </div>
    </body>
</html>