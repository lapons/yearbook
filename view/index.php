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
    </head>
    <body>
		<?php
		require_once '../dao/ParticipantesDAO.php';

		// Pesquisa dos participantes cadastrados
		$participantesDAO = new ParticipantesDAO();
		$participantes = $participantesDAO->pesqOrdemAlfabetica();
		
		// Inclusão do header na página
		require_once 'layout/header.php';
		
		// Inclusão do menu
		require_once 'layout/menu.php';
		?>
		<div class="row">
			<div class="col-lg-12">
				<section class="conteudo">
				<div class="col-lg-12" id="apresentacao">
					<p>Yearbook do curso de pós graduação em Desenvolvimento de Aplicações 
						WEB da PUC Minas Virtual 1º semestre de 2014.</p>
					<p>Faça parte da nossa turma, <a href="cadastro.php">cadastre-se</a> você também!</p>
				</div>
				<div class="col-lg-12">
					<p id="titulo-lista-pessoas">Usuários já cadastrados</p>
				</div>
				<ul>
					<?php
					$contUsuarios = 6; // variável temp para contar quantos usuários já foram inseridos
					foreach ($participantes as $participante) {
						?>
						<li>
							<figure class="pessoa">
								<a href="pagina-pessoal.php?participante=<?php echo $participante->getLogin(); ?>" ><img alt="<?php echo $participante->getNomeCompleto(); ?>" class="foto" src="../img/fotos/<?php echo $participante->getArquivoFoto(); ?>" /></a>
								<figcaption>
									<a href="pagina-pessoal.php?participante=<?php echo $participante->getLogin(); ?>" class="nome"><?php echo $participante->getNomeCompleto(); ?></a>
								</figcaption>
							</figure>
						</li>
						<?php
						$contUsuarios--;
						if (!$contUsuarios) {
							exit();
						}
					}
					?>
				</ul>
			</section>
		</div>
		<?php
			// Inclusão do footer na página
			require_once 'layout/footer.php';
		?>
		
		
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="../js/bootstrap.min.js"></script>
		
    </body>
</html>
