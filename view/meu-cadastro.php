<?php
require_once './funcoes.php';

iniciaSessao();
$participante_logado = $_SESSION['participante-logado'];
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Yearbook - Meu cadastro</title>
        <meta charset="UTF-8">
        <link type="text/css" rel="stylesheet" href="../css/estilo.css"/>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#estado').change(function() {
                    $('#cidade').load('listaCidades.php?estado=' + $('#estado').val());
                });
            });
        </script>
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
        include_once '../dao/EstadosDAO.php';
        include_once '../dao/CidadesDAO.php';
        include_once '../model/Cidades.php';
        include_once './layout/header.php';
        include_once './layout/menu.php';

        $estadoDAO = new EstadosDAO();
        $cidadeDAO = new CidadesDAO();

        $estados = $estadoDAO->getAllOrdemAlfabetica();
        $id_cidade_part_logado = $participante_logado->getCidade();
        $cidade_part_logado = $cidadeDAO->getPorId($id_cidade_part_logado);
        $cidade_part_logado = $cidade_part_logado[0];
        $cidades = $cidadeDAO->getPorIdEstado($cidade_part_logado->getIdEstado()); // pesquiso todas as cidades para preenchimento do select
        ?>
		<div class="row">
			<div class="col-lg-8">
				<div class="panel panel-default">
					<div class="panel-heading">Meu Cadastro</div>
					<div class="panel-body">
						<section class="conteudo">
							<form method="POST" action="funcoes.php?acao=alterar" id="form-alteracao-cadastro" enctype="multipart/form-data" role="form">
								<div class="linha-form form-group">
									<label class="label-cadastro" for="login">Login</label>
									<input type="text" class="form-control" name="login" disabled value="<?php echo $participante_logado->getLogin(); ?>"/><br/>
								</div>
								<div class="linha-form form-group">
									<label class="label-cadastro" for="novaSenha">Nova Senha</label>
									<input type="password" class="form-control" name="nova-senha" required value="<?php echo $participante_logado->getSenha(); ?>"/><br/>
								</div>
								<div class="linha-form form-group">
									<label class="label-cadastro" for="repetirSenha">Repita a nova senha</label>
									<input type="password" class="form-control" name="repetir-nova-senha" required  value="<?php echo $participante_logado->getSenha(); ?>" /><br/>
								</div>
								<div class="linha-form form-group">
									<label class="label-cadastro" for="foto">Foto</label>
									<input type="file" name="arquivoFoto" /><br/>
								</div>
								<div class="linha-form form-group">
									<label class="label-cadastro" for="nomeCompleto">Nome Completo</label>
									<input type="text" class="form-control" name="nomeCompleto" required value="<?php echo $participante_logado->getNomeCompleto(); ?>"/><br/>
								</div>
								<div class="linha-form form-group">
									<label class="label-cadastro" for="estado">Estado</label>
									<select name="estado" id="estado" required class="form-control">
										<option value=""></option>
										<?php
										foreach ($estados as $estado) {
											if ($estado->getIdEstado() == $cidade_part_logado->getIdEstado()) {
												?>
												<option value="<?php echo $estado->getIdEstado(); ?>" selected ><?php echo $estado->getNomeEstado(); ?></option>
											<?php } else { ?>
												<option value="<?php echo $estado->getIdEstado(); ?>"><?php echo $estado->getNomeEstado(); ?></option>
												<?php
											}
										}
										?>
									</select>
								</div>
								<div class="linha-form form-group" id="cidade">
									<label class='label-cadastro' for="cidade">Cidade</label>
									<select name='cidade' required class="form-control" >
										<option></option>
										<?php
										foreach ($cidades as $cidade) {
											if ($cidade->getIdCidade() == $cidade_part_logado->getIdCidade()) {
												?>
												<option value='<?php echo $cidade->getIdCidade(); ?>' selected ><?php echo $cidade->getNomeCidade(); ?></option>
											<?php } else { ?>
												<option value='<?php echo $cidade->getIdCidade(); ?>'><?php echo $cidade->getNomeCidade(); ?></option>
												<?php
											}
										}
										?>
									</select>
								</div>
								<div class="linha-form form-group">
									<label class="label-cadastro" for="email">E-mail</label>
									<input type="email" name="email" class="form-control" required value="<?php echo $participante_logado->getEmail(); ?>" /><br/>
								</div>
								<div class="linha-form">
									<label class="label-cadastro">Descrição</label>
									<textarea name="descricao" class="form-control" required ><?php echo $participante_logado->getDescricao(); ?></textarea><br/>
								</div>
								<button type="submit" value="Salvar" id="btn-cadastrar" class="btn btn-primary">Salvar</button>

							</form>
							<figure id="img-alteracao-cadastro">
								<img src="../img/fotos/<?php echo $participante_logado->getArquivoFoto(); ?>" alt="<?php echo $participante_logado->getNomeCompleto(); ?>"
							</figure>
						</section>
					</div>
				</div>
			</div>
		</div>
    </body>
</html>