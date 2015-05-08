<?php

require_once '../model/Participantes.php';
require_once 'DAO.php';

class ParticipantesDAO extends DAO {

    public function insert(Participantes $participante) {
        $con = $this->getCon();
        $con->beginTransaction();

        try {
            $stmt = $con->prepare(
                    'INSERT INTO participantes (login, senha, nomeCompleto, '
                    . 'arquivoFoto, cidade, email, descricao) VALUES (:login, :senha, '
                    . ':nomeCompleto, :arquivoFoto, :cidade, :email, :descricao)');

            $stmt->bindValue(':login', $participante->getLogin());
            $stmt->bindValue(':senha', $participante->getSenha());
            $stmt->bindValue(':nomeCompleto', $participante->getNomeCompleto());
            $stmt->bindValue(':arquivoFoto', $participante->getArquivoFoto());
            $stmt->bindValue(':cidade', $participante->getCidade());
            $stmt->bindValue(':email', $participante->getEmail());
            $stmt->bindValue(':descricao', $participante->getDescricao());

            $stmt->execute();
            $con->commit();
        } catch (Exception $exc) {
            $con->rollBack();
        }
    }

    public function pesqOrdemAlfabetica() {
        $con = $this->getCon();

        $stmt = $con->query(
                'SELECT * FROM participantes ORDER BY nomeCompleto');
        $participantes = $this->processaResultado($stmt);

        return $participantes;
    }
    
    public function pesqPorNome($nome){
        $con = $this->getCon();

        $stmt = $con->prepare(
                'SELECT * FROM participantes WHERE nomeCompleto like :nome');
        $stmt->bindValue(':nome', '%'. $nome . '%');
        $stmt->execute();
        $participante = $this->processaResultado($stmt);

        return $participante;
    }
    
    public function pesqPorLogin($login){
        $con = $this->getCon();

        $stmt = $con->prepare(
                'SELECT * FROM participantes WHERE login like :login');
        $stmt->bindValue(':login', $login);
        $stmt->execute();
        $participante = $this->processaResultado($stmt);

        return $participante;
    }

    public function alterar($participante){
        $con = $this->getCon();
        $con->beginTransaction();

        try {
            $stmt = $con->prepare(
                    'UPDATE participantes SET senha = :senha, '
                    . 'nomeCompleto = :nomeCompleto, arquivoFoto = :arquivoFoto, '
                    . 'cidade = :cidade, email = :email, descricao = :descricao '
                    . 'WHERE login like :login)');

            $stmt->bindValue(':login', $participante->getLogin());
            $stmt->bindValue(':senha', $participante->getSenha());
            $stmt->bindValue(':nomeCompleto', $participante->getNomeCompleto());
            $stmt->bindValue(':arquivoFoto', $participante->getArquivoFoto());
            $stmt->bindValue(':cidade', $participante->getCidade());
            $stmt->bindValue(':email', $participante->getEmail());
            $stmt->bindValue(':descricao', $participante->getDescricao());

            $stmt->execute();
            $con->commit();
        } catch (Exception $exc) {
            $con->rollBack();
        }
    }
    
    private function processaResultado($statement) {
        $resultado = array();

        if ($statement) {
            while ($row = $statement->fetch(PDO::FETCH_OBJ)) {
                $participante = new Participantes();

                $participante->setArquivoFoto($row->arquivoFoto);
                $participante->setCidade($row->cidade);
                $participante->setDescricao($row->descricao);
                $participante->setEmail($row->email);
                $participante->setLogin($row->login);
                $participante->setNomeCompleto($row->nomeCompleto);
                $participante->setSenha($row->senha);

                $resultado[] = $participante;
            }
        }

        return $resultado;
    }

}

?>