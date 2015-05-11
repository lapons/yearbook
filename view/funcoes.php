<?php

require_once '../dao/ParticipantesDAO.php';
require_once '../dao/CidadesDAO.php';
require_once '../dao/EstadosDAO.php';

if (isset($_GET['acao'])) {
    if ($_GET['acao'] == 'login') {
        login();
    } else if ($_GET['acao'] == 'pesquisa') {
        pesquisa();
    } else if ($_GET['acao'] == 'logout') {
        logout();
    } else if ($_GET['acao'] == 'cadastro') {
        cadastro();
    } else if ($_GET['acao'] == 'alterar') {
        alterar();
    }
}

function login() {
    $login = $_POST['login'];
    $senha = $_POST['senha'];
    $lembrar_senha = $_POST['lembrar-senha'];

    $participantesDAO = new ParticipantesDAO();
    $participante = $participantesDAO->pesqPorLogin($login);

    iniciaSessao();
    if ($participante) {

        if ($senha == $participante[0]->getSenha()) { // senha ok
            $_SESSION['erro-login'] = false;
            $_SESSION['login'] = $login;
            $_SESSION['participante-logado'] = $participante[0];
            header('refresh: 0; url=funcoes.php?acao=pesquisa');
        } else { // senha incorreta
            $_SESSION['erro-login'] = 1;
            header('refresh: 0; url=cadastro.php'); // redireciona para a página de cadastro com erros
        }
    } else { // não entrou com login correto
        $_SESSION['erro-login'] = 2;
        header('refresh: 0; url=cadastro.php'); // redireciona para a página de cadastro com erros
    }
}

function logout() {
    iniciaSessao();
    session_destroy();
    header('refresh: 0; url=index.php');
}

function iniciaSessao() {
    if (!isset($_SESSION)) {
        session_start();
    }
}

function pesquisa() {
    iniciaSessao();
    $participantesDAO = new ParticipantesDAO();
    $cidadesDAO = new CidadesDAO();
    $estadosDAO = new EstadosDAO();

    if (strlen($_POST['txt-pesquisa']) == 0) { // pesquisa todos
        $participantes = $participantesDAO->pesqOrdemAlfabetica();

        $cidades = array();
        $estados = array();
        foreach ($participantes as $participante) {
            $cidades[] = $cidadesDAO->getPorId($participante->getCidade());
            $idEstado = $cidades[sizeof($cidades) - 1][0]->getIdEstado();
            $estados[] = $estadosDAO->getPorId($idEstado);
        }
    } else { // pesquisa pelo nome desejado
        $nome = $_POST['txt-pesquisa'];

        if ($nome == "" || $nome == NULL) { // não escreveu nada no campo de pesquisa (pesquisa todos)
            $participantes = $participantesDAO->pesqOrdemAlfabetica();
        } else {
            $participantes = $participantesDAO->pesqPorNome($nome);
        }

        $cidades = array();
        $estados = array();

        if ($participantes != NULL) {
            foreach ($participantes as $participante) {
                $cidades[] = $cidadesDAO->getPorId($participante->getCidade());
                $idEstado = $cidades[sizeof($cidades) - 1][0]->getIdEstado();
                $estados[] = $estadosDAO->getPorId($idEstado);
            }
        }
    }

    $_SESSION['participantes'] = $participantes;
    $_SESSION['cidades'] = $cidades;
    $_SESSION['estados'] = $estados;
    header('refresh: 0; url=participantes.php');
}

function cadastro() {

    require_once '../model/Participantes.php';
    require_once '../dao/ParticipantesDAO.php';

    $participante = new Participantes();

    $nome_final = efetuaUploadFoto();

    $participante->setLogin($_POST['login']);
    $participante->setSenha($_POST['senha']);
    $participante->setArquivoFoto($nome_final);
    $participante->setNomeCompleto($_POST['nomeCompleto']);
    $participante->setCidade(intval($_POST['cidade']));
    $participante->setEmail($_POST['email']);
    $participante->setDescricao($_POST['descricao']);

    $participanteDAO = new ParticipantesDAO();

    $participanteDAO->insert($participante);
}

function efetuaUploadFoto() {
    // Pasta onde serão salvas as fotos
    $_UP['pasta'] = '../img/fotos/';

    // Tamanho máximo do arquivo em bytes
    $_UP['tamanho'] = 1024 * 1024 * 5; // 5MB
    // Array com as extensões permitidas
    $_UP['extensoes'] = array('jpg', 'png', 'gif');

    // Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
    $_UP['renomeia'] = true;

    // Array com os tipos de erros de upload do PHP
    $_UP['erros'][0] = 'Não houve erro';
    $_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
    $_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
    $_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
    $_UP['erros'][4] = 'Não foi feito o upload do arquivo';

    // Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
    if ($_FILES['arquivoFoto']['error'] != 0) {
        die("Não foi possível fazer o upload, erro:<br />" . $_UP['erros'][$_FILES['arquivoFoto']['error']]);
        exit; // Para a execução do script
    }

    // Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar
    // Faz a verificação da extensão do arquivo
    $temp = explode('.', $_FILES['arquivoFoto']['name']);
    $extensao = strtolower(end($temp));

    if (array_search($extensao, $_UP['extensoes']) === false) {
        echo "Por favor, envie arquivos com as seguintes extensões: jpg, png ou gif";
    }

    // Faz a verificação do tamanho do arquivo
    else if ($_UP['tamanho'] < $_FILES['arquivoFoto']['size']) {
        echo "O arquivo enviado é muito grande, envie arquivos de até 5Mb.";
    }

    // O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
    else {
        // Primeiro verifica se deve trocar o nome do arquivo
        if ($_UP['renomeia'] == true) {
            // Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
            $nome_final = time() . '.jpg';
        } else {
            // Mantém o nome original do arquivo
            $nome_final = $_FILES['arquivoFoto']['name'];
        }

        // Depois verifica se é possível mover o arquivo para a pasta escolhida
        if (move_uploaded_file($_FILES['arquivoFoto']['tmp_name'], $_UP['pasta'] . $nome_final)) {
            // Upload efetuado com sucesso, exibe uma mensagem.
            //echo "Upload efetuado com sucesso!<br/>";
            //echo "Você será redirecionado em 4 segundos...";
            header('refresh: 0; url=funcoes.php?acao=pesquisa');
            return $nome_final;
        } else {
            // Não foi possível fazer o upload, provavelmente a pasta está incorreta
            echo "Não foi possível enviar o arquivo, tente novamente";
        }
    }
}

function alterar() {

    require_once '../model/Participantes.php';
    require_once '../dao/ParticipantesDAO.php';

    iniciaSessao();
    $participante = $_SESSION['participante-logado'];
    $nova_senha = $_POST['nova-senha'];
    $repetir_nova_senha = $_POST['repetir-nova-senha'];

    if ($_FILES['arquivoFoto']['error'] == 0) { // selecionou algum outra imagem
        $nome_final = efetuaUploadFoto();
    } else { // não selecionou nenhuma imagem
        $nome_final = $participante->getArquivoFoto(); // pego a mesma imagem
    }

    if ($nova_senha == $repetir_nova_senha) {
        $participante->setSenha($nova_senha);
    } else { // digitou senhas diferentes
        header('refresh: 0; url=funcoes.php?acao=alterar');
        return;
    }
    $participante->setArquivoFoto($nome_final);
    $participante->setNomeCompleto($_POST['nomeCompleto']);
    $participante->setCidade(intval($_POST['cidade']));
    $participante->setEmail($_POST['email']);
    $participante->setDescricao($_POST['descricao']);

    $participanteDAO = new ParticipantesDAO();

    $participanteDAO->alterar($participante);
    header('refresh: 0; url=funcoes.php?acao=pesquisa');
}

?>