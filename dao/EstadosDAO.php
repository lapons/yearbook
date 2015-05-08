<?php

include_once 'DAO.php';
include_once '../model/Estados.php';

class EstadosDAO extends DAO {

    public function getAllOrdemAlfabetica() {
        $con = $this->getCon();

        $stmt = $con->query(
                'SELECT * FROM estados ORDER BY nomeEstado');
        $estados = $this->processaResultado($stmt);
        
        return $estados;
    }

    private function processaResultado($statement) {
        $resultado = array();

        if ($statement) {
            while ($row = $statement->fetch(PDO::FETCH_OBJ)) {
                $estado = new Estados();

                $estado->setIdEstado($row->idEstado);
                $estado->setNomeEstado($row->nomeEstado);
                $estado->setSiglaEstado($row->siglaEstado);

                $resultado[] = $estado;
            }
        }

        return $resultado;
    }

}

?>
