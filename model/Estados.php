<?php

class Estados {

    private $idEstado;
    private $siglaEstado;
    private $nomeEstado;

    public function setIdEstado($idEstado) {
        $this->idEstado = $idEstado;
    }
    
    public function setSiglaEstado($siglaEstado){
        $this->siglaEstado = $siglaEstado;
    }
    
    public function setNomeEstado($nomeEstado){
        $this->nomeEstado = $nomeEstado;
    }
    
    public function getIdEstado(){
        return $this->idEstado;
    }
    
    public function getSiglaEstado(){
        return $this->siglaEstado;
    }
    
    public function getNomeEstado(){
        return $this->nomeEstado;
    }

}
?>

