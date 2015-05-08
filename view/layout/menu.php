<?php if (isset($_SESSION['login'])){ ?>
<nav class="navbar navbar-default" role="navigation">
	<div class="container">		
		<ul class="nav navbar-nav">
			<li><a href="funcoes.php?acao=pesquisa">Participantes</a></li>
			<li><a href="meu-cadastro.php">Meu Cadastro</a></li>
		</ul>
  </div><!-- /.container-fluid -->
</nav>
<?php } ?>