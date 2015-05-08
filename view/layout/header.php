<?php
require_once 'funcoes.php';
iniciaSessao();
?>
<div class="row">
	<header>
		<div class="col-md-2">
			<a href="index.php"><img alt="Logo PUC Minas Virtual" src="../img/img-logo-puc-minas-virtual.jpg" id="logo-puc" /></a>
		</div>
		<div id="bloco-titulo-cabecalho" class="col-md-8">
			<h1 id="titulo-01-header">Desenvolvimento de Aplicações WEB 2014</h1>
			<h3 id="titulo-02-header">Pós Graduação - PUC Minas</h3><br/>
			<p id="titulo-03-header">Yearbook</p>
		</div>
	
		<div class="col-md-2">
			<?php if (isset($_SESSION['login'])) { // variável login existe, então usuário está logado ?>
				<div id="bloco-msg-login">
					<p>Olá, <?php echo $_SESSION['login']; ?></p>
					<a href="funcoes.php?acao=logout">Sair</a>
				</div>
			<?php } else { ?>
				<form id="form" action="funcoes.php?acao=login" method="post" class="form-inline" role="form">
					<div class="form-group">
						<label class="sr-only" for="exemploLogin">Login</label>
						<input class="input-login form-control" type="text" name="login" placeholder="login" required />
					</div>
					<div class="form-group">
						<label class="sr-only" for="exemploSenha">Senha</label>
						<input class="input-login form-control" type="password" name="senha" placeholder="senha" required />
					</div>
					<div class="checkbox" id="checkbox-lembrar-senha">
						<label id="label-lembrar-senha-login" class="input-login">
							<input type="checkbox" id="input-lembra-senha-login" name="lembrar-senha" checked="checked"/>
							Lembrar Senha
						</label>
					</div>
					<input type="submit" value="Entrar" id="btn-login" class="btn btn-primary"/>
				</form>
			<?php } ?>
		</div>
	</header>
</div>