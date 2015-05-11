<?php
require_once 'funcoes.php';
iniciaSessao();
?>
<div class="row">
    <header>
        <div class="col-lg-2">
            <a href="index.php"><img alt="Logo PUC Minas Virtual" src="../img/img-logo-puc-minas-virtual.png" id="logo-puc" /></a>
        </div>
        <div id="bloco-titulo-cabecalho" class="col-lg-8">
            <h1 id="titulo-01-header">Desenvolvimento de Aplicações WEB</h1>
            <h3 id="titulo-02-header">Pós Graduação - PUC Minas</h3><br/>
            <p id="titulo-03-header">Yearbook</p>
        </div>

        <div class="col-lg-2">
            <?php if (isset($_SESSION['login'])) { // variável login existe, então usuário está logado ?>
                <div id="bloco-msg-login">
                    <p>Olá, <?php echo $_SESSION['login']; ?></p>
                    <a href="funcoes.php?acao=logout">Sair</a>
                </div>
            <?php } else { ?>
                <form action="cadastro.php">
                    <button class="btn btn-success" type="submit" id="btn-entrar">Entrar</button>
                </form>
            <?php } ?>
        </div>
    </header>
</div>