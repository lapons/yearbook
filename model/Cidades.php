<?php

class Cidades {
    
    private $idCidade;
    private $idEstado;
    private $nomeCidade;
    
    public function getIdCidade(){
        return $this->idCidade;
    }
    
    public function getIdEstado(){
        return $this->idEstado;
    }
    
    public function getNomeCidade(){
        return $this->nomeCidade;
    }
    
    public function setIdCidade($idCidade){
        $this->idCidade = $idCidade;
    }
    
    public function setIdEstado($idEstado){
        $this->idEstado = $idEstado;
    }
    
    public function setNomeCidade($nomeCidade){
        $this->nomeCidade = $nomeCidade;
    }
}
?>
