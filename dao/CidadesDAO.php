<?php

require_once '../model/Cidades.php';
require_once 'DAO.php';

class CidadesDAO extends DAO {

    public function getPorIdEstado($idEstado) {
        $con = $this->getCon();

        $stmt = $con->prepare(
                'SELECT * FROM cidades WHERE idEstado = :idEstado');
        $stmt->bindValue(':idEstado', $idEstado);
        $stmt->execute();

        $cidades = $this->processaResultado($stmt);

        return $cidades;
    }

    public function getPorId($idCidade) {
        $con = $this->getCon();

        $stmt = $con->prepare(
                'SELECT * FROM cidades WHERE idCidade = :idCidade');
        $stmt->bindValue(':idCidade', $idCidade);
        $stmt->execute();

        $cidades = $this->processaResultado($stmt);

        return $cidades;
    }

    private function processaResultado($statement) {
        $resultado = array();

        if ($statement) {
            while ($row = $statement->fetch(PDO::FETCH_OBJ)) {
                $cidade = new Cidades();

                $cidade->setIdCidade($row->idCidade);
                $cidade->setIdEstado($row->idEstado);
                $cidade->setNomeCidade($row->nomeCidade);

                $resultado[] = $cidade;
            }
        }

        return $resultado;
    }

}
?>

