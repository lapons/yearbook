<div class="row">
    <nav class="navbar navbar-default" id="menu-principal">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Menu</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="nav navbar-nav">
                    <li><a href="sobre-trabalho.php">Sobre o trabalho</a></li>
                    <li><a href="sobre-autor.php">Autor</a></li>
                    <?php if (isset($_SESSION['login'])) { ?>
                        <li><a href="funcoes.php?acao=pesquisa">Participantes</a></li>
                        <li><a href="meu-cadastro.php">Meu Cadastro</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
</div>